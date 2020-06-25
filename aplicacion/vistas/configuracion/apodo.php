<?php
echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false);
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3"],null, false);
        echo CHTML::iniciarForm().
            
            CHTML::dibujaEtiqueta("h1",["class"=>"h3 mb-3 font-weight-normal text-center"],"Página de apodos").
            
            CHTML::dibujaEtiqueta("div",["class"=>"col-12"],null, false).
            
            CHTML::dibujaEtiqueta("label",["for"=>"apodo"],"Apodo").
            
            
            CHTML::dibujaEtiquetaCierre("div").
            
            CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-10"],null, false).
            
            
            
            CHTML::dibujaEtiqueta("input",[
                "type"=>"text",
                "class"=>"form-control",
                "placeholder"=>"Escribe aquí tu apodo.",
                "id"=>"apodo",
                "name"=>"apodo",
                "value"=>$apodo
            ]).
            
            "<br>".
            
            CHTML::dibujaEtiquetaCierre("div").
            
            CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-2"],null, false).
            CHTML::dibujaEtiqueta("input",
                ["type"=>"submit",
                    "id"=>"submitApodo",
                    "class"=>"btn btn-danger",
                    "value"=>"Confirmar apodo"
                ]).
                CHTML::dibujaEtiquetaCierre("div").
                
                
                
        CHTML::finalizarForm();
    echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");