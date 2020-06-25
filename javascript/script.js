$(function(){
	
	// Si existe localStorage, quiere decir que el usuario ha guardado
	// el color del texto
	if(localStorage.colorTexto){

		// Es posible que ya haya contenido en el atributo style,
		// así que lo recojo para no eliminarlo
		let $style = $("body").attr("style");
		
		if($style!=undefined)
			$("body").attr("style",$style+"color: "+localStorage.getItem("colorTexto")+";");
		else
			$("body").attr("style","color: "+localStorage.getItem("colorTexto")+";");
		
	}
	
	// Clono el div que contiene el formulario de los artistas
	var $divArtista = $('#divArtista').clone();
	
	// Código para mostrar el nombre del archivo seleccionado
	// en el formulario de registro
	 $('#imagen').on('change',function(){

		 // Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaImagen').remove();
		 
         //Obtengo el nombre del archivo
         var fileName = $(this).val().replace(/^.*[\\\/]/, '');
         //Cambio el texto para mostrar el nombre del archivo
         $(this).next('.custom-file-label').html(fileName);
         
         if(!validaImagen(fileName)){
        	 
        	 $divAlert = $('<div id="divAlertaImagen" class="text-danger" role="alert"> '+
			 'La imagen debe estar en formato .jpg o .png</div>');
	 
        	 $divAlert.insertAfter('#imagen');
        	 
         }
         
     });
	 
	 function validaImagen(fileName){
		 
		// Obtengo el tipo de imagen
         var extension = fileName.substring(fileName.length -3, fileName.length).toLowerCase();
         
         // Si el tipo de imagen es jpg o png, es correcto
         if(extension == "jpg" || extension == "png")
        	 return true;
		 
	 }
	
	$('.menu').click(function() {
		
		$("#nav").toggleClass("mostrar");
		
	});
	 
	 
	// Al radiobutton le pongo un evento de tipo
	// onchange para que cada vez que lo pulse
	// generar de manera dinámica los elementos
	// relacionados con el artista
	 $('#radioArtista').on('change', function(){
		 
	// Borro el div que contiene los campos del restaurante
	 $('#divRestaurante').remove();
	 
	 $divArtista.insertAfter('#divRadio2');
	 
	 // Añado los eventos necesarios
	 $('#genero, #anio, #musica').on('keyup', verificaDatos);
	 $('#anio').on("keyup", creaDivAlertaAnio);
	 $('#musica').on("keyup", creaDivAlertaMusica);
	 
	 // Deshabilito el botón de validar el restaurante
	 $('#submitRestaurante').attr("disabled", "disabled");
		 
	 });
	 
	 // Lo mismo, pero con los elementos del restaurante
	 $('#radioRestaurante').on('change', cambiaElementosRestaurante);
	 
	 
	 // Controlo que el nombre no esté vacío cuando pierda el foco
	 $('#nombreReg').on('blur', function(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlerta').remove();
		 
		 // Si no hay nada escrito, le muestro un error
		 if($('#nombreReg').val()==""){
			 
			 $divAlert = $('<div id="divAlerta" class="alert alert-danger" role="alert"> '+
					 'Campo vacío</div>');
			 
			 $divAlert.insertAfter('#nombreReg');
			 
			 // Efecto para remarcar que se ha equivocado
			 $( "#nombreReg" ).effect("shake");
		 }
		 
	 });
	 
	 // Compruebo que el correo insertado es válido
	 // con expresiones regulares
	 
	 function verificaCorreo(){
		 
		 var expresion = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
		 
		 if($('#correo').val().match(expresion))
			 return true;
		 
	 }
	 
	 $('#correo').on("keyup", function(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaCorreo').remove();
		 
		
		 // Si la expresión regular no coincide con 
		 // el correo insertado, se lo
		 // indico al usuario
		 if(!verificaCorreo()){
			 
			 $divAlert = $('<div id="divAlertaCorreo" class="text-danger" role="alert"> '+
					 'La dirección de correo no es válida</div>');
			 
			 $divAlert.insertAfter('#correo');
			 
		 }
		 
	 });
	 
	// Compruebo que la contraseña tenga de 3 a 12 letras
	 // con expresiones regulares
	 
	 function validaContra(){
		 
		 var expresion = /^[a-zA-Z]{3,12}$/;
		 
		 if($('#contra').val().match(expresion))
			 return true;
	 }
	 
	 $('#contra').on("keyup", function(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaContra').remove();
		 
		 // Si la expresión regular no coincide con 
		 // los requisitos de la contraseña, se lo
		 // indico al usuario
		 if(!validaContra()){
			 
			 $divAlert = $('<div id="divAlertaContra" class="text-danger" role="alert"> '+
					 'La contraseña debe ser entre 3 y 12 letras. No se admiten signos</div>');
			 
			 $divAlert.insertAfter('#contra');
			 
		 }
		 
	 });
	 
	// Compruebo que el año es un año comprendido entre
	// 1950 y el año actual
	 
	 function validaAnio(){
		 
		 var anio = new Date().getFullYear();
		 
		 if($('#anio').val()>=1950 && $('#anio').val()<=anio)
			 return true;
	 }
	 
	 $('#anio').on("keyup", creaDivAlertaAnio);
	 
	 function creaDivAlertaAnio(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaAnio').remove();
		 
		 // Si el año no es correcto, le muestro
		 // un mensaje de error
		 if(!validaAnio()){
			 
			 $divAlert = $('<div id="divAlertaAnio" class="text-danger" role="alert"> '+
					 'El año de inicio debe estar entre 1950 y el año actual</div>');
			 
			 $divAlert.insertAfter('#anio');
			 
		 }
		 
	 }
 
	// Compruebo que la dirección de la música es una URL de
	// un álbum de Spotify válido
	 function validaMusica(){
		 
		 var expresion = /^https:\/\/open.spotify\.com\/album\/[a-zA-Z0-9]{22}$/;
		 
		 if($('#musica').val().match(expresion))
			 return true;
	 }
	 
	 $('#musica').on("keyup", creaDivAlertaMusica);
	 
	 function creaDivAlertaMusica(){
		 
			// Borro el div de alerta si hubiera ya uno creado
			 $('#divAlertaMusica').remove();
			 
			 // Si el enlace no es correcto, muestro un mensaje de
			 // error
			 if(!validaMusica()){
				 
				 $divAlert = $('<div id="divAlertaMusica" class="text-danger" role="alert"> '+
						 'Debes poner un enlace a un álbum tuyo de Spotify</div>');
				 
				 $divAlert.insertAfter('#musica');
				 
			 }
			 
		 }
	 
	 
	// Compruebo que la descripción del restaurante ocupa
	// menos de 500 caracteres
	 function validaDescripcion(){
		 
		 if($('#descripcion').val().length<=500 &&
				 $('#descripcion').val().length>0 )
			 return true;
	 }
	 
	 $('#descripcion').on("keyup", creaDivAlertaDescripcion);
	 
	 function creaDivAlertaDescripcion(){
		 
			// Borro el div de alerta si hubiera ya uno creado
			 $('#divAlertaDescripcion').remove();
			 
			 // Si la descripcion es muy larga o no la ha puesto, indico
			 // un mensaje de error
			 if(!validaDescripcion()){
				 
				 $divAlert = $('<div id="divAlertaDescripcion" class="text-danger" role="alert"> '+
						 'La descripción debe tener entre 1 y 500 caracteres</div>');
				 
				 $divAlert.insertAfter('#descripcion');
				 
			 }
			 
		 }
	 
	 function creaDivAlertaPrecio(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaPrecio').remove();
		 
		 // Si no ha indicado un precio, le muestro un mensaje de error
		 if($('#precio').val()==0){
			 
			 $divAlert = $('<div id="divAlertaPrecio" class="text-danger" role="alert"> '+
					 'Debes indicar un precio para tu restaurante</div>');
			 
			 $divAlert.insertAfter('#precio');
			 
		 }
			 
	 }
	 
	 function creaDivAlertaVegetariano(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaVegetariano').remove();
		 
		 // Si no ha indicado un grado de oferta, le muestro un mensaje de error
		 if($('#grado_vegetariano').val()==-1){
			 
			 $divAlert = $('<div id="divAlertaVegetariano" class="text-danger" role="alert"> '+
					 'Debes indicar la oferta vegetariana de tu restaurante</div>');
			 
			 $divAlert.insertAfter('#grado_vegetariano');
			 
		 }
				 
	 }
	 
	 function creaDivAlertaVegano(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaVegano').remove();
		 
		 // Si no ha indicado un grado de oferta, le muestro un mensaje de error
		 if($('#grado_vegano').val()==-1){
			 
			 $divAlert = $('<div id="divAlertaVegano" class="text-danger" role="alert"> '+
					 'Debes indicar la oferta vegana de tu restaurante</div>');
			 
			 $divAlert.insertAfter('#grado_vegano');
			 
		 }
					 
	 }
	 
	 function creaDivAlertaProvincia(){
		 
		// Borro el div de alerta si hubiera ya uno creado
		 $('#divAlertaProvincia').remove();
		 
		 // Si no ha indicado una provincia, le muestro un mensaje de error
		 if($('#provincia').val()==""){
			 
			 $divAlert = $('<div id="divAlertaProvincia" class="text-danger" role="alert"> '+
					 'Debes indicar la provincia y municipio</div>');
			 
			 $divAlert.insertAfter('#provincia');
			 
		 }
					 
	 }
	 
 
	// Añado un evento al combo de las provincias. Cuando haga click
	 // cargaré el nombre de los municipios en el combo que obtendré de manera
	 // asíncrona
	 $('#provincia').on("change", verificaDatos);
	 $('#provincia').on("change", cargarMunicipios);
	 $('#provincia').on("change", creaDivAlertaProvincia);

	 // Función asíncrona que se encargará de buscar las provincias
	 // y cargarlas en un combo
	function cargarMunicipios(){
		
		// Borro el contenido del combo
		$("#municipio").empty();
		
		var provinciaSelec = $('#provincia').val();
		
		// Si no ha escogido provincia, no cargo los municipios
		if(provinciaSelec == ""){
			$("<option>Escoge el municipio de tu artista"+
					" o restaurante</option>").appendTo($("#municipio"));
		}
		else{
			$.ajax({
				
				// la URL para la petición
				url : '../../api/municipios',
				// especifica si será una petición POST o GET
				type : 'POST',
				data: {provincia : provinciaSelec	},
				// el tipo de información que se espera de respuesta
				dataType : 'json',
				// código a ejecutar si la petición es satisfactoria;
				// la respuesta es pasada como argumento a la función
				success : function(json) {
					
					for (let clave in json){
						
						$("<option value='"+json[clave]+
								"'>"+json[clave]+"</option>").appendTo($("#municipio"));
						
					}
					
				},
				// código a ejecutar si la petición falla;
				// son pasados como argumentos a la función
				// el objeto jqXHR (extensión de XMLHttpRequest), un texto con el estatus
				// de la petición y un texto con la descripción del error que haya dado el
				// servidor
				error : function(jqXHR, status, error) {
				alert('Disculpe, existió un problema');
				}
			});
				

		}
	}
	 
	 
	
	 // Función encargada de habilitar el botón de enviar formulario
	 function verificaDatos(){
		 
		 // Cuando se incumpla algún requisito, este boolean se cambiará
		 // a false
		 var sw = true;
		 
		 if($('#nombreReg').val()==""){
			 sw = false;
		 }
		 
		 if(!verificaCorreo()){
			 sw = false;
		 }
		 
		 if(!validaContra()){
			 sw = false;
		 }

		 if($('#provincia').val()==""){
			 sw = false;
		 }
		 
		 if($('#municipio').val()==""){
			 sw = false;
		 }
		 
		 if(!validaImagen($('#imagen').val())){
			 sw = false;
		 }
		 
		 // Parte del artista
		 if($("#radioArtista").is(':checked')) {  
			 
			 if($('#genero').val()==""){
				 sw = false;
			 }
			 
			 if(!validaAnio()){
				 sw = false;
			 }
			 
			 if(!validaMusica()){
				 sw = false;
			 }
			 
			// Si el sw es verdadero, habilito el botón
			 if(sw){
				 $('#submitArtista').removeAttr("disabled");
			 }
			 // Si es falso lo deshabilito
			 else{
				 $('#submitArtista').attr("disabled", "disabled");
			 }
	           
	     }
		 
		 // Parte del restaurante
		 else {
			 
			 if($('#direccion').val()==""){
				 sw = false;
			 }
			 
			 if(!validaDescripcion()){
				 sw = false;
			 }
			 

			 if($('#precio').val()==0){
				 sw = false;
			 }
			 

			 if($('#grado_vegetariano').val()==-1){
				 sw = false;
			 }
			 
			 if($('#grado_vegano').val()==-1){
				 sw = false;
			 }
			 
			 if($('#ambiente').val()==""){
				 sw = false;
			 }
			 
			// Si el sw es verdadero, habilito el botón
			 if(sw){
				 $('#submitRestaurante').removeAttr("disabled");
			 }
			 // Si es falso lo deshabilito
			 else{
				 $('#submitRestaurante').attr("disabled", "disabled");
			 }
	           
	     }  
	 }
	 
	 // Para asegurarnos de que el usuario no hace "trampas", añadimos
	 // una serie de eventos para evitar que el usuario rellene todos
	 // los campos para habilitar el botón, borre los datos de un campo
	 // y le de al botón de enviar información con el campo vacío
	 $('#nombreReg, #correo, #contra, #genero, #anio, #musica').on('keyup', verificaDatos);
	 $('#imagen').on('change', verificaDatos);
	 
	 // Método que se ejecuta cuando se suelta una tecla en el
	 // campo descripción. Con esto contaré el número de
	 // caracteres que lleva y rellenaré una barra de progreso
	 function cuentaLetras(){
		 
		 // Obtengo la longitud de la cadena y la escribo
		 var $cadena = $('#descripcion').val();
		 
		 var longitud = $cadena.length;
		 // Si la longitud de la barra es menor de 500, el color
		 // de la barra será verde, pero si se pasa será rojo
		 
		 if(longitud<=500){
			 
			 $('#barra').attr("class", "progress-bar progress-bar-striped progress-bar-animated bg-success");
		 }
		 else{
			 $('#barra').attr("class", "progress-bar progress-bar-striped progress-bar-animated bg-danger"); 
		 }
		 
		 $('#barra').html(longitud + " / 500");
		 
		 $('#barra').attr("style", "width:"+longitud/5+"%");
		 $('#barra').attr("aria-valuenow",longitud);
	 }
	 
	 // Función que cambia los elementos de artista por los de
	 // restaurante
	 function cambiaElementosRestaurante(){
		 
		 // Borro el div que contiene los campos del artista
		 $('#divArtista').remove();
		 
		 // Creo los campos del restaurante
		 var $divRestaurante = $('<div id="divRestaurante"></div>');
		 
		 var $labelDescripcion = $('<label for="descripcion">Descripción</label>');
		 var $descripcion = $(
				 '<textarea class="form-control" ' +
				 'id="descripcion" name="descripcion"'+
				 'placeholder="Describe tu restaurante para hacerlo más atractivo en la web."' +
				 'rows="3"></textarea>');
		 
		// Añado el evento a la descripción
		$descripcion.on('keyup', cuentaLetras);
		
		// Añado un div para contar el número de letras que le quedan
		var $divCuentaLetras = $('<div class="progress"></div>');
		var $divBarraProgreso = $('<div id="barra" class="progress-bar progress-bar-striped progress-bar-animated" '+
				'role="progressbar" style="width:0%" aria-valuenow="0" '+
				'aria-valuemin="0" aria-valuemax="500">0 / 500</div>');
		
		$divBarraProgreso.appendTo($divCuentaLetras);
		
		 var $labelPrecio = $('<label for="precio">Precio</label>');
		 
			 var $selectPrecio = $('<select class="form-control" id="precio" name="precio" ></select>');
				 var $ningunaOpcion = $('<option value="0" >¿Qué precio tiene tu restaurante?</option>')
				 var $optionBarato = $('<option value="1" >Barato</option>');
				 var $optionNormal = $('<option value="2" >Normal</option>');
				 var $optionCaro = $('<option value="3" >Caro</option>');
		 
			$ningunaOpcion.appendTo($selectPrecio);
			$optionBarato.appendTo($selectPrecio);
			$optionNormal.appendTo($selectPrecio);
			$optionCaro.appendTo($selectPrecio);
			
			
		 var $labelVeggie = $('<label for="grado_vegetariano">Opciones vegetarianas</label>');
		 
		 var $selectVeggie = $('<select class="form-control" id="grado_vegetariano" name="grado_vegetariano" ></select>');
			 var $optionPregunta = $('<option value="-1" >¿Cuántas opciones vegetarianas hay en tu restaurante?</option>')
			 var $optionNinguna = $('<option value="0" >Ninguna</option>');
			 var $optionPocas = $('<option value="1" >Pocas</option>');
			 var $optionNormal = $('<option value="2" >Normal</option>');
			 var $optionMuchas = $('<option value="3" >Muchas</option>');
	 
		 $optionPregunta.appendTo($selectVeggie);
		 $optionNinguna.appendTo($selectVeggie);
		 $optionPocas.appendTo($selectVeggie);
		 $optionNormal.appendTo($selectVeggie);
		 $optionMuchas.appendTo($selectVeggie);
		 
		 var $labelVegan = $('<label for="grado_vegano">Opciones veganas</label>');
		 
		 var $selectVegan = $('<select class="form-control" id="grado_vegano" name="grado_vegano" ></select>');
			 var $optionPreguntaVegan = $('<option value="-1" >¿Cuántas opciones veganas hay en tu restaurante?</option>')
			 
		 // Aprovecho los option del select anterior
		 $optionPreguntaVegan.clone().appendTo($selectVegan);
		 $optionNinguna.clone().appendTo($selectVegan);
		 $optionPocas.clone().appendTo($selectVegan);
		 $optionNormal.clone().appendTo($selectVegan);
		 $optionMuchas.clone().appendTo($selectVegan);
		 
		 var $labelAmbiente = $('<label for="ambiente">Ambiente</label>');
		 var $inputAmbiente = $('<input type="text" class="form-control" '+
				 'id="ambiente" name="ambiente" placeholder="Rock, reggae, flamenco...">');
		 
		 var $labelDireccion = $('<label for="direccion">Direccion</label>');
		 var $inputDireccion = $('<input type="text" class="form-control" '+
				 'id="direccion" name="direccion" maxlength="50" placeholder="Dirección de tu restaurante">');
		 
		 // En lugar de un checkbox voy a poner un checkbox estilizado como
		 // un switch con bootstrap
		 var $divSwitch = $('<div class="custom-control custom-switch">');

		 var $labelAutovia = $('<label class="custom-control-label"'+
				 ' for="autovia_cerca">Autovía cerca del restaurante</label>');
		 var $checkAutovia = $('<input type="checkbox" '+
				 'class="custom-control-input" id="autovia_cerca" '+
				 'name="autovia_cerca">');
		 

		$checkAutovia.appendTo($divSwitch);
		$labelAutovia.appendTo($divSwitch);
		 
		$labelDireccion.appendTo($divRestaurante);
		$inputDireccion.appendTo($divRestaurante);
		 
		$('<br>').appendTo($divRestaurante);
		 
		$labelDescripcion.appendTo($divRestaurante);
		$descripcion.appendTo($divRestaurante);
		$('<br>').appendTo($divRestaurante);
		$divCuentaLetras.appendTo($divRestaurante);
		
		$('<br>').appendTo($divRestaurante);
		
		$labelPrecio.appendTo($divRestaurante);
		$selectPrecio.appendTo($divRestaurante);
		
		$('<br>').appendTo($divRestaurante);
		
		$labelVeggie.appendTo($divRestaurante);
		$selectVeggie.appendTo($divRestaurante);
		
		$('<br>').appendTo($divRestaurante);
		
		$labelVegan.appendTo($divRestaurante);
		$selectVegan.appendTo($divRestaurante);
		
		$('<br>').appendTo($divRestaurante);
		
		$labelAmbiente.appendTo($divRestaurante);
		$inputAmbiente.appendTo($divRestaurante);
		
		$('<br>').appendTo($divRestaurante);
		
		$divSwitch.appendTo($divRestaurante);
		
		$divRestaurante.insertAfter('#divRadio2');
		 
		// Añado los eventos necesarios
		$('#descripcion, #ambiente, #direccion').on('keyup', verificaDatos);
		$('#descripcion').on("keyup", creaDivAlertaDescripcion);
		$('#grado_vegano, #grado_vegetariano, #precio').on("change", verificaDatos);
		$('#precio').on("change", creaDivAlertaPrecio);
		$('#grado_vegetariano').on("change", creaDivAlertaVegetariano);
		$('#grado_vegano').on("change", creaDivAlertaVegano);
		
		// Deshabilito el botón de validar artista
		$('#submitArtista').attr("disabled", "disabled");
	 }
});