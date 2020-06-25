<?php

class LibreriaMetodos{
    
    // Función que devuelve todas las provincias que hay registradas
    // en la base de datos
    static function dameProvincias(){
        
        $url = Sistema::app()->generaURL(["api","provincias"]);
        $url = $_SERVER["SERVER_NAME"].$url;
        //creo una sesión Curl
        $enlaceCurl=curl_init();
        //se indican las opciones para una petición HTTP Post
        curl_setopt($enlaceCurl, CURLOPT_URL,$url);
        //curl_setopt($enlaceCurl, CURLOPT_POST, 1);
        curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
        curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
        //ejecuto la petición
        if (! $jsonProvincias=curl_exec($enlaceCurl))
            echo curl_error($enlaceCurl);
        //cierro la sesión
        curl_close($enlaceCurl);
        
        // Decodifico el json que he obtenido
        $arrayJson = json_decode($jsonProvincias, JSON_UNESCAPED_UNICODE);
        
        return $arrayJson;
    }
    
    // Función que modifica una provincia mediante una petición POST
    static function modificaProvincia($vieja, $nueva){
        
        $url = Sistema::app()->generaURL(["api","provincias"]);
        $url = $_SERVER["SERVER_NAME"].$url;
        //creo una sesión Curl
        $enlaceCurl=curl_init();
        //se indican las opciones para una petición HTTP Post
        curl_setopt($enlaceCurl, CURLOPT_URL,$url);
        curl_setopt($enlaceCurl, CURLOPT_POST, 1);
        curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS,
            "vieja=$vieja"."&nueva=$nueva");
        curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
        curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
        //ejecuto la petición
        if (! $jsonProvincias=curl_exec($enlaceCurl))
            echo curl_error($enlaceCurl);
            //cierro la sesión
        curl_close($enlaceCurl);
        
        // Decodifico el json que he obtenido
        $arrayJson = json_decode($jsonProvincias, JSON_UNESCAPED_UNICODE);
        
