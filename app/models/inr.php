<?php
class Inr extends AppModel {
	var $name = 'Inr';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength', 1),
				'message' => 'El nombre del investigador introduccido es muy pequeño.',
				'allowEmpty' => false
			),
		),
	);

	var $hasAndBelongsToMany = array(
		'Correo' => array(
			'className' => 'Correo',
			'joinTable' => 'correos_inr',
			'foreignKey' => 'inr_id',
			'associationForeignKey' => 'correos_id',
			'unique' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Publicaciones' => array(
			'className' => 'Publicaciones',
			'joinTable' => 'inr_publicacion',
			'foreignKey' => 'inr_id',
			'associationForeignKey' => 'publicacion_id',
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
