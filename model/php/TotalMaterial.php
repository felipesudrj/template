<?php 

//Material(total_material_id,material_id,unidade_medida_id,total,data_operacao)
App::uses('AppModel','Model');
class TotalMaterial extends AppModel {    
    
    public $useTable = 'total_material';
	public $primaryKey = 'total_material_id';
    
	
	public $belongsTo = array(
			'UnidadeMedida'=>array(
				'ClassName'=>'UnidadeMedida'
				'foreignKey'=>'unidade_medida_id'
				),
			'Material'=>array(
				'ClassName'=>'Material'
				'foreignKey'=>'material_id'
				),
			'Tecnico'=>array(
				'ClassName'=>'Tecnico'
				'foreignKey'=>'tecnico_id'
				),
			);
			
}


?>
