<?php
class PublicacionesController extends AppController {

	var $name = 'Publicaciones';

	var $components = array('ArrayJsonSearch');
	var $helpers = array('Time');

	function beforeFilter() {
		parent::beforeFilter();
		if (!$this -> Session -> read('Auth.Usuario.validado')) {
			$this -> redirect(array('controller' => 'usuarios', 'action' => 'politica_privacidad'));
		}
	}

	/**
	 *  Añade publicaciones segun el id del Investigador
	 */
	function add() {
		$idInvestigador = $this -> Session -> read('Auth.Usuario.investigador_id');
		if (!$idInvestigador) {
			$this -> Session -> setFlash('Error no Existe tal Investigador.', 'default', array('class' => 'mensaje-error'));
			$this -> redirect(array('controller' => 'pages', 'action' => 'index'));
		}
		if (!empty($this -> data)) {
			$autores = json_decode($this -> data["Autores"]["input"]);
			$this -> data["Investigador"]["id"] = $idInvestigador;
			if ($this -> Publicacion -> save($this -> data)) {
				$idPublicacion = $this -> Publicacion -> id;
				foreach ($autores as $autor) {
					if (isset($autor -> correos)) {
						$this -> Publicacion -> Inr -> save(array("Inr" => array("nombre" => $autor -> nombre)));
						$idInrNuevo = $this -> Publicacion -> Inr -> id;

						$this -> Publicacion -> create();
						$this -> Publicacion -> save(array("Publicacion" => array("id" => $idPublicacion), "Inr" => array("id" => $idInrNuevo)));

						$correos = explode(",", $autor -> correos);
						foreach ($correos as $correo) {
							$correo = trim($correo);
							if ($correo) {
								if (!$idUsuario = $this -> Publicacion -> Investigador -> Usuario -> field("id", array("correo LIKE" => $correo))) {
									$this -> Publicacion -> Inr -> Correo -> create();
									$this -> Publicacion -> Inr -> Correo -> save(array("Correo" => array("correo" => $correo)));

									$idCorreoNuevo = $this -> Publicacion -> Inr -> Correo -> id;

									$this -> Publicacion -> Inr -> create();
									$this -> Publicacion -> Inr -> save(array("Inr" => array("id" => $idInrNuevo), "Correo" => array("id" => $idCorreoNuevo)));
								} else {
									// TODO usuario no registrado, si existe segun el correo, entonces obtener su id de investiador con la de usuario y crear una relacion publicacion_investigador
								}
							}
						}
					} else {
						$id = $this -> Publicacion -> Investigador -> field("id", array("datos_personales_id" => $this -> Publicacion -> Investigador -> DatosPersonales -> field("id", array("nombre_completo" => $autor -> nombre))));

						$this -> Publicacion -> create();
						$this -> Publicacion -> save(array("Publicacion" => array("id" => $idPublicacion), "Investigador" => array("id" => $id)));
					}
				}

				$palabrasClave = explode(",", $this -> data["PalabrasClaves"]["conjunto"]);
				foreach ($palabrasClave as $palabraClave) {
					$palabraClave = trim($palabraClave);
					$idPalabraClave = $this -> Publicacion -> PalabraClave -> field("id", array("nombre" => $palabraClave));
					if ($idPalabraClave) {
						$this -> Publicacion -> PalabraClave -> create();
						$this -> Publicacion -> PalabraClave -> save(array("Publicacion" => array("id" => $idPublicacion), "PalabraClave" => array("id" => $idPalabraClave)));
					} else {
						$this -> Publicacion -> PalabraClave -> create();
						$this -> Publicacion -> PalabraClave -> save(array("Publicacion" => array("id" => $idPublicacion), "PalabraClave" => array("nombre" => $palabraClave)));
					}
				}
			}
		}

		$data = $this -> Publicacion -> Investigador -> read(null, $idInvestigador);
		$areasSni = $this -> Publicacion -> AreaSni -> find('list');

		$estadosPublicaciones = $this -> Publicacion -> EstadoPublicacion -> find('list');
		$publicaciones = $data["Publicacion"];
		$posicionPaginas = array( array(0, 1), array(0, 1), array(1, 1));
		$posicionPaginasLogo = "bookmark-logo-3";
		$objetivosBookmark = $this->Options->field("contenido", array("id" => 6));
		$this -> set(compact('publicaciones', 'areasSni', 'estadosPublicaciones', 'posicionPaginas', 'posicionPaginasLogo', 'objetivosBookmark'));

	}

