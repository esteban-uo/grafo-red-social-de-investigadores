<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
	
	function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow(array('login', 'logut'));
    }
	
	function edit(){
		if(!$this->Session->read('Auth.Usuario.validado')){
			$this->redirect(array('controller'=>'usuarios','action' => 'politica_privacidad'));
		}
		$id = $this->Session->read('Auth.Usuario.id');
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Los datos del usuario son inválidos.', 'default', array('class' => 'mensaje-error'));
			$this->redirect(array('controller'=>'pages','action' => 'index'));
		}
		if (!empty($this->data)) {
			if($this->Usuario->save($this->data)){
				$this->Session->setFlash('Tu perfil se ha actualizado correctamente.', 'default', array('class' => 'mensaje-ok'));
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
		}
		
		$objetivosBookmark = $this->Options->field("contenido", array("id" => 7));
		$this->set(compact('objetivosBookmark'));
	}
	
	function login(){
		if (!empty($this->data)) {
			if($this->Auth->login($this->data)){
				$usuario_id = $this->Session->read('Auth.Usuario.id');
				$parametrosContain = array(
										"Investigador"=>array("id",
															"DatosPersonales"=>array("id", "nombre_completo"),
															"DatosProfesionales"=>array("id")
															)
									);
									
				$this->Usuario->Behaviors->attach('Containable', array('recursive' => true));
				
				$usuario = $this->Usuario->find("first", array("contain" => $parametrosContain, "conditions" => array("Usuario.id" =>$usuario_id)));

				$this->Session->write('Auth.Usuario.nombre_completo', $usuario["Investigador"]["DatosPersonales"]["nombre_completo"]);
				$this->Session->write('Auth.Usuario.datos_personales_id', $usuario["Investigador"]["datos_personales_id"]);
				$this->Session->write('Auth.Usuario.datos_profesionales_id', $usuario["Investigador"]["datos_profesionales_id"]);
				$this->Session->write('Auth.Usuario.investigador_id', $usuario["Investigador"]["id"]);
				$this->Session->write('Auth.Usuario.validado', $usuario["Usuario"]["validado"]);
				
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
			}else{
				$this->Session->setFlash('Correo/Contraseña erroneos.', 'default', array('class' => 'mensaje-error'), "auth");
				$this->redirect(array('controller'=>'pages','action' => 'index'));
			}
		}
		if ($this->Session->read('Auth.Usuario')) {
			$this->Session->setFlash('¡Ya has iniciado sesión!');
			$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
		}
	}
	
	function logout(){
		$this->Session->setFlash('Se ha desconectado satisfactoriamente.', 'default', array('class' => 'mensaje-ok'), "auth");
    	$this->redirect($this->Auth->logout());
	}
	
	function politica_privacidad() {
		if($this->Session->read('Auth.Usuario.validado')){
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
		}
		if (!empty($this->data)) {
			if($this->data["Usuario"]["acepto"]){
				$this->Usuario->id = $this->Session->read('Auth.Usuario.id');
				$this->Usuario->saveField('validado', 1);
				$this->Session->write('Auth.Usuario.validado', 1);
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
			}
		}
		$objetivosBookmark = $this->Options->field("contenido", array("id" => 2));
		$politicaPrivacidad = $this->Options->field("contenido", array("id" => 3));
		$this->set(compact('objetivosBookmark', 'politicaPrivacidad'));
	}

}
