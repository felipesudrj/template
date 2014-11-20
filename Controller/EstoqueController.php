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
        'Atendimento', 'Material', 'MaterialDistribuido', 'MaterialUtilizado', 'TotalMaterial', 'UnidadeMedida');

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

            $materiais[$indice]['Material']['total'] = $this->TotalMaterial->totalMaterial($valor['Material']['material_id']);
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

        $materiais = $this->Material->find('list');
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
        $this->set(compact('materiais', 'tecnicos'));

        if ($this->request->is('post')) {

            $dataSource = $this->MaterialDistribuido->getDataSource();

            /* PEGAR MATERIAIS GRAVADOS NA SESSAO */
            $itens = $this->Session->read('itens');
            if (!empty($itens)) {

                $dataSource->begin();

                try {

                    foreach ($itens as $indice => $valor) {

                        $saveMaterialDistribuido['MaterialDistribuido']['material_id'] = $valor['material_id'];
                        $saveMaterialDistribuido['MaterialDistribuido']['tecnico_id'] = $valor['tecnico_id'];
                        $saveMaterialDistribuido['MaterialDistribuido']['quantidade'] = $valor['quantidade'];
                        $saveMaterialDistribuido['MaterialDistribuido']['informacoes'] = $valor['informacoes'];

                        $this->MaterialDistribuido->create();
                        $this->MaterialDistribuido->save($saveMaterialDistribuido);
                    }

                    $dataSource->commit();
                } catch (Exception $e) {

                    $dataSource->rollback();
                }
            }
            /* REGISTRAR A OPERACAO NA TABELA DE TotalMaterial */
        }
    }

    public function ajaxIncluirItem() {

        $this->layout = null;

        if ($this->request->is('post')) {



            if ($this->Session->read('itens')) {

                $dados = array('material_id' => $_post['material_id'], 'descricao' => $_post['descricao'], 'quantidade' => $_post['quantidade'], 'informacoes' => $_post['informacoes']);
                $novoItem[] = $this->Session->read('itens');
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

    public function ajaxRemoverItem($indice) {

        $dados = $this->Session->read('itens');
        unset($dados[$indice]);
        $this->Session->write('itens', $dados);
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

}
