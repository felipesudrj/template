<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Tecnico
 * @author felipe
 */
class Tecnico extends AppModel {
        public $useTable = 'tecnico';
	public $primaryKey = 'tecnico_id';
        
        
        public $validate = array( 
                'nome'=>array(
                        'required' => true,
                        'rule'=>array('notEmpty'),
                        'message'=>"O campo nome de funcionário é obrigatório",
                   
                   )
        );
}
