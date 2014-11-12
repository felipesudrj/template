<?php 

public function ajaxAtribuir(){
		
		$dados = $this->request->data;
		
		$update['Atendimento']['atendimento_id'] = $atendimento_id;
		$update['Atendimento']['status_atendimento_id'] = '3';
		$statusAgendamento = $this->Atendimento->findByatendimento_id($atendimento_id)
		
			if($this->Auth->user('tipo_usuario_id')=='1'){
					
					/**VERIFICAR SE O STATUS DE ATENDIMENTO É AGENDADO SÓ ENTAO ATRIBUIR*/
					if($statusAgendamento['Atendimento']['status_atendimento_id']==2){
							
							$this->begin()
							try{
							
								$this->Atribuicao->saveAll();
								/* ALTERAR STATUS */
								$this->Atendimento->save($update)
								$this->commit();
								
								$retorno = array('msg'=>'Atribuição realiza com sucesso','titulo'=>'Sucesso','tipo'=>'success');
								echo json_encode($retorno);
								die;
								
							}catch (Exception $e) {
							
								$this->rollback();
								$msg = "Ocorreu um erro ao realizar a atribuição".$e->getMessage();
								$retorno = array('msg'=>$msg,'titulo'=>'Erro','tipo'=>'error');
								echo json_encode($retorno);
								die;
								
							}
						
					}else{
						$retorno = array('msg'=>'Essa OS ainda não recebeu uma data de agendamento','titulo'=>'Erro','tipo'=>'error');
						echo json_encode($retorno);
						die;
					
					}
					
				
		
				}else{
		
					$retorno = array('msg'=>'Você não tem perfil de administrador','titulo'=>'Erro','tipo'=>'error');
					echo json_encode($retorno);
					die;
		}

}

public function ajaxEditarAtendimento(){
		$dados = $this->request->data;
		if($this->Auth->user('tipo_usuario_id')=='1'){
		
						$this->begin()
							try{
							
								$this->Atendimento->saveAll($dados);
								$this->commit();
								$retorno = array('msg'=>'Ordem de serviço salva com sucesso','titulo'=>'Sucesso','tipo'=>'success');
								echo json_encode($retorno);
								die;
								
							}catch (Exception $e) {
							
								$this->rollback();
								$msg = "Ocorreu um erro ao realizar essa operação".$e->getMessage();
								$retorno = array('msg'=>$msg,'titulo'=>'Erro','tipo'=>'error');
								echo json_encode($retorno);
								die;
								
							}
		}else{
		
					$retorno = array('msg'=>'Não foi possível realizar essa operação, você não tem permissão de administrador para alterar uma OS','titulo'=>'Atenção','tipo'=>'warning');
					echo json_encode($retorno);
					die;
		}


}

public function ajaxAgendar(){
		$dados = $this->request->data;
		$update['Atendimento']['atendimento_id'] = $atendimento_id;
		$update['Atendimento']['status_atendimento_id'] = '2';
		
		$dados['Agendamento']['data_agendamento'] = $this->formatData($dados['Agendamento']['data_agendamento']);
		
		if($this->Auth->user('tipo_usuario_id')=='1'){
					/**VALIDAR ENTRA DE DADOS E CAMPOS OBRIGATORIOS*/
					if($this->Atendimento->validates()){
					
						$this->begin()
							try{
							
								$this->Agendamento->saveAll($dados);
								$this->Atendimento->save($update);
								$this->commit();
								$retorno = array('msg'=>'Agendamento realizado com sucesso','titulo'=>'Sucesso','tipo'=>'success');
								echo json_encode($retorno);
								die;
								
							}catch (Exception $e) {
							
								$this->rollback();
								$msg = "Ocorreu um erro ao realizar essa operação. ".$e->getMessage();
								$retorno = array('msg'=>$msg,'titulo'=>'Erro','tipo'=>'error');
								echo json_encode($retorno);
								die;
								
							}
					
					
					}else{
						/*PEGAR ERROS E APRESENTA-LOS EM MENSAGEM*/
						$errors = $this->Model->validationErrors;
						$retorno = array('msg'=>'MENSAGEM COM ERROS','titulo'=>'Erro de validação','tipo'=>'error');
						echo json_encode($retorno);
						die;
					}
		
		}else{
		
					$retorno = array('msg'=>'Não foi possível realizar essa operação, você não tem permissão de administrador para Agendar uma OS','titulo'=>'Atenção','tipo'=>'warning');
					echo json_encode($retorno);
					die;
		}
	
}

