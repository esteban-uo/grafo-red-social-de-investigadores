<?php
class Publicacion extends AppModel {
	var $name = 'Publicacion';
	var $displayField = 'titulo';
	var $validate = array(
		'titulo' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'El nombre de la publicación agregada es muy pequeña.',
				'allowEmpty' => false,
			),
		),
		'fecha_publicacion' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'El dato introducido no es tipo fecha.',
				'allowEmpty' => false,
			),
		),
		'resumen' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Porfavor instroduce un Abstract mayor.',
				'allowEmpty' => false
			),
		),
	);

	var $belongsTo = array(
		'AreaSni' => array(
			'className' => 'AreaSni',
			'foreignKey' => 'area_sni_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EstadoPublicacion' => array(
			'className' => 'EstadoPublicacion',
			'foreignKey' => 'estado_publicacion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Investigador' => array(
			'className' => 'Investigador',
			'joinTable' => 'investigadores_publicaciones',
			'foreignKey' => 'publicacion_id',
			'associationForeignKey' => 'investigador_id',
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
		'PalabraClave' => array(
			'className' => 'PalabraClave',
			'joinTable' => 'publicaciones_palabras_claves',
			'foreignKey' => 'publicacion_id',
			'associationForeignKey' => 'palabra_clave_id',
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
		'Inr' => array(
			'className' => 'Inr',
			'joinTable' => 'inr_publicacion',
			'foreignKey' => 'publicacion_id',
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
