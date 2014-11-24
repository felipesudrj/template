<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP RelatorioController
 * @author felipe
 */
class RelatorioController extends AppController {

    public $uses = array('MaterialDistribuido', 'Atendimento', 'TotalMaterial', 'Tecnico', 'StatusAtendimento', 'TipoServico', 'MaterialUtilizado');

    public function atendimento($item = null) {
        $statusAtendimento = $this->StatusAtendimento->find('list', array('fields' => array('status_atendimento_id', 'descricao')));
        $tipoServico = $this->TipoServico->find('list', array('fields' => array('tipo_servico_id', 'descricao')));
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));

        $this->set(compact('statusAtendimento', 'tipoServico', 'tecnicos'));

        if ($this->request->is('post')) {

            if ($this->request->data['Agendamento']['data_agendamento']) {
                $data = explode('/', $this->request->data['Agendamento']['data_agendamento']);
                $this->request->data['Agendamento']['data_agendamento'] = $data['2'] . "-" . $data['1'] . "-" . $data['0'];
            }

            $post = $this->postConditions($this->request->data, null, 'and', true);
            $post = array_filter($post);
            $conditions = array('conditions' => $post);
            $atendimentos = $this->Atendimento->find('all', $conditions);

            pr($atendimentos);
            $total = count($atendimentos);
            $this->set(compact('atendimentos', 'total'));
            $this->layout = null;
            $this->render('atendimentoimpressao');
        }
    }

    public function equipamento() {
        $tecnicos = $this->Tecnico->find('list', array('fields' => array('tecnico_id', 'nome')));
        $this->set('tecnicos', $tecnicos);

        if ($this->request->is('post')) {

            $post = $this->postConditions($this->request->data, null, 'and', true);
            $post = array_filter($post);
            $conditions = array('conditions' => $post, 'group' => 'MaterialDistribuido.material_id');
            $orders = $this->MaterialDistribuido->find('all', $conditions);

            $tecnico_id = $this->request->data['MaterialDistribuido']['tecnico_id'];


            foreach ($orders as $indice => $valor) {
                $material_id = $valor['MaterialDistribuido']['material_id'];
                $orders[$indice]['MaterialDistribuido']['TotalMaterial'] = $this->MaterialUtilizado->totalMaterialUsuario($material_id, $tecnico_id);
            }
            $this->set('equipamentos', $orders);
            $this->layout = null;
            $this->render('equipamentoimpressao');
        }
    }

    public function ordem($atendimento_id = null) {
        $this->layout = null;
        $this->Atendimento->recursive = 2;
        $atendimento = $this->Atendimento->findByatendimento_id($atendimento_id);

        if (!$atendimento) {
            $this->Session->setFlash('Desculpe nenhuma ordem de serviço encontrada', 'default', '', 'negar');
            $this->redirect('/atendimento/listar');
        }

        $this->set('atendimento', $atendimento);
        /* 	PEGAR DADOS DE ATENDIMENTO E IMPRIMIR EM TELA */
    }

    public function importacao() {
        /* MOSTRAR TODAS AS IMPORTACOES FILTRAR POR DATA DE IMPORTACAO E TIPO */
    }

}