public function ajaxFinaliza(){
		$dados = $this->request->data;
		$update['Atendimento']['atendimento_id'] = $dados['Atendimento']['atendimento_id'];
		$update['Atendimento']['status_atendimento_id'] = '5';
		
		
		if($this->Auth->user('tipo_usuario_id')=='1'){
		
			/* DAR BAIXA NO ESTOQUE DOS MATERIAIS USADOS -
			cacular total de itens usados, subtrair ao total 
			do mesmo item registrado em estoque */
			
			
			
				
		
			/*ATUALIZAR STATUS DE ATENDIMENTO DA OS*/
			$this->Atendimento->save($update);
			
			
			
			
			
		
		}
}

public function adicionarItem(){
		$this->layout = null;
		
		if($this->request->is('post')){
				
				$dados = $this->request->data;
		
				if(isset($this->Session->read('itens'))){
						$novoItem[] = $this->Session->read('itens')
						$novoItem[] = $dados;
						$itens = $this->Session->write('itens',$novoItem);
					}else{
						$novoItem = $this->Session->write('itens',$dados);
				}
		
		$itensSalvos = $this->Session->read('itens');
		$this->set('itens',$itensSalvos);
		
		}
		
		

}

public function ajaxRat(){
		
		$transaction = $this->Rat->getDataSource();
		$dados = $this->Session->read('itens');
		/*observacoes,numerorat,itens*/
		$form = $this->request->data;
		$update['Atendimento']['atendimento_id'] = $form['Rat']['atendimento_id'];
		$update['Atendimento']['status_atendimento_id'] = '4';
		
		
		
		$Atribuicao = $this->Atribuicao->find('first',array('conditions'=>array('Rat.atendimento_id'=>$atendimento_id)));
		
		
		/*VERIFICAR RAT É DO TÉCNICO OU O ADMINISTRADOR ESTA ATUANDO NA RAT */
		if($this->Auth->user('tipo_usuario_id')=='1' || $Atribuicao['Atribuicao']['tecnico_id'] == $this->Auth->user('tecnico_id')){
		
				/* VALIDAR PREENCHIMENTO DO CODIGO DA RAT */
				$this->Rat->set($this->request->data);
		
		if($this->Rat->validates()){
						
						$transaction->begin();
							try{
								/**SALVAR TODOS OS ITENS + NR RAT + DESCRICAO */
								foreach($dados as $indice=>$content){
										
									$dados[$indice] = $dados;
									$this->Rat->save($dados);
								}
								
								$this->Atendimento->save($update);
								$transaction->commit();
								$retorno = array('msg'=>'Relatório técnico gravado com sucesso','titulo'=>'Sucesso','tipo'=>'success');
								echo json_encode($retorno);
								die;
								
							}catch (Exception $e) {
							
								$transaction->rollback();
								$msg = "Ocorreu um erro ao realizar essa operação".$e->getMessage();
								$retorno = array('msg'=>$msg,'titulo'=>'Erro','tipo'=>'error');
								echo json_encode($retorno);
								die;
								
							}
				}
				
		
		}else{
		
		
			$msg = "Essa atividade não foi atribuida ao seu perfil";
			$retorno = array('msg'=>$msg,'titulo'=>'Erro','tipo'=>'error');
			echo json_encode($retorno);
			die;
		}
		
}




public function formatData($data){
	$newData = explode('/',$data);
	return $newData['2']."-".$newData['1']."-".$newData['0'];

}

public validacao(){

$this->Agendamento->validate = array(
				'contato' => array(
                    'required' => array(
                        'rule' => array('notEmpty'),
                        'message' => 'O campo contato deve ser preenchido'
                    )
				),
				'data_agendamento' => array(
                    'required' => array(
                        'rule' => array('notEmpty'),
                        'message' => 'O campo contato deve ser preenchido'),
					'date'=>array(
						'rule' => array('notEmpty'),
                        'message' => 'Informar uma data valida');
						)
					);
					
	if ($this->Atendimento->validates($validates)) {
        
				die("Action can be performed as validated !! Fields are correct");
    
	} 					
}




?>
