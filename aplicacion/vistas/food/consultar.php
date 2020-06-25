<?php
echo CHTML::scriptFichero("/javascript/resena.js", ["defer"=>""]);

// Creo strings en función de los valores de la tabla para hacer 
// descripciones más precisas
$precio = LibreriaMetodos::creaDescripcionPrecio($modelo->precio);
$oVegetariana = LibreriaMetodos::creaDescripcionVegetariano($modelo->grado_vegetariano);
$oVegana = LibreriaMetodos::creaDescripcionVegano($modelo->grado_vegano);
$cercaAutovia = LibreriaMetodos::creaDescripcionAutovia($modelo->autovia_cerca);

$descripcionEstrellas = [0=>"Muy malo",
    1=>"Malo",
    2=>"Ok",
    3=>"Bueno",
    4=>"Excelente"
];

$idEstrellas = [0=>"muyMalo",
    1=>"malo",
    2=>"ok",
    3=>"bueno",
    4=>"excelente"
];

$estrellas = [0=>"oneStar",
    1=>"twoStars",
    2=>"threeStars",
    3=>"fourStars",
    4=>"fiveStars"
];


echo CHTML::dibujaEtiqueta("div", ["class"=>"row"], null, false);
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-4",
                                    "style"=>"margin-bottom:2%"
    ], null, false);
        echo CHTML::dibujaEtiqueta("img", [
            "src"=>'/imagenes/restaurantes/'.$modelo->imagen,
            "class"=>"imagen",
            "alt"=>$modelo->nombre,
            "style"=>"width: 100%;"
        ]);
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-6"], null, false);
    
        echo CHTML::dibujaEtiqueta("h1", [], $modelo->nombre);
        
        echo CHTML::dibujaEtiqueta("p",[],$modelo->descripcion);
        
        echo "<br>";
        
        echo CHTML::dibujaEtiqueta("h4",[],"¿Qué encontrarás aquí?");
        
        echo CHTML::dibujaEtiqueta("ul",[], null, false);
        
        $ambiente = "Ambiente: ".strtolower($modelo->ambiente).".";
        
            echo CHTML::dibujaEtiqueta("li",[], $precio);
            echo CHTML::dibujaEtiqueta("li",[], $oVegetariana);
            echo CHTML::dibujaEtiqueta("li",[], $oVegana);
            echo CHTML::dibujaEtiqueta("li",[], $cercaAutovia);
            echo CHTML::dibujaEtiqueta("li",[],$ambiente);
        
        
        echo CHTML::dibujaEtiquetaCierre("ul");
        
        echo CHTML::dibujaEtiqueta("h4",[],"Dirección");
        
        echo CHTML::dibujaEtiqueta("p",[],$modelo->direccion. " ($modelo->municipio)");
        
        if($valMedia){
            echo "<br>"; 
            
            echo CHTML::dibujaEtiqueta("h4",[],"Puntuación media del restaurante");
            
            echo CHTML::dibujaEtiqueta("span",["id"=>"puntuacionMedia","class"=>"col-12 text-center"],null,false);
            for($i=0;$i<5;$i++){
                echo CHTML::dibujaEtiqueta("i",[
                    "class"=>
                    "fa fa-star py-2 px-1 rate-popover ".((($valMedia[0]["puntuacion"]-1)>=$i) ? $estrellas[($valMedia[0]["puntuacion"])-1] : ""),
                    "data-index"=>$i,
                    "data-html"=>"true",
                    "data-toggle"=>"popover",
                    "data-placement"=>"top",
                    "title"=>$descripcionEstrellas[$i]
                ],null,false);
                echo CHTML::dibujaEtiquetaCierre("i");
            }
            echo CHTML::dibujaEtiquetaCierre("span");
            
        }
        else{
            echo "<br>";
            echo CHTML::dibujaEtiqueta("h4",[],"Este restaurante no tiene ninguna valoración.");
        }
        
        echo "<br><br>"; 
        
        if($actualizado){
            ?>
                <br>
                <span class="badge badge-pill badge-success"  style= "font-size: 12pt">
                	Datos de la reseña guardados correctamente.
                </span>
                <br>
                <br>
                <?php
            }
            
            if($borrado){
                ?>
                <br>
                <span class="badge badge-pill badge-success"  style= "font-size: 12pt">
                	Tu reseña ha sido eliminada.
                </span>
                <br>
                <br>
                <?php
            }
  
        // Si hay un artista, muestro su puntuación
        if(!isset($puntuacionArtista[0]) && !isset($puntuaciones[0])){
            
            if(!$sw){
                echo CHTML::dibujaEtiqueta("h3",[], "Todavía no hay reseñas de este restaurante :(");
            }
            else{
                
                echo CHTML::dibujaEtiqueta("h3",[], "Todavía no has reseñado este restaurante :(");
                
                $descripcion = "Pero eso puede cambiar. ¿Has comido aquí? Cuéntanos tu experiencia y ayuda a ".
                    "otros usuarios a encontrar el mejor sitio para darse una buena comilona.";
                
                echo CHTML::dibujaEtiqueta("p",[],$descripcion);
                
                LibreriaMetodos::dibujaFormulario($idEstrellas, $descripcionEstrellas);
                
            }
            
            echo CHTML::dibujaEtiquetaCierre("div");
        }
        
        else{
            // Si hay un artista pero no tiene puntuación,
            // le muestro el formulario para introducir una
            if($sw && !isset($puntuacionArtista[0])){
                echo CHTML::dibujaEtiqueta("h3",[], "Todavía no has reseñado este restaurante :(");
                
                $descripcion = "Pero eso puede cambiar. ¿Has comido aquí? Cuéntanos tu experiencia y ayuda a ".
                    "otros usuarios a encontrar el mejor sitio para darse una buena comilona.";
                
                echo CHTML::dibujaEtiqueta("p",[],$descripcion);
                
                LibreriaMetodos::dibujaFormulario($idEstrellas, $descripcionEstrellas);
                
                echo CHTML::dibujaEtiquetaCierre("div");
            }
            
            
            if($sw && isset($puntuacionArtista[0])){
                
                echo CHTML::dibujaEtiqueta("h3",[], "Tu valoración");
                LibreriaMetodos::dibujaFormulario($idEstrellas, $descripcionEstrellas, $estrellas, $puntuacionArtista);
                
            }
            echo CHTML::dibujaEtiquetaCierre("div");
            
                if(isset($puntuaciones[0])){
                echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"],null,false);
                echo CHTML::dibujaEtiqueta("h3",[], "Artistas que han comido aquí");
            
            echo CHTML::dibujaEtiqueta("table",["class"=>"table table-striped"],null, false);
            
                echo CHTML::dibujaEtiqueta("thead",[],null, false);
                    echo CHTML::dibujaEtiqueta("tr",[],null, false);
                        echo CHTML::dibujaEtiqueta("th",[],"Artista");
                        echo CHTML::dibujaEtiqueta("th",[]);
                        echo CHTML::dibujaEtiqueta("th",[]);
                        echo CHTML::dibujaEtiqueta("th",[],"Reseña");
                        echo CHTML::dibujaEtiqueta("th",[]);
                        echo CHTML::dibujaEtiqueta("th",[]);
                        echo CHTML::dibujaEtiqueta("th",[]);
                        echo CHTML::dibujaEtiqueta("th",[]);
                    echo CHTML::dibujaEtiquetaCierre("tr");
                echo CHTML::dibujaEtiquetaCierre("thead");
                
                echo CHTML::dibujaEtiqueta("tbody",[],null, false);
                
                foreach($puntuaciones as $puntuacion){
                    echo CHTML::dibujaEtiqueta("tr",[],null, false);
                    echo CHTML::dibujaEtiqueta("td",["colspan"=>3],null, false);
                            echo CHTML::dibujaEtiqueta("a",
                                ["href"=>
                                    Sistema::app()->generaURL(["rock", "consultar"],
                                        ["id"=>$puntuacion["cod_artista"]])
                                    
                                ],
                                $puntuacion["nombre"]
                                );
                        echo CHTML::dibujaEtiquetaCierre("td");
                        
                        // Muestro la puntuación del restaurante
                        
                        $textoResena = $puntuacion["resena"]."<br><br><i>".
                            "Plato favorito: ".$puntuacion["plato_favorito"]."</i><br><br><i>Valoración del artista:</i> <br>";
                        
                            for($i=0;$i<5;$i++){
                                $textoResena .= CHTML::dibujaEtiqueta("i",[
                                    "class"=>
                                    "fa fa-star py-2 px-1 rate-popover ".((($puntuacion["puntuacion"]-1)>=$i) ? $estrellas[($puntuacion["puntuacion"])-1] : ""),
                                    "data-index"=>$i,
                                    "data-html"=>"true",
                                    "data-toggle"=>"popover",
                                    "data-placement"=>"top",
                                    "title"=>$descripcionEstrellas[$i]
                                ],null,false);
                                $textoResena .= CHTML::dibujaEtiquetaCierre("i");
                            }
                        echo CHTML::dibujaEtiqueta("td",["colspan"=>5],$textoResena);
                        
                    echo CHTML::dibujaEtiquetaCierre("tr");
                }
            
                
                echo CHTML::dibujaEtiquetaCierre("tbody");
                
            echo CHTML::dibujaEtiquetaCierre("table");
        
            }
        
    
        echo CHTML::dibujaEtiquetaCierre("div");
        }
    
echo CHTML::dibujaEtiquetaCierre("div");
