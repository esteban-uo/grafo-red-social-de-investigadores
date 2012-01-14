<div class="page-upload-image">
	<?php echo $this->Form->create('Imagen',array('type'=>'file'));?>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('url', array('type'=>'file', "label"=>false));
		?>
	<?php echo $this->Form->end('Subir fotografía');?>
</div>