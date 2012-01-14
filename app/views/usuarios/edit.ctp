<div class="botonFormularioAtras"><?php echo $this->Html->link("Atrás", array("controller"=>"datos_personales", "action"=>"edit")); ?></div>
<h2>Editar Perfil</h2>
<?php
	echo $this->Form->create('Usuario');
	echo $this->Form->input('Usuario.id');
	echo $this->Form->input('Usuario.correo', array("label"=> "Correo electrónico", "class" => ""));
	echo $this->Form->input('Usuario.twitter');
	echo $this->Form->end(array("name"=>"Actualizar información", "label"=>"Actualizar Campos", "class" => ""));
?>