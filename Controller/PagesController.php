<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('criar');
    }

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Usuario', 'Atendimento', 'StatusAtendimento', 'TipoServico');
    public $components = array('Session');

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     * 	or MissingViewException in debug mode.
     */
    public function criar() {

        if ($this->request->is('post')) {

            $this->request->data['Usuario']['senha'] = AuthComponent::password($this->request->data['Usuario']['senha']);

            $this->Usuario->save($this->request->data);

            $this->redirect('login');
        }
    }

    public function login() {



        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                $this->redirect($this->Auth->loginRedirect);
            } else {

                $this->Session->setFlash('Email ou senha informados estão inválidos, acesso negado', 'default', array('class' => 'alert alert-danger'), 'mensagem');
            }
        }
    }

    public function painel() {
        if ($this->Auth->user('tipo_usuario_id') == '1') {
            $this->redirect('administrador');
        } else {
            $this->redirect('tecnico');
        };
    }

    public function sair() {

        $this->Session->destroy();
        $this->redirect('/');
    }

    public function administrador() {
        $breadcrumb = array(
            '/' => 'Painel Inicial'
        );
        $this->set(compact('breadcrumb'));

        $this->FilterResults->setPaginate('limit', 6);
        $this->FilterResults->setPaginate('group', 'Atendimento.nros');  // optional
// optional
        $conditions = $this->FilterResults->getConditions();
        $this->FilterResults->setPaginate('conditions', $conditions);

        $atendimentos = $this->Paginate('Atendimento');

        $this->set('atendimento', $atendimentos);
    }

    public function tecnico() {
        $breadcrumb = array(
            '/' => 'Painel Inicial  '
        );
        $this->set(compact('breadcrumb'));
        $this->FilterResults->setPaginate('limit', 5);
        $this->FilterResults->setPaginate('group', 'Atendimento.nros');  // optional
        $conditions = $this->FilterResults->getConditions();
        $conditions['Atendimento.tecnico_id'] = 11;
        $this->FilterResults->setPaginate('conditions', $conditions);

        $atendimentos = $this->Paginate('Atendimento');
        $this->set('atendimento', $atendimentos);
    }

}
