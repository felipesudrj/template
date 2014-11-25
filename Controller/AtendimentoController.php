<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::import('Vendor', 'ex/simplexlsx');

/**
 * CakePHP AtendimentoController
 * @author felipe
 */
class AtendimentoController extends AppController {

    public $uses = array(
        'Atendimento', 'TipoServico', 'StatusAtendimento', 'Rat', 'Importacao',
        'Agendamento', 'Atribuicao', 'Tecnico', 'MaterialDistribuido', 'MaterialUtilizado');
    public $components = array('Session');

    public function tecnico() {

        $breadcrumb = array(
            '/' => 'Painel Inicial',
            '' => 'Lista de chamados'
        );
        $this->set(compact('breadcrumb'));
        $statusAtendimento = $this->StatusAtendimento->find('list', array('fields' => array('status_atendimento_id', 'descricao')));
        $tipoServico = $this->TipoServico->find('list', array('fields' => array('tipo_servico_id', 'descricao')));


        $optio = array(
            'nros' => array(
                'Atendimento.nros' => array(
                    'operator' => '='
                )
            ),
            'agendamento' => array(
                'agendamento.data_agendamento' => array(
                    'operator' => 'BETWEEN',
                    'between' => array(
                        'text' => __(' e ', true),
                        'date' => true
                    )
                )
            ),
            'tipoServico' => array(
                'Atendimento.tipo_servico_id' => array(
                    'operator' => '=',
                    'select' => $this->FilterResults->select('Todos', $tipoServico)
                )
            ),
            'statusAtendimento' => array(
                'Atendimento.status_atendimento_id' => array(
                    'operator' => '=',
                    'select' => $this->FilterResults->select('Todos', $statusAtendimento)
                )
            )
        );
        $this->FilterResults->addFilters($optio);
        $this->FilterResults->setPaginate('group', 'Atendimento.nros');  // optional

        $this->FilterResults->setPaginate('limit', 10);              // optional
        $conditions = $this->FilterResults->getConditions();
        $conditions['Atendimento.tecnico_id'] = 11;
        $this->FilterResults->setPaginate('conditions', $conditions);

        $atendimentos = $this->Paginate('Atendimento');
        $this->set('atendimento', $atendimentos);
    }

    public function index() {
        
    }

    public function alterar($atendimento_id) {

        $breadcrumb = array(
            '/' => 'Painel inicial',
            '' => 'Dados da demanda'
        );
        $this->set(compact('breadcrumb'));

        $atendimento = $this->Atendimento->findByatendimento_id($atendimento_id);

        $this->request->data = $atendimento;
        $tipoServico = $this->TipoServico->find('list', array('fields' => array('tipo_servico_id', 'descricao')));
        $statusAtendimento = $this->StatusAtendimento->find('list', array('fields' => array('status_atendimento_id', 'descricao')));
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));


