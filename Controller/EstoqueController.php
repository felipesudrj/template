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
    
	public function distribuir(){}
    
    public function excluir() {
        
    }
}
