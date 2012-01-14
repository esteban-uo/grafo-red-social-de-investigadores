<?php
class Usuario extends AppModel {
	var $name = 'Usuario';
	var $displayField = 'correo';
	
	var $validate = array(
		'correo' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Correo ingresado no es válido.',
				'allowEmpty' => false
			),
			'minlength' => array(
				'rule' => array('minlength', 3),
				'message' => 'No puedes dejar un correo vacio.',
				'allowEmpty' => false
			)
		),
		'password' => array(
			'minlength' => array(
				'rule' => array('minlength', 6),
				'message' => 'La contraseña debe de ser mayor a 6 carácteres.',
				'allowEmpty' => false
			),
		),
	);

	var $belongsTo = array('Group');
	var $actsAs = array('Acl' => array('type' => 'requester'));
	
	function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['Usuario']['group_id'])) {
			$groupId = $this->data['Usuario']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}
	
	var $hasOne = array(
		'Investigador' => array(
			'className' => 'Investigador',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
