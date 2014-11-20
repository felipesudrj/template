<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP TipoUsuario
 * @author felipe
 */
class TipoUsuario extends AppModel {
    public $useTable = 'tipo_usuario';
    public $primaryKey = 'tipo_usuario_id';
}
