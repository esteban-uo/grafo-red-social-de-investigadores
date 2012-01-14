<?php
class Institucion extends AppModel {
	var $name = 'Institucion';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'El nombre de la institución es muy pequeño.',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'institucion_id',
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
