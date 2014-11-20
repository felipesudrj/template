<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Rat
 * @author felipe
 */
class Rat extends AppModel {
        public $useTable = 'rat';
	public $primaryKey = 'rat_id';
        
       public $validate = array( 
                'numero_rat'=>array(
                        'required' => true,
                        'rule'=>array('notEmpty'),
                        'message'=>"Preencher o campo contato"
                   ),
           );
}
