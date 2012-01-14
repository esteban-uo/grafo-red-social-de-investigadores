<?php
	if(!$this->Session->read("Logeado.root")):
		echo $this->Form->create('Panel');
		echo $this->Form->input('password');
		echo $this->Form->end("Validar");
	else:
?>
	<div>
		<fieldset>
			<legend>Correo a uno</legend>
		<?php
			echo $this->Form->create('Panel');
			echo $this->Form->input('Panel1.correoaenviar', array("label"=>"Correo a Enviar"));
			echo $this->Form->input('accion', array("value"=>"1", "type"=>"hidden"));
			echo $this->Form->end("Enviar Correo");
		?>
		</fieldset>
	</div>
	<div>
		<fieldset>
			<legend>Correo a Todos</legend>
		<?php
			echo $this->Form->create('Panel');
			echo $this->Form->input('accion', array("value"=>"2", "type"=>"hidden"));
			echo $this->Form->end("Enviar Correo a todos");
		?>
		</fieldset>
	</div>
	<div>
		<fieldset>
			<legend>Modificar Contenidos</legend>
			<ul>
				<li><?php echo $this->Html->link('Inicio', array("controller"=>"options","action"=>"edit", 1)); ?></li>
				<li><?php echo $this->Html->link('Privacidad', array("controller"=>"options","action"=>"edit", 2)); ?></li>
				<li><?php echo $this->Html->link('Privacidad (texto política)', array("controller"=>"options","action"=>"edit", 3)); ?></li>
				<li><?php echo $this->Html->link('Datos Personales', array("controller"=>"options","action"=>"edit", 4)); ?></li>
				<li><?php echo $this->Html->link('Datos Profesionales', array("controller"=>"options","action"=>"edit", 5)); ?></li>
				<li><?php echo $this->Html->link('Publicaciones', array("controller"=>"options","action"=>"edit", 6)); ?></li>
				<li><?php echo $this->Html->link('Perfil', array("controller"=>"options","action"=>"edit", 7)); ?></li>
			</ul>
		</fieldset>
	</div>
	<div>
		<p><?php echo $this->Html->link('Desconectarse', array("controller"=>"panel","action"=>"desconectarse")); ?></p>
	</div>
<?php
	endif;
?>