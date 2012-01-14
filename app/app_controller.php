<?php
class AppController extends Controller {
	var $components = array('Acl', 'Auth', 'Session');
	var $helpers = array('Html', 'Form', 'Session');
	var $uses = array('Options');

	function beforeFilter() {
		$this->Auth->actionPath = 'controllers/';
		$this->Auth->userModel = 'Usuario';
		$this->Auth->fields = array('username' => 'correo', 'password' => 'password');
        $this->Auth->authError = "Error: Acceso denegado";
		
		$this -> Auth -> authorize = 'actions';
		$this -> Auth -> loginAction = array('controller' => 'pages', 'action' => 'index');
		$this -> Auth -> logoutRedirect = array('controller' => 'pages', 'action' => 'index');
		$this -> Auth -> loginRedirect = array('controller' => 'datos_profesonales', 'action' => 'edit');
	}
}
?>