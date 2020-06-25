<?php
echo CHTML::scriptFichero("/javascript/spotify.js", ["defer"=>""]);

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
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-4"], null, false);
        echo CHTML::dibujaEtiqueta("img", [
            "src"=>'/imagenes/artistas/'.$modelo->imagen,
            "class"=>"imagen",
            "alt"=>$modelo->nombre,
            "style"=>"width: 100%;"
        ]);
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-6"], null, false);
    
        echo CHTML::dibujaEtiqueta("h1", [], $modelo->nombre);
        
        
        $descripcion = $modelo->nombre. " es una banda de " .$modelo->genero." proveniente de ".
                        $modelo->municipio. " formada en el año " .$modelo->anio_inicio.".";
        
        //echo CHTML::dibujaEtiqueta("p",[],$descripcion);

        echo CHTML::dibujaEtiqueta("h4",[],"Datos del artista");
        
        echo CHTML::dibujaEtiqueta("ul",[], null, false);
        
        $genero = CHTML::dibujaEtiqueta("span",["class"=>"badge badge-pill badge-danger", "style"=>"font-size: 12pt"],$modelo->genero);
        
        
        echo CHTML::dibujaEtiqueta("li",[], "Género: ".$genero);
        echo CHTML::dibujaEtiqueta("li",[], "Banda procedente de " .$modelo->municipio." (".$modelo->provincia.").");
        echo CHTML::dibujaEtiqueta("li",[], "En activo desde ".$modelo->anio_inicio);
        
        
        echo CHTML::dibujaEtiquetaCierre("ul");
        
        echo CHTML::dibujaEtiqueta("h4",[],"Echa un vistazo a la música de $modelo->nombre");
        
        $desMusica = "Aquí te dejamos un álbum seleccionado por el ".
                     "artista para que los conozcas un poquito más ".
                     "(¡No todo va a ser comer!).";
        
        echo CHTML::dibujaEtiqueta("p",[],$desMusica);
        
        echo "<br>";
        
        echo CHTML::dibujaEtiqueta("div", ["id"=>"spotify", "class"=>"embed-responsive embed-responsive-16by9"], null, false);
        
        echo CHTML::dibujaEtiquetaCierre("div");
        
        echo "<br>";  
        
        echo CHTML::dibujaEtiqueta("a",[
            "href"=>$modelo->musica,
            "class"=>"btn btn-danger mb-4",
            "id"=>"enlace"
        ], "Ver álbum en Spotify");
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"],null,false);
    echo CHTML::dibujaEtiqueta("h3",[], "Todo eso está muy bien, pero... ¿dónde ha comido $modelo->nombre?");
    
    if(!$puntuaciones){
        $desComida = "¡Ups! Parece que $modelo->nombre todavía no se ha aventurado a ".
                     "comer en alguno de los restaurantes registrados en rock x food. ".
                     "Prueba suerte otro día.";
        
        echo CHTML::dibujaEtiqueta("p",[],$desComida);
        
    }
        else{
        
        $desComida = "¡Tachán! Esta es la lista con todos los sitios en los que ".
                    "$modelo->nombre se ha pegado una comilona. ¿Te atreves a probar alguno?";
        
        echo CHTML::dibujaEtiqueta("p",[],$desComida);
        
        echo "<br>";
        
        echo CHTML::dibujaEtiqueta("table",["class"=>"col-12 table table-striped"],null, false);
        
        echo CHTML::dibujaEtiqueta("thead",[],null, false);
        echo CHTML::dibujaEtiqueta("tr",[],null, false);
        echo CHTML::dibujaEtiqueta("th",[],"Restaurante");
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
                    Sistema::app()->generaURL(["food", "consultar"],
                        ["id"=>$puntuacion["cod_restaurante"]])
                    
                ],
                $puntuacion["nombre"]." (".$puntuacion["municipio"].")"
                );
            echo CHTML::dibujaEtiquetaCierre("td");
            
            
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
            
            echo CHTML::dibujaEtiqueta("td",["colspan"=>5],
                $textoResena);
            
            echo CHTML::dibujaEtiquetaCierre("tr");
        }
        
        
        echo CHTML::dibujaEtiquetaCierre("tbody");
        
        echo CHTML::dibujaEtiquetaCierre("table");
        
        }
    
echo CHTML::dibujaEtiquetaCierre("div");