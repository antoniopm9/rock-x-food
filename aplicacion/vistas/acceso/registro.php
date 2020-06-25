<?php

// Almaceno las provincias existentes en la base de datos en un array
$arrayProvincias = LibreriaMetodos::dameProvincias();

// url a la que se irá para validar el registro
$url = Sistema::app()->generaURL(["acceso","validaregistro"]);

// Una vez obtenido el array, me crearé un array asociativo en el que la
// posición y el nombre de la provincia serán los mismos. Esto lo hago así
// porque luego crearé un combo con opciones mediante el framework y quiero
// que el atributo value sea el nombre de la provincia

$arrayAsociativo = [];
foreach ($arrayProvincias as $value) {
    
    $arrayAsociativo[$value["nombre"]] = $value["nombre"];
    
}

$textoBienvenida= "¿Eres un artista o tienes un restaurante? ¡Qué alegría nos das!".
    " Si te registras en rockfood no solo ayudarás a tu banda o local a crecer. ".
    "También nos ayudas a nosotros y a toda una comunidad de fans ansiosos por comer ".
    "donde comen sus estrellas favoritas.";

echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false).

    CHTML::dibujaEtiqueta("div",["class"=>"col-md-12 col-lg-8 justify-content-center"],null, false).
        CHTML::dibujaEtiqueta("h1", [], "Registro").
        CHTML::dibujaEtiqueta("p", [], $textoBienvenida).
        
        "<br>".
        
    CHTML::iniciarForm($url, "post", ["enctype"=>"multipart/form-data"]).
    
        CHTML::dibujaEtiqueta("label",["for"=>"nombreReg"],"Nombre").
        CHTML::dibujaEtiqueta("input",[
                                "id"=>"nombreReg",
                                "name"=>"nombreReg",
                                "type"=>"text",
                                "class"=>"form-control",
                                "maxlength"=>"30",
                                "placeholder"=>"Nombre de tu banda o restaurante."
        ]).
        
        "<br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"correo"],"Correo electrónico").
        CHTML::dibujaEtiqueta("input",[
            "id"=>"correo",
            "name"=>"correo",
            "type"=>"email",
            "class"=>"form-control",
            "placeholder"=>"ejemplo@rockfood.es"
        ]).
        
        "<br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"contra"],"Contraseña").
        CHTML::dibujaEtiqueta("input",[
            "id"=>"contra",
            "name"=>"contra",
            "type"=>"password",
            "class"=>"form-control",
            "placeholder"=>"Escribe aquí tu contraseña."
        ]).
        
        
        "<br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"provincia"],"Provincia").
        
        CHTML::campoListaDropDown("provincia",
                     -1,
                    $arrayAsociativo,
                    ["class"=>"form-control",
                        "id"=>"provincia",
                        "linea"=>"Escoge la provincia de tu artista o restaurante."
                    ]).
                    
        "<br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"municipio"],"Municipio").
        CHTML::campoListaDropDown("municipio",
            -1,
            [],
            ["class"=>"form-control",
                "id"=>"municipio",
                "linea"=>"Escoge el municipio de tu artista o restaurante."
            ]).
            
            "<br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"divImagen"],"Foto de perfil");
        
        ?>
       
        <div class="custom-file" id="divImagen">
            <input type="file" class="custom-file-input" id="imagen" name="imagen">
            <label class="custom-file-label" for="imagen">Escoge una imagen .jpg o .png</label>
        </div>
       
       <?php
        
        echo "<br><br>".
        
        CHTML::dibujaEtiqueta("label",["for"=>"divRadios"],"Escoge tu categoría").
        "<br>";

        
        
       ?>
       
        <div class="divRadios custom-control custom-radio custom-control-inline">
            <input type="radio" id="radioArtista" name="radioButton" class="custom-control-input" value="artista" checked>
            <label class="custom-control-label" for="radioArtista">Artista</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline" id="divRadio2">
            <input type="radio" id="radioRestaurante" name="radioButton" class="custom-control-input"  value="restaurante">
            <label class="custom-control-label" for="radioRestaurante">Restaurante</label>
            <br><br>
        </div>
       
       <?php
       
       echo CHTML::dibujaEtiqueta("div",["id"=>"divArtista"],null, false).
           CHTML::dibujaEtiqueta("label",["for"=>"genero"],"Género:").
           CHTML::dibujaEtiqueta("input",[
               "id"=>"genero",
               "name"=>"genero",
               "type"=>"text",
               "class"=>"form-control",
               "placeholder"=>"Jazz, Death Metal, Indie..."
           ]).
           
           "<br>".
           
           CHTML::dibujaEtiqueta("label",["for"=>"anio"],"Año de inicio:").
           CHTML::dibujaEtiqueta("input",[
               "id"=>"anio",
               "name"=>"anio",
               "type"=>"text",
               "class"=>"form-control",
               "placeholder"=>"¿En qué año empezaste?"
           ]).
           
           "<br>".
    
           CHTML::dibujaEtiqueta("label",["for"=>"musica"],"Tu música:").
           CHTML::dibujaEtiqueta("input",[
               "id"=>"musica",
               "name"=>"musica",
               "type"=>"text",
               "class"=>"form-control",
               "placeholder"=>"Pon un enlace a algún álbum tuyo."
           ]).
       
        CHTML::dibujaEtiquetaCierre("div").
           
       "<br><br>".
       
       
                    
       CHTML::dibujaEtiqueta("input",
                        ["type"=>"submit",
                         "id"=>"submitArtista",
                         "class"=>"btn btn-danger",
                         "value"=>"Dar de alta artista",
                         "disabled"=>"disabled"
                        ]).
     
     "<br><br>".  
     
     CHTML::dibujaEtiqueta("input",
         ["type"=>"submit",
          "id"=>"submitRestaurante",
          "class"=>"btn btn-danger",
          "value"=>"Dar de alta restaurante",
          "disabled"=>"disabled"
         ]).
          
    CHTML::finalizarForm().
    CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");

?>





