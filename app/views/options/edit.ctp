<div class="options">
<?php echo $this->Form->create('Option');?>
	<fieldset>
		<legend>Editar Leyenda</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('contenido');
	?>
	</fieldset>
<?php echo $this->Form->end('Actualizar');?>
</div>
<p><?php echo $this->Html->link('Regresar', array("controller"=>"panel","action"=>"index")); ?></p>