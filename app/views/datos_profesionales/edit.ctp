<script type='text/javascript' src='js/jquery-1.4.2.js'></script>
<script type='text/javascript' src='js/jquery.metadata.js'></script>
<script type='text/javascript' src='js/jquery.auto-complete.js'></script>
<script type='text/javascript' src='js/app.js'></script>
<script type="text/javascript">
	$(function(){
		autoCompletarAsignarId('#DatosProfesionalesAlternoTitulo', 'datosProfesionales/ajax/titulos', '#DatosProfesionalesTituloId');
		autoCompletarAsignarId('#DatosProfesionalesAlternoDependencia', 'datosProfesionales/ajax/dependencias', '#DatosProfesionalesDependenciaId');
		autoCompletarAsignarId('#DatosProfesionalesAlternoInstitucion', 'datosProfesionales/ajax/instituciones', '#DatosProfesionalesInstitucionId');
		autoCompletarAsignarId('#DatosProfesionalesAlternoAreaSni', 'datosProfesionales/ajax/areasSni', '#DatosProfesionalesAreaSniId');
	});
</script>
<div class="botonFormularioAtras"><?php echo $this->Html->link("Atrás", array("controller"=>"datos_personales", "action"=>"edit")); ?></div>
<div class="botonFormularioAdelante"><?php echo $this->Html->link("Adelente",array("controller"=>"publicaciones", "action"=>"add")); ?></div>
<h3>Datos Profesionales</h3>
<?php
echo $this -> Form -> create('DatosProfesionales');
echo $this -> Form -> input('DatosProfesionales.id', array('type' => 'hidden'));

echo $this -> Form -> input('DatosProfesionales.titulo_id', array("label" => "Título", "class" => ""));

echo $this -> Form -> input('DatosProfesionales.nivel_sni_id', array("label" => "Nivel de SNI", "class" => ""));

echo $this -> Form -> input('DatosProfesionales.alterno.dependencia', array("label" => "Dependencia", "class" => "", "value" => $dependencia));
echo $this -> Form -> input('DatosProfesionales.dependencia_id', array("type"=>"hidden", "label" => "Dependencia", "class" => ""));

echo $this -> Form -> input('DatosProfesionales.institucion_id', array("label" => "Institución", "class" => ""));

echo $this -> Form -> input('DatosProfesionales.area_sni_id', array("label" => "Área de SNI", "class" => ""));

echo $this -> Form -> end(array("name" => "Actualizar", "label" => "Actualizar", "class" => ""));
?>