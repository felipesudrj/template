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

	public function atualizarnumeros($material_id,$quantidade,$operacao,$tecnico_id){
	
			$material  = $this->Material->find('first',array(
													'conditions'=>array('Material.material_id'=>$material_id)
													));
										
												
			if($operacao=='1'){
				$updateTotal['Material']['quantidade'] = $updateTotal['Material']['quantidade'] + $quantidade;
			}else{
				$updateTotal['TotalMaterial']['quantidade'] = $updateTotal['TotalMaterial']['quantidade'] - $quantidade;
			}
			/*ATUALIZAR QUANTIDADE DE MATERIAIS */
			$updateTotal['Material']['material_id'] = 	$material['Material']['material_id'];									
			$this->Material->save($updateTotal);
			
			/*GRAVAR HISTORICO DE MATERIAIS*/
			$historico['TotalMaterial']['material_id'] = $material['Material']['material_id'];	
			$historico['TotalMaterial']['quantidade'] = $quantidade;	
			$historico['TotalMaterial']['operacao'] = $operacao;
			$historico['TotalMaterial']['tecnico_id'] = $tecnico_id;
			$this->TotalMaterial->save($historico);
			return true;
	
	}

    public function cadastrarmaterial() {
        
		$UnidadeMedidas = $this->UnidadeMedida->find('list',array('fields'=>array('unidade_medida_id','descricao')));
		if($this->request->is('post')){
			 $dataSource = $this->Material->getDataSource();
			$form = $this->request->data;
			
			$this->Material->set($form);
			if($this->Material->validates()){
					
					$dataSource->begin();
					$this->Material->save($form);
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
					$operacao = 1; //somar
					
					/*ATUALIZAR SALDO TOTAL DE MATERIAL E GRAVAR HISTORICO*/
					if($this->atualizarnumeros($valor['material_id'],$valor['quantidade'],$operacao,$valor['tecnico_id'])){
					
						$this->MaterialDistribuido->create();
						$this->MaterialDistribuido->save($saveMaterialDistribuido);
						
					};
					
					
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