	function edit($id) {
		if (!$id && empty($this -> data)) {
			$this -> Session -> setFlash('La publicación buscada es inválida.', 'default', array('class' => 'mensaje-error'));
			$this -> redirect(array('controller' => 'publicaciones', 'action' => 'add'));
		}
		if (!empty($this -> data)) {
			if ($this -> Publicacion -> save($this -> data)) {
				$idPublicacionActualizada = $this -> Publicacion -> id;
				$autores = json_decode($this -> data["Autores"]["input"]);
				foreach ($autores as $autor) {
					if (!isset($autor -> registrado)) {
						if (isset($autor -> correos)) {
							debug($autor -> nombre);
							$this -> Publicacion -> Inr -> save(array("Inr" => array("nombre" => $autor -> nombre)));
							$idInrNuevo = $this -> Publicacion -> Inr -> id;

							$this -> Publicacion -> create();
							$this -> Publicacion -> save(array("Publicacion" => array("id" => $id), "Inr" => array("id" => $idInrNuevo)));

							$correos = explode(",", $autor -> correos);
							foreach ($correos as $correo) {
								$correo = trim($correo);
								if ($correo) {
									if (!$idUsuario = $this -> Publicacion -> Investigador -> Usuario -> field("id", array("correo LIKE" => $correo))) {
										$this -> Publicacion -> Inr -> Correo -> create();
										$this -> Publicacion -> Inr -> Correo -> save(array("Correo" => array("correo" => $correo)));

										$idCorreoNuevo = $this -> Publicacion -> Inr -> Correo -> id;

										$this -> Publicacion -> Inr -> create();
										$this -> Publicacion -> Inr -> save(array("Inr" => array("id" => $idInrNuevo), "Correo" => array("id" => $idCorreoNuevo)));
									} else {
										// TODO usuario no registrado, si existe segun el correo, entonces obtener su id de investiador con la de usuario y crear una relacion publicacion_investigador
									}
								}
							}
						} else {
							$idInvestigadorRegistrado = $this -> Publicacion -> Investigador -> field("id", array("datos_personales_id" => $this -> Publicacion -> Investigador -> DatosPersonales -> field("id", array("nombre_completo" => $autor -> nombre))));

							$this -> Publicacion -> create();
							$this -> Publicacion -> save(array("Publicacion" => array("id" => $id), "Investigador" => array("id" => $idInvestigadorRegistrado)));
						}
					}else if (isset($autor -> eliminado)) {
						if ($autor -> registrado && $autor -> eliminado) {
							// Bloque para eliminar autor
							if (isset($autor -> correos)) {
								$this -> Publicacion -> InrPublicacion -> deleteAll(array("InrPublicacion.inr_id" => $this -> Publicacion -> Inr -> field("id", array("Inr.nombre" => $autor -> nombre))), false);
							} else {
								$idInvestigadorRegistrado = $this -> Publicacion -> Investigador -> field("id", array("datos_personales_id" => $this -> Publicacion -> Investigador -> DatosPersonales -> field("id", array("nombre_completo" => $autor -> nombre))));
								$this -> Publicacion -> InvestigadoresPublicacione -> deleteAll(array("InvestigadoresPublicacione.investigador_id" => $idInvestigadorRegistrado), false);
							}
						}

					}
				}
				$palabrasClave = json_decode($this -> data["PalabrasClave"]["json"]);
				foreach ($palabrasClave as $palabraClave) {
					if (!$palabra = trim($palabraClave -> palabra)) {
						continue;
					}
					$idPalabraAgregar = $this -> Publicacion -> PalabraClave -> field("id", array("PalabraClave.nombre" => $palabra));
					if ($palabraClave -> agregada) {
						if ($idPalabraAgregar) {
							$this -> Publicacion -> PalabraClave -> save(array("Publicacion" => array("id" => $id), "PalabraClave" => array("id" => $idPalabraAgregar)));
						} else {
							$this -> Publicacion -> PalabraClave -> save(array("Publicacion" => array("id" => $id), "PalabraClave" => array("nombre" => $palabra)));
						}
					} else {
						$this -> Publicacion -> PublicacionesPalabrasClafe -> deleteAll(array("PublicacionesPalabrasClafe.palabra_clave_id" => $idPalabraAgregar), false);
					}
				}
				$this -> Session -> setFlash('La publicación se ha actualizado correctamente.', 'default', array('class' => 'mensaje-ok'));
				$this -> redirect(array('controller' => 'publicaciones', 'action' => 'add', null));

			} else {
				$this -> Session -> setFlash('La actualización no se ha actualizado correctamente, intenta de nuevo.', 'default', array('class' => 'mensaje-error'));
			}
		}
		if (empty($this -> data)) {
			$idInvestigador = $this -> Session -> read('Auth.Usuario.investigador_id');

			if (!$this -> Publicacion -> InvestigadoresPublicacione -> field("InvestigadoresPublicacione.id", array("InvestigadoresPublicacione.investigador_id" => $idInvestigador, "InvestigadoresPublicacione.publicacion_id" => $id))) {
				$this -> Session -> setFlash('Publicación erronea.', 'default', array('class' => 'mensaje-error'));
				$this -> redirect(array('controller' => 'publicaciones', 'action' => 'add', null));
			}

			$parametrosContain = array("AreaSni" => array("id"), "EstadoPublicacion" => array("id"), "Investigador" => array("id", "DatosPersonales" => array("id", "nombre_completo")), "PalabraClave" => array("nombre"), "Inr" => array("id" => array(), "nombre" => array(), "Correo" => array("correo")));

			$this -> Publicacion -> Behaviors -> attach('Containable', array('recursive' => true));

			$this -> data = $this -> Publicacion -> find('first', array('conditions' => array('Publicacion.id' => $id), 'contain' => $parametrosContain));
			$areasSni = $this -> Publicacion -> AreaSni -> find('list');
			$estadosPublicaciones = $this -> Publicacion -> EstadoPublicacion -> find('list');

			$palabrasClave = array();
			foreach ($this->data["PalabraClave"] as $palabraClave) {
				$palabrasClave[] = array("nombre" => $palabraClave["nombre"]);
			}
			$palabrasClave = json_encode($palabrasClave);
			$autoresNoRegistrados = array();

			foreach ($this->data["Investigador"] as $investigador) {
				if ($investigador["id"] != $idInvestigador) {
					$autoresNoRegistrados[] = array("nombre" => $investigador["DatosPersonales"]["nombre_completo"], "db" => true);
				}
			}

			foreach ($this->data["Inr"] as $inr) {
				$correos = array();

				foreach ($inr["Correo"] as $correo) {
					array_push($correos, $correo["correo"]);
				}

				$autoresNoRegistrados[] = array("nombre" => $inr["nombre"], "correos" => $correos, "db" => true);
			}

			$jsonNoRegistrados = json_encode($autoresNoRegistrados);

			$posicionPaginas = array( array(0, 1), array(0, 1), array(1, 1));
			$posicionPaginasLogo = "bookmark-logo-3";
			$objetivosBookmark = "<p>Grafo es una red social orientada a científicos, específicamente del <a href='http://www.conacyt.mx/'>CONACYT</a>,
		 tiene como fín dar a conocer científicos mexicanos y sus publicaciones, la unión de científicos con el sector empresarial. </p>
		 <p>La gráfica de a continuación muestra el porcentaje de científicos en las 7 áreas principales del estado de Aguascalientes que se han unido a Grafo.</p>";
			$this -> set(compact('publicaciones', 'areasSni', 'estadosPublicaciones', 'posicionPaginas', 'posicionPaginasLogo', 'objetivosBookmark'));
			$this -> set(compact('areasSni', 'estadosPublicaciones', 'posicionPaginas', 'posicionPaginasLogo', 'objetivosBookmark', 'palabrasClave', 'jsonNoRegistrados'));
		}
	}

