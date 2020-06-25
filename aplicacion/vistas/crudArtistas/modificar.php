<?php 


echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false).

CHTML::dibujaEtiqueta("div",["class"=>"col-md-12 col-lg-8 justify-content-center"],null, false).
CHTML::dibujaEtiqueta("h1", [], "Modificar artista").

"<br>".



CHTML::iniciarForm();

        echo CHTML::modeloLabel($art, "nombre") . 
             CHTML::modeloText($art, "nombre", [
                                            "placeholder" => "Nombre",
                                            "maxlength"=>30,
                                            "size"=>31,
                                            "class"=>"form-control"
                                        ]) . 
             CHTML::modeloError($art, "nombre") . 
             "<br>" . PHP_EOL;
        echo CHTML::modeloLabel($art, "correo") . 
             CHTML::modeloText($art, "correo", [
                                             "placeholder" => "example@rockfood.es",
                                             "class"=>"form-control"
                                        ]) . 
             CHTML::modeloError($art, "correo") . 
             "<br>" . PHP_EOL;
        echo CHTML::modeloLabel($art, "genero") . 
        CHTML::modeloText($art, "genero",["class"=>"form-control",
                                            "placeholder" => "Rock, indie, jazz..."]) . 
             CHTML::modeloError($art, "genero") . 
             "<br>" . PHP_EOL;
        
        echo CHTML::modeloLabel($art, "anio_inicio") . 
        CHTML::modeloText($art, "anio_inicio", ["maxlength"=>4,
                                                 "class"=>"form-control",
                                                "placeholder"=>"1950"
             ]) . 
             CHTML::modeloError($art, "anio_inicio") . 
             "<br>" . PHP_EOL;
        
             
        echo CHTML::modeloLabel($art, "provincia") .
             CHTML::modeloText($art, "provincia",
                 ["class"=>"form-control","placeholder" => "Provincia del artista"]) .
                 CHTML::modeloError($art, "provincia") .
                 "<br>" . PHP_EOL;
        
         echo CHTML::modeloLabel($art, "municipio") .
             CHTML::modeloText($art, "municipio",
                 ["class"=>"form-control","placeholder" => "Municipio del artista"]) .
                 CHTML::modeloError($art, "municipio") .
                 "<br>" . PHP_EOL;
             
         echo CHTML::modeloLabel($art, "musica") .
             CHTML::modeloText($art, "musica",
                 ["class"=>"form-control","placeholder" => "Un enlace a algún álbum del artista"]) .
                 CHTML::modeloError($art, "para") .
                 "<br>" . PHP_EOL;
             
        echo CHTML::modeloLabel($art, "imagen") . 
             CHTML::modeloText($art, "imagen", [
                 "placeholder" => "Dirección a alguna imagen del artista",
                 "class"=>"form-control"
                                        ]) . 
             CHTML::modeloError($art, "imagen") . 
             "<br>" . PHP_EOL;
        
        
        echo CHTML::modeloCheckBox($art, "borrado", [
                 "value"=>1,
                 "uncheckValor"=>0,
                 "etiqueta"=>"borrado"
             ]) .
             CHTML::modeloError($art, "borrado") .
             "<br>" . PHP_EOL;
        
echo CHTML::campoBotonSubmit("Modificar",["class"=>"btn btn-danger"]) . "<br>" . PHP_EOL;
        
CHTML::finalizarForm().
CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");