$(function(){
	
	// ---------------------
	// DATOS DEL RESTAURANTE
	// ---------------------
	
	var $nombre = $("#nombre_nombre").val();
	var $correo = $("#nombre_correo").val();
	var $descripcion = $("#nombre_descripcion").val();
	var $direccion = $("#nombre_direccion").val();
	var $provincia = $("#nombre_provincia").val();
	var $municipio = $("#nombre_municipio").val();
	var $precio = $("#nombre_precio").val();
	var $grado_vegetariano = $("#nombre_grado_vegetariano").val();
	var $grado_vegano = $("#nombre_grado_vegano").val();
	var $ambiente = $("#nombre_ambiente").val();
	var $autovia_cerca = $("#nombre_autovia_cerca").is(":checked");
	// trim() para eliminar los espacios en blanco
	var $imagen = $(".custom-file-label").html().trim();
	
	// Evento para habilitar edición
	$('#habilitar_edicion').on('change', habilitaEdicion);
	
	// Activo el evento para cargar los municipios disponibles
	$('#nombre_provincia').on("change", cargarMunicipiosRestaurantes);


	// Llamo a la función de cargar municipios
	cargarMunicipiosRestaurantes();
	
	function habilitaEdicion(){
		
		// Si se activa, elimino el atributo disabled y el atributo
		// readonly
		if($('#habilitar_edicion').is(":checked")){
			$('.form-control').removeAttr("readonly");
			$('.form-control').removeAttr("disabled");
			$('.custom-control-input').removeAttr("disabled");
			$('.custom-file-input').removeAttr("disabled");
			
			$("#habilitar").html("Descartar cambios");
			
		}
		
		else{
			$('.form-control').attr("readonly","readonly");
			$('.form-control').attr("disabled","disabled");
			$('#nombre_autovia_cerca').attr("disabled","disabled");
			$('.custom-file-input').attr("disabled", "disabled");
			$("#habilitar").html("Habilitar edición");
			
			// Como ha dado a descartar cambios, vuelvo a poner
			// los valores que tenía el restaurante
			$("#nombre_nombre").val($nombre);
			$("#nombre_correo").val($correo);
			$("#nombre_descripcion").val($descripcion);
			$("#nombre_direccion").val($direccion);
			$("#nombre_provincia").val($provincia);
			cargarMunicipiosRestaurantes();
			$("#nombre_precio").val($precio);
			$("#nombre_grado_vegetariano").val($grado_vegetariano);
			$("#nombre_grado_vegano").val($grado_vegano);
			$("#nombre_ambiente").val($ambiente);
			$(".custom-file-label").html($imagen);
			$("img").attr("src","/imagenes/restaurantes/"+$imagen);
			$("#nombre_autovia_cerca").prop('checked', $autovia_cerca);
			
		}
		
	}
	
	// ---------------------
	// VERIFICACIÓN DE DATOS
	// ---------------------
	$('#nombre_nombre, #nombre_correo, #nombre_descripcion, '+
			'#nombre_direccion, #nombre_ambiente').on('keyup', verificaDatos);
	$('#nombre_provincia, #nombre_municipio, #nombre_precio, '+
			'#nombre_grado_vegetariano, #nombre_grado_vegano, #nombre_autovia_cerca').on('change',verificaDatos);
	$('#nombre_descripcion').on('keyup',cuentaLetras);

	function verificaDatos(){
		
		// Cuando se incumpla algún requisito, este boolean se cambiará
		// a false
		 var sw = true;
		 
		 if($('#nombre_nombre').val()==""){
			 sw = false;
			 creaDivAlerta("errorNombre", "Debe introducir un nombre", "#nombre_nombre");
		 }
		 else{
			 $("#errorNombre").remove();
		 }
		 if(!verificaCorreo()){
			 sw = false;
		 }
		 
		 if($('#nombre_descripcion').val().length>500 ||
				 $('#nombre_descripcion').val().length<=0 ){
			 sw = false;
			 creaDivAlerta("errorDescripcion",
					 "La descripción debe tener entre 1 y 500 caracteres",
					 "#nombre_descripcion");
		
		 }
		 
		 else{
			 $('#errorDescripcion').remove();
		 }
		 
		 if($('#nombre_direccion').val()==""){
			 sw = false;
			 creaDivAlerta("errorDireccion", "Debe introducir una dirección", "#nombre_direccion");
		 }
		 else{
			 $("#errorDireccion").remove();
		 }
		 
		 if($('#nombre_precio').val()==0){
			 sw = false;
			 creaDivAlerta("errorPrecio", "Debe introducir un precio", "#nombre_precio");
		 }
		 else{
			 $("#errorPrecio").remove();
		 }
		 
		 if($('#nombre_grado_vegetariano').val()==-1){
			 sw = false;
			 creaDivAlerta("errorVegetariano", "Debe introducir la oferta vegetariana", "#nombre_grado_vegetariano");
		 }
		 else{
			 $("#errorVegetariano").remove();
		 }
		 
		 if($('#nombre_grado_vegano').val()==-1){
			 sw = false;
			 creaDivAlerta("errorVegano", "Debe introducir la oferta vegana", "#nombre_grado_vegano");
		 }
		 else{
			 $("#errorVegano").remove();
		 }
		 
		 if($('#nombre_ambiente').val()==""){
			 sw = false;
			 creaDivAlerta("errorAmbiente", "Debe indicar el ambiente de su bar", "#nombre_ambiente");
		 }
		 else{
			 $("#errorAmbiente").remove();
		 }
		 
		 if(!validaImagen($(".custom-file-label").html().trim())){
			 sw = false;
			 
		 }
		 
		 if($('#nombre_provincia').val()==""){
			 sw = false;
			 creaDivAlerta("errorProvincia", "Debe introducir una provincia", "#nombre_provincia");
		 }
		 else{
			 $("#errorProvincia").remove();
		 }
		 
		 if($('#nombre_municipio').val()==""){
			 sw = false;
			 creaDivAlerta("errorMunicipio", "Debe introducir un municipio", "#nombre_municipio");
		 }
		 else{
			 $("#errorMunicipio").remove();
		 }
		 
		 if($("#nombre_autovia_cerca").is(":checked")){
			 $("#nombre_autovia_cerca").attr("value", 1);
		 }
		 
		 else{
			 $("#nombre_autovia_cerca").attr("value", 0);
		 }
		 
		// Si el sw es verdadero, habilito el botón
		 if(sw){
			 $('#modificar').removeAttr("disabled");
		 }
		 // Si es falso lo deshabilito
		 else{
			 $('#modificar').attr("disabled", "disabled");
		 }
		
	}
	
	
	// -------------------------
	// FUNCIONES DE VERIFICACIÓN
	// -------------------------
	
	// Compruebo que el correo insertado es válido
	// con expresiones regulares
	 
	 function verificaCorreo(){
		 
		 var expresion = /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/;
		 
		 if($('#nombre_correo').val().match(expresion)){
			 // Borro la alerta de error si hubiera
			 $("#errorCorreo").remove();
			 return true;
		 }
		 // Indico el fallo con una alerta
		 creaDivAlerta("errorCorreo",
				 "Debe introducir una dirección de correo válida",
				 "#nombre_correo");
		 return false;
		 
	 }
	 
	 function validaImagen(fileName){
		 
		// Obtengo el tipo de imagen
         var extension = fileName.substring(fileName.length -3, fileName.length).toLowerCase();
         
         // Si el tipo de imagen es jpg o png, es correcto
         if(extension == "jpg" || extension == "png")
        	 return true;
         
         return false;
		 
	 }
	 
	 // Método que se ejecuta cuando se suelta una tecla en el
	 // campo descripción. Con esto contaré el número de
	 // caracteres que lleva y rellenaré una barra de progreso
	 function cuentaLetras(){
		 
		 // Obtengo la longitud de la cadena y la escribo
		 var $cadena = $('#nombre_descripcion').val();
		 
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
	
	$('#nombre_imagen').on('change',function(){
		
		// Borro el div de alerta si hubiera ya uno creado
		 $('#errorImagen').remove();
		 
        //Obtengo el nombre del archivo
        var fileName = $(this).val().replace(/^.*[\\\/]/, '');
        //Cambio el texto para mostrar el nombre del archivo
        $(this).next('.custom-file-label').html(fileName);
        
        // Si el tipo de imagen no es jpg o png, muestro un mensaje de error
        if(!validaImagen(fileName)){
        	creaDivAlerta("errorImagen",
        			"La imagen debe estar en formato .jpg o .png",
        			"#nombre_imagen");
	       	 
	       	 // Vuelvo a poner la imagen original
	       	$('.imagen').attr('src', '/imagenes/restaurantes/'+$imagen);
       	 
        }
        
        // Si el tipo de imagen es correcto, cargo la imagen
        else{
        	var reader = new FileReader();
            reader.onload = function (e) {
              $('.imagen').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
        
        // Verifico los datos
        verificaDatos();
    });
	
	
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
	
	// -------------------
	// CARGA DE MUNICIPIOS
	// -------------------
	
	 // Función asíncrona que se encargará de buscar las provincias
	 // y cargarlas en un combo
	function cargarMunicipiosRestaurantes(){
		
		// Borro el contenido del combo
		$("#nombre_municipio").empty();
		
		var provinciaSelec = $('#nombre_provincia').val();
		
		// Si no ha escogido provincia, no cargo los municipios
		if(provinciaSelec == ""){
			$("<option>Escoge el municipio de tu restaurante"+
					"</option>").appendTo($("#nombre_municipio"));
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
								"'>"+json[clave]+"</option>").appendTo($("#nombre_municipio"));
						
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
			}).then(() => {
					var nuevoNombre = $("#nombre_provincia").val();
					if(nuevoNombre == $provincia)
						$("#nombre_municipio").val($municipio);
				
				});
		}
		
		$("#nombre_municipio").val($municipio);
	}
});