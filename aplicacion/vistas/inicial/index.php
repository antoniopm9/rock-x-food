<?php 


?>

<!-- Con Bootstrap creo un carrusel de imágenes.
Las mismas opciones aparecerán debajo del carrusel -->
<div id="carouselExampleIndicators" class="carousel slide carrusel" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="/imagenes/carrusel2.jpg" alt="First slide">
      	<div class="carousel-caption d-none d-md-block">
        	<h2>Bienvenido a rockfood: donde comen las estrellas</h2>
        	<p>En rockfood hay una selección de artistas más grande que <br>
        		una pizza familiar. Y no solo eso: ¡Puedes averiguar <br>
        		dónde come tu artista favorito!
        	</p>
        	<p>
        		<a class="btn btn-lg btn-danger"
        			href="<?php echo Sistema::app()->generaURL(["rock"]);?>"
        			role="button">Ver artistas
        		</a>
        	</p>
  		</div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="/imagenes/carrusel3.jpg" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
        	<h2>¿Te apetece comer algo?</h2>
        	<p>Descubre toda una selección de restaurantes de lo más variados. <br>
        		¿Que quién crea esa selección de restaurantes? Los artistas.
        	</p>
        	<p>
        		<a class="btn btn-lg btn-danger"
        			href="<?php echo Sistema::app()->generaURL(["food"]);?>"
        			role="button">Ver restaurantes
        		</a>
        	</p>
  		</div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php
 
    echo CHTML::dibujaEtiqueta("div",["class"=>"row "],null, false);
    
        echo CHTML::dibujaEtiqueta("div",["class"=>"row m-0 col-lg-2 col-12 justify-content-center"],null, false);
        
        echo CHTML::dibujaEtiquetaCierre("div");
        
        
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"row m-0 col-lg-4 col-12  justify-content-center"],null, false);
        
            echo CHTML::dibujaEtiqueta("img", [
                "src"=>"/imagenes/iconArtistas.jpg",
                "class"=>"imagen mt-5",
                "alt"=>"Sección de artistas",
                "style"=>"width: 60%;"
            ]);
            
            echo CHTML::dibujaEtiqueta("h2", ["class"=>"col-12 text-center"], "Busca solo los artistas que te interesan.");
            echo CHTML::dibujaEtiqueta("p",
                ["class"=>"col-12 text-center"],
                "En rockfood hay una selección de artistas abrumadora.".
                "Puedes descubrir nueva música o simplemente buscar ".
                "los restaurantes favoritos de tu banda fetiche");
            
            echo CHTML::dibujaEtiqueta("p",[],null, false);
                echo CHTML::dibujaEtiqueta("a",
                    ["class"=>"btn btn-lg btn-danger",
                        "href"=> Sistema::app()->generaURL(['rock']),
                        "role"=>"button"
                    ],
                    "Ver artistas");
            echo CHTML::dibujaEtiquetaCierre("p");
                
        echo CHTML::dibujaEtiquetaCierre("div");
        
        
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"row m-0 col-lg-4 col-12 justify-content-center"],null, false);
        
            echo CHTML::dibujaEtiqueta("img", [
                "src"=>"/imagenes/iconRestaurantes.jpg",
                "class"=>"imagen mt-5",
                "alt"=>"Sección de restaurantes",
                "style"=>"width: 60%;"
            ]);
            
            echo CHTML::dibujaEtiqueta("h2", ["class"=>"col-12 text-center"], "Encuentra el mejor restaurante cerca de tu ciudad");
            echo CHTML::dibujaEtiqueta("p",
                ["class"=>"col-12 text-center"],
                "Come donde come tu artista favorito. Si eres un artista ".
                "en busca de nuevos sitios de comida durante tu gira ".
                "aquí encontrarás lo que buscas.");
            
                echo CHTML::dibujaEtiqueta("p",[],null, false);
                    echo CHTML::dibujaEtiqueta("a",
                        ["class"=>"btn btn-lg btn-danger",
                            "href"=> Sistema::app()->generaURL(['food']),
                            "role"=>"button"
                        ],
                        "Ver restaurantes");
                echo CHTML::dibujaEtiquetaCierre("p");
                
        echo CHTML::dibujaEtiquetaCierre("div");
            
    echo CHTML::dibujaEtiquetaCierre("div");
    
    




