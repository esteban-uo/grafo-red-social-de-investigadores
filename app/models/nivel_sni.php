<?php
class NivelSni extends AppModel {
	var $name = 'NivelSni';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'Valor muy pequeño.',
				'allowEmpty' => false
			),
		),
		'descripcion' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Ingrese una descripción mas detallada.',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'nivel_sni_id',
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
