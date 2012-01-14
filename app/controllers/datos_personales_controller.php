<?php
class DatosPersonalesController extends AppController {
	
	public $uses = array('DatosPersonales');
	var $name = 'DatosPersonales';
	
	function beforeFilter() {
	    parent::beforeFilter();
	   	if(!$this->Session->read('Auth.Usuario.validado')){
			$this->redirect(array('controller'=>'usuarios','action' => 'politica_privacidad'));
		}
    }
	
	function edit(){
		$id = $this->Session->read('Auth.Usuario.datos_personales_id');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Los datos personales son inválidos.', 'default', array('class' => 'mensaje-error'));
			$this->redirect(array('controller'=>'pages','action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DatosPersonales->save($this->data)) {
				$this->Session->setFlash('Los datos personales han sido actualizados correctamente.', 'default', array('class' => 'mensaje-ok'));
				$this->redirect(array('controller'=>'datos_profesionales','action' => 'edit'));
			} else {
				$this->Session->setFlash('Los datos personales son incorrectos, porfavor verificalos.', 'default', array('class' => 'mensaje-error'));
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DatosPersonales->read(null, $id);
			$imagen_id = $this->data["DatosPersonales"]["imagen_id"];
			$imagenPerfil = "./" . Configure::read('rutaImagenesInvestigadores') . $this->data["Imagen"]["url"];
			$this->set(compact('sexos', 'imagen_id', 'imagenPerfil'));
		}
		$objetivosBookmark = $this->Options->field("contenido", array("id" => 2));
		
		$posicionPaginas = array(array(1, 1),array(0, 1),array(0, 1));
		$posicionPaginasLogo = "bookmark-logo-1";
		$sexos = $this->DatosPersonales->Sexo->find('list');
		$this->set(compact('sexos', 'posicionPaginas', 'posicionPaginasLogo', 'objetivosBookmark'));
		
	}

}
