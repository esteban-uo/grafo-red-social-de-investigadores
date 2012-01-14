<?php
class Correo extends AppModel {
	var $name = 'Correo';
	var $displayField = 'correo';
	var $validate = array(
		'correo' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Correo ingresado no es válido.',
				'allowEmpty' => false
			),
		),
	);

	var $hasAndBelongsToMany = array(
		'Inr' => array(
			'className' => 'Inr',
			'joinTable' => 'correos_inr',
			'foreignKey' => 'correos_id',
			'associationForeignKey' => 'inr_id',
			'unique' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
