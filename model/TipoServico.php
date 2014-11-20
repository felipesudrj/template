<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP TipoServico
 * @author felipe
 */
class TipoServico extends AppModel {
        public $useTable = 'tipo_servico';
	public $primaryKey = 'tipo_servico_id';
        
        public $belongsTo = array(
            'Atendimento' => array(
                 'className' => 'Atendimento',
                 'foreignKey' => 'atendimento_id'
                )
            );
}
