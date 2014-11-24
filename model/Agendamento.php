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
class Agendamento extends AppModel {

	public $useTable = 'agendamento';
	public $primaryKey = 'agendamento_id';
        
        public $validate = array( 
                'contato'=>array(
                        'required' => true,
                        'rule'=>array('notEmpty'),
                        'message'=>"Preencher o campo contato"
                   )
            );

        
        public $belongsTo = array(
            'Atendimento' => array(
                 'className' => 'Atendimento',
                 'foreignKey' => 'atendimento_id',
                 )
            );
       
         
         public function afterFind($results, $primary = false) {
             
             foreach ($results as $strIndice=>$strValor){
                 if(isset($strValor['Agendamento']['data_agendamento'])){
                 $results[$strIndice]['Agendamento']['data_agendamento'] = date('d/m/Y',  strtotime($strValor['Agendamento']['data_agendamento']));
                 }
                 
                 };
                return $results;
             
             }
}
