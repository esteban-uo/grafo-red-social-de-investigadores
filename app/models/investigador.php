<?php
class Investigador extends AppModel {
	var $name = 'Investigador';
	var $displayField = 'id';

	var $belongsTo = array(
		'DatosPersonales' => array(
			'className' => 'DatosPersonales',
			'foreignKey' => 'datos_personales_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DatosProfesionales' => array(
			'className' => 'DatosProfesionales',
			'foreignKey' => 'datos_profesionales_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Publicacion' => array(
			'className' => 'Publicacion',
			'joinTable' => 'investigadores_publicaciones',
			'foreignKey' => 'investigador_id',
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
