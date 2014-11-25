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

    public $uses = array('Usuario', 'Tecnico', 'TipoUsuario');

    public function cadastrar($id = null) {

        if ($this->request->is('post')) {
            $dados = $this->request->data;
            $dados['Usuario']['nome'] = $dados['Tecnico']['nome'];


            $this->Tecnico->set($this->request->data);
            $this->Usuario->set($this->request->data);
            if ($this->Tecnico->validates() && $this->Usuario->validates()) {

                try {
     
                    $this->Usuario->saveAll($dados);
                    
                    $this->Session->setFlash("Salvo com sucesso", false, false, 'confirma');
                    $this->redirect($this->here);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    $this->Session->setFlash($msg, false, false, 'negar');
                    $this->redirect($this->here);
                }
            } else {
                $erros = $this->Tecnico->validationErrors;
                $erros = $this->Usuario->validationErrors;
                $msg = "Alguns campos obrigatórios não foram preenchidos";
                $this->Session->setFlash($msg, false, false, 'atencao');
                $this->set('erros', $erros);
            }
        }

        $tipoUsuario = $this->TipoUsuario->find('list', array('fields' => array('tipo_usuario_id', 'descricao')));
        $this->set('tipoUsuario', $tipoUsuario);
        if (!empty($id)) {
            $this->request->data = $this->Tecnico->findBytecnico_id($id);
           
        }
    }

    public function editar() {
        
    }

    public function listar() {
        $tecnicos = $this->paginate('Tecnico');
        $this->set('tecnicos',$tecnicos);
    }

}
