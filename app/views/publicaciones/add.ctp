<script type='text/javascript' src='js/jquery-1.4.2.js'></script>
<script type='text/javascript' src='js/jquery.metadata.js'></script>
<script type='text/javascript' src='js/jquery.auto-complete.js'></script>
<script type='text/javascript' src='js/json2.min.js'></script>
<script type='text/javascript' src='js/app.js'></script>
<script type="text/javascript">
	$(function(){
		var autores = [];
		$("#agregarPublicacionBoton").click(function(){
			$(this).next().toggle("slow");
			var a = $(this).find("a");
			if(a.html() == "Ocultar"){
				a.html("¿Agregar Publicación?");
			}else{
				a.html("Ocultar");
			}
			return false;
		});
		
		$("#agregarAutorNoRegistradoBtn").click(function(){
			var autorRegistradoInput = $("#AutorRegistradoInput");
		    var autor = autorRegistradoInput.val();
		    var existeAutor = true;
		    if(autor != ""){
		         $.post('./publicaciones/ajax/existeInvestigadores', {value:autor}, function(data) {
				   existeAutor = data.resultado;
				   autorRegistradoInput.attr("disabled", true); 
					var divAutorNoRegistrado = $("#correosAutorNoRegistrado");
					if(!existeAutor){
						divAutorNoRegistrado.slideDown("slow", function(){
							var autorNoRegistrado = $("#AutorNoRegistradoCorreos");
							autorNoRegistrado.focus();
							$("#agregarCorreoNoRegistradoBtn").bind('click', function(){
								var noRegistradosCorreos = $("#AutorNoRegistradoCorreos");
								var correosArreglo = $.trim(noRegistradosCorreos.val());
								if(correosArreglo == "" || correosArreglo == null){
									alert("Porfavor agrega por lo menos un correo.");
									return;
								}
								$("#contenedor-autores ul").append(crearLista(autor, correosArreglo));
								divAutorNoRegistrado.slideUp("fast", function(){
									autorRegistradoInput.val("").focus();
									noRegistradosCorreos.val("");
								});
								$(this).unbind("click");
								autorRegistradoInput.removeAttr("disabled");
								autorRegistradoInput.val("").focus();
								noRegistradosCorreos.val("");
							});
						});
					}else{
						$("#contenedor-autores ul").append(crearLista(autor));
						autorRegistradoInput.removeAttr("disabled");
						autorRegistradoInput.val("").focus();
					}
				}, "json");
		    }else{
		        return;
		    }
		});
		
		function crearLista(autor, correosArreglo){
			var correos = "";
			if(correosArreglo != null){
				correos = ": <span>"+ correosArreglo + "</span>"
			}
			var objetoAutor = {nombre:autor,correos:correosArreglo};
			autores.push(objetoAutor);
			
			return $('<li><span>' + autor + ' </span>'+ correos + '</li>').append($('<a href="#">Remover</a>').click(function(){
							var li = $(this).parent();
							autores.splice(li.index(), 1);
							li.fadeOut("slow", function(){
								$(this).remove();
								autores.splice(li.index(), 1);
							});
							return false;
			}));
		}
		
		$("#PublicacionAddForm").submit(function(){
			var input = $('<input type="hidden" name=data[Autores][input] />').val(JSON.stringify(autores));
			$(this).append(input);
		});		
		
		autoCompletar('#PublicacionesTitulo', 'publicaciones/ajax/titulosPublicaciones', "#mensajeTituloPublicacion");
		autoCompletarMultiples('#PalabrasClavesConjunto', 'publicaciones/ajax/palabrasClave');
		autoCompletarInsterarOpciones('#AutorRegistradoInput', 'publicaciones/ajax/investigadores', "#removerAutorBtn", "#AutorRegistradoOptions", "#agregarAutorNoRegistradoBtn", 'publicaciones/ajax/existeInvestigadores');
		
	});
</script>
<div class="botonFormularioAtras"><?php echo $this->Html->link("Atrás", array("controller"=>"datos_profesionales", "action"=>"edit")); ?></div>
<div id="wrapper-publicaciones">
<?php
	if(isset($publicaciones)):
		$clase = "oculto";
?>
	<h3>Publicaciones</h3>
<div id="agregarPublicacionBoton"><a href="#">¿Agregar Publicación?</a></div>
<div id="nuevas-publicaciones" class="<?php echo $clase; ?>">
<?php
	echo $this->Form->create('Publicacion');
	echo $this->Form->input('Publicacion.titulo', array("label"=> "Título", "class" => "", 'before' => '<div id="mensajeTituloPublicacion"><ul><li>Autor: <span class="nombre"></span></li><li>Correo: <span class="correo"></span></li></ul></div>'));
	echo $this->Form->input('Publicacion.fecha_publicacion', array("type"=>"date", "label"=> "Fecha de Publicación", "class" => "", 'minYear' =>date('Y') - 60,'maxYear' => date('Y')));
	echo $this->Form->input('Publicacion.area_sni_id', array("label"=> "Área de SNI", "class" => ""));
	echo $this->Form->input('Publicacion.resumen', array("label"=> "Abstract", 'type' => 'textarea', "class" => ""));
	echo $this->Form->input('Publicacion.estado_publicacion_id', array("label"=> "Estado de la publicación", "class" => ""));
	echo $this->Form->input('PalabrasClaves.conjunto', array("label"=> "Palabras Claves (separa con coma cada palabra clave)", "class" => ""));
?>


	<div id="autoresPublicaciones">
		<div>
			<?php
				echo $this->Form->input('AutorRegistrado.input', array("label"=> "Autores", "class" => "", "after"=> '<input type="button" id="agregarAutorNoRegistradoBtn" class="boton-agregar" value="Agregar" />'));
				echo $this->Form->input('AutorNoRegistrado.correos', array("label"=> "Correo(s) (Usa coma para separar múltiples)", "div" => array("id"=>"correosAutorNoRegistrado",  "class" => "oculto"), "after"=> '<input type="button" id="agregarCorreoNoRegistradoBtn" class="boton-agregar" value="Agregar correo(s)" />'));
			?>
		</div>
		<div class="cb"></div>
		<div id="contenedor-autores" class="redondar5px"><ul></ul></div>
	</div>
	<div class="cl"></div>
<?php
	echo $this->Form->end(array("name"=>"Guardar", "label"=>"Crear Publicación", "class" => ""));
?>
</div>
	<?php
		foreach ($publicaciones as $publicacion):
	?>
		<div class="box-publicacion redondar5px">
			<div class="tool-publicacion">
				<?php
					echo $this->Html->link("Editar", array("controller"=>"publicaciones", "action"=>"edit", $publicacion["id"]), array("class"=>"editar-publicacion"));
					echo $this->Html->link("Borrar", array('action'=>'eliminar', $publicacion["id"]), null, sprintf(__('¿Eliminar la publicación de "%s"?', true), $publicacion["titulo"], array("class"=>"borrar-publicacion")));
				?>
			</div>
			<ul>
				<li class="titulo-publicacion"><?php echo $publicacion["titulo"]; ?>, <span class="cursiva"><?php echo $this->Time->format("Y", $publicacion["fecha_publicacion"]); ?></span></li>
				<li class="abstract-publicacion redondar5px"><?php echo $publicacion["resumen"]; ?></li>
			</ul>
		</div>
	<?php endforeach; ?>
<?php
	else:
		$clase = "";
	endif; 
?>
</div>