var rutaAbsoluta = "http://localhost/grafoCapturador/";

function autoCompletarAsignarId(muestraAutoCompletado, direccionAjax, campoValorId) {
	var accionAjax = function(event, ui) {
					console.log(ui.data.id);
					$(campoValorId).val(ui.data.id)
				}
				
	$(muestraAutoCompletado).autoComplete({
				autoFill : true,
				ajax : rutaAbsoluta + direccionAjax,
				delay : 200,
				onSelect : accionAjax,
				onRollover : accionAjax
			});
}

function autoCompletarInsterarOpciones(muestraAutoCompletado, direccionAjax, mostrarEn, botonRemover, botonAgregar, direccionValidar) {
	var mostrar = $(mostrarEn);
	var me = this;
	
	$(botonRemover).click(function(){
		mostrar.find(":selected").remove();
	});
	
	$(botonAgregar).click(function(){
		var autor = $(muestraAutoCompletado).val();
		$.post(rutaAbsoluta + direccionValidar, {value:autor}, function(data){
		}, "json");
	});
	
	var accionAjax = function(event, ui) {
					mostrar.append('<option value="'+ui.data.investigador_id+'">'+ui.data.value+" - Agregado"+'</option>');	
					$(muestraAutoCompletado).val("");
				}
	
	
	
	$(muestraAutoCompletado).autoComplete({
				autoFill : true,
				ajax : rutaAbsoluta + direccionAjax,
				delay : 200,
				onSelect : accionAjax,
				onRollover : accionAjax,
				onLoad : function(event, ui){
					me.arregloValores = ui.list;
					return ui.list;
				}
				
	});

}

function autoCompletarMultiples(muestraAutoCompletado, direccionAjax){	
	$(muestraAutoCompletado).autoComplete({
		autoFill : true,
		multiple: true,
		multipleSeparator: ',',
		striped: 'auto-complete-striped',
		ajax : rutaAbsoluta + direccionAjax,
		delay : 200
	});
}

function autoCompletar(muestraAutoCompletado, direccionAjax, mostrarEn) {
	var divMostrar = $(mostrarEn);
	
	var accionAjax = function(event, ui) {
					console.dir(ui.data);
					if(!divMostrar.is(":visible")){
						divMostrar.fadeIn("slow", function(){
							mostrarDatos(divMostrar, ui.data.nombre, ui.data.correo);
						});
					}else{
						mostrarDatos(divMostrar, ui.data.nombre, ui.data.correo);
					}
					
				}
	
	$(muestraAutoCompletado).autoComplete({
				autoFill : true,
				ajax : rutaAbsoluta + direccionAjax,
				delay : 200,
				onSelect : accionAjax,
				onRollover : accionAjax
	});
	
	function mostrarDatos(objeto, nombre, correo){
		objeto.find(".nombre").html(nombre);
		objeto.find(".correo").html(correo);
	}
}

function animacionMensajeFlash(elemento, altura, duracion){
    var jElemento = $(elemento);
    if(!jElemento){
		return;
	}
    var mensaje = jElemento.clone(false);
    var padre = jElemento.parent();
    jElemento.remove();
    padre.css({
        "position":"relative"
    });
    mensaje.css({
        "position":"absolute", 
        "display":"none", 
        "top":altura
    });
    padre.append(mensaje);
    mensaje.css({
        "left":((padre.width()/2) - (mensaje.width()/2))
    }).fadeTo(500,0.9).delay(duracion).fadeOut(1500,function(){
        $(this).remove();
    }); 
}


/* Extiende efecto animacion JQuery */
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	}
});

animacionMensajeFlash("#flashMessage", -100, 5000);
animacionMensajeFlash("#authMessage", -50, 5000);