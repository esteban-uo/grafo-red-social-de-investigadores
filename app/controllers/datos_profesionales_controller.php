<?php
class DatosProfesionalesController extends AppController {
		
	public $uses = array('DatosProfesionales');
	var $name = 'DatosProfesionales';
	var $components = array('ArrayJsonSearch');
	
	function beforeFilter() {
	    parent::beforeFilter();
	   	if(!$this->Session->read('Auth.Usuario.validado')){
			$this->redirect(array('controller'=>'usuarios','action' => 'politica_privacidad'));
		}
    }
	
	/**
	 * 	Edición de Datos Profesionales
	 */
	function edit(){
		$id = $this->Session->read('Auth.Usuario.datos_profesionales_id');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Los datos profesionales inválidos.', 'default', array('class' => 'mensaje-error'));
			$this->redirect(array('controller'=>'pages','action' => 'index'));
		}
		if (!empty($this->data)) {
			if(!$this->DatosProfesionales->Dependencia->field("id", array("id" => $this->data["DatosProfesionales"]["dependencia_id"], "nombre" => $this->data["DatosProfesionales"]["alterno"]["dependencia"])) && trim($this->data["DatosProfesionales"]["alterno"]["dependencia"])){
				if($this->DatosProfesionales->Dependencia->save(array("Dependencia"=>array("nombre" => $this->data["DatosProfesionales"]["alterno"]["dependencia"])))){
					$this->data["DatosProfesionales"]["dependencia_id"] = $this->DatosProfesionales->Dependencia->id;
				}
			}
			if ($this->DatosProfesionales->save($this->data)) {
				$this->Session->setFlash('Los datos profesionales han sido actualizados correctamente.', 'default', array('class' => 'mensaje-ok'));
				$this->redirect(array('controller'=>'publicaciones','action' => 'add'));
			} else {
				$this->Session->setFlash('Los datos profesionales son incorrectos, porfavor verificalos.', 'default', array('class' => 'mensaje-error'));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->DatosProfesionales->read(null, $id);
			
			$titulos = $this->DatosProfesionales->Titulo->find('list');
			$nivelesSni = $this->DatosProfesionales->NivelSni->find('list');
			$dependencia = $this->data["Dependencia"]["nombre"];
			$instituciones = $this->DatosProfesionales->Institucion->find('list');
			$areasSni = $this->DatosProfesionales->AreaSni->find('list');
			$posicionPaginas =  array(array(0, 1), array(1, 1), array(0, 1));
			$posicionPaginasLogo = "bookmark-logo-2";
			$objetivosBookmark = $this->Options->field("contenido", array("id" => 5));
			$this->set(compact('titulos', 'nivelesSni', 'dependencia', 'instituciones', 'areasSni', 'posicionPaginas', 'posicionPaginasLogo','objetivosBookmark'));
		}
	}

	/**
	 *  Función AJAX para recuperar datos relacionados a este Controlador
	 */
	function ajax($metodo){
		$this->layout = 'ajax';
		$this->autoRender = false;
		$valor = trim($_POST['value']);
		if($metodo == "titulos"){
			echo $this->ArrayJsonSearch->obtenerArregloIdValueJson($this->DatosProfesionales->Titulo->find('list'), $valor);
		}else if($metodo == "nivelesSni"){
			echo $this->ArrayJsonSearch->obtenerArregloIdValueJson($this->DatosProfesionales->NivelSni->find('list'), $valor);
		}else if($metodo == "dependencias"){
			echo $this->ArrayJsonSearch->obtenerArregloIdValueJson($this->DatosProfesionales->Dependencia->find('list'), $valor);
		}else if($metodo == "instituciones"){
			echo $this->ArrayJsonSearch->obtenerArregloIdValueJson($this->DatosProfesionales->Institucion->find('list'), $valor);
		}else if($metodo == "areasSni"){
			echo $this->ArrayJsonSearch->obtenerArregloIdValueJson($this->DatosProfesionales->AreaSni->find('list'), $valor);
		}
		
	}
}
