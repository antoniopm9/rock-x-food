<?php
echo CHTML::scriptFichero("/javascript/buscador.js", ["defer"=>""]);

$descripcionEstrellas = [0=>"Muy malo",
                         1=>"Malo",
                         2=>"Ok",
                         3=>"Bueno",
                         4=>"Excelente"
];

$estrellas = [0=>"oneStar",
              1=>"twoStars",
              2=>"threeStars",
              3=>"fourStars",
              4=>"fiveStars"
];

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],null, false).
         CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-3"],null, false).
         CHTML::dibujaEtiqueta("label",["for"=>"buscador"],null,false).
             CHTML::dibujaEtiqueta("h1", ["class"=>"titulo"], "food: lista de restaurantes").
         CHTML::dibujaEtiquetaCierre("label");
            // Buscar restaurante
             if($filas){
                echo CHTML::dibujaEtiqueta("input",[
                    "class"=>"form-control border-bottom",
                    "placeholder"=>"Buscar restaurante por nombre.",
                    "id"=>"buscador"
                ]);
             }
             else{
                 echo CHTML::dibujaEtiqueta("input",[
                     "class"=>"form-control border-bottom",
                     "placeholder"=>"Buscar restaurante por nombre.",
                     "id"=>"buscador",
                     "disabled"=>""
                 ]);
             }
            echo "<hr>";
            
            if($form){
                
                echo CHTML::dibujaEtiqueta("a",
                    ["class"=>"btn btn-lg btn-danger",
                        "href"=>Sistema::app()->generaURL(["food"]),
                        "role"=>"button"
                    ],
                    "Volver atrás");
            }
            else{
                
                echo CHTML::dibujaEtiqueta("h4",[],"Búsqueda avanzada");
                
                // Div formulario búsqueda avanzada
                echo CHTML::dibujaEtiqueta("div",["class"=>"collapse", "id"=>"collapseForm"],null, false);
                
                echo CHTML::iniciarForm();
                
                ?>
                <br>
                <p>Busco un restaurante...</p>
                
                <br>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="vegetariano" name="vegetariano"/>
            		
                    <label class="custom-control-label" for="vegetariano" id="labelVeget">
                    	Con opciones vegetarianas.
                </label>
        		 	</div>
                <br>
                
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="vegano" name="vegano"/>
            		
                    <label class="custom-control-label" for="vegano" id="labelVegan">
                    	Con opciones veganas.
                </label>
        		 	</div>
                <br>
                
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="autovia" name="autovia"/>
            		
                    <label class="custom-control-label" for="autovia" id="labelAutovia">
                    	Cerca de la autovía.
                </label>
        		 	</div>
                <br>
                <?php 
                
                echo CHTML::dibujaEtiqueta("label",["for"=>"provincia"],"En esta provincia:");
                
                echo CHTML::campoListaDropDown("provincia",
                    -1,
                    $provincias,
                    ["class"=>"form-control",
                        "id"=>"provincia",
                        "linea"=>false
                    ]);
                
                echo "<br>";
                
                echo CHTML::dibujaEtiqueta("label",["for"=>"artista"],"En el que haya comido mi artista favorito:");
                
                echo CHTML::dibujaEtiqueta("input",[
                    "class"=>"form-control",
                    "id"=>"artista",
                    "name"=>"artista",
                    "placeholder"=>"Escribe el nombre del artista.",
                    "list"=>"artistas"
                ]);
                
                echo CHTML::dibujaEtiqueta("datalist",["id"=>"artistas"],null, false);
                foreach ($artistas as $artista) {
                    
                    echo CHTML::dibujaEtiqueta("option",["value"=>$artista],$artista);
                }
                echo CHTML::dibujaEtiquetaCierre("datalist");
                
                echo "<br>";
                
                echo CHTML::dibujaEtiqueta("input",[
                    "class"=>"form-control btn btn-danger",
                    "id"=>"buscarRes",
                    "name"=>"buscarRes",
                    "type"=>"submit",
                    "value"=>"Buscar restaurantes"
                ]);
                
                echo CHTML::finalizarForm();
                
                // Cierre div formulario búsqueda
                echo CHTML::dibujaEtiquetaCierre("div");
            
            echo "<br>";
            
            echo CHTML::dibujaEtiqueta("button",[
                "class"=>"btn btn-danger",
                "type"=>"button",
                "data-toggle"=>"collapse",
                "id"=>"mostrar",
                "data-target"=>"#collapseForm",
                "aria-expanded"=>"false",
                "aria-controls"=>"collapseForm"
            ], "Mostrar / Ocultar");
            }
          echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",["class"=>"filas row m-0 col-12 col-lg-9"],null, false);
    
        if(!$filas){
            echo CHTML::dibujaEtiqueta("h1",[],"Vaya, no hemos encontrado ningún restaurante :(");
        
            for($i=0;$i<20; $i++){
                echo "<br>";
            }
        }
        foreach($filas as $clave=>$valor){
            // Variable que comprueba si el restaurante ha sido puntuado por el artista
            $valorado = false;
            if(isset($valor["puntuacion"])){
                $valorado = true;
            }
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"row col-xl-4 col-lg-6 col-12 m-0 justify-content-center"],null, false);
            
            echo CHTML::dibujaEtiqueta("img", [
                "src"=>'/imagenes/restaurantes/'.$filas[$clave]["imagen"],
                "alt"=>$filas[$clave]["nombre"],
                "class"=>"imagen mt-5",
                "style"=>"width: 40%;"
            ]);
            
            echo CHTML::dibujaEtiqueta("h2", ["class"=>"col-12 text-center nombre"], $filas[$clave]["nombre"]);
            
            if(mb_strlen($filas[$clave]["descripcion"])>110){
                echo CHTML::dibujaEtiqueta("p",
                    ["class"=>"col-12 text-center"],
                    mb_substr($filas[$clave]["descripcion"],0,110) . "[...]").
                    CHTML::dibujaEtiqueta("p",
                        ["class"=>"col-12 text-center"],
                        $filas[$clave]["municipio"]);
            }
            
            else{
            
                echo CHTML::dibujaEtiqueta("p",
                    ["class"=>"col-12 text-center"],
                    $filas[$clave]["descripcion"]) .
                    CHTML::dibujaEtiqueta("p",
                    ["class"=>"col-12 text-center"],
                    $filas[$clave]["municipio"]);
            }
                if($valorado && $sw){
                    echo CHTML::dibujaEtiqueta("p",
                        ["class"=>"col-12 text-center"],
                        "Tu puntuación:");
                }
                
                if($valorado && !$sw){
                    echo CHTML::dibujaEtiqueta("p",
                        ["class"=>"col-12 text-center"],
                        "Puntuación media:");
                }
                else if(!$valorado){
                    echo CHTML::dibujaEtiqueta("p",
                        ["class"=>"col-12 text-center"],
                        "Sin puntuar");
                }
                // Muestro la puntuación del restaurante
                echo CHTML::dibujaEtiqueta("span",["id"=>"rateMe","class"=>"col-12 text-center hola"],null,false);
                for($i=0;$i<5;$i++){
                    
                    echo CHTML::dibujaEtiqueta("i",[
                        "class"=>
                        "fa fa-star py-2 px-1 rate-popover ".(($valorado && ($valor["puntuacion"]-1)>=$i) ? $estrellas[($valor["puntuacion"])-1] : ""),
                        "data-index"=>$i,
                        "data-html"=>"true",
                        "data-toggle"=>"popover",
                        "data-placement"=>"top",
                        "title"=>$descripcionEstrellas[$i]
                    ],null,false);
                    echo CHTML::dibujaEtiquetaCierre("i");
                    }
                    
                CHTML::dibujaEtiquetaCierre("span");
                
                
                echo CHTML::dibujaEtiqueta("p",[],null, false);
                echo CHTML::dibujaEtiqueta("a",
                    ["class"=>"btn btn-lg btn-danger",
                        "href"=>Sistema::app()->generaURL(["food", "consultar"], ["id"=>$filas[$clave]["cod_restaurante"]]),
                        "role"=>"button"
                    ],
                    "Ver restaurante");
                    echo CHTML::dibujaEtiquetaCierre("p");
                    
                    echo CHTML::dibujaEtiquetaCierre("div");
                
            
        }
    echo CHTML::dibujaEtiquetaCierre("div");
    echo CHTML::dibujaEtiqueta("div",["class"=>"row"],null, false);
    
echo CHTML::dibujaEtiquetaCierre("div");



