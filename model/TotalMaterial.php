<?php

App::uses('AppModel', 'Model');

class TotalMaterial extends AppModel {

    public $useTable = 'total_material';
    public $primaryKey = 'total_material_id';
    public $belongsTo = array(
        'Material' => array(
            'ClassName' => 'Material',
            'foreignKey' => 'material_id'
    ));
    public $virtualFields = array(
        'TotalMaterial' => 'sum(TotalMaterial.quantidade)'
    );

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }
    
    
    public function totalMaterial($material_id) {
        
        $conditions = array(
            'conditions'=>array('TotalMaterial.material_id'=>$material_id),
            'fields'=>array('TotalMaterial.TotalMaterial'),
            'group'=>array('TotalMaterial.material_id'));
        $dados = $this->find('first',$conditions);
        
        
        return isset($dados['TotalMaterial']['TotalMaterial'])?$dados['TotalMaterial']['TotalMaterial']:'0';
    }

}

?>
