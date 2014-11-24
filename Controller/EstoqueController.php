<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP EstoqueController
 * @author felipe
 */
class EstoqueController extends AppController {

    public $uses = array(
        'Atendimento', 'Material', 'Tecnico', 'MaterialDistribuido', 'MaterialUtilizado', 'TotalMaterial', 'UnidadeMedida');

    public function cadastrarmaterial($id = null) {

        $UnidadeMedidas = $this->UnidadeMedida->find('list', array('fields' => array('unidade_medida_id', 'descricao')));
        $this->set('UnidadeMedidas', $UnidadeMedidas);

        if ($this->request->is('post')) {


            $dataSource = $this->Material->getDataSource();
            $form = $this->request->data;

            $this->Material->set($form);
            if ($this->Material->validates()) {

                $dataSource->begin();
                try {


                    /* GRAVA DADOS DO MATERIAL E QUANTIDADE DE MATERIAL QUE EXISTE */
                    $this->Material->save($form);
                    $dataSource->commit();
                    $this->Session->setFlash('Material cadastrado com sucesso.', false, false, 'confirmar');
                    $this->redirect(array('action' => 'listarmaterial'));
                } catch (Exception $exc) {
                    $msg = 'Ocorreu um erro. ' . $exc->getMessage();
                    $dataSource->rollback();
                    $this->Session->setFlash($msg, false, false, 'negar');
                }
            } else {

                $errors = $this->Material->validationErrors;
                $msg = "";
                foreach ($errors as $indice => $mensagem) {
                    $msg.= $mensagem['0'] . ".\n";
                };
                $dataSource->rollback();
                $this->Session->setFlash($msg, false, false, 'negar');
            }
        }

        if (!empty($id)) {

            $this->request->data = $this->Material->findBymaterial_id($id);
        }
    }

    public function listarmaterial() {

        $breadcrumb = array(
            '/' => 'Painel Inicial',
            '/estoque/listarmaterial' => 'Lista de materiais'
        );
        $this->set(compact('breadcrumb'));
        $optio = array(
            'descricao' => array(
                'Material.descricao' => array(
                    'operator' => 'LIKE'
                )
            )
        );
        $this->FilterResults->addFilters($optio);

        $this->FilterResults->setPaginate('limit', 10);

        $conditions = $this->FilterResults->getConditions();
        $this->FilterResults->setPaginate('conditions', $conditions);
        $materiais = $this->Paginate('Material');

        foreach ($materiais AS $indice => $valor) {
            $estoque = $this->TotalMaterial->totalMaterial($valor['Material']['material_id']);
            $distribuido = $this->MaterialDistribuido->totalMaterial($valor['Material']['material_id']);
            $materiais[$indice]['Material']['totalestoque'] = $estoque;
            $materiais[$indice]['Material']['totaldistribuido'] = $distribuido;
            $materiais[$indice]['Material']['total'] = $estoque - $distribuido;
        }


        $this->set('materiais', $materiais);
    }

    public function atualizaquantidade($material_id) {
        
    }

    public function devolucaomaterial($tecnico_id) {
        
    }

    public function excluirmaterial($material_id) {
        try {
            $this->Material->delete($material_id);
            $this->Session->setFlash('Material excluido com sucesso', false, false, 'confirmar');
            $this->redirect(array('action' => 'listarmaterial'));
        } catch (Exception $exc) {
            $msg = 'Ocorreu um erro. ' . $exc->getMessage();
            $dataSource->rollback();
            $this->Session->setFlash($msg, false, false, 'negar');
            $this->redirect(array('action' => 'listarmaterial'));
        }
    }

