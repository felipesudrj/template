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
	
			$total = $this->TotalMaterial->find('first',array(
												'fields'=>array('quantidade','material_id','total_material_id'),
												'conditions'=>array('tecnico_id'=>$tecnico_id,'material_id'=>$material_id),
												'group'=>array('material_id','tecnico_id')
												));
												
			if($operacao=='1'){
				$total['TotalMaterial']['quantidade'] = $total['TotalMaterial']['quantidade'] + $quantidade;
			}else{
				$total['TotalMaterial']['quantidade'] = $total['TotalMaterial']['quantidade'] - $quantidade;
			}
			
			$this->TotalMaterial->save($total);
	
	}

    public function cadastrarmaterial() {
        
		$UnidadeMedidas = $this->UnidadeMedida->find('list',array('fields'=>array('unidade_medida_id','descricao')));
		
    }

    public function listarmaterial() {
        
    }
   
   
	
	public function materialdistribuido(){}
	
	public function devolucaomaterial($tecnico_id){}
	
    public function excluirmaterial($material_id) {
        
    }

	public function distribuir(){
	
	$materiais = $this->Material->find('list');
	$tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
	$this->set(compact('materiais','tecnicos'));

		if($this->request->is('post')){
		
		
			/* PEGAR MATERIAIS GRAVADOS NA SESSAO */
			/* REGISTRAR A OPERACAO NA TABELA DE TotalMaterial */
			/* SUBTRATIR OS VALOR DO TOTAL REGISTRADO PARA CADA MATERIAL DA SESSAO */
		
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
