$(function(){
	
	$("#buscador").on('keyup',buscar);
	
	// Cuando se pulsa el botón de mostrar búsqueda avanzada,
	// la página web centra la atención en el formulario que
	// se expande, desenfocando el resto y restableciendo los
	// valores por defecto
	$("#mostrar").on("click", function(){
		$(".filas").toggleClass("desenfoqueRes");
		if($(".filas").hasClass("desenfoqueRes")){
			$('#buscador').attr("disabled","disabled");
			$("#buscador").val("");
			$('.nombre').parent().removeAttr('style');
			$('#error').remove();
		}
		else{
			$('#buscador').removeAttr("disabled");
		}
	});
	
	// Definición de contains insensitivo
	// (A la hora de hacer búsquedas no tiene 
	// en cuenta ni mayúsculas ni minúsculas)
	$.extend($.expr[':'], {
		'containsi': function(elem, i, match, array)
		{
			return (quitarTildes(elem.textContent) || quitarTildes(elem.innerText) || '').toLowerCase()
					.indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});
	
	// Función que quita las tildes de un string
	const quitarTildes = (str) => {
		  return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
		  
		} 
	
	function buscar(){
		
		// Cada vez que busco debo volver a mostrar todas
		// las opciones
		$('.nombre').parent().removeAttr('style');
		
		// Debo borrar el mensaje de error si hubiera
		$('#error').remove();
		$('.filas br').remove();
		
		// Obtengo el texto a buscar
		var $busqueda = quitarTildes($('#buscador').val());
		
		// Obtengo los divs de los padres que no contienen la palabra a buscar
		var $nombres = $('.nombre').not(":containsi("+$busqueda+")").parent();
		
		// Obtengo los divs de los padres que SÍ contienen la palabra a buscar
		var $nombresSi = $('.nombre:containsi('+$busqueda+')').parent();
			
		// Oculto todos los elementos de este array
		$nombres.attr("style", "display: none;");
		
		// Si no ha encontrado nada se lo indico al usuario
		if($nombresSi.length == 0){
			$('<br>').appendTo(".filas");
			$('<h1 id="error">Vaya, no hemos encontrado '+
					'lo que estabas buscando :(</h1>').appendTo(".filas");
			
			
		}
		for(let i=0; i<15;i++){
			$('<br>').appendTo(".filas");
		}
		
	}
	
	
});