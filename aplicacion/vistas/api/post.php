<?php

// Almaceno las provincias existentes en la base de datos en un array
$arrayProvincias = LibreriaMetodos::dameProvincias();

// Una vez obtenido el array, me crearé un array asociativo en el que la
// posición y el nombre de la provincia serán los mismos. Esto lo hago así
// porque luego crearé un combo con opciones mediante el framework y quiero
// que el atributo value sea el nombre de la provincia

$arrayAsociativo = [];
foreach ($arrayProvincias as $value) {
    
    $arrayAsociativo[$value["cod_provincia"]] = $value["nombre"];
    
}

echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3"],null, false);
echo CHTML::iniciarForm().

CHTML::dibujaEtiqueta("h1",["class"=>"h3 mb-3 font-weight-normal text-center"],"Modificar provincia (post)").

        CHTML::dibujaEtiqueta("label",["for"=>"provincia"],
            "Provincia a modificar (obtenidas con la API (por petición GET)").
        
        CHTML::campoListaDropDown("provincia",
            -1,
            $arrayAsociativo,
            ["class"=>"form-control",
                "id"=>"provinciaVieja",
                "linea"=>"Escoge la provincia para modificar",
                "autofocus"=>"autofocus"
            ]).
            
            "<br>".

        CHTML::campoLabel("Nuevo nombre", "nuevoNombre").
        CHTML::campoText("nuevoNombre", "",
            ["class"=>"form-control",
                "placeholder"=>"Escribe aquí el nuevo nombre",
                "required"=>"required"
            ]).
            "<br>".
          
        
        CHTML::dibujaEtiqueta("button",
            ["class"=>"btn btn-lg btn-danger btn-block",
                "type"=>"submit"
            ],
            "Modificar provincia").
            
            
CHTML::finalizarForm();
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");