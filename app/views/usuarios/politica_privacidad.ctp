<h2>Política de privacidad</h2>
<?php
	echo $this->Form->create('Usuario'); 
	echo $this->Form->input('', array("label"=>false, "type"=>"textarea", "class"=>"text-area-privacidad", "rows"=>15, "value"=> $politicaPrivacidad));
	echo $this->Form->input('Usuario.acepto', array("type"=>"hidden", "value"=>true));
	echo $this->Form->end(array("name"=>"Acepto", "label"=>"Acepto", "class" => "fl"));
?>
<div><input value="Declino" type="button" class="botonSubmit fl" onclick="window.location.href='./desconectarse'" /></div>
<div class="cl" style="height: 53px"></div>