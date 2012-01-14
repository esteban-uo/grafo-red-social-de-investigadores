/**
*	@author darknavi esteban.uscanga@tekiotl.com
*	Plugin para modelos en cakephp
*/
(function($){
  $.fn.cakephp = function(parametros, callback) {
		var eDOM = this;
		eDOM.hide();
		eDOM.parent().append($('<div id="panelTmpAjax"></div>'));
		var panel = $("#panelTmpAjax");
		panel.append($('<input id="botonGenerarAjax" type="button" value="'+parametros.label+'" class="'+parametros.cssAccion+'" />'));
		$("#botonGenerarAjax").bind("click", function(){
								$(this).attr("disabled","disabled");
								$.ajax({
									url: parametros.rutaJs+"/"+parametros.controlador+"/"+parametros.accion,
									type: 'POST',
									success: function(respuesta){
										$('body').css('overflow-y', 'hidden');
										$('<div id="overlay"></div>')
											.css('top', $(document).scrollTop())
											.css('opacity', '0')
											.animate({'opacity': '0.5'}, 'slow')
											.appendTo('body');
										
										$('<div id="lightbox"></div>')
											.hide()
											.appendTo('body');
										
										$('#lightbox').append(respuesta);
										
										var top = ($(window).height() - $('#lightbox').height()) / 2;
										var left = ($(window).width() - $('#lightbox').width()) / 2;
										
										$('#lightbox').append($('<a href="" id="cerrarLightBox" title="Cerrar" >Cerrar</a>').bind("click", function(){
											cerrarLightBox();
											return false;
										}));
										
										$('#lightbox')
										.css({
										'top': top + $(document).scrollTop(),
										'left': left
										})
										.fadeIn();
										
										var formulario = $('#lightbox').find('form');
										formulario.submit(function() {
											$(this).ajaxSubmit({
																url: parametros.rutaJs+"/"+parametros.controlador+"/"+parametros.accion,
																dataType: 'json',
																success: function(response){
																	cerrarLightBox();
																	if($.isFunction(callback)) {
																		callback.call(this, (response == null)? {estado:false, mensaje : "Sin respuesta del servidor."} : response);
																	}
																}
															}); 
											return false; 
										});
									},
									dataType: 'html'
								});
						  });
	
	$(document).keypress(function(e){
		if (e.keyCode == 27 && $("#overlay").length > 0) {
				cerrarLightBox();
		}
	});
	
	function cerrarLightBox(){
		$('#overlay, #lightbox')
				.fadeOut('slow', function() {
					$(this).remove();
					$('body').css('overflow-y', 'auto');
					$("#botonGenerarAjax").removeAttr("disabled");
		});
	}
	
	function l(parametros){
		console.log(parametros);
	}
	
  };
})( jQuery );