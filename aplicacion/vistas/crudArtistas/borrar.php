<br><br>
<?php 


echo CHTML::dibujaEtiqueta("div",["class"=>"row justify-content-center"],null, false).

CHTML::dibujaEtiqueta("div",["class"=>"col-md-12 col-lg-8 justify-content-center"],null, false).
CHTML::dibujaEtiqueta("h1", [], "Borrado de artista").

"<br>".



CHTML::iniciarForm();

        echo CHTML::modeloLabel($art, "nombre") . 
             CHTML::modeloText($art, "nombre", [
                                            "placeholder" => "Nombre",
                                            "maxlength"=>30,
                                            "size"=>31,
                                            "class"=>"form-control",
                                            "readonly"=>""
                                        ]) ;
        echo CHTML::modeloLabel($art, "correo") . 
             CHTML::modeloText($art, "correo", [
                                             "placeholder" => "Correo",
                                             "class"=>"form-control",
                                            "readonly"=>""
                                        ]);
        echo CHTML::modeloLabel($art, "genero") . 
             CHTML::modeloText($art, "genero",[
                                            "readonly"=>"",
                                            "class"=>"form-control"
             ]);
        
        echo CHTML::modeloLabel($art, "anio_inicio") . 
        CHTML::modeloText($art, "anio_inicio", ["maxlength"=>4,
                                                 "class"=>"form-control",
                                                "placeholder"=>"1900",
                                                "readonly"=>""
             ]);
        
             
        echo CHTML::modeloLabel($art, "provincia") .
             CHTML::modeloText($art, "provincia",
                 [
                     "readonly"=>"",
                     "class"=>"form-control"
                 ]);
        
         echo CHTML::modeloLabel($art, "municipio") .
             CHTML::modeloText($art, "municipio",
                 [
                     "readonly"=>"",
                     "class"=>"form-control"
                 ]);
             
         echo CHTML::modeloLabel($art, "musica") .
             CHTML::modeloText($art, "musica",
                 [
                     "readonly"=>"",
                     "class"=>"form-control"
                 ]);
             
        echo CHTML::modeloLabel($art, "imagen") . 
             CHTML::modeloText($art, "imagen", [
                 "placeholder" => "imagen",
                 "class"=>"form-control",
                 "readonly"=>""
                                        ]);
        
        
        echo CHTML::modeloCheckBox($art, "borrado", [
                 "value"=>1,
                 "uncheckValor"=>0,
                 "etiqueta"=>"borrado",
                 "disabled"=>""
             ]);
        
echo CHTML::modeloHidden($art, "cod_artista"). "<br>".PHP_EOL;
echo CHTML::campoBotonSubmit("Borrar",["name"=>"borrar", "class"=>"btn btn-danger"]) . "<br>" . PHP_EOL;
        
        
CHTML::finalizarForm().
CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiquetaCierre("div");