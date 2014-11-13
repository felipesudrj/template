<?php 

//MaterialDistribuido(material_distribuido_id,material_id,quantidade,tecnico_id,data_atribuicao)

App::uses('AppModel','Model');
class MaterialDistribuido extends AppModel {    
    
    public $useTable = 'material_distribuido';
	public $primaryKey = 'material_distribuido_id';
    
	public $belongsTo = array(
			'Material'=>array(
				'ClassName'=>'Material'
				'foreignKey'=>'material_id'
				),
			'Tecnico'=>array(
				'ClassName'=>'Tecnico'
				'foreignKey'=>'tecnico_id'
				)
			);
	
	/*public $virtualFields = array(
			'totalMaterial'=>'sun(MaterialDistribuido.quantidade)'
				);
	public function beforeFind($query = array()) {
		parent::beforeFind($query);
		return $query['conditions'] = array('group'=>array('MaterialDistribuido.tecnico_id','MaterialDistribuido.material_id'));
	
	}		*/	
}


?>
