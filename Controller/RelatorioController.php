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

    public function atendimento() {	
	
	if($this->request->is('post')){
			/*PEGAR VIEW DE IMPRESSÃO */
			
			/* MOSTRAR TODOS OS ATENDIMENTOS DO TÉCNICO EM LISTA CONFORME 
			DATA AGENDADA, TECNICO ID E STATUS DE ATENDIMENTO */
					
	}
	
	}
    public function equipamento(){
	
	
	if($this->request->is('post')){
			/*PEGAR VIEW DE IMPRESSÃO */
			
			/* MOSTRAR EM LISTA DADOS DOS EQUIPAMENTOS QUE O TÉCNICO 
			POSSUI CONFORME DISTRIBUICAO - UTILIZADO 
			FILTRAR POR DATA DE RETIRADA E TECNICO 
			*/
			
			/* VER O TOTAL DE ITENS DISTRIBUIDOS SUBTRAIR PELO TOTAL DE UTILIZADOS EXIBIR NA TELA AS 3
				INFORMAÇOES, TOTAL RETIRADO, UTILIZADO, SALDO */
					
	}
	
	}
	public function ordem($atendimento_id){
	
	/*	PEGAR DADOS DE ATENDIMENTO E IMPRIMIR EM TELA */
	
	}
	public function importacao(){
	/*MOSTRAR TODAS AS IMPORTACOES FILTRAR POR DATA DE IMPORTACAO E TIPO */
	
	}
}
