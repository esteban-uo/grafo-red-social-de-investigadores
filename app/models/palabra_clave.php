<?php
class PalabraClave extends AppModel {
	var $name = 'PalabraClave';
	var $displayField = 'nombre';
	var $validate = array(
		'id' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'La palabra introducida es muy pequeña.',
				'allowEmpty' => false
			),
		),
	);

	var $hasAndBelongsToMany = array(
		'Publicacion' => array(
			'className' => 'Publicacion',
			'joinTable' => 'publicaciones_palabras_claves',
			'foreignKey' => 'palabra_clave_id',
			'associationForeignKey' => 'publicacion_id',
			'unique' => true,
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
