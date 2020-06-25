<?php
echo CHTML::scriptFichero("/javascript/buscador.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],null, false).
         CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-3"],null, false).
         CHTML::dibujaEtiqueta("label",["for"=>"buscador"],null,false).
             CHTML::dibujaEtiqueta("h1", ["class"=>"titulo"], "rock: lista de artistas").
         CHTML::dibujaEtiquetaCierre("label").
             CHTML::dibujaEtiqueta("input",[
                 "class"=>"form-control border-bottom",
                 "placeholder"=>"Buscar artista por nombre.",
                 "id"=>"buscador"
             ]).

        CHTML::dibujaEtiquetaCierre("div");
    
         
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"filas row m-0 col-12 col-lg-9"],null, false);
        foreach($filas as $clave=>$valor){
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"row col-xl-4 col-lg-6 col-12 m-0 justify-content-center"],null, false);
            
            echo CHTML::dibujaEtiqueta("img", [
                "src"=>'/imagenes/artistas/'.$filas[$clave]["imagen"],
                "alt"=>$filas[$clave]["nombre"],
                "class"=>"imagen mt-5",
                "style"=>"width: 40%;"
            ]);
            
            if(!isset($filas[$clave]["contador"])){
                $descripcionContador = "No ha comido en ningún restaurante.";
            }
            else if($filas[$clave]["contador"]==1){
                $descripcionContador = "Ha comido en 1 restaurante.";
            }
            else{
                $descripcionContador = "Ha comido en ".$filas[$clave]["contador"]." restaurantes.";
            }
            
            echo CHTML::dibujaEtiqueta("h2", ["class"=>"col-12 text-center nombre"], $filas[$clave]["nombre"]);
            echo CHTML::dibujaEtiqueta("p",
                ["class"=>"col-12 text-center"],
                $filas[$clave]["genero"]. " desde ".
                $filas[$clave]["municipio"]).
                CHTML::dibujaEtiqueta("p",["class"=>"text-center col-12"],$descripcionContador);
                
                echo CHTML::dibujaEtiqueta("p",[],null, false);
                echo CHTML::dibujaEtiqueta("a",
                    ["class"=>"btn btn-lg btn-danger",
                        "href"=>Sistema::app()->generaURL(["rock", "consultar"], ["id"=>$filas[$clave]["cod_artista"]]),
                        "role"=>"button"
                    ],
                    "Ver artista");
                    echo CHTML::dibujaEtiquetaCierre("p");
                    
                    echo CHTML::dibujaEtiquetaCierre("div");
                
            
        }
    echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");



