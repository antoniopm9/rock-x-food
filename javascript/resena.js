$(function(){
	
	// Array para las puntuaciones
	var aPunt = ["Muy malo", "Malo", "Ok", "Bueno", "Excelente"];
	
	// Array para los atributos de las estrellas
	// Array para las puntuaciones
	var aEstr = ["oneStar", "twoStars", "threeStars", "fourStars", "fiveStars"];
		
	// Añado el evento a la descripción
	$('#resena').on('keyup', cuentaLetras);
	
	// Añado los eventos a las estrellas
	for(var i=0;i<5;i++){
		$('.puntEstrella:eq('+i+')').on('click',{numEstrella:i}, function(e){
			
			// Elimino el color de las estrellas
			for(var cont=0; cont<=5;cont++){
				$('.puntEstrella:eq('+cont+')').attr(
						"class", "fa fa-star py-2 px-1 rate-popover puntEstrella ");
			
			}
			
			for(var i=0;i<=e.data.numEstrella; i++){
				
				// Modifico el atributo de las estrellas para que se muestren con colores
				$('.puntEstrella:eq('+i+')').attr(
						"class", $('.puntEstrella:eq('+i+')').attr("class")+ " " + aEstr[e.data.numEstrella]);
			}
			
			// Añado la descripción de la estrella al input
			$("#puntuacion").attr("value",aPunt[e.data.numEstrella]);

		});
	}
	
	// Evento para comprobar la veracidad de los datos
	$('#muyMalo, #malo, #ok, #bueno, #excelente').on('click', function(e){verificarDatos(e)});
	$('#resena, #platoFavorito').on('keyup', function(e){verificarDatos(e)});
	
	// Método que se ejecuta cuando se suelta una tecla en el
	// campo descripción. Con esto contaré el número de
	// caracteres que lleva y rellenaré una barra de progreso
	function cuentaLetras(){
		 
		 // Obtengo la longitud de la cadena y la escribo
		 var $cadena = $('#resena').val();
		 
		 var longitud = $cadena.length;
		 // Si la longitud de la barra es menor de 500, el color
		 // de la barra será verde, pero si se pasa será rojo
		 
		 if(longitud<=300){
			 
			 $('#barra').attr("class", "progress-bar progress-bar-striped progress-bar-animated bg-success");
		 }
		 else{
			 $('#barra').attr("class", "progress-bar progress-bar-striped progress-bar-animated bg-danger"); 
		 }
		 
		 $('#barra').html(longitud + " / 300");
		 
		 $('#barra').attr("style", "width:"+longitud/3+"%");
		 $('#barra').attr("aria-valuenow",longitud);
	}
	 
	 // Función encargada de verificar los datos
	 function verificarDatos(e){
		 
		// Cuando se incumpla algún requisito, este boolean se cambiará
		// a false
		 var sw = true;
		 
		 if($('#puntuacion').val()==""){
			 sw = false;
			 if(e.target.id == "muyMalo" || e.target.id == "malo" ||
				e.target.id == "ok" || e.target.id == "bueno" ||
				e.target.id == "excelente"){
				 
			 	creaDivAlerta("errorPuntuacion", "Introduce una puntuación para el restaurante", "#divPuntuacion");
		 	}
		 }
		 else{
			 $("#errorPuntuacion").remove();
		 }
		 
		 if($('#resena').val().length>300 ||
				 $('#resena').val().length<=0 ){
			 sw = false;
			 if(e.target.id == "resena"){
				 creaDivAlerta("errorResena",
						 "La reseña debe tener entre 1 y 300 caracteres",
						 "#resena");
			 }
		 }
		 
		 else{
			 $('#errorResena').remove();
		 }
		 
		 if($('#platoFavorito').val()==""){
			 sw = false;
			 if(e.target.id == "platoFavorito"){
				 creaDivAlerta("errorPlatoFavorito", "Introduce un plato favorito para el restaurante", "#platoFavorito");
			 }
		 }
		 else{
			 $("#errorPlatoFavorito").remove(); 
		 }
		 
		// Si el sw es verdadero, habilito el botón
		 if(sw){
			 $('#guardar').removeAttr("disabled");
		 }
		 // Si es falso lo deshabilito
		 else{
			 $('#guardar').attr("disabled", "disabled");
		 }
		 
	 }
	 
	// -------
	// ALERTAS
	// -------
	function creaDivAlerta(nombreDiv, mensaje, insercion){
	 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#'+nombreDiv).remove();
		 
		 $divAlert = $('<div id="'+nombreDiv+'" class="text-danger" role="alert"> '+
				 mensaje+'</div>');
		 
		 $divAlert.insertAfter(insercion);
		 
	 }
		
	
});