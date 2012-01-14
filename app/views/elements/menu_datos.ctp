<?php
/**
 * Recibe array $posicion, que es el lugar de la página actual.
 * 	[0] => Si no es 0, esta dentro
 *  [1] => Si no es 0, puede acceder a él
 */

 $links = array(
 			'Datos Personales' => array('controller' => 'datos_personales', 'action' => 'edit'),
 			'Datos Profesionales' => array('controller' => 'datos_profesionales', 'action' => 'edit'),
 			'Publicaciones' => array('controller' => 'publicaciones', 'action' => 'add')
			);

 ?>
<div id="menu_datos">
<ul>
	<li>
		<?php
		if($posicion[0][1]){
			$linkPos = "Datos Personales";
			$posicionPage = 0;
			echo $this->Html->link($linkPos,  $links[$linkPos], array("class"=> ($posicion[0][0])? 'activo':''));
		}
		?>
	</li>
	<li class="line"></li>
	<li>
		<?php
		if($posicion[1][1]){
			$linkPos = "Datos Profesionales";
			$posicionPage = 1;
			echo $this->Html->link($linkPos, $links[$linkPos], array("class"=>($posicion[1][0])? 'activo':'')); 
		}
			
		?>
	</li>
	<li class="line"></li>
	<li <?php if($posicion[2][0]) echo 'class="activo"';?>>
		<?php
		if($posicion[2][1]){
			$linkPos = "Publicaciones";
			$posicionPage = 2;
			echo $this->Html->link($linkPos, $links[$linkPos], array("class"=>($posicion[2][0])? 'activo':'')); 
		}
	 		
	 	?>
	</li>
</ul>
<div class="cl"></div>
</div>