	/**
	 *  Función AJAX para recuperar datos relacionados a este Controlador
	 */
	function ajax($metodo) {
		$this -> layout = 'ajax';
		$this -> autoRender = false;
		$valor = trim($_POST['value']);
		if ($metodo == "titulosPublicaciones") {
			echo $this -> obtenerJsonPorValorPublicaciones($valor);
		}else if ($metodo == "palabrasClave") {
			echo $this -> ArrayJsonSearch -> obtenerArregloIdValueJson($this -> Publicacion -> PalabraClave -> find('list'), $valor);
		}else if ($metodo == "investigadores") {
			echo $this -> obtenerJsonInvestigadores($valor);
		}else if ($metodo == "existeInvestigadores") {
			if ($this -> Publicacion -> Investigador -> DatosPersonales -> field("id", array("nombre_completo LIKE" => $valor))) {
				return json_encode(array("resultado" => true));
			} else {
				return json_encode(array("resultado" => false));
			}
		}
	}

	function obtenerJsonPorValorPublicaciones($valor) {
		if ((!isset($valor) || $valor == ''))
			exit ;
		$parametrosContain = array("Investigador" => array("id" => array(), "DatosPersonales" => array("id", "nombre_completo"), "Usuario" => array("id", "correo")));
		$this -> Publicacion -> Behaviors -> attach('Containable', array('recursive' => true, 'notices' => true));
		$publicaciones = $this -> Publicacion -> find('all', array('contain' => $parametrosContain));

		//publicaciones
		$arreglo = array();
		foreach ($publicaciones as $publicacion) {
			if (strpos($publicacion["Publicacion"]["titulo"], $valor) === 0 || strpos(strtoupper($publicacion["Publicacion"]["titulo"]), strtoupper($valor)) === 0) {
				$arreglo[] = array("id" => $publicacion["Publicacion"]["id"], "value" => $publicacion["Publicacion"]["titulo"], "correo" => $publicacion["Investigador"][0]["Usuario"]["correo"], "nombre" => $publicacion["Investigador"][0]["DatosPersonales"]["nombre_completo"]);
			}
		}

		return json_encode($arreglo);
	}

