<?php
class Dependencia extends AppModel {
	var $name = 'Dependencia';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Nombre de dependencia muy pequeña.',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'dependencia_id',
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
