<?php
class OptionsController extends AppController {

	var $name = 'Options';
	
	function beforeFilter() {
	    parent::beforeFilter();
		$this->layout = "panelcontrol";
		if($this->Session->read("Logeado.root")){
			$this->Auth->allow(array('*'));
		}
    }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Opcion inválida', true));
			$this->redirect(array('controller'=>'panel','action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Option->save($this->data)) {
				$this->Session->setFlash(__('La opción se ha guardado', true));
				$this->redirect(array('controller'=>'panel','action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error al guardar.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Option->read(null, $id);
		}
	}
}
