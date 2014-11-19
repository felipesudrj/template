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
        'Atendimento', 'Material','MaterialDistribuido','MaterialUtilizado','TotalMaterial');

	
    public function cadastrarmaterial() {
        
		$UnidadeMedidas = $this->UnidadeMedida->find('list',array('fields'=>array('unidade_medida_id','descricao')));
		
		if($this->request->is('post')){
			 $dataSource = $this->Material->getDataSource();
			$form = $this->request->data;
			
			$this->Material->set($form);
			if($this->Material->validates()){
					
					$dataSource->begin();
					/* GRAVA DADOS DO MATERIAL E QUANTIDADE DE MATERIAL QUE EXISTE */
					$this->Material->saveAll($form);
					$dataSource->commit();
					$this->Session->setFlash('Material cadastrado com sucesso.', false, false, 'confirma');

			
			}else{
					$errors = $this->Material->validationErrors;
					$msg = "";
					foreach ($errors as $indice => $mensagem) {
                    $msg.= $mensagem['0'] . ".\n";
					};
					$dataSource->rollback();
					$this->Session->setFlash($msg, false, false, 'negar');
					
					
			}
		
		}
    }

    public function listarmaterial() {
        /* PEGAR TOTAL DE MATERIAIS  EM ESTOQUE (TOTALMATERIAL) E TOTAL DE MATERIAS DISTRIBUIDOS (MATERIALDISTRIBUIDIO) */
    }
   
    public function atualizaquantidade($material_id){}
	
	public function devolucaomaterial($tecnico_id){}
	
    public function excluirmaterial($material_id) {
        
    }

	public function distribuir(){
	
	$materiais = $this->Material->find('list');
	$tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
	$this->set(compact('materiais','tecnicos'));

		if($this->request->is('post')){
		
			$dataSource = $this->MaterialDistribuido->getDataSource();
		
			/* PEGAR MATERIAIS GRAVADOS NA SESSAO */
			$itens = $this->Session->read('itens');
			if (!empty($itens)) {
				
				$dataSource->begin();
				
				try{
					
					foreach($itens as $indice=>$valor){
					
					$saveMaterialDistribuido['MaterialDistribuido']['material_id'] = $valor['material_id'];
					$saveMaterialDistribuido['MaterialDistribuido']['tecnico_id'] = $valor['tecnico_id'];
					$saveMaterialDistribuido['MaterialDistribuido']['quantidade'] = $valor['quantidade'];
					$saveMaterialDistribuido['MaterialDistribuido']['informacoes'] = $valor['informacoes'];
					
					$this->MaterialDistribuido->create();
					$this->MaterialDistribuido->save($saveMaterialDistribuido);
					}
				
					$dataSource->commit();
					
				}catch (Exception $e) {
					
					$dataSource->rollback();
				}
				
			}
			/* REGISTRAR A OPERACAO NA TABELA DE TotalMaterial */
			
			
		
		}
	
	}
    	
	public function ajaxIncluirItem() {

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

	public function relatorioitens(){
	/* IMPRIMIR LISTA DE MATERIAIS ENTREGUES AO TÉCNICO */
	}
	}
