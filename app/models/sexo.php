<?php
class Sexo extends AppModel {
	var $name = 'Sexo';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'El nombre del sexo es muy pequeño.',
				'allowEmpty' => false,
			),
		),
	);

	var $hasMany = array(
		'DatosPersonales' => array(
			'className' => 'DatosPersonales',
			'foreignKey' => 'sexo_id',
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