        return $arrayJson;
    }
    
    // Función para añadir una provincia por petición PUT
    // Lo he intentado pero no funciona
    static function anadeProvincia($provincia){
        
        $url = Sistema::app()->generaURL(["api","provincias"]);
        $url = $_SERVER["SERVER_NAME"].$url;
        //creo una sesión Curl
        $enlaceCurl=curl_init();
        
        $arrayDatos["provincia"] = $provincia;
        $envio = json_encode($arrayDatos, JSON_UNESCAPED_UNICODE);
        
        //se indican las opciones para una petición HTTP Post
        curl_setopt($enlaceCurl, CURLOPT_URL,$url);
        // --- Petición PUT.
        
        curl_setopt($enlaceCurl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS, $envio);
        // --- HTTPGET a false porque no se trata de una petición GET.
        
        curl_setopt($enlaceCurl, CURLOPT_HTTPGET, FALSE);
        curl_setopt($enlaceCurl, CURLOPT_HEADER, 1);
        curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
        //ejecuto la petición
        if (! $jsonProvincias=curl_exec($enlaceCurl))
            echo curl_error($enlaceCurl);
            //cierro la sesión
            curl_close($enlaceCurl);
            
            // Decodifico el json que he obtenido
            $arrayJson = json_decode($jsonProvincias, JSON_UNESCAPED_UNICODE);
            
            return $arrayJson;
    }
    
    // Función que devuelve todos los municipios dado el nombre
    // de una provincia
    static function dameMunicipios($nombreProvincia){
        
        //creo una sesión CURl
        $enlaceCurl=curl_init();
        //se indican las opciones para una petición HTTP Post
        curl_setopt($enlaceCurl, CURLOPT_URL,
            "http://ovc.catastro.meh.es//ovcservweb/OVCSWLocalizacionRC/OVCCallejero.asmx/ConsultaMunicipio");
        curl_setopt($enlaceCurl, CURLOPT_POST, 1);
        curl_setopt($enlaceCurl, CURLOPT_POSTFIELDS,
            "Provincia=$nombreProvincia"."&Municipio=");
        curl_setopt($enlaceCurl, CURLOPT_HEADER, 0);
        curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");
        //ejecuto la petición
        $xmlMunicipios=curl_exec($enlaceCurl);
        //cierro la sesión
        curl_close($enlaceCurl);
        //si quiero usar xpath con el documento XML
        $xmlMunicipios = str_replace('xmlns=', 'ns=', $xmlMunicipios);
        
        $municipios = new SimpleXMLElement($xmlMunicipios);
        
        $cont=0;
        $arrayMunicipios = [];
        foreach($municipios->municipiero->muni as $municipio){
            $arrayMunicipios[$cont] = "{$municipio->nm}";
            
            $cont++;
        }
        
        $datos = json_encode($arrayMunicipios, JSON_UNESCAPED_UNICODE);
        
        echo $datos;
        
        
        
    }
    
    // Función que crea una frase descriptiva del precio del restaurante.
    // En la base de datos se guarda el dato 'precio', que es un número
    // desde el 1 hasta el 3. Para hacerlo más comprensible para el público
    // mostraré en la aplicación una frase más detallada
    static function creaDescripcionPrecio($numPrecio){
        
        switch ($numPrecio) {
            case 1: $precio="Bueno, bonito... ¡y barato! Este restaurante ".
                "tiene unos precios muy competitivos.";
            
            break;
            case 2: $precio="Ni caro ni barato. Los precios de este restaurante".
                " son como la de la mayoría de restaurantes.";
            
            break;
            case 3: $precio="Este restaurante es un poco más caro que la media.".
                " Vas a tener que rascarte el bolsillo, ¡pero merece la pena!";
            
            break;
            
            default: $precio="No conocemos los precios de este restuarante :(" ;
            break;
        }
        
        return $precio;
        
    }
    
    // Igual que la anterior pero con las opciones vegetarianas
    static function creaDescripcionVegetariano($numVegetariano){
        
        switch ($numVegetariano) {
            case 0: $oVegetariana="Si eres vegetariano, este no es tu sitio :(".
                "Quizá puedan adaptarte algún plato, pero será mejor que consultes".
                " en el restaurante.";
            
            break;
            case 1: $oVegetariana="Oferta vegetariana existente, pero algo reducida.";
            
            break;
            case 2: $oVegetariana="Si eres vegetariano, aquí encontrarás una buena ".
                " oferta de platos.";
            
            break;
            case 3: $oVegetariana="¡El paraíso de un vegetariano! Este restaurante  ".
                " es conocido por su gran variedad de ofertas vegetarianas en su menú. ".
                "Ponte las botas sin preocuparte.";
            
            break;
            
            default: $oVegetariana="No conocemos la oferta vegetariana de este restuarante :(" ;
            break;
        }
        
        
        return $oVegetariana;
    }
    
    // Igual que el anterior pero con las opciones veganas
    static function creaDescripcionVegano($numVegano){
        
        switch ($numVegano) {
            case 0: $oVegana="Oferta vegana inexistente.";
            
            break;
            case 1: $oVegana="Oferta vegana reducida. Puede que un par de platos o tres como mucho.";
            
            break;
            case 2: $oVegana="Si eres vegano, aquí encontrarás una buena ".
                " oferta de platos.";
            
            break;
            case 3: $oVegana="Este restaurante es bien conodico por la cantidad de platos veganos ".
                "que puedes encontrar en su carta.";
            
            break;
            
            default: $oVegana="No conocemos la oferta vegana de este restuarante :(" ;
            break;
        }
        
        return $oVegana;
        
    }
    
    // Igual que el anterior, pero para indicar si hay una autovia cerca o no
    static function creaDescripcionAutovia($autoviaCerca){
        
        switch ($autoviaCerca) {
            case 0: $cercaAutovia="Restaurante dentro de la ciudad. Genial si estás haciendo una visita.";
            
            break;
            case 1: $cercaAutovia="Restaurante de carretera. Genial si estás de viaje con tu banda y ".
                "no tienes mucho tiempo para comer.";
            
            break;
            
            default: $cercaAutovia="No sabemos si este restaurante está en la ciudad o en la carretera. ".
                "¿Por qué no lo buscas en el mapa?" ;
            break;
        }
        
        return $cercaAutovia;
    }
    
    // Función que dibuja el formulario para modificar o añadir resñas a los restaurantes
    static function dibujaFormulario($idEstrellas, $descripcionEstrellas, $estrellas=null,$puntuaciones=null){
        
        echo CHTML::iniciarForm();
        
        echo CHTML::dibujaEtiqueta("div",["id"=>"divResena"],null, false);
        
        echo CHTML::dibujaEtiqueta("label",["for"=>"rateMe"], "Puntuación");
        
        echo CHTML::dibujaEtiqueta("div",["id"=>"divPuntuacion", "class"=>"form-group row"],null, false);
        
        echo CHTML::dibujaEtiqueta("div",[],null, false);
        
        echo CHTML::dibujaEtiqueta("span",["id"=>"rateMe", "class"=>"col-12 text-center"],null,false);
        
        for($i=0;$i<5;$i++){
            echo CHTML::dibujaEtiqueta("i",[
                "class"=>
                "fa fa-star py-2 px-1 rate-popover puntEstrella ".(($puntuaciones!=null &&($puntuaciones[0]["puntuacion"]-1)>=$i) ? $estrellas[($puntuaciones[0]["puntuacion"])-1] : ""),
                "data-index"=>$i,
                "data-html"=>"true",
                "data-toggle"=>"popover",
                "id"=>$idEstrellas[$i],
                "data-placement"=>"top",
                "title"=>$descripcionEstrellas[$i]
            ],null,false);
            echo CHTML::dibujaEtiquetaCierre("i");
        }
        
        echo CHTML::dibujaEtiquetaCierre("span");
        
        echo CHTML::dibujaEtiquetaCierre("div");
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],null, false);
        
        echo CHTML::dibujaEtiqueta("input",
            ["id"=>"puntuacion",
                "name"=>"puntuacion",
                "type"=>"text",
                "class"=>"form-control",
                "placeholder"=>"¿Qué te ha parecido?",
                "readonly"=>"readonly",
                "value"=>(($puntuaciones!=null )? $descripcionEstrellas[$puntuaciones[0]["puntuacion"]-1]:"")
            ]);
        
        // divTextoPuntuacion
        echo CHTML::dibujaEtiquetaCierre("div");
        
        // divPuntuacion
        echo CHTML::dibujaEtiquetaCierre("div");
        
        // ------
        // RESEÑA
        // ------
        echo CHTML::dibujaEtiqueta("label",["for"=>"resena"], "Reseña");
        
        echo CHTML::dibujaEtiqueta("textarea",[
            "class"=>"form-control",
            "id"=>"resena",
            "name"=>"resena",
            "placeholder"=>"Cuéntanos qué te ha parecido este restaurante",
            "rows"=>3
        ],
            ($puntuaciones!=null )? ($puntuaciones[0]["resena"]): "");
        
        echo "<br>";
        // Contador de letras
        echo CHTML::dibujaEtiqueta("div",["class"=>"progress"],null, false);
        
        // div Barra progreso
        if($puntuaciones!=null ){
            $longitud = mb_strlen($puntuaciones[0]["resena"]);
        }
        else{
            $longitud = 0;
        }
        echo CHTML::dibujaEtiqueta("div",[
            "id"=>"barra",
            "class"=>"progress-bar progress-bar-striped progress-bar-animated bg-success",
            "role"=>"progressbar",
            "style"=>"width:".($longitud/3)."%",
            "aria-valuenow"=>$longitud,
            "aria-valuemin"=>0,
            "aria-valuemax"=>300]
            ,"$longitud / 300", false);
        
        // div Barra progreso
        echo CHTML::dibujaEtiquetaCierre("div");
        
        // divContadorLetras
        echo CHTML::dibujaEtiquetaCierre("div");
        
        echo "<br>";
        
        // Plato favorito
        echo CHTML::dibujaEtiqueta("label",["for"=>"platoFavorito"],"Plato favorito");
        echo CHTML::dibujaEtiqueta("input",[
            "type"=>"text",
            "class"=>"form-control",
            "id"=>"platoFavorito",
            "name"=>"platoFavorito",
            "placeholder"=>"¿Cuál ha sido el plato que más te ha gustado?",
            "value"=>(($puntuaciones!=null)? $puntuaciones[0]["plato_favorito"] : "")
            
        ]);
        
        echo "<br>";
        
        echo CHTML::dibujaEtiqueta("input",[
            "type"=>"submit",
            "id"=>"guardar",
            "name"=>(($puntuaciones!=null)? "modificar":"insertar"),
            "class"=>"btn btn-danger",
            "value"=>(($puntuaciones!=null)? "Modificar":"Añadir reseña"),
            "disabled"=>"disabled"
            
        ]);
        
        if($puntuaciones!=null){
            echo CHTML::dibujaEtiqueta("input",[
                "type"=>"submit",
                "id"=>"borrar",
                "name"=>"borrar",
                "class"=>"btn btn-danger ml-4",
                "value"=>"Borrar reseña"
                
            ]);
        }
        
        //divReseña
        echo CHTML::dibujaEtiquetaCierre("div");
        
        
        echo CHTML::finalizarForm();
        
    }
    
}