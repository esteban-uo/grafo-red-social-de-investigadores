<?php
class ImagenesController extends AppController {

	var $name = 'Imagenes';

	function edit($id = null) {
		$this -> layout = "ajax";
		if (!empty($this->data)) {
			$this->autoRender = false;
			if ($resultado = $this -> upload($this -> data)) {
				if ($this -> data["Imagen"]["id"] == 1) {
					$this->Imagen->create();
				} else {
					$eliminar = $this->deleteImage($this->data["Imagen"]["id"]);
				}
				$this->Imagen->save(array("Imagen"=>array("url" => $resultado["imagen"])));
				$resultado["id"] = $this->Imagen->id;
				return json_encode(array("estado" => true, "resultado" => $resultado));
			} else {
				return json_encode(array("estado" => false, "mensaje" => "La imagen no pudo Guardarse. Porfavor, intente de nuevo"));
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Imagen -> read(null, $id);
		}
	}

	function upload($file = null) {
		$imagen = $this -> randomName($file['Imagen']['url']['name']);
		$miniimagen = $this -> getMiniatureimagen($imagen);
		$uploadedFile = $file['Imagen']['url']['tmp_name'];
		$type = strtolower($file['Imagen']['url']['type']);
		$type = str_split($type, strrpos($type, '/'));
		if (!empty($imagen) && $type[0] == 'image') {;
			$rutaImagenesInvestigadores = Configure::read('rutaImagenesInvestigadores');
			$path = getcwd() . $rutaImagenesInvestigadores . $imagen;
			$path2 = getcwd() . $rutaImagenesInvestigadores . $miniimagen;
			if (!file_exists($path)) {
				$this -> resizeimagen($uploadedFile, 180, 200);
				if (move_uploaded_file($uploadedFile, $path)) {
					copy($path, $path2);
					$this -> resizeimagen($path2, 30, 50);
					return array(
								"imagen" => $imagen,
								"th" => $miniimagen,
								"path" => $rutaImagenesInvestigadores
								);
				} else {
					//$this->Session->setFlash(__('La imagenn no pudo ser cargada', true));
					return false;
				}
			} else {
				//$this->Session->setFlash(__('Esta imagenn ya existe en la carpeta', true));
				return false;
			}
		} else {
			//$this->Session->setFlash(__('El archivo que intenta subir no es una imagenn, intente de nuevo', true));
			return false;
		}

	}

	function deleteImage($id = null) {
		$imagen = $this->Imagen->field("url", array("id" => $id));
		$rutaImagenesInvestigadores = Configure::read('rutaImagenesInvestigadores');
		if (unlink(getcwd() . $rutaImagenesInvestigadores . $imagen) && unlink(getcwd() . $rutaImagenesInvestigadores . $this -> getMiniatureimagen($imagen))) {
			return true;
		} else {
			return false;
		}
	}

	function resizeimagen($imagen = null, $width = null, $height = null) {
		App::import('Vendor', 'ThumbLibInc', array('file' => 'phpthumb' . DS . 'ThumbLib.inc.php'));
		$thumb = PhpThumbFactory::create($imagen);
		$thumb -> resize($width, $height) -> save($imagen);
	}

	function randomName($imagen = null, $id = null) {
		$id = ($id == null) ? rand(0, 9) : id;
		return rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . $id . '.' . $this -> getExtension($imagen);
	}

	function getMiniatureimagen($file = null) {
		$imagen = str_split($file, strrpos($file, '.'));
		return $imagen[0] . '.th' . '.' . $this -> getExtension($file);
	}

	function getExtension($file = null) {
		$file = explode(".", $file);
		return $file[1];
	}

}
