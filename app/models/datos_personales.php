<?php
class DatosPersonales extends AppModel {
	var $name = 'DatosPersonales';
	var $displayField = 'nombre_completo';
	var $virtualFields = array(
    	'nombre_completo' => 'CONCAT(DatosPersonales.nombres, " ", DatosPersonales.apellidos)'
    );
	
	var $validate = array(
		'nombres' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Tu nombre es muy pequeño.',
				'allowEmpty' => false
			),
		),
		'apellidos' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'Tu apellido es muy pequeño.',
				'allowEmpty' => false
			),
		),
		'fecha_nacimiento' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'El dato introducido no es una fecha válida.',
				'allowEmpty' => false
			),
		),
	);

	var $belongsTo = array(
		'Sexo' => array(
			'className' => 'Sexo',
			'foreignKey' => 'sexo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Imagen' => array(
			'className' => 'Imagen',
			'foreignKey' => 'imagen_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Investigador' => array(
			'className' => 'Investigador',
			'foreignKey' => 'datos_personales_id',
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
