<?php
class Titulo extends AppModel {
	var $name = 'Titulo';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Ingrese más información del título',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'titulo_id',
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