//        pr($atendimento);
        $this->set(compact('atendimento', 'tipoServico', 'statusAtendimento', 'tecnicos'));
    }

    public function ajaxEditarAtendimento() {
        $dataSource = $this->Atendimento->getDataSource();
        $dados = $this->request->data;

        if ($this->Auth->user('tipo_usuario_id') == '1') {



            $dataSource->begin();
            try {

                $this->Atendimento->saveAll($dados);
                $dataSource->commit();
                $retorno = array('msg' => 'Ordem de serviço salva com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success');
                echo json_encode($retorno);
                die;
            } catch (Exception $e) {

                $dataSource->rollback();
                $msg = "Ocorreu um erro ao realizar essa operação" . $e->getMessage();
                $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }
        } else {

            $retorno = array('msg' => 'Não foi possível realizar essa operação, você não tem permissão de administrador para alterar uma OS', 'titulo' => 'Atenção', 'tipo' => 'warning');
            echo json_encode($retorno);
            die;
        }
    }

    public function importar() {
        $breadcrumb = array(
            '/' => 'Painel Inicial',
            '' => 'Importar demandas'
        );
        $this->set(compact('breadcrumb'));
        $dataSource = $this->Atendimento->getDataSource();

        if ($this->request->is('post')) {

            /* MOVER ARQUIVO PARA PASTA TEMPORARIA */
            $arquivo = $this->request->data['Atendimento']['file']['tmp_name'];
            $xlsx = new SimpleXLSX($arquivo);
            $dados = $xlsx->rows();

            $protocolo = date('YmdHis');
            $totalImportado = 0;
            $repetidos = array();
            $valida_cabecalho = false;

            
            
            /* VALIDAR CABEÇALHO DO ARQUIVO */
            if ($this->request->data['Atendimento']['tipo_id'] == 1) {
                if ($dados['0']['4'] == "CONTRATO" && $dados['0']['2'] == 'OS' && $dados['0']['5'] == 'CLIENTE') {
                    $valida_cabecalho = true;
                }
            } else {

                if ($dados['0']['2'] == "CONTRATO" && $dados['0']['0'] == 'OS' && $dados['0']['3'] == 'CLIENTE') {
                    $valida_cabecalho = true;
                }
            }

            
            if ($valida_cabecalho == true) {


                if ($this->request->data['Atendimento']['tipo_id'] == 1) {


                    foreach ($dados as $indice => $valor) {
                        if (!empty($valor['3'])) {

                            if ($indice != 0) {

                                $salvar['Atendimento']['protocolo'] = $protocolo;
                                $salvar['Atendimento']['nros'] = $valor['2']; /* Ordem de servico */
                                $salvar['Atendimento']['nrcontrato'] = $valor['4']; /* Contrato */
                                $salvar['Atendimento']['observacoes'] = $valor['19']; /* observacoes */
                                $salvar['Atendimento']['tarefa'] = $valor['13']; /* Tarefa */
                                $salvar['Atendimento']['periodo'] = $valor['14']; /* Periodo */


                                switch ($valor['12']) {
                                    case 'Habilitação': $tipo_servico = 1;
                                        break;
                                    case '001 - Habilitação':$tipo_servico = 1;
                                        break;
                                    case 'Retirada de Equipamento': $tipo_servico = 2;
                                        break;
                                    case '002 - Retirada de Equipamento':$tipo_servico = 2;
                                        break;
                                    case 'Habilitação Ponto Adicionar': $tipo_servico = 4;
                                        break;

                                    case '003 - Habilitação de Ponto Adicional':$tipo_servico = 4;
                                        break;
                                    default : $tipo_servico = 5;
                                        break;
                                }
                                $salvar['Atendimento']['tipo_servico_id'] = $tipo_servico; /* observacoes */


                                $salvar['Cliente']['nome'] = $valor['5']; /* Cliente */
                                $salvar['Cliente']['logradouro'] = $valor['6']; /* Logradouro */
                                $salvar['Cliente']['numero'] = $valor['7']; /* Numero */
                                $salvar['Cliente']['complemento'] = $valor['8']; /* Complemento */
                                $salvar['Cliente']['bairro'] = $valor['9']; /* Bairro */
                                $salvar['Cliente']['cidade'] = $valor['10']; /* Cidade */
                                $salvar['Cliente']['estado'] = ''; /* Cidade */
                                $salvar['Cliente']['telefone1'] = $valor['16']; /* Fone */
                                $salvar['Cliente']['telefone2'] = $valor['17']; /* Fone */
                                $salvar['Cliente']['telefone3'] = $valor['18']; /* Fone */

                                /* CRIAR AGENDAMENTO */
                                if ($valor['5'] == "AG") {
                                    $valor['6'] = date('Y-m-d', strtotime('+1 day', $xlsx->unixstamp($valor['6'])));

                                    $salvar['Atendimento']['status_atendimento_id'] = 2; /* status atendimento id */
                                    $salvar['Agendamento']['data_agendamento'] = $valor['6'];
                                    $salvar['Agendamento']['contato'] = $valor['14'];
                                } else {

                                    $salvar['Atendimento']['status_atendimento_id'] = 1; /* status atendimento id */
                                }


                                try {
                                    $dataSource->begin();
                                    $this->Atendimento->create();
                                    $this->Atendimento->saveAll($salvar);
                                    $dataSource->commit();
                                    $totalImportado++;
                                } catch (Exception $exc) {

                                    $atendimento = $this->Atendimento->findBynros($salvar['Atendimento']['nros']);

                                    $repetidos[$indice] = $atendimento;

                                    $msg = $exc->getMessage();
                                    $dataSource->rollback();
                                }
                            }
                        }
                    } /* foreach */
                } else {


                    foreach ($dados as $indice => $valor) {

                        if (!empty($valor['3'])) {

                            if ($indice != 0) {

                                $salvar['Atendimento']['protocolo'] = $protocolo;
                                $salvar['Atendimento']['nros'] = $valor['0']; /* Ordem de servico */
                                $salvar['Atendimento']['nrcontrato'] = $valor['2']; /* Contrato */
                                $salvar['Atendimento']['observacoes'] = $valor['17']; /* observacoes */
                                $salvar['Atendimento']['tarefa'] = $valor['11']; /* Tarefa */
                                $salvar['Atendimento']['periodo'] = $valor['12']; /* Periodo */


                                switch ($valor['10']) {
                                    case 'Habilitação': $tipo_servico = 1;
                                        break;
                                    case '001 - Habilitação':$tipo_servico = 1;
                                        break;
                                    case 'Retirada de Equipamento': $tipo_servico = 2;
                                        break;
                                    case '002 - Retirada de Equipamento':$tipo_servico = 2;
                                        break;
                                    case 'Habilitação Ponto Adicionar': $tipo_servico = 4;
                                        break;

                                    case '003 - Habilitação de Ponto Adicional':$tipo_servico = 4;
                                        break;
                                }
                                $salvar['Atendimento']['tipo_servico_id'] = $tipo_servico; /* observacoes */


                                $salvar['Cliente']['nome'] = $valor['3']; /* Cliente */
                                $salvar['Cliente']['logradouro'] = $valor['4']; /* Logradouro */
                                $salvar['Cliente']['numero'] = $valor['5']; /* Numero */
                                $salvar['Cliente']['complemento'] = $valor['6']; /* Complemento */
                                $salvar['Cliente']['bairro'] = $valor['7']; /* Bairro */
                                $salvar['Cliente']['cidade'] = $valor['8']; /* Cidade */
                                $salvar['Cliente']['estado'] = ''; /* Cidade */
                                $salvar['Cliente']['telefone1'] = $valor['14']; /* Fone */
                                $salvar['Cliente']['telefone2'] = $valor['15']; /* Fone */
                                $salvar['Cliente']['telefone3'] = $valor['16']; /* Fone */

                                /* CRIAR AGENDAMENTO */
                                if ($valor['5'] == "AG") {
                                    $valor['6'] = date('Y-m-d', strtotime('+1 day', $xlsx->unixstamp($valor['6'])));

                                    $salvar['Atendimento']['status_atendimento_id'] = 2; /* status atendimento id */
                                    $salvar['Agendamento']['data_agendamento'] = $valor['6'];
                                    $salvar['Agendamento']['contato'] = $valor['14'];
                                } else {

                                    $salvar['Atendimento']['status_atendimento_id'] = 1; /* status atendimento id */
                                }


                                try {
                                    $dataSource->begin();
                                    $this->Atendimento->create();
                                    $this->Atendimento->saveAll($salvar);
                                    $dataSource->commit();
                                    $totalImportado++;
                                } catch (Exception $exc) {

                                    $atendimento = $this->Atendimento->findBynros($salvar['Atendimento']['nros']);

                                    $repetidos[$indice] = $atendimento;

                                    $msg = $exc->getMessage();
                                    $dataSource->rollback();
                                }
                            }
                        }
                    } /* foreach */
                } /* if tipo */
            
                
                
                                } else {
            
                $this->Session->setFlash('Não foi possível realizar a importação, principais motivos:'
                        . '<ul>'
                        . '<li>Formato de arquivo inválido. Faça o download do modelo correto <a href="/modelo_rota.xlsx">Modelo arquivo de Rota Diária</a> | <a href="/modelo_backlog.xlsx">Modelo arquivo Backlog</a></li>'
                        . '<li>Dados informações da planilha estão corrompidas.</li> '
                        . '<li>Tipo de serviço selecionado e planilha não são compatíveis</li>'
                        . '<ul>',null,null,'negar');
            }









            $total = count($repetidos);

            $this->set('totalImportado', $totalImportado);
            $this->set('total', $total);
            $this->set('repetidos', $repetidos);
        }
    }

    private function insertAgendamento($id, $data) {

        $agendamento['Agendamento']['atendimento_id'] = $id;
        $agendamento['Agendamento']['data_agendamento'] = $data;

        $this->Agendamento->create();
        $this->Agendamento->save($agendamentoag);
        return true;
    }

    public function listar() {

        if($this->Auth->user('tipo_usuario_id')!='1'){
            $this->redirect(array('controller'=>'Atendimento','action'=>'tecnico'));
        }
        
        $breadcrumb = array(
            '/' => 'Painel Inicial',
            '' => 'Lista de demandas'
        );
        $this->set(compact('breadcrumb'));

        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
        $statusAtendimento = $this->StatusAtendimento->find('list', array('fields' => array('status_atendimento_id', 'descricao')));
        $tipoServico = $this->TipoServico->find('list', array('fields' => array('tipo_servico_id', 'descricao')));



        $optio = array(
            'nros' => array(
                'Atendimento.nros' => array(
                    'operator' => '='
                )
            ),
            'nomeCliente' => array(
                'Cliente.nome' => array(
                    'operator' => 'LIKE'
                )
            ),
            'tipoServico' => array(
                'Atendimento.tipo_servico_id' => array(
                    'operator' => '=',
                    'select' => $this->FilterResults->select('Todos', $tipoServico)
                )
            ),
            'tecnico' => array(
                'Atendimento.tecnico_id' => array(
                    'operator' => '=',
                    'select' => $this->FilterResults->select('Todos', $tecnicos)
                )
            ),
            'statusAtendimento' => array(
                'Atendimento.status_atendimento_id' => array(
                    'operator' => '=',
                    'select' => $this->FilterResults->select('Todos', $statusAtendimento)
                )
            )
        );

        $this->FilterResults->addFilters($optio);
        $this->FilterResults->setPaginate('limit', 10);
        $this->FilterResults->setPaginate('group', 'Atendimento.nros');  // optional
// optional
        $conditions = $this->FilterResults->getConditions();
        $this->FilterResults->setPaginate('conditions', $conditions);

        $atendimentos = $this->Paginate('Atendimento');

        $this->set('atendimento', $atendimentos);
    }

    public function formatData($data) {
        $newData = explode('/', $data);
        return $newData['2'] . "-" . $newData['1'] . "-" . $newData['0'];
    }

    public function ajaxAgendar() {
        $dataSource = $this->Agendamento->getDataSource();
        $dados = $this->request->data;

        $update['Atendimento']['atendimento_id'] = $dados['Agendamento']['atendimento_id'];
        $update['Atendimento']['status_atendimento_id'] = '2';

        $dados['Agendamento']['data_agendamento'] = $this->formatData($dados['Agendamento']['data_agendamento']) . " " . date('H:i:s');

        if ($this->Auth->user('tipo_usuario_id') == '1') {


            $this->Agendamento->set($this->request->data);
            /*             * VALIDAR ENTRA DE DADOS E CAMPOS OBRIGATORIOS */
            if ($this->Agendamento->validates()) {


                $dataSource->begin();
                try {

                    $this->Agendamento->saveAll($dados);
                    $this->Atendimento->save($update);
                    $last_id = $this->Agendamento->id;

                    $dataSource->commit();
                    $retorno = array('msg' => 'Agendamento realizado com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success', 'id' => $last_id);
                    echo json_encode($retorno);
                    die;
                } catch (Exception $e) {

                    $dataSource->rollback();
                    $msg = "Ocorreu um erro ao realizar essa operação. " . $e->getMessage();
                    $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                    echo json_encode($retorno);
                    die;
                }
            } else {
                $errors = $this->Agendamento->validationErrors;
                $msg = "";
                foreach ($errors as $indice => $mensagem) {
                    $msg.= $mensagem['0'] . ".\n";
                };

                $retorno = array('msg' => $msg, 'titulo' => 'Erro de Validação', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }
        } else {

            $retorno = array('msg' => 'Não foi possível realizar essa operação, Você não tem permissão de administrador para Agendar uma OS', 'titulo' => 'Atenção', 'tipo' => 'warning');
            echo json_encode($retorno);
            die;
        }
    }

    public function ajaxRat() {

        $transaction = $this->Rat->getDataSource();
        $dados = $this->Session->read('itens');
        /* observacoes,numerorat,itens */
        $form = $this->request->data;


        $atendimento = $this->Atendimento->findByatendimento_id($form['Rat']['atendimento_id']);

        if ($atendimento['Atendimento']['status_atendimento_id'] < 3) {
            $msg = "Não é possível elaborar o preenchimento de RAT esse chamado não foi atribuido a nenhum técnico ou Não foi agendado.";
            $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
            echo json_encode($retorno);
            die;
        } elseif ($atendimento['Atendimento']['status_atendimento_id'] > 3) {
            $msg = "O preenchimento dessa RAT já foi realizado.";
            $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
            echo json_encode($retorno);
            die;
        }


        $form['Rat']['data_realizacao'] = $this->formatData($form['Rat']['data_realizacao']);

        $update['Atendimento']['atendimento_id'] = $form['Rat']['atendimento_id'];
        $update['Atendimento']['status_atendimento_id'] = '4';

        $tecnico_id = $this->Auth->user('Tecnico.tecnico_id');
        $form['Rat']['tecnico_id'] = $tecnico_id;

        $Atribuicao = $this->Atribuicao->find('first', array(
            'conditions' => array('Atribuicao.atendimento_id' => $form['Rat']['atendimento_id']),
            'order' => 'Atribuicao.data_atribuicao DESC'));



        /* VERIFICAR RAT É DO TÉCNICO OU O ADMINISTRADOR ESTA ATUANDO NA RAT */
        if ($this->Auth->user('tipo_usuario_id') == '1' || $Atribuicao['Atribuicao']['tecnico_id'] == $this->Auth->user('Tecnico.tecnico_id')) {

            /* VALIDAR PREENCHIMENTO DO CODIGO DA RAT */


            $this->Rat->set($this->request->data);

            if ($this->Rat->validates()) {

                $transaction->begin();
                try {
                    /*                     * SALVAR TODOS OS ITENS + NR RAT + DESCRICAO */
                    foreach ($dados as $indice => $content) {



                        $new['MaterialUtilizado'] = $dados[$indice];
                        $new['MaterialUtilizado']['atendimento_id'] = $form['Rat']['atendimento_id'];
                        $new['MaterialUtilizado']['tecnico_id'] = $this->Auth->user('Tecnico.tecnico_id');
                        $this->MaterialUtilizado->create();
                        $this->MaterialUtilizado->save($new);
                    }


                    $this->Rat->save($form);

                    $this->Atendimento->save($update);
                    $transaction->commit();
                    $retorno = array('msg' => 'Relatório técnico gravado com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success');
                    echo json_encode($retorno);
                    die;
                } catch (Exception $e) {

                    $transaction->rollback();
                    $msg = "Ocorreu um erro ao realizar essa operação" . $e->getMessage();
                    $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                    echo json_encode($retorno);
                    die;
                }
            } else {

                $msg = "O preenchimento do número da RAT é obrigatório";
                $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }
        } else {


            $msg = "Essa atividade não foi atribuida ao seu perfil";
            $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
            echo json_encode($retorno);
            die;
        }
    }

    public function ajaxAtribuir() {

        $dataSource = $this->Atribuicao->getDataSource();
        $dados = $this->request->data;

        $update['Atendimento']['atendimento_id'] = $dados['Atribuicao']['atendimento_id'];
        $update['Atendimento']['status_atendimento_id'] = '3';
        $update['Atendimento']['tecnico_id'] = $dados['Atribuicao']['tecnico_id'];
        $statusAgendamento = $this->Atendimento->findByatendimento_id($dados['Atribuicao']['atendimento_id']);
        $dados['Atribuicao']['data_execucao'] = $this->formatData($dados['Atribuicao']['data_execucao']) . " " . date('H:i:s');


        if ($this->Auth->user('tipo_usuario_id') == '1') {

            /*             * VERIFICAR SE O STATUS DE ATENDIMENTO Ã‰ AGENDADO SÃ“ ENTAO ATRIBUIR */
            if ($statusAgendamento['Atendimento']['status_atendimento_id'] >= 2) {

                $dataSource->begin();
                try {

                    $this->Atribuicao->saveAll($dados);
                    /* ALTERAR STATUS */
                    $this->Atendimento->save($update);


                    $dataSource->commit();

                    $retorno = array('msg' => 'Atribuição realiza com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success');
                    echo json_encode($retorno);
                    die;
                } catch (Exception $e) {

                    $dataSource->rollback();
                    $msg = "Ocorreu um erro ao realizar a atribuição." . $e->getMessage();
                    $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                    echo json_encode($retorno);
                    die;
                }
            } else {


                $retorno = array('msg' => 'Não foi permitido realizar a atribuição, essa OS não recebeu agendamento ', 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }
        } else {

            $retorno = array('msg' => 'Você não tem perfil de administrador', 'titulo' => 'Erro', 'tipo' => 'error');
            echo json_encode($retorno);
            die;
        }
    }

    public function ajaxVisualizaTabelaItens($atendimento_id) {

        $this->layout = null;

        $itensSalvos = $this->Session->read('itens');

        $materiais = $this->MaterialUtilizado->find('all', array('conditions' => array('MaterialUtilizado.atendimento_id' => $atendimento_id)));

        if ($materiais) {
            foreach ($materiais as $indice => $valor) {
                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['material_utilizado_id'] = $valor['MaterialUtilizado']['material_utilizado_id'];
                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['atendimento_id'] = $valor['MaterialUtilizado']['atendimento_id'];

                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['material_id'] = $valor['MaterialUtilizado']['material_id'];
                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['descricao'] = $valor['Material']['descricao'];
                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['quantidade'] = $valor['MaterialUtilizado']['quantidade'];
                $itensSalvos[$valor['MaterialUtilizado']['material_id']]['informacoes'] = $valor['MaterialUtilizado']['informacoes'];
            }
            $this->Session->write('itens', $itensSalvos);
        }

        $this->set('itens', $itensSalvos);
    }

    public function ajaxIncluirItemRat() {

        $this->layout = null;

        if ($this->request->is('post')) {

            if (empty($this->request->data['material_id'])) {
                $retorno = array('msg' => 'Selecione um tipo de material', 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            } else if (empty($this->request->data['quantidade'])) {
                $retorno = array('msg' => 'Informe a quantidade de materiais', 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }


            $existe = $this->Session->read('itens');

            if ($existe) {


                $dados = array(
                    'material_id' => $this->request->data['material_id'],
                    'descricao' => trim($this->request->data['descricao']),
                    'quantidade' => trim($this->request->data['quantidade']),
                    'informacoes' => trim($this->request->data['informacoes']));
                $novoItem = $this->Session->read('itens');
                $novoItem[$this->request->data['material_id']] = $dados;
                $this->Session->write('itens', $novoItem);
                $retorno = array('msg' => 'Item adicionado', 'titulo' => 'Sucesso', 'tipo' => 'success');
                echo json_encode($retorno);
                die;
            } else {


                $dados[$this->request->data['material_id']]['material_id'] = $this->request->data['material_id'];
                $dados[$this->request->data['material_id']]['quantidade'] = trim($this->request->data['quantidade']);
                $dados[$this->request->data['material_id']]['informacoes'] = trim($this->request->data['informacoes']);
                $dados[$this->request->data['material_id']]['descricao'] = trim($this->request->data['descricao']);
                $novoItem = $this->Session->write('itens', $dados);
                $retorno = array('msg' => 'Item adicionado', 'titulo' => 'Sucesso', 'tipo' => 'success');
                echo json_encode($retorno);
                die;
            }
        }
    }

    public function ajaxRemoverItemRat($indice) {

        $dados = $this->Session->read('itens');

        if (isset($dados[$indice]['material_utilizado_id'])) {


            $atendimento = $this->Atendimento->findByatendimento_id($dados[$indice]['atendimento_id']);

            if ($atendimento['Atendimento']['status_atendimento_id'] < 3) {
                $msg = "Não é possível elaborar o preenchimento de RAT esse chamado não foi atribuido a nenhum técnico ou Não foi agendado.";
                $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            } elseif ($atendimento['Atendimento']['status_atendimento_id'] > 3) {
                $msg = "O preenchimento dessa RAT já foi realizado. Alterar o status da RAT para realizar a mudança";
                $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }


            $this->MaterialUtilizado->delete($dados[$indice]['material_utilizado_id']);
        };


        unset($dados[$indice]);
        $this->Session->write('itens', $dados);
        die;
    }

    public function ajaxMostrarMateriaisDoTecnico($atendimento_id) {

        $this->layout = null;
        $atendimento = $this->Atendimento->findByatendimento_id($atendimento_id);

        $materiais = $this->MaterialDistribuido->find('all', array(
            'conditions' => array('MaterialDistribuido.tecnico_id' => $atendimento['Atendimento']['tecnico_id']),
            'fields' => array('MaterialDistribuido.material_id', 'Material.*'),
            'recursive' => +2
                )
        );

        $this->set('materiais', $materiais);
    }

    public function ajaxVisualizaItensRat() {
        $this->layout = null;
        $atendimento_id = $_post['atendimento_id'];
        $itensSalvos = $this->MaterialUtilizado->findByatendimento_id($atendimento_id);
        $this->set('itens', $itensSalvos);
    }

    public function ajaxFinalizar() {

        $dados = $this->request->data;
        $dados['Atendimento']['status_atendimento_id'] = '5';
        $dados['Atendimento']['data_finaliza'] = date('Y-m-d');

        $atendimento = $this->Atendimento->findByatendimento_id($dados['Atendimento']['atendimento_id']);


        if ($this->request->is('post')) {


            if ($atendimento['Atendimento']['status_atendimento_id'] >= 4) {

                try {
                    $this->Atendimento->save($dados);
                    $retorno = array('msg' => 'Ordem de serviço finalizada com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success');
                    echo json_encode($retorno);
                    die;
                } catch (Exception $e) {

                    $msg = "Ocorreu um erro ao finalizar essa ordem de serviço." . $e->getMessage();
                    $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                    echo json_encode($retorno);
                    die;
                }
            } else {


                $msg = "Esse chamado não pode ser finalizado, altere o status do atendimento para finaliza-lo.";
                $retorno = array('msg' => $msg, 'titulo' => 'Erro', 'tipo' => 'error');
                echo json_encode($retorno);
                die;
            }
        }
    }

}
