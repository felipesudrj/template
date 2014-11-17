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
        'Atendimento', 'TipoServico', 'StatusAtendimento',
        'Agendamento', 'Atribuicao', 'Tecnico', 'MaterialDistribuido', 'MaterialUtilizado');

    public function index() {
        
    }

    public function alterar($atendimento_id) {
        $atendimento = $this->Atendimento->findByatendimento_id($atendimento_id);
        $this->request->data = $atendimento;
        $tipoServico = $this->TipoServico->find('list', array('fields' => array('tipo_servico_id', 'descricao')));
        $statusAtendimento = $this->StatusAtendimento->find('list', array('fields' => array('status_atendimento_id', 'descricao')));
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));



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

        $dataSource = $this->Atendimento->getDataSource();

        if ($this->request->is('post')) {

            /* MOVER ARQUIVO PARA PASTA TEMPORARIA */
            $arquivo = $this->request->data['Atendimento']['file']['tmp_name'];
            $xlsx = new SimpleXLSX($arquivo);
            $dados = $xlsx->rows();
            if ($this->request->data['Atendimento']['tipo_id'] == 1) {
                foreach ($dados as $indice => $valor) {

                    if ($indice != 0) {


                        $salvar[$indice]['Atendimento']['nros'] = $valor['2']; /* Ordem de servico */
                        $salvar[$indice]['Atendimento']['nrcontrato'] = $valor['4']; /* Contrato */
                        $salvar[$indice]['Atendimento']['observacoes'] = $valor['19']; /* observacoes */
                        $salvar[$indice]['Atendimento']['tipo_servico_id'] = 1; /* observacoes */
                        $salvar[$indice]['Atendimento']['tarefa'] = $valor['13']; /* Tarefa */
                        $salvar[$indice]['Atendimento']['periodo'] = $valor['14']; /* Periodo */
                        $salvar[$indice]['Atendimento']['status_atendimento_id'] = 1; /* status atendimento id */


                        $salvar[$indice]['Cliente']['nome'] = $valor['5']; /* Cliente */
                        $salvar[$indice]['Cliente']['logradouro'] = $valor['6']; /* Logradouro */
                        $salvar[$indice]['Cliente']['numero'] = $valor['7']; /* Numero */
                        $salvar[$indice]['Cliente']['complemento'] = $valor['8']; /* Complemento */
                        $salvar[$indice]['Cliente']['bairro'] = $valor['9']; /* Bairro */
                        $salvar[$indice]['Cliente']['cidade'] = $valor['10']; /* Cidade */
                        $salvar[$indice]['Cliente']['telefone1'] = $valor['16']; /* Fone */
                        $salvar[$indice]['Cliente']['telefone2'] = $valor['17']; /* Fone */
                        $salvar[$indice]['Cliente']['telefone3'] = $valor['18']; /* Fone */
                    }
                }

                try {

                    $dataSource->begin();

                    $totalImportado = count($salvar);
                    foreach ($salvar as $dados) {
                        $this->Atendimento->create();
                        $this->Atendimento->saveAll($dados);
                    }

                    $dataSource->commit();
                    $this->Session->setFlash($totalImportado, false, false, 'confirma');
                } catch (Exception $exc) {
                    $msg = $exc->getMessage();
                    $dataSource->rollback();
                    $this->Session->setFlash($msg, 'default', '', 'negar');
                }
            }
        }
    }

    public function listar() {
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
        $this->FilterResults->setPaginate('limit', 5);              // optional
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
                    $dataSource->commit();
                    $retorno = array('msg' => 'Agendamento realizado com sucesso', 'titulo' => 'Sucesso', 'tipo' => 'success');
                    echo json_encode($retorno);
                    die;
                } catch (Exception $e) {

                    $dataSource->rollback();
                    $msg = "Ocorreu um erro ao realizar essa operaÃ§Ã£o. " . $e->getMessage();
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

            $retorno = array('msg' => 'NÃ£o foi possÃ­vel realizar essa operaÃ§Ã£o, vocÃª nÃ£o tem permissÃ£o de administrador para Agendar uma OS', 'titulo' => 'AtenÃ§Ã£o', 'tipo' => 'warning');
            echo json_encode($retorno);
            die;
        }
    }

    public function ajaxRat() {

        $transaction = $this->Rat->getDataSource();
        $dados = $this->Session->read('itens');
        /* observacoes,numerorat,itens */
        $form = $this->request->data;
        $update['Atendimento']['atendimento_id'] = $form['Rat']['atendimento_id'];
        $update['Atendimento']['status_atendimento_id'] = '4';


        $Atribuicao = $this->Atribuicao->find('first', array('conditions' => array('Rat.atendimento_id' => $atendimento_id)));


        /* VERIFICAR RAT É DO TÉCNICO OU O ADMINISTRADOR ESTA ATUANDO NA RAT */
        if ($this->Auth->user('tipo_usuario_id') == '1' || $Atribuicao['Atribuicao']['tecnico_id'] == $this->Auth->user('tecnico_id')) {

            /* VALIDAR PREENCHIMENTO DO CODIGO DA RAT */
            $this->Rat->set($this->request->data);

            if ($this->Rat->validates()) {

                $transaction->begin();
                try {
                    /*                     * SALVAR TODOS OS ITENS + NR RAT + DESCRICAO */
                    foreach ($dados as $indice => $content) {

                        $dados[$indice] = $form['Rat'];
                        $this->MateriaisUtilizado->save($dados);

                        /* SUBTRAIR O TOTAL DE DISTRIBUIDOS CONFORME A QUANTIDADE UTILIZADA */
                    }

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

                $msg = "O preenchimento do número da RAT é obirgatório";
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

            $retorno = array('msg' => 'VocÃª nÃ£o tem perfil de administrador', 'titulo' => 'Erro', 'tipo' => 'error');
            echo json_encode($retorno);
            die;
        }
    }

    public function ajaxVisualizaTabelaItens() {
        $this->layout = null;
        $itensSalvos = $this->Session->read('itens');
        $this->set('itens', $itensSalvos);
    }

    public function ajaxIncluirItemRat() {

        $this->layout = null;

        if ($this->request->is('post')) {



            if (isset($this->Session->read('itens'))) {

                $dados = array('material_id' => $_post['material_id'], 'descricao' => $_post['descricao'], 'quantidade' => $_post['quantidade'], 'informacoes' => $_post['informacoes']);
                $novoItem[] = $this->Session->read('itens')
                $novoItem[] = $dados;
                $itens = $this->Session->write('itens', $novoItem);
            } else {
                $dados['0']['material_id'] = $_post['material_id'];
                $dados['0']['quantidade'] = $_post['quantidade'];
                $dados['0']['informacoes'] = $_post['informacoes'];
                $dados['0']['descricao'] = $_post['descricao'];
                $novoItem = $this->Session->write('itens', $dados);
            }
        }
    }

    public function ajaxRemoverItemRat($indice) {

        $dados = $this->Session->read('itens');
        unset($dados[$indice]);
        $this->Session->write('itens', $dados);
        die;
    }

    public function ajaxMostrarMateriaisDoTecnico($atendimento_id) {


        $atendimento = $this->Atendimento->findByatendimento_id($atendimento_id);
        $materiais = $this->MaterialDistribuido->find('list', array(
            'conditions' => array('MaterialDistribuido.tecnico_id' => $atendimento['Atendimento']['tecnico_id']),
            'fields' => array('MaterialDistribuido.material_id', 'Material.descricao')
                )
        );
        $this->set('materiais' => $materiais);
    }

    public function ajaxVisualizaItensRat() {
        $this->layout = null;
        $atendimento_id = $_post['atendimento_id'];
        $itensSalvos = $this->MaterialUtilizado->findByatendimento_id($atendimento_id);
        $this->set('itens', $itensSalvos);
    }

    public function ajaxFinalizar() {

        $dados = $this->request->data;
        $update['Atendimento']['atendimento_id'] = $dados['Agendamento']['atendimento_id'];
        $update['Atendimento']['status_atendimento_id'] = '6';

        $tecnico_id = $this->Atendimento->findByatendimento_id($dados['Agendamento']['atendimento_id']);
        $itensUsados = $this->MaterialUtilizado->findByatendimento_id($dados['Agendamento']['atendimento_id']);

        /* Chamar função na controller estoque e subtrair valor de total de materiais utilizados */
        /* na tabela totalMaterial subtrair o total de material conforme o valor já encontrado dentro da tabela */
    }

}
