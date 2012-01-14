<?php
class AreaSni extends AppModel {
	var $name = 'AreaSni';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Área de SNI muy pequeña.',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'area_sni_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Publicacion' => array(
			'className' => 'Publicacion',
			'foreignKey' => 'area_sni_id',
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
