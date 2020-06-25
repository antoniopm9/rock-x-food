<?php
echo CHTML::scriptFichero("/javascript/perfilRestaurante.js", ["defer"=>""]);

// Array con las opciones de precio
$arrayPrecios = ["0"=>"¿Qué precio tiene tu restaurante?",
    "1"=>"Barato",
    "2"=>"Normal",
    "3"=>"Caro"
];

// Array con las opciones vegetarianas
$ofertaVegetariana = ["-1"=>"¿Cómo es la oferta vegetariana en tu restaurante?",
                        "0"=>"Ninguna",
                        "1"=>"Poca",
                        "2"=>"Normal",
                        "3"=>"Mucha"
];

// Array con las opciones veganas
$ofertaVegana = ["-1"=>"¿Cómo es la oferta vegana en tu restaurante?",
    "0"=>"Ninguna",
    "1"=>"Poca",
    "2"=>"Normal",
    "3"=>"Mucha"
];

// Almaceno las provincias existentes en la base de datos en un array
$arrayProvincias = LibreriaMetodos::dameProvincias();

$url = Sistema::app()->generaURL(["perfil","perfilRestaurante"]);

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
            "src"=>'/imagenes/restaurantes/'.$res->imagen,
            "class"=>"imagen",
            "alt"=>$res->nombre,
            "style"=>"width: 100%;"
        ]);
        
        echo CHTML::modeloLabel($res, "imagen");
        ?>
            <div class="custom-file" id="divImagen">
            <input type="file" class="custom-file-input" id="nombre_imagen" value=<?php echo $res->imagen;?> name="nombre[imagen]" disabled>
            <label class="custom-file-label">
            	<?php echo $res->imagen;?>
            </label>
            </div>
            <br>
            <br>
        <?php
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"col-12 col-md-8"], null, false);
    
        echo CHTML::dibujaEtiqueta("h1", [], $res->nombre);
            
            echo CHTML::dibujaEtiqueta("p",[],$descripcion);
            
            if($resModificado){
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
            
            echo CHTML::modeloLabel($res, "nombre") .
            CHTML::modeloText($res, "nombre", [
                "placeholder" => "Nombre",
                "maxlength"=>30,
                "size"=>31,
                "class"=>"form-control",
                "readonly"=>""
            ]) ;
            echo CHTML::modeloLabel($res, "correo") .
            CHTML::modeloText($res, "correo", [
                "placeholder" => "Correo",
                "class"=>"form-control",
                "readonly"=>""
            ]);
            echo CHTML::modeloLabel($res, "descripcion") .
            CHTML::modeloTextArea($res, "descripcion",[
                "readonly"=>"",
                "class"=>"form-control"
            ]);
            
            ?>
            <br>
            <div class="progress">
            	<div id="barra"
            		class="progress-bar progress-bar-striped progress-bar-animated bg-success"
            		role="progressbar" style="width:<?php echo mb_strlen($res->descripcion)/5;?>%"
            		aria-valuenow="<?php echo mb_strlen($res->descripcion);?>"
            		aria-valuemin="0" aria-valuemax="500">
            		<?php echo mb_strlen($res->descripcion);?> / 500
            	</div>
            
            </div>
            
            <br>
            
            <?php
            
            echo CHTML::modeloLabel($res, "direccion") .
            CHTML::modeloText($res, "direccion", [
                "placeholder" => "Dirección",
                "class"=>"form-control",
                "readonly"=>""
            ]);
            
            echo CHTML::modeloLabel($res, "provincia") .
            CHTML::campoListaDropDown("nombre[provincia]",
                $res->provincia,
                $arrayAsociativo,
                ["class"=>"form-control",
                    "id"=>"nombre_provincia",
                    "linea"=>"Escoge la provincia de tu artista.",
                    "disabled"=>""
                ]);
            
            echo CHTML::modeloLabel($res, "municipio") .
            CHTML::campoListaDropDown("nombre[municipio]",
                $res->municipio,
                [$res->municipio=>$res->municipio],
                ["class"=>"form-control",
                    "id"=>"nombre_municipio",
                    "linea"=>"Escoge el municipio de tu artista.",
                    "disabled"=>""
                ]);
            
            echo CHTML::modeloLabel($res, "precio") .
            CHTML::campoListaDropDown("nombre[precio]",
                $res->precio,
                $arrayPrecios,
                ["class"=>"form-control",
                    "id"=>"nombre_precio",
                    "linea"=>false,
                    "disabled"=>""
                ]);
            
            echo CHTML::modeloLabel($res, "grado_vegetariano") .
            CHTML::campoListaDropDown("nombre[grado_vegetariano]",
                $res->grado_vegetariano,
                $ofertaVegetariana,
                ["class"=>"form-control",
                    "id"=>"nombre_grado_vegetariano",
                    "linea"=>false,
                    "disabled"=>""
                ]);
            
            echo CHTML::modeloLabel($res, "grado_vegano") .
            CHTML::campoListaDropDown("nombre[grado_vegano]",
                $res->grado_vegano,
                $ofertaVegana,
                ["class"=>"form-control",
                    "id"=>"nombre_grado_vegano",
                    "linea"=>false,
                    "disabled"=>""
                ]);

            echo CHTML::modeloLabel($res, "ambiente") .
            CHTML::modeloText($res, "ambiente", [
                "placeholder" => "Ambiente",
                "class"=>"form-control",
                "readonly"=>""
            ]);
            
            echo "<br>";
            
            ?>
            <div class="custom-control custom-switch">
            	<input type="checkbox" class="custom-control-input"
            	id="nombre_autovia_cerca" name="nombre[autovia_cerca]"
            	<?php if($res->autovia_cerca) echo "checked";?>
            	value="<?php echo $res->autovia_cerca;?>" disabled>
            	<label class="custom-control-label" for="nombre_autovia_cerca">
            		Autovía cerca del restaurante
            	</label>
            
            </div>
            
            <br>
            <?php
            
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





