<!DOCTYPE html>
<html lang="es">
<?php 
$contador = 0;
if(isset($_COOKIE["contador"])){
    $contador = $_COOKIE["contador"];
}
    $contador++;

    setcookie("contador",$contador,time()+3600*24*15, "/");
    
$colorFondo = "white";

if (isset($_COOKIE["colorFondo"])) {
    $colorFondo = $_COOKIE["colorFondo"];
}


?>
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $titulo;?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
		 <!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    	crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/estilos/style.css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  		<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
		<!-- Font Awesome Icon Library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		 <script src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
        </script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script src="/javascript/script.js" defer></script>
		<link rel="icon" type="image/png" href="/imagenes/favicon.jpg" />
		<?php 
			if (isset($this->textoHead))
			    echo $this->textoHead; 
	    ?>
	</head>
	<body id="body" <?php echo "style='background-color: $colorFondo;'";?>>
		<div id="todo" class="container-fluid">	
			<header class="row">
				<?php 
				
				// Creo la cabecera de la página con el objeto CMenu
				// Para ello preparo un array con todas las opciones
				// Array con las secciones
				$arraySecciones = [
				"Artistas"=>Sistema::app()->generaURL(["rock"]),
				"Restaurantes"=>Sistema::app()->generaURL(["food"])
				//,
				//"Configuración"=>Sistema::app()->generaURL(["configuracion"])
				];
				
				// Si hay un usuario en el sistema, muestro su nombre en lugar
				// del botón de login y una opción para acceder a su perfil
				if (Sistema::app()->Acceso() &&
				Sistema::app()->Acceso()->hayUsuario()){
				    $url = Sistema::app()->generaURL(["acceso", "logout"]);
				    $nombre = Sistema::app()->Acceso()->getNombre(). ": salir";
				    
				    $codRole = Sistema::app()->ACL()->getUsuarioRole(Sistema::app()->Acceso()->getNick());
				    
				    if($codRole == 5){
				        $arraySecciones["Perfil"] = Sistema::app()->generaURL(["perfil","perfilArtista"]);
				    }
				    if($codRole == 6){
				        $arraySecciones["Perfil"] = Sistema::app()->generaURL(["perfil","perfilRestaurante"]);
				    }
				}
				
				// Si no hay un usuario en el sistema, muestro el botón de
				// registrarse
				else{
				    $arraySecciones["Registrarse"] = Sistema::app()->generaURL(["acceso", "registro"]);
				    $url = Sistema::app()->generaURL(["acceso", "login"]);
				    $nombre = "Login";
				    
				}
				
				// Si el usuario tiene permisos para acceder y modificar, muestro la
				// opción de herramientas de administrador
				// Si el usuario no tiene permiso de configurar, muestro la página de error
				if(Sistema::app()->Acceso()->puedeConfigurar()&&
				Sistema::app()->Acceso()->puedeAcceder()){
				    $arraySecciones["Herramientas para administrador"] = 
				    Sistema::app()->generaURL(["crudArtistas"]);
				}
				
				// Si hay un apodo guardado en la sesión lo pongo en el array
				
				/* if(isset($_SESSION["apodo"])){
				    $textoDescriptivo = $_SESSION["apodo"].": cambiar apodo";
				    $arraySecciones[$textoDescriptivo] = 
				        Sistema::app()->generaURL(["configuracion", "apodo"]);
				}
				else{
				    
				    $arraySecciones["Elegir apodo"] =
				        Sistema::app()->generaURL(["configuracion", "apodo"]);
				} */
				
				//$arraySecciones["API POST"] = Sistema::app()->generaURL(["api","post"]);
				
				
				$arrayOpciones = [
				    "NOMBRE_PAG"=>"rock x food",
				    "URL_SECCIONES"=>$arraySecciones,
			         "TITULO_DERECHA"=>$nombre,
			         "URL_DERECHA"=>$url
				];
				
				$menu = new CMenu($arrayOpciones);
				
				echo $menu->dibujate();
				
				?>
			</header><!-- #header -->
			
			<div class="contenido row">
				
	        	
	        	<article class="col-12">
	        		<?php echo $contenido;?>
	 			</article><!-- #content -->
			</div>
			
		    <footer class="row" style="background-color: white; color:#F2EAD0;">
            
                  <!-- Grid column -->
                  <div class="col-12 text-center pie">
                  
            		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            			
            			<path fill="#4A3715" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,106.7C384,96,480,64,576,58.7C672,53,768,75,864,96C960,117,1056,139,1152,133.3C1248,128,1344,96,1392,80L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            			</path>
            			<div class="contenidoSvg" style="background-color: #4A3715;" >
                    		 <h5 class="titulo">
                            	 <a class="enlacesFooter" href="<?php echo Sistema::app()->generaURL(["rock"]);?>">rock x food</a>
                            </h5>
                            
                             <a class="enlacesFooter" href="<?php echo Sistema::app()->generaURL(["mapa"]);?>">Mapa del sitio</a>
                        
                        	<br>
                        	<br>
                        </div>
                		
            		</svg>
                    <!-- Content -->
                   
                    
                  </div>
                  <!-- Grid column -->
            
              
            
            </footer>
            <!-- Footer -->
				
		</div><!-- #wrapper -->	
		
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>		
</html>
