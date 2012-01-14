<?php
class DatosProfesionales extends AppModel {
	var $name = 'DatosProfesionales';

	var $belongsTo = array(
		'Titulo' => array(
			'className' => 'Titulo',
			'foreignKey' => 'titulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'NivelSni' => array(
			'className' => 'NivelSni',
			'foreignKey' => 'nivel_sni_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Dependencia' => array(
			'className' => 'Dependencia',
			'foreignKey' => 'dependencia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Institucion' => array(
			'className' => 'Institucion',
			'foreignKey' => 'institucion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AreaSni' => array(
			'className' => 'AreaSni',
			'foreignKey' => 'area_sni_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Investigador' => array(
			'className' => 'Investigador',
			'foreignKey' => 'datos_profesionales_id',
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
