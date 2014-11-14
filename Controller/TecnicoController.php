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
            $this->request->data = $this->Usuario->findByusuario_id($id);
            pr($this->request->data);
        }
    }

	public function excluir($id){
	
		try{
		$this->Usuario->delete($id);
		$this->Session->setFlash("Excluido com sucesso.", false, false, 'confirma');
        $this->redirect(array('action'=>'listar'));
		}catch (Exception $e) {
					$msg = "Não foi possível excluir esse usuário. "
                    $msg .= $e->getMessage();
                    $this->Session->setFlash($msg, false, false, 'negar');
                    $this->redirect(array('action'=>'listar');
                }
	}
   
    public function listar() {
		$tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));

		$optio = array(
                        'tecnico' => array(
                            'Tecnico.tecnico_id' => array(
                                'operator' => '=',
                                'select' => $this->FilterResults->select('Todos', $tecnicos)
                            )
                        )
                );
        
        $this->FilterResults->addFilters($optio);
        $this->FilterResults->setPaginate('limit', 5);              // optional
        $conditions = $this->FilterResults->getConditions();
        $this->FilterResults->setPaginate('conditions', $conditions);

        $tecnicos = $this->Paginate('Tecnico');

        $this->set('tecnicos', $tecnicos);
		
    }

}
