<?php 

//MaterialDistribuido(material_distribuido_id,material_id,quantidade,tecnico_id,data_atribuicao)

App::uses('AppModel','Model');
class MaterialDistribuido extends AppModel {    
    
    public $useTable = 'material_distribuido';
	public $primaryKey = 'material_distribuido_id';
    
	public $belongsTo = array(
			'Material'=>array(
				'ClassName'=>'Material',
				'foreignKey'=>'material_id'
				),
			'Tecnico'=>array(
				'ClassName'=>'Tecnico',
				'foreignKey'=>'tecnico_id'
				)
			);
	
	public $virtualFields = array(
        'TotalDistribuido' => 'sum(MaterialDistribuido.quantidade)'
    );
        
        public function totalMaterial($material_id) {
        
        $conditions = array(
            'conditions'=>array('MaterialDistribuido.material_id'=>$material_id),
            'fields'=>array('MaterialDistribuido.TotalDistribuido'),
            'group'=>array('MaterialDistribuido.material_id'));
        $dados = $this->find('first',$conditions);
        
        
        return isset($dados['MaterialDistribuido']['TotalDistribuido'])?$dados['MaterialDistribuido']['TotalDistribuido']:'0';
    }
}


?>
