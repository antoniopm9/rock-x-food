// Este js se encarga del funcionamiento de las cookies y
// del almacenamiento local
$(function(){
	
	// Como esta página tiene poco contenido, al footer
	// le añado la clase esconderFooter que lo oculta
	$("footer").addClass("esconderFooter");
	
	// Si cambio el color en el combo, muestro el botón
	// para cambiar el color con un efecto
	 $('#colorFondo').on('change',function(){
		 
		 $( "#submitColorFondo" ).fadeIn("slow");
		 
	 });
	 
	 // Si el usuario hace click en el fondo se almacenará
	 // en una cookie
	 $('#submitColorFondo').on('click',function(){
		 
		 // Si hay una cookie creada, la elimino
		    if(document.cookie){
		        document.cookie = "colorFondo=;max-age=0";
		    }

		    let fecha = new Date();

		    fecha.setTime(fecha.getTime() + 24*60*60*1000);

		    document.cookie = "colorFondo="+$("#colorFondo").val()+";expires="+fecha.toUTCString();
		 
		 // El color se cambia utilizando la cookie desde PHP. Es decir:
		 // Cuando recargue la página se verán los cambios. Para surtir un
		 // efecto inmediato cambiaré el color de la página actual
		  
		 $("body").attr("style","background-color: "+$("#colorFondo").val()+";");
	 });
	 
	 
	
	 // Si el usuario hace click en el botón se almacenará
	 // el color de texto en el almacenamiento local
	 $('#submitColorTexto').on('click',function(){
		 
		 
		 localStorage.colorTexto = $("#colorTexto").val();
		 
		 $("body").attr("style","color: "+localStorage.getItem("colorTexto")+";");
		 
	 });
	 
	
});