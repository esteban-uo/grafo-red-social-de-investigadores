<script type='text/javascript' src='../js/jquery-1.4.2.js'></script>
<script type='text/javascript' src='../js/jquery.metadata.js'></script>
<script type='text/javascript' src='../js/jquery.auto-complete.js'></script>
<script type='text/javascript' src='../js/json2.min.js'></script>
<script type='text/javascript' src='../js/app.js'></script>
<script type="text/javascript">
	$(function(){
		var autoresArray = <?php echo $jsonNoRegistrados; ?>;
		var palabrasClave = <?php echo $palabrasClave; ?>;
		var autores = [];
		
		var stringPalabrasClave = "";
		for (var i=0; i < palabrasClave.length; i++) {
		  stringPalabrasClave += palabrasClave[i].nombre+", ";
		}
		$("#PalabrasClavesConjunto").val(stringPalabrasClave);
		
		for(var i=0; i<autoresArray.length; i++){
		    var correos = "";
		    if(autoresArray[i].correos != null){
			    for(var j=0; j<autoresArray[i].correos.length; j++){
			       correos += autoresArray[i].correos[j]+", ";
			    }
			    $("#contenedor-autores ul").append(crearLista(autoresArray[i].nombre, correos, autoresArray[i].db));
		    }else{
		    	$("#contenedor-autores ul").append(crearLista(autoresArray[i].nombre, null, autoresArray[i].db));
		    }
		}
		
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
		         $.post('../publicaciones/ajax/existeInvestigadores', {value:autor}, function(data) {
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
		
		function crearLista(autor, correosArreglo, bd){
			var correos = "";
			if(correosArreglo != null){
				correos = ": <span>"+ correosArreglo + "</span>"
			}
			var objetoAutor = {nombre:autor,correos:correosArreglo, registrado:bd};
			autores.push(objetoAutor);
			
			return $('<li><span>' + autor + ' </span>'+ correos + '</li>').append($('<a href="#">Remover</a>').click(function(){
							var li = $(this).parent();
							li.fadeOut("slow", function(){
								autores[li.index()]["eliminado"] = "true";
								$(this).remove();
							});
							return false;
			}));
		}
		
		$("#PublicacionEditForm").submit(function(){
			var palabrasNuevas = $("#PalabrasClavesConjunto").val().split(',');
			var arregloNuevo = [];
			for(var i=0; i<palabrasClave.length; i++){
			        var encontrada = false;
				for(var j=0; j<palabrasNuevas.length; j++){
			                palabrasNuevas[j] = $.trim(palabrasNuevas[j]);
			                if(palabrasClave[i].nombre == palabrasNuevas[j]){
			                    encontrada = true;
			                    palabrasNuevas.splice(j, 1);
			                }
				}
			    if(!encontrada){
			         arregloNuevo.push({"palabra":palabrasClave[i].nombre, "agregada":"0"});
			         var encontrada = false;
			    }
			}
			
			for(var i = 0; i<palabrasNuevas.length; i++){
			    arregloNuevo.push({"palabra":palabrasNuevas[i], "agregada":"1"});
			}
			
			$(this).append($('<input type="hidden" name=data[PalabrasClave][json] />').val(JSON.stringify(arregloNuevo)));
			$(this).append($('<input type="hidden" name=data[Autores][input] />').val(JSON.stringify(autores)));
		});	
		
		autoCompletar('#PublicacionesTitulo', 'publicaciones/ajax/titulosPublicaciones', "#mensajeTituloPublicacion");
		autoCompletarMultiples('#PalabrasClavesConjunto', 'publicaciones/ajax/palabrasClave');
		autoCompletarInsterarOpciones('#AutorRegistradoInput', 'publicaciones/ajax/investigadores', "#removerAutorBtn", "#AutorRegistradoOptions", "#agregarAutorNoRegistradoBtn", 'publicaciones/ajax/existeInvestigadores');
		
	});
</script>
<div class="botonFormularioAtras"><?php echo $this->Html->link("Atrás", array("controller"=>"publicaciones", "action"=>"add")); ?></div>
<h3>Publicaciones</h3>
<?php
	echo $this->Form->create('Publicacion');
	echo $this->Form->input('Publicacion.id');
	echo $this->Form->input('Publicacion.titulo', array("label"=> "Título", "class" => "", 'before' => '<div id="mensajeTituloPublicacion"><ul><li>Autor: <span class="nombre"></span></li><li>Correo: <span class="correo"></span></li></ul></div>'));
	echo $this->Form->input('Publicacion.fecha_publicacion', array("type"=>"date", "label"=> "Fecha de Publicación", "class" => "", 'minYear' =>date('Y') - 60,'maxYear' => date('Y')));
	echo $this->Form->input('Publicacion.area_sni_id', array("label"=> "Área de SNI", "class" => ""));
	echo $this->Form->input('Publicacion.resumen', array("label"=> "Abstract", 'type' => 'textarea', "class" => ""));
	echo $this->Form->input('Publicacion.estado_publicacion_id', array("label"=> "Estado de la publicación", "class" => ""));
	echo $this->Form->input('PalabrasClaves.conjunto', array("label"=> "Palabras Claves (separa con coma cada palabra clave)", "class" => "", "value"=>""));
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
	echo $this->Form->end("Actualizar publicación");
?>