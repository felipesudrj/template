<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Atendimento
 * @author felipe
 */
class Atendimento extends AppModel {

	public $useTable = 'atendimento';
	public $primaryKey = 'atendimento_id';
        
         public $hasOne = array(
              'Cliente' => array(
                 'className' => 'Cliente',
                 'foreignKey' => 'atendimento_id',
                 'type'=>'INNER'
            ),
             'Agendamento'=>array(
                 'className' => 'Agendamento',
                 'foreignKey' => 'atendimento_id',
                 'order' => 'Agendamento.data_agendamento DESC',
                 'limit' => '1',
           )
             
             
         );
         public $belongsTo = array(
            'StatusAtendimento' => array(
                 'className' => 'StatusAtendimento',
                 'foreignKey' => 'status_atendimento_id',
                 'type'=>'INNER'
            ),
            'TipoServico' => array(
                 'className' => 'TipoServico',
                 'foreignKey' => 'tipo_servico_id',
                 'type'=>'INNER'
            ),
             
             'Tecnico' => array(
                 'className' => 'Tecnico',
                 'foreignKey' => 'tecnico_id',
                 'type'=>'LEFT'
            ),
            
        );
         
         public function afterFind($results, $primary = false) {
             
             foreach ($results as $strIndice=>$strValor){
                 if(isset($strValor['Atendimento']['data_criacao'])){
                 $results[$strIndice]['Atendimento']['data_criacao'] = date('d/m/Y',  strtotime($strValor['Atendimento']['data_criacao']));
                 }
                 
                 };
                return $results;
             
             }
}
