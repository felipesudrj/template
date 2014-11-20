<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Atribuicao
 * @author felipe
 */
class Atribuicao extends AppModel {
    public $useTable = 'atribuicao';
	public $primaryKey = 'atribuicao_id';
        
        public $belongsTo = array(
            'Atendimento' => array(
                 'className' => 'Atendimento',
                 'foreignKey' => 'atendimento_id'
            )
            );
}