    public function distribuir() {

        $materiais = $this->Material->find('all', array());
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
        $this->set(compact('materiais', 'tecnicos'));
        if ($this->request->is('post')) {

            $dataSource = $this->MaterialDistribuido->getDataSource();

            /* PEGAR MATERIAIS GRAVADOS NA SESSAO */
            $itens = $this->Session->read('itens');
            if (!empty($itens)) {

                $dataSource->begin();

                try {
                    $protocolo = date('YmdHis');
                    foreach ($itens as $indice => $valor) {
                        $saveMaterialDistribuido['MaterialDistribuido']['data_retirada'] = date('Y-m-d');

                        $saveMaterialDistribuido['MaterialDistribuido']['protocolo'] = $protocolo;
                        $saveMaterialDistribuido['MaterialDistribuido']['material_id'] = $valor['material_id'];
                        $saveMaterialDistribuido['MaterialDistribuido']['tecnico_id'] = $this->request->data['MaterialDistribuido']['tecnico_id'];
                        $saveMaterialDistribuido['MaterialDistribuido']['quantidade'] = $valor['quantidade'];
                        $saveMaterialDistribuido['MaterialDistribuido']['informacoes'] = $valor['informacoes'];
                        $this->MaterialDistribuido->create();
                        $this->MaterialDistribuido->save($saveMaterialDistribuido);
                    }

                    $dataSource->commit();

                    $this->layout = null;
                    $this->set('protocolo', $protocolo);
                    $this->set('tecnico', $tecnicos[$this->request->data['MaterialDistribuido']['tecnico_id']]);
                    $this->set('itens', $itens);
                    $this->render('imprimirlista');
                    $this->Session->delete('itens');
                } catch (Exception $e) {

                    $dataSource->rollback();
                    $msg = $exc->getMessage();
                    $this->Session->setFlash($msg, false, false, 'negar');
                    $this->redirect('/estoque/listarmaterial');
                }
            }
            /* REGISTRAR A OPERACAO NA TABELA DE TotalMaterial */
        } else {
            $this->Session->delete('itens');
        }
    }

    public function relatoriotecnico() {
        
    }

    public function ajaxIncluirItem() {

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

    public function ajaxRemoverItem($indice) {

        $dados = $this->Session->read('itens');
        unset($dados[$indice]);
        $this->Session->write('itens', $dados);

        $retorno = array('msg' => 'Item removido', 'titulo' => 'Erro', 'tipo' => 'error');
        echo json_encode($retorno);

        die;
    }

    public function ajaxVisualizaTabelaItens() {
        $this->layout = null;
        $itensSalvos = $this->Session->read('itens');

        $this->set('itens', $itensSalvos);
    }

    public function relatorioitens() {
        /* IMPRIMIR LISTA DE MATERIAIS ENTREGUES AO TÉCNICO */
    }

    public function gerenciar($material_id) {
        $breadcrumb = array(
            '/' => 'Painel Inicial',
            '/estoque/listarmaterial' => 'Lista de materiais',
            '' => 'Gerenciar Material'
        );
        $this->set(compact('breadcrumb'));

        $material = $this->TotalMaterial->find('first', array('conditions' => array('TotalMaterial.material_id' => $material_id)));

        $distribuido = $this->MaterialDistribuido->find('first', array('conditions' => array('MaterialDistribuido.material_id' => $material_id)));

        $total = $material['TotalMaterial']['TotalMaterial'] - $distribuido['MaterialDistribuido']['TotalDistribuido'];

        $this->set('total', $total);
        $this->set('material', $material);
        $this->set('material_id', $material_id);




        if ($this->request->is('post')) {

            $dataSource = $this->TotalMaterial->getDataSource();

            $this->request->data['TotalMaterial']['tecnico_id'] = $this->Auth->user('Tecnico.tecnico_id');
            $this->request->data['MaterialDistribuido']['tecnico_id'] = $this->Auth->user('Tecnico.tecnico_id');

            $dataSource->begin();
            try {

                if (!empty($this->request->data['MaterialDistribuido']['quantidade'])) {
                    $this->MaterialDistribuido->save($this->request->data);
                }

                if (!empty($this->request->data['TotalMaterial']['quantidade'])) {
                    $this->TotalMaterial->save($this->request->data);
                }

                $dataSource->commit();
                $this->Session->setFlash('Estoque atualizado com sucesso.', false, false, 'confirmar');
                $this->redirect(array('action' => 'listarmaterial'));
            } catch (Exception $exc) {

                $dataSource->rollback();
                $msg = $exc->getMessage();
                $this->Session->setFlash($msg, false, false, 'negar');
                $this->redirect(array('action' => 'listarmaterial'));
            }
        }
    }

}
