$(function(){
	
	// Obtengo el id del álbum de Spotify a partir del
	// enlace proporcionado
	var enlace = $('#nombre_musica').val();
	var idAlbum = enlace.substring(31);
	
	// -----------------
	// DATOS DEL ARTISTA
	// -----------------
	
	var $nombre = $("#nombre_nombre").val();
	var $correo = $("#nombre_correo").val();
	var $genero = $("#nombre_genero").val();
	var $anio_inicio = $("#nombre_anio_inicio").val();
	var $provincia = $("#nombre_provincia").val();
	var $municipio = $("#nombre_municipio").val();
	var $musica = $("#nombre_musica").val();
	// trim() para eliminar los espacios en blanco
	var $imagen = $(".custom-file-label").html().trim();
	
	// Variable para crear el iframe del álbum
	var $iframe = $('<iframe '+
			'src="https://open.spotify.com/embed?uri=spotify:album:'+idAlbum+'" '+
			'class="embed-responsive-item" frameborder="0" allowtransparency="1" '+
			'allow="encrypted-media" width="300" height="80"/>');
	
	$iframe.appendTo('#spotify');
	
	
	// Evento para habilitar edición
	$('#habilitar_edicion').on('change', habilitaEdicion);
	
	// Activo el evento para cargar los municipios disponibles
	$('#nombre_provincia').on("change", cargarMunicipiosArtistas);


	// Llamo a la función de cargar municipios
	cargarMunicipiosArtistas();
	
	function habilitaEdicion(){
		
		// Si se activa, elimino el atributo disabled y el atributo
		// readonly
		if($('#habilitar_edicion').is(":checked")){
			$('.form-control').removeAttr("readonly");
			$('.form-control').removeAttr("disabled");
			$('.custom-file-input').removeAttr("disabled");
			
			$("#habilitar").html("Descartar cambios");
			
		}
		
		else{
			$('.form-control').attr("readonly","readonly");
			$('.form-control').attr("disabled","disabled");
			$('.custom-file-input').attr("disabled", "disabled");
			$("#habilitar").html("Habilitar edición");
			
			// Como ha dado a descartar cambios, vuelvo a poner
			// los valores que tenía el artista
			$("#nombre_nombre").val($nombre);
			$("#nombre_correo").val($correo);
			$("#nombre_genero").val($genero);
			$("#nombre_anio_inicio").val($anio_inicio);
			$("#nombre_provincia").val($provincia);
			cargarMunicipiosArtistas();
			$("#nombre_musica").val($musica);
			$(".custom-file-label").html($imagen);
			$("img").attr("src","/imagenes/artistas/"+$imagen);
		}
		
	}
	
	// ---------------------
	// VERIFICACIÓN DE DATOS
	// ---------------------
	$('#nombre_nombre, #nombre_correo, #nombre_genero, #nombre_anio_inicio, #nombre_musica').on('keyup', verificaDatos);
	$('#nombre_provincia, #nombre_municipio').on('change',verificaDatos);
	
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
		 
		 if(!validaImagen($(".custom-file-label").html().trim())){
			 sw = false;
			 
		 }
		 
		 if($('#nombre_genero').val()==""){
			 sw = false;
			 creaDivAlerta("errorGenero", "Debe introducir un género", "#nombre_genero");
		 }
		 else{
			 $("#errorGenero").remove(); 
		 }
		 
		 if(!validaAnio()){
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
		 
		 if(!validaMusica()){
			 sw = false;
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
	 
	// Compruebo que el año es un año comprendido entre
	// 1950 y el año actual
	 
	 function validaAnio(){
		 
		 var anio = new Date().getFullYear();
		 
		 if($('#nombre_anio_inicio').val()>=1950 && $('#nombre_anio_inicio').val()<=anio){
			 $("#errorAnio").remove();
			 return true;
		 }
		 
		 creaDivAlerta("errorAnio",
				 "El año debe estar entre 1950 y el actual",
				 "#nombre_anio_inicio");
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
	 
	// Compruebo que la dirección de la música es una URL de
	// un álbum de Spotify válido
	 function validaMusica(){
		 
		 var expresion = /^https:\/\/open.spotify\.com\/album\/[a-zA-Z0-9]{22}$/;
		 
		 if($('#nombre_musica').val().match(expresion)){
			 $("#errorMusica").remove();
			 return true;
		 }
		 creaDivAlerta("errorMusica",
				 "Debes introducir un enlace válido a un álbum de Spotify",
				 "#nombre_musica");
		 return false;
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
	       	$('.imagen').attr('src', '/imagenes/artistas/'+$imagen);
       	 
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
	function cargarMunicipiosArtistas(){
		
		// Borro el contenido del combo
		$("#nombre_municipio").empty();
		
		var provinciaSelec = $('#nombre_provincia').val();
		
		// Si no ha escogido provincia, no cargo los municipios
		if(provinciaSelec == ""){
			$("<option>Escoge el municipio de tu artista"+
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