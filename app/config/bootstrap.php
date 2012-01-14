<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

Inflector::rules('singular', array('rules' => array(),
		'irregular' => array(
			"area_sni"=>"areas_sni",
			"inr"=>"inr",
			"datos_personales"=>"datos_personales",
			"datos_profesionales"=>"datos_profesionales",
			"estado_publicacion"=>"estados_publicaciones",
			"institucion"=>"instituciones",
			"imagen"=>"imagenes",
			"investigador"=>"investigadores",
			"nivel_sni"=>"niveles_sni",
			"palabra_clave" => "palabras_claves",
			"panel"=>"panel",
			"publicacion" => "publicaciones"
		), 'uninflected' => array()));
		
	Inflector::rules('plural', array('rules' => array(), 
		'irregular' => array(
			"area_sni"=>"areas_sni",
			"inr"=>"inr",
			"datos_personales"=>"datos_personales",
			"imagen"=>"imagenes",
			"panel"=>"panel",
			"datos_profesionales"=>"datos_profesionales",
			"estado_publicacion"=>"estados_publicaciones",
			"institucion"=>"instituciones",
			"investigador"=>"investigadores",
			"nivel_sni"=>"niveles_sni",
			"palabra_clave" => "palabras_claves",
			"publicacion" => "publicaciones"
		), 'uninflected' => array()));