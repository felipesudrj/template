<?php

//MaterialUtilizado(material_utilizado_id,material_id,quantidade,tecnico_id,data_atribuicao)
App::uses('AppModel', 'Model');

class MaterialUtilizado extends AppModel {

    public $useTable = 'material_utilizado';
    public $primaryKey = 'material_utilizado_id';
    public $belongsTo = array(
        'Material' => array(
            'ClassName' => 'Material',
            'foreignKey' => 'material_id'
        ),
        'Tecnico' => array(
            'ClassName' => 'Tecnico',
            'foreignKey' => 'tecnico_id'
        ),
        'Atendimento' => array(
            'ClassName' => 'Atendimento',
            'foreignKey' => 'atendimento_id'
        )
    );

    
    public function totalMaterial($material_id) {
        
        $this->virtualFields = array(
            'TotalUtilizado'=>'sum(MaterialUtilizado.quantidade)'
        );


        $conditions = array(
            'conditions' => array('MaterialUtilizado.material_id' => $material_id),
            'group' => array('MaterialUtilizado.material_id'));
        
        $dados = $this->find('first', $conditions);


        return isset($dados['MaterialUtilizado']['TotalUtilizado']) ? $dados['MaterialUtilizado']['TotalUtilizado'] : '0';
    }
    
    public function totalMaterialUsuario($material_id,$tecnico_id) {
        
        $this->virtualFields = array(
            'TotalUtilizado'=>'sum(MaterialUtilizado.quantidade)'
        );


        $conditions = array(
            'conditions' => array('MaterialUtilizado.material_id' => $material_id,'MaterialUtilizado.tecnico_id'=>$tecnico_id),
            'group' => array('MaterialUtilizado.material_id'));
        
        $dados = $this->find('first', $conditions);


        return isset($dados['MaterialUtilizado']['TotalUtilizado']) ? $dados['MaterialUtilizado']['TotalUtilizado'] : '0';
    }

}

?>
