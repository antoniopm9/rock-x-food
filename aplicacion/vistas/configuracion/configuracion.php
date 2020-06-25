<?php
$colorFondo = "white";

if (isset($_COOKIE["colorFondo"])) {
    $colorFondo = $_COOKIE["colorFondo"];
}


echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);


echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false).

    CHTML::dibujaEtiqueta("div",["class"=>"row col-md-12 col-lg-8 justify-content-center"],null, false).
        CHTML::dibujaEtiqueta("h1", [], "Página de configuración.").
        
        "<br>".
        
        CHTML::dibujaEtiqueta("div",["class"=>"col-12"],null, false).
        
            CHTML::dibujaEtiqueta("label",["for"=>"colorFondo"],"Cambiar color del fondo").
            
            
        CHTML::dibujaEtiquetaCierre("div").
            
        CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-10"],null, false).
        
           
            
            CHTML::campoListaDropDown("colorFondo",
                $colorFondo,
                ["white"=>"blanco", "#F2EAD0"=>"especial"],
                ["class"=>"form-control",
                    "id"=>"colorFondo",
                    "linea"=>false
                ]).
                
                "<br>".
            
        CHTML::dibujaEtiquetaCierre("div").
                    
        CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-2"],null, false).
             CHTML::dibujaEtiqueta("input",
                 ["type"=>"button",
                  "id"=>"submitColorFondo",
                  "class"=>"btn btn-danger",
                  "style"=>"display: none;",
                  "value"=>"Cambiar color fondo"
                 ]).
        CHTML::dibujaEtiquetaCierre("div").
        
        
        
        CHTML::dibujaEtiqueta("div",["class"=>"col-12"],null, false).
        
        CHTML::dibujaEtiqueta("label",["for"=>"colorTexto"],"Cambiar color del texto").
        
        
        CHTML::dibujaEtiquetaCierre("div").
        
        CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-10"],null, false).
        
        
        
        CHTML::campoListaDropDown("colorTexto",
            $colorFondo,
            ["gray"=>"Gris", "black"=>"Negro"],
            ["class"=>"form-control",
                "id"=>"colorTexto",
                "linea"=>false
            ]).
            
            "<br>".
            
            CHTML::dibujaEtiquetaCierre("div").
            
            CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-2"],null, false).
            CHTML::dibujaEtiqueta("input",
                ["type"=>"button",
                    "id"=>"submitColorTexto",
                    "class"=>"btn btn-danger",
                    "value"=>"Cambiar color texto"
                ]).
                CHTML::dibujaEtiquetaCierre("div").
                
        
    CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");





