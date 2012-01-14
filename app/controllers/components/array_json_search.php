<?php
class ArrayJsonSearchComponent extends Object {
    
	/**
	 *  Obtiene un arreglo array("id"=>"valor") y obtiene un arreglo de objetos [{id:id,value:"valor"}]
	 */
	function obtenerArregloIdValueJson($array, $valor){
		if ((!isset($valor) || $valor == '') ) exit;
		$arregloJson = array();
		while ($boolean = current($array)) {
		    $key = key($array);
			if (strpos($array[$key], $valor) === 0 || strpos(strtoupper($array[$key]), strtoupper($valor)) === 0){
				$arregloJson[] = array(
							"id" => $key,
							"value" => $array[$key]
				);
				
				if (count($arregloJson) >= 10)
					break;
			}
		    next($array);
		}
		return json_encode($arregloJson);
	}
	
	/**
	 *  Obtiene un arreglo array("id"=>"valor", ) y obtiene un arreglo de objetos [{id:id,value:"valor"}]
	 */
	
}

?>
