<?php 
//MaterialUtilizado(material_utilizado_id,material_id,quantidade,tecnico_id,data_atribuicao)
App::uses('AppModel','Model');
class MaterialUtilizado extends AppModel {    
    
    public $useTable = 'material_utilizado';
	public $primaryKey = 'material_utilizado_id';
    
	
	public $belongsTo = array(
			'Material'=>array(
				'ClassName'=>'Material'
				'foreignKey'=>'material_id'
				),
			'Tecnico'=>array(
				'ClassName'=>'Tecnico'
				'foreignKey'=>'tecnico_id'
				),
			'Atendimento'=>array(
				'ClassName'=>'Atendimento'
				'foreignKey'=>'atendimento_id'
				)
			);
			
	/*public $virtualFields = array(
			'totalMaterial'=>'sun(MaterialUtilizado.quantidade)'
				);*/
}


?>
