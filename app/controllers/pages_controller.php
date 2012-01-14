<?php
class PagesController extends AppController {
	var $name = 'Pages';
	var $helpers = array('Html', 'Session');
	var $uses = array();
	
	function beforeFilter() {
	    parent::beforeFilter();
	   	$this->Auth->allow(array('*'));
    }

	function index() {
		if($this->Session->read('Auth.Usuario')){
				$this->redirect(array('controller'=>'datos_personales','action' => 'edit'));
		}
		
		$posicionInicio = true;
		$objetivosBookmark = $this->Options->field("contenido", array("id" => 1));
		App::import('Model', 'Investigador' );
		$investigador = new Investigador();
		$areasInvestiadores = array();
		for($i=1;$i<=7;$i++){
			$areasInvestigadores[] = array(
			"max" => $investigador->DatosProfesionales->find('count', array('conditions' => array('DatosProfesionales.area_sni_id' => $i))),
			"val" => $investigador->find('count', array('recursive' => 3, 'conditions' => array('DatosProfesionales.area_sni_id' => $i, 'Usuario.validado' => 1)))
			);
		}
		$title_for_layout = "";
		$this->set("areasInvestigadores", $areasInvestigadores);
		$this->set(compact('posicionInicio','objetivosBookmark', 'title_for_layout'));
	}
}