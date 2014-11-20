<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Cliente
 * @author felipe
 */
class Cliente extends AppModel {
        public $useTable = 'cliente';
	public $primaryKey = 'atendimento_id';
        
        public $belongsTo = array(
            'Atendimento' => array(
                 'className' => 'Atendimento',
                 'foreignKey' => 'atendimento_id'
            )
            );
        
}