	function obtenerJsonInvestigadores($valor) {
		if ((!isset($valor) || $valor == ''))
			exit ;
		$parametrosContain = array("DatosPersonales" => array("id", "nombre_completo"));
		$this -> Publicacion -> Investigador -> Behaviors -> attach('Containable', array('recursive' => true, 'notices' => true));
		$investigadores = $this -> Publicacion -> Investigador -> find("all", array('contain' => $parametrosContain));

		$arreglo = array();

		foreach ($investigadores as $investigador) {
			if (strpos($investigador["DatosPersonales"]["nombre_completo"], $valor) === 0 || strpos(strtoupper($investigador["DatosPersonales"]["nombre_completo"]), strtoupper($valor)) === 0) {
				$arreglo[] = array("investigador_id" => $investigador["Investigador"]["id"], "value" => $investigador["DatosPersonales"]["nombre_completo"]);
			}
		}
		return json_encode($arreglo);
	}

	function eliminar($id = null) {
		if (!$id) {
			$this -> Session -> setFlash('Publicación erronea.', 'default', array('class' => 'mensaje-error'));
			$this -> redirect(array('action' => 'add'));
		}
		if ($this -> Publicacion -> delete($id)) {
			$this -> Session -> setFlash('La publicación se ha eliminado correctamente.', 'default', array('class' => 'mensaje-ok'));
			$this -> redirect(array('action' => 'add'));
		}
		$this -> Session -> setFlash('Publicación erronea.', 'default', array('class' => 'mensaje-error'));
		$this -> redirect(array('action' => 'add'));
	}

}
