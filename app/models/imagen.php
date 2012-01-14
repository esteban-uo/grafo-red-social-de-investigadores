<?php
class Imagen extends AppModel {
	var $name = 'Imagen';
	var $displayField = 'url';
	var $validate = array(
		'url' => array(
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'No hay alguna URL valida'
			),
		),
	);
	
	var $hasMany = array(
		'DatosPersonales' => array(
			'className' => 'DatosPersonales',
			'foreignKey' => 'imagen_id',
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
