<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  public $components = array(
    'Session', 'Cookie', 'Auth',
    'FilterResults.FilterResults' => array(
        'auto' => array(
            'paginate' => false,
            'explode'  => true,  // recommended
        ),
        'explode' => array(
            'character'   => ' ',
            'concatenate' => 'AND',
        )
    )
);

public $helpers = array(
    'Html', 'Session',
    'FilterResults.FilterForm' => array(
        'operators' => array(
            'LIKE'       => 'containing',
            'NOT LIKE'   => 'not containing',
            'LIKE BEGIN' => 'starting with',
            'LIKE END'   => 'ending with',
            '='  => 'equal to',
            '!=' => 'different',
            '>'  => 'greater than',
            '>=' => 'greater or equal to',
            '<'  => 'less than',
            '<=' => 'less or equal to'
        )
    )
);
  
  public function beforeFilter() {
    parent::beforeFilter();
    
    $this->Auth->loginAction = array('controller' => 'Pages', 'action' => 'login');
    
    $this->Auth->authenticate = array(
        'Form' => array('userModel' => 'Usuario', 'username' => 'login', 'password' => 'senha',
        'fields' => array('userModel' => 'Usuario', 'username' => 'login', 'password' => 'senha')));
    
    $this->Auth->loginRedirect = array('controller' => 'Pages', 'action' => 'painel');
    $this->Auth->logoutRedirect = array('controller' => 'Pages', 'action' => 'sair');
   
  }

    
}
