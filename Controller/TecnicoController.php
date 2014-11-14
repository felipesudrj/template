<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP TecnicoController
 * @author felipe
 */
class TecnicoController extends AppController {

    public $uses = array('Usuario', 'Tecnico','TipoUsuario');

    public function cadastrar($id = null) {

        if ($this->request->is('post')) {

            
            $this->Tecnico->set($this->request->data);
            $this->Usuario->set($this->request->data);
            if ($this->Tecnico->validates() && $this->Usuario->validates()) {
            
                if(isset($this->request->data['Usuario']['senha'])){
            $this->request->data['Usuario']['senha'] = AuthComponent::password($this->request->data['Usuario']['senha']);
            }
                
                $this->request->data['Usuario']['nome'] = $this->request->data['Tecnico']['nome'];
                
                try {
                    if(empty($this->request->data['Usuario']['usuario_id'])){
                        unset($this->request->data['Usuario']['usuario_id']);
                         unset($this->request->data['Tecnico']['tecnico_id']);
                    }
                    pr($this->request->data);
                    $this->Usuario->saveAll($this->request->data);
                    die('salvou');
                    $this->Session->setFlash("Salvo com sucesso", false, false, 'confirma');
                    $this->redirect($this->here);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    $this->Session->setFlash($msg, false, false, 'negar');
                    $this->redirect($this->here);
                }
            }else{
                    $erros = $this->Tecnico->validationErrors;
                    $erros = $this->Usuario->validationErrors;
                    $msg = "Alguns campos obrigatórios não foram preenchidos";
                    $this->Session->setFlash($msg, false, false, 'atencao');
                    $this->set('erros',$erros);

            }
        } 

            $tipoUsuario = $this->TipoUsuario->find('list',array('fields'=>array('tipo_usuario_id','descricao')));
            $this->set('tipoUsuario',$tipoUsuario);
            if (!empty($id)) {
                $this->request->data = $this->Usuario->findByusuario_id($id);
                pr($this->request->data);
                
            }
        
    }

    public function editar() {
        
    }

    public function listar() {
        
    }

}
