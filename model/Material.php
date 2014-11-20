<?php

//Material(material_id,unidade_medida_id,quantidade)
App::uses('AppModel', 'Model');

class Material extends AppModel {

    public $useTable = 'material';
    public $primaryKey = 'material_id';
    public $belongsTo = array(
        'UnidadeMedida' => array(
            'ClassName' => 'UnidadeMedida',
            'foreignKey' => 'unidade_medida_id'
        )  
    );
    
    
    public $validate = array(
        'descricao' => array(
            'required' => true,
            'rule' => array('notEmpty'),
            'message' => "Informe o nome do material"
        ),
        'unidade_medida_id' => array(
            'required' => true,
            'rule' => array('notEmpty'),
            'message' => "Selecione uma unidade de medida"
        )
    );
    
   

    

}

?>
