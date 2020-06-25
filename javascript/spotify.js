$(function(){
	
	// Obtengo el id del álbum de Spotify a partir del
	// enlace proporcionado
	var enlace = $('#enlace').attr("href");
	var idAlbum = enlace.substring(31);
	
	// Variable para crear el iframe del álbum
	var $iframe = $('<iframe '+
			'src="https://open.spotify.com/embed?uri=spotify:album:'+idAlbum+'" '+
			'class="embed-responsive-item" frameborder="0" allowtransparency="1" '+
			'allow="encrypted-media" width="300" height="80"/>');
	
	$iframe.appendTo('#spotify');
	
	
});