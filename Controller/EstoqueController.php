<?php 
App::uses('AppController','Controller');

Class EstoqueController extends AppController{

public $uses = array('MaterialUtilizado','MaterialDistribuido','UnidadeMedida','Material');

public function beforeFilter(){
		parent::beforeFilter();
		
		if($this->Auth->uses('tipo_usuario_id')!=1){
		
			$this->Session->setFlash('Voce nao tem permissao para acessar essa pagina');
			$this->redirect('/');
		}
		
}

public function cadastrarmateriais($id=null){
	
	if(!empty($id)){
		$this->request->data = $this->Material->findBymaterial_id($id);
	}

	
	if($this->request->is('post')){
		
		try {
			  $this->Material->save($this->request->data);
			  $this->Session->setFlash('Cadastrado com sucesso.');
			  $this->redirect($this->here);
			
			} catch (Exception $e) {
				
			  $this->Session->setFlash('Ocorreu um erro ao tentar salvar esse material. '. $e->getMessage());
			  
			
			}
		
	}
	
}

public function excluirmateriais($id){
	try {
	
			$this->Material->delete($id))
			$this->Session->setFlash('Excluido com sucesso.');
			$this->redirect(array('action'=>'listarmateriais'));
	} catch (Exception $e) {
			
			 $this->Session->setFlash('Não foi possivel remover esse material. '. $e->getMessage());
			 $this->redirect(array('action'=>'listarmateriais'));
	}
	
	
}

public function listarmateriais(){
/* visualizar materiais distribuidos aos técnicos */ 
/* calcular total de materiais - quantidade utilizada geral */ 
/* filtrar e criar lista paginada de materiais por tipo */


	$this->paginate = array('limit'=>'10');
	$materias = $this->paginate('Material');
	
	$this->set(compact('materias'));
}

public function distribuirmaterial(){
/* realizar a atribuicao de um tipo de material e sua quantidade a um tecnico espeficico */
}

public function listadistribuicao(){
/* Visualizar materiais atribuidos aos técnicos */
/* Para cada técnico visualizar a quantidade dele registrado e subtrair pela quantidade utilizada para o material N */
/* Criar filtro paginado por tecnico e tipo de material */

}

}




