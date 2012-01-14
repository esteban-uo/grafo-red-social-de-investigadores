<?php
class EstadoPublicacion extends AppModel {
	var $name = 'EstadoPublicacion';
	var $displayField = 'nombre';
	var $validate = array(
		'nombre' => array(
			'minlength' => array(
				'rule' => array('minlength',1),
				'message' => 'El estado de las publicaciones es muy pequeño.',
				'allowEmpty' => false
			),
		),
	);

	var $hasMany = array(
		'Publicacion' => array(
			'className' => 'Publicacion',
			'foreignKey' => 'estado_publicacion_id',
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
