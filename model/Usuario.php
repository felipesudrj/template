<?php
App::uses('AppModel', 'Model');
/**
 * Avaliacao Model
 *
 */
class Usuario extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'usuario';

	public $primaryKey = 'usuario_id';

        
        public $hasOne = array(
			'Tecnico'=>array(
				'ClassName'=>'Tecnico',
				'foreignKey'=>'usuario_id'
				)
			);
        
        public $validate = array( 
                'login'=>array(
                        'required' => true,
                        'rule'=>array('notEmpty'),
                        'message'=>"O campo login é obrigatório"
                   ),
                'senha'=>array(
                        'between' => array(
                                  'rule' => array('between', 3, 9),
                                  'message' => 'Você deve criar uma senha com o minimo de 3 e o máximo de 8 caracteres'
                            )
                   ),
        );
        
        public function beforeSave($options = array()) {
            parent::beforeSave($options);
            $this->data['Usuario']['senha'] = AuthComponent::password($this->data['Usuario']['senha']);
            return true;
        }
       
}
