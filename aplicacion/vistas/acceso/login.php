<?php
echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false);
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3"],null, false);
        echo CHTML::iniciarForm().
            
            CHTML::dibujaEtiqueta("h1",["class"=>"h3 mb-3 font-weight-normal text-center"],"Iniciar sesión").
            
            CHTML::modeloLabel($log,"nick").
            CHTML::modeloText($log, "nick",
                            ["class"=>"form-control",
                             "placeholder"=>"Correo electrónico",
                             "required"=>"required",
                             "autofocus"=>"autofocus"
                            ]).
            "<br>".
            
            CHTML::modeloLabel($log,"contrasenia").
            CHTML::modeloPassword($log, "contrasenia",
                ["class"=>"form-control",
                 "placeholder"=>"Contraseña",
                 "required"=>"required"
                ]).
            
            "<br>".
            
           
                
            CHTML::dibujaEtiqueta("button",
                ["class"=>"btn btn-lg btn-danger btn-block",
                 "type"=>"submit"
                ],
                "Entrar").
                
            CHTML::modeloError($log, "nick").PHP_EOL.
                
        CHTML::finalizarForm();
    echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");