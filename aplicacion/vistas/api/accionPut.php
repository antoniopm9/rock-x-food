<?php
echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3"],null, false);
echo CHTML::iniciarForm().

CHTML::dibujaEtiqueta("h1",["class"=>"h3 mb-3 font-weight-normal text-center"],"Insertar provincia (put)").

        CHTML::campoLabel("Provincia", "provinciaInsertada").
        CHTML::campoText("provinciaAInsertar", "",
            ["class"=>"form-control",
                "placeholder"=>"Escribe aquí la provincia a insertar",
                "required"=>"required",
                "autofocus"=>"autofocus"
            ]).
            "<br>".
          
        
        CHTML::dibujaEtiqueta("button",
            ["class"=>"btn btn-lg btn-danger btn-block",
                "type"=>"submit"
            ],
            "Añadir provincia").
            
            
CHTML::finalizarForm();
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");