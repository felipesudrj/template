<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsuarioController
 * @author felipe
 */
class UsuarioController extends AppController {

    public function senha() {

        if ($this->request->is('post')) {


            $conditions = array('conditions' => array(
                    'usuario_id' => $this->Auth->user('usuario_id'),
                    'senha' => AuthComponent::password($this->request->data['Usuario']['atual'])
            ));

            /** verificar se senha atual confere */
            if ($this->Usuario->find('first', $conditions)) {


                if ($this->request->data['Usuario']['senha'] === $this->request->data['Usuario']['confirma']) {

                    $atualiza = array('Usuario.senha' =>"'".AuthComponent::password($this->request->data['Usuario']['senha'])."'");
                    $conditions = array("Usuario.usuario_id" => $this->Auth->user('usuario_id'));
                    if ($this->Usuario->updateAll($atualiza, $conditions)) {

                        $this->Session->setFlash('Salvo com sucesso.', 'default', array('class' => 'alert alert-success'), 'confirma');
                    };
                } else {

                    $this->Session->setFlash('Repita a nova senha no campo confirmar nova senha.', 'default', array('class' => 'alert alert-danger'), 'confirma');
                }
            } else {

                $this->Session->setFlash('Senha atual não confere.', 'default', array('class' => 'alert alert-danger'), 'confirma');
            };
        }
    }

    public function index() {



        if ($this->request->is('post')) {

            $this->Usuario->save($this->request->data);

            $this->Session->setFlash('Salvo com sucesso.', 'default', array('class' => 'alert alert-success'), 'confirma');
        }

        $this->request->data = $this->Usuario->findByusuario_id($this->Auth->user('usuario_id'));
    }

}
