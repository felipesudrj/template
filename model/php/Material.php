<?php 

//Material(material_id,unidade_medida_id,quantidade)
App::uses('AppModel','Model');
class Material extends AppModel {    
    
    public $useTable = 'material';
	public $primaryKey = 'material_id';
    
	public $belongsTo = array(
			'UnidadeMedida'=>array(
				'ClassName'=>'UnidadeMedida'
				'foreignKey'=>'unidade_medida_id'
				)
			);
			
}


?>
