<div class="botonFormularioAdelante"><?php echo $this->Html->link("Adelente",array("controller"=>"datos_profesionales", "action"=>"edit")); ?></div>
<h3>Datos Personales</h3>
<?php
	echo $this->Form->create('DatosPersonales');
	echo $this->Form->input('DatosPersonales.id');
	echo $this->Form->input('DatosPersonales.nombres', array("label"=> "Nombres", "class" => ""));
	echo $this->Form->input('DatosPersonales.apellidos', array("label"=> "Apellidos", "class" => ""));
	echo $this->Form->input('DatosPersonales.sexo_id', array("label"=> "Sexo", "class" => ""));
	echo $this->Form->input('DatosPersonales.fecha_nacimiento', array("label"=> "Fecha de Nacimiento", "class" => "", 'minYear' =>date('Y') - 60,'maxYear' => date('Y')));
	echo $this->Form->input('DatosPersonales.imagen_id', array("label"=> "Fotografía", "type"=>"text",  "class" => "","div"=>"principal-contenedor-imagen-perfil input", 'before'=> '<div class="contenedor-imagen-perfil"><span class="leyenda-fotografia">Fotografía actual</span><img id="imagen-perfil" src="'.$imagenPerfil.'" /></div>'));
	echo $this->Form->end("Actualizar información personal");
?>
<script type='text/javascript' src='js/jquery-1.4.2.js'></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.cakephp.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
$(function(){
	$("#DatosPersonalesImagenId").cakephp({
		"controlador" : "imagenes",
		"accion" : "edit/<?php echo $imagen_id; ?>",
		"cssAccion" : "",
		"label" : "Click para actualizar fotografía",
		"mensajeCorrecto" : "",
		"rutaJs" : "."
	}, function (data){
		console.dir(data);
		if(data.estado){
			$("#imagen-perfil").fadeOut(1000, function(){
				$(this).attr("src", "." + data.resultado.path + data.resultado.th).fadeIn("slow");
			});
			$("#DatosPersonalesImagenId").val(data.resultado.id);	
		}else{
			alert(data.mensaje);
		}
	});
});

</script>