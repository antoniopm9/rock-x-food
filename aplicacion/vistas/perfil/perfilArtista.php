<?php
echo CHTML::scriptFichero("/javascript/perfilArtista.js", ["defer"=>""]);

// Almaceno las provincias existentes en la base de datos en un array
$arrayProvincias = LibreriaMetodos::dameProvincias();

$url = Sistema::app()->generaURL(["perfil","perfilArtista"]);

// Una vez obtenido el array, me crearé un array asociativo en el que la
// posición y el nombre de la provincia serán los mismos. Esto lo hago así
// porque luego crearé un combo con opciones mediante el framework y quiero
// que el atributo value sea el nombre de la provincia

$arrayAsociativo = [];
foreach ($arrayProvincias as $value) {
    
    $arrayAsociativo[$value["nombre"]] = $value["nombre"];
    
}

$descripcion= "Esta es la información que figura en tu perfil.";

echo CHTML::dibujaEtiqueta("div",[],null, false).
CHTML::iniciarForm($url, "post", ["enctype"=>"multipart/form-data"]).

    CHTML::dibujaEtiqueta("div", ["class"=>"row"], null, false);
        echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-4"], null, false);
        echo CHTML::dibujaEtiqueta("img", [
            "src"=>'/imagenes/artistas/'.$art->imagen,
            "class"=>"imagen",
            "alt"=>$art->nombre,
            "style"=>"width: 100%;"
        ]);
        
        echo CHTML::modeloLabel($art, "imagen");
        ?>
            <div class="custom-file" id="divImagen">
            <input type="file" class="custom-file-input" id="nombre_imagen" value=<?php echo $art->imagen;?> name="nombre[imagen]" disabled>
            <label class="custom-file-label">
            	<?php echo $art->imagen;?>
            </label>
            </div>
            <br>
            <br>
        <?php
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-8"], null, false);
    
        echo CHTML::dibujaEtiqueta("h1", [], $art->nombre);
            
            echo CHTML::dibujaEtiqueta("p",[],$descripcion);
            
            if($artistaModificado){
                ?>
                <br>
                <span class="badge badge-pill badge-success"  style= "font-size: 12pt">
                	Datos modificados correctamente
                </span>
                <br>
                <?php
            }
            
            ?>
            <br>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="habilitar_edicion" name="habilitar_edicion"/>
        		
                <label class="custom-control-label" for="habilitar_edicion" id="habilitar">
                	Habilitar edición
            </label>
    		 	</div>
            <br>
            <?php 
            
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
            CHTML::campoListaDropDown("nombre[provincia]",
                $art->provincia,
                $arrayAsociativo,
                ["class"=>"form-control",
                    "id"=>"nombre_provincia",
                    "linea"=>"Escoge la provincia de tu artista.",
                    "disabled"=>""
                ]);
            
            echo CHTML::modeloLabel($art, "municipio") .
            CHTML::campoListaDropDown("nombre[municipio]",
                $art->municipio,
                [$art->municipio=>$art->municipio],
                ["class"=>"form-control",
                    "id"=>"nombre_municipio",
                    "linea"=>"Escoge el municipio de tu artista.",
                    "disabled"=>""
                ]);

            echo CHTML::modeloLabel($art, "musica") .
            CHTML::modeloText($art, "musica",
                [
                    "readonly"=>"",
                    "class"=>"form-control"
                ]);
            
            echo "<br>";
            
            echo CHTML::dibujaEtiqueta("div", ["id"=>"spotify", "class"=>"embed-responsive embed-responsive-16by9"], null, false);
              
            echo CHTML::dibujaEtiquetaCierre("div");
            
            echo "<br>";  
            
            echo CHTML::dibujaEtiqueta("input",
                ["type"=>"submit",
                    "id"=>"modificar",
                    "class"=>"btn btn-danger",
                    "value"=>"Modificar datos",
                    "disabled"=>"disabled"
                ]);
        echo CHTML::dibujaEtiquetaCierre("div");
        
echo CHTML::finalizarForm();
echo CHTML::dibujaEtiquetaCierre("div");

?>





