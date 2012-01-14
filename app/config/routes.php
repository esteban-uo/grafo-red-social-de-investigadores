<?php
	Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
	Router::connect('/politica-privacidad', array('controller' => 'usuarios', 'action' => 'politica_privacidad'));
	Router::connect('/datos-personales/*', array('controller' => 'datos_personales', 'action' => 'edit'));
	Router::connect('/datos-profesionales/*', array('controller' => 'datos_profesionales', 'action' => 'edit'));
	Router::connect('/mis-publicaciones/*', array('controller' => 'publicaciones', 'action' => 'add'));
	Router::connect('/publicacion/*', array('controller' => 'publicaciones', 'action' => 'edit'));
	Router::connect('/mi-perfil/*', array('controller' => 'usuarios', 'action' => 'edit'));
	Router::connect('/desconectarse', array('controller' => 'usuarios', 'action' => 'logout'));
	
	
