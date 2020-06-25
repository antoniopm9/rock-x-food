<?php


class foodControlador extends CControlador
{

    public function __construct()
    {
        $this->accionDefecto="index";
    }
    
    
    public function accionIndex(){
        
        $res = new Restaurantes();
        
        // Variable para saber si ha entrado en el formulario de búsqueda.
        $form = false;
        
        
        $sentenciaWhere = "borrado=0";
        if($_POST){
            $form = true;
        
        // Si viene del formulario de búsqueda avanzada, recojo los
        // criterios de búsqueda
            if(isset($_POST["vegetariano"])){
                $sentenciaWhere .= " and grado_vegetariano > 1";
            }
            
            if(isset($_POST["vegano"])){
                $sentenciaWhere .= " and grado_vegano > 1";
            }
            
            if(isset($_POST["autovia"])){
                $sentenciaWhere .= " and autovia_cerca != 0";
            }
            
            if($_POST["provincia"] != -1){
                $sentenciaWhere .= " and provincia = '". $_POST["provincia"]."'";
            }
            
            if($_POST["artista"]!=""){
                
                // Busco el código del artista
                $nombreArtista = CGeneral::addSlashes($_POST["artista"]);
                
                $artistaABuscar = new Artistas();
                
                $filaArtista = $artistaABuscar->buscarTodos(["where"=>"nombre = '$nombreArtista'"]);
                
                if($filaArtista){
                    $artistaCod = $filaArtista[0]["cod_artista"];
                
                    // Obtengo los restaurantes en los que ha comido este artista
                    $sentencia="SELECT cod_restaurante ".
                        "from artistas_restaurantes ".
                        "where cod_artista = $artistaCod";
                    
                    //ejecuto la sentencia
                    $consulta=Sistema::App()->BD()->crearConsulta($sentencia);
                    
                    //devuelvo las filas
                    $resultado=$consulta->filas();
                
                    if($resultado){
                        
                        $sentenciaWhere .= " and cod_restaurante in (";
                        
                        for($i=0; $i<(count($resultado)-1);$i++){
                            
                            $sentenciaWhere .= $resultado[$i]["cod_restaurante"] .", ";
                        }
                        
                        $sentenciaWhere .= $resultado[(count($resultado)-1)]["cod_restaurante"] .")";
                        
                    }
                    else{
                        // Si no hay resultados, la búsqueda no arrojará ningún restaurante
                        $sentenciaWhere .= " and cod_restaurante = -1";
                    }
                
                }
                
                else{
                    // Si no hay resultados, la búsqueda no arrojará ningún restaurante
                    $sentenciaWhere .= " and cod_restaurante = -1";
                }
            }
            
            
        }
        $filas = $res->buscarTodos([
            "where"=> $sentenciaWhere
            
        ]);
        
        
        
        // Obtengo los datos del usuario que intenta acceder
        // (si es que hay alguno logueado)
        $sw = false;
        $codRole = 0;
        
        if(Sistema::app()->Acceso()->hayUsuario()){
            $sw = true;
            
            $nick = Sistema::app()->Acceso()->getNick();
            $codRole = Sistema::app()->ACL()->getUsuarioRole($nick);
            
        }
        
        // Si el usuario que intenta acceder es un restaurante, administrador
        // o simplemente no hay usuario validado, lo indico en la variable
        // $sw poniéndola a false. Los artistas tienen el rol 5
        if(!$sw || $codRole != 5){
            $sw = false;
            $cod_artista = -1;
            
            // Como no hay usuario validado, mostraré la media redondeada de valoración de cada
            // restaurante en lugar de la puntuación que ha dado cada artista
            $sentencia="SELECT ROUND(AVG(puntuacion),0) as puntuacion, cod_restaurante ".
                            "from artistas_restaurantes ".
                            "group by cod_restaurante";
            
            //ejecuto la sentencia
            $consulta=Sistema::App()->BD()->crearConsulta($sentencia);
            
            //devuelvo las filas
            $puntuaciones=$consulta->filas();
            
            // Ahora añado la puntuación a cada restaurante
            foreach ($filas as $indice=>$res) {
                
                // Busco si el restaurante tiene puntuación
                foreach ($puntuaciones as $indicePuntuacion=>$puntuacion){
                    if ($res["cod_restaurante"] == $puntuacion["cod_restaurante"]){
                        $filas[$indice]["puntuacion"]= $puntuaciones[$indicePuntuacion]["puntuacion"];
                    }
                }
                    
            }
        }
        
        else{
            // Obtengo el código del artista
            $art = new Artistas();
            
            // El nick del usuario es el correo electrónico. Es un valor
            // único, por lo que puedo buscar al artista por
            // su dirección de correo
            if(!$art->buscarPor(["where"=>"correo='$nick'"])){
                
                Sistema::app()->paginaError(300,"Ha habido un problema al encontrar tu perfil.");
                return;
                
            }
            
            $cod_artista = $art->cod_artista;
            
            // Ahora obtengo los restaurantes en los que ha comido el artista
            $artRes = new Artistas_restaurantes();
            
            $puntuaciones = $artRes->buscarTodos([ "where"=> "cod_artista=$cod_artista"]);
            
            // Ahora añado la puntuación a cada restaurante
            foreach ($filas as $indice=>$res) {
                
                $puntuaciones = $artRes->buscarTodos([
                    "where"=> "cod_artista=$cod_artista and cod_restaurante=".$res["cod_restaurante"]]);
                if($puntuaciones){
                    $filas[$indice]["puntuacion"]= $puntuaciones[0]["puntuacion"];
                }
            }
        }
        
        // Obtengo las provincias disponibles
        $sentenciaProvincias="SELECT distinct provincia ".
            "from restaurantes";
        
        //ejecuto la sentencia
        $consultaProvincias=Sistema::App()->BD()->crearConsulta($sentenciaProvincias);
        
        //devuelvo las filas
        $provincias=$consultaProvincias->filas();
        
        $arrayProvincias[-1] = "Escoge una provincia";
        
        foreach ($provincias as $provincia) {
            $arrayProvincias[$provincia["provincia"]] = $provincia["provincia"];
        }
        
        // Obtengo los artistas que han comido en algún restaurante
        $sentenciaArtistas="SELECT distinct a.nombre ".
            "from artistas a ".
                "join artistas_restaurantes ar using (cod_artista);";
        
        //ejecuto la sentencia
        $consultaArtistas=Sistema::App()->BD()->crearConsulta($sentenciaArtistas);
        
        //devuelvo las filas
        $artistas=$consultaArtistas->filas();
        
        foreach ($artistas as $artista) {
            $arrayArtistas[] = $artista["nombre"];
        }
        
        $this->dibujaVista("food", [
            "filas"=> $filas,
            "provincias"=>$arrayProvincias,
            "artistas"=>$arrayArtistas,
            "sw"=>$sw,
            "form"=>$form,
            "cod_artista"=>$cod_artista],
         "food");
    }
    
    public function accionConsultar()
    {
        $res = new Restaurantes();
        
        $id = $_GET["id"];
        
        // obtengo totales y opciones de filtrado
        $fila = $res->buscarPorId($id);
        
        // Obtengo los datos del usuario que intenta acceder
        // (si es que hay alguno logueado)
        $sw = false;
        $codRole = 0;
        
        if(Sistema::app()->Acceso()->hayUsuario()){
            $sw = true;
            
            $nick = Sistema::app()->Acceso()->getNick();
            $codRole = Sistema::app()->ACL()->getUsuarioRole($nick);
            
        }
        
        // Si el usuario que intenta acceder es un restaurante, administrador
        // o simplemente no hay usuario validado, lo indico en la variable
        // $sw poniéndola a false. Los artistas tienen el rol 5
        if(!$sw || $codRole != 5){
            $sw = false;
            $cod_artista = -1;
            
            $sentencia = "SELECT a.nombre, a.cod_artista, ar.puntuacion, ar.plato_favorito, ar.resena ".
	                        "FROM artistas_restaurantes ar ".
    	                       "join artistas a using (cod_artista) ".
   	                        "where cod_restaurante = $id";
        }
        else{
            // Obtengo el código del artista
            $art = new Artistas();
            
            // El nick del usuario es el correo electrónico. Es un valor
            // único, por lo que puedo buscar al artista por
            // su dirección de correo
            if(!$art->buscarPor(["where"=>"correo='$nick'"])){
                
                Sistema::app()->paginaError(300,"Ha habido un problema al encontrar tu perfil.");
                return;
                
            }
            else{
                $cod_artista = $art->cod_artista;
                
                // Puntuaciones del restaurante excluyendo al artista validado
                $sentencia = "SELECT a.nombre, a.cod_artista, ar.puntuacion, ar.plato_favorito, ar.resena ".
                                "FROM artistas_restaurantes ar ".
                                    "join artistas a using (cod_artista) ".
                                "where cod_restaurante = $id and ".
                                "cod_artista != $cod_artista";
                
                // Puntuación del artista validado
                $sentenciaArtista = "SELECT a.nombre, a.cod_artista, ar.puntuacion, ar.plato_favorito, ar.resena ".
                    "FROM artistas_restaurantes ar ".
                    "join artistas a using (cod_artista) ".
                    "where cod_restaurante = $id and ".
                    "cod_artista = $cod_artista";
            }
        }
        
        
        
        // Actualizado es una variable para saber si se han realizado cambios
        $actualizado = false;
        $borrado = false;
        
        if($_POST){
            
            if(isset($_POST["borrar"])){
                
                $sentenciaBorrado = "DELETE from artistas_restaurantes ".
                                "where cod_artista = $cod_artista and ".
                                "cod_restaurante = $id";
                
                $resultadoBorrado=Sistema::app()->BD()->crearConsulta($sentenciaBorrado);
                if ($resultadoBorrado)
                {
                    $borrado = true;
                }
                
            }
            
            else{
            
                // En este punto, si el artista ha hecho click en el formulario de modificar
                // o añadir reseña, debo hacer las operaciones necesarias en la base de datos
                // para que la consulta que se ejecute luego esté actualizada.
                $arrayPuntuaciones = ["Muy malo"=>1,
                                      "Malo"=>2,
                                      "Ok"=>3,
                                      "Bueno"=>4,
                                      "Excelente"=>5];
                
                // Creo el objeto
                $resena = new Artistas_restaurantes();
                
                // Obtengo los datos necesarios para la reseña
                $arrayDatos = ["cod_artista"=>$cod_artista,
                               "cod_restaurante"=>$id,
                               "puntuacion"=>$arrayPuntuaciones[$_POST["puntuacion"]],
                               "plato_favorito"=>$_POST["platoFavorito"],
                               "resena"=>$_POST["resena"]
                ];
                
                if(isset($_POST["modificar"])){
                    
                    $sentencia2 = "SELECT cod_artista_restaurante ".
                        "FROM artistas_restaurantes ".
                        "where cod_restaurante = $id and ".
                        "cod_artista = $cod_artista";
                    
                    //Ejecuto la sentencia
                    $consulta2=Sistema::App()->BD()->crearConsulta($sentencia2);
                    
                    //Devuelvo las filas
                    $cod_artista_restaurante=$consulta2->filas();
                    
                    $resena->buscarPorId($cod_artista_restaurante[0]["cod_artista_restaurante"]);
                    
                    
                }
                
                else{
                    
                    $resena->cod_artista_restaurante = 1;
                    
                }
                
                $resena->setValores($arrayDatos);
                
                if($resena->validar()){
                    
                    if($resena->guardar()){
                        $actualizado = true;
                    }
                }
                
                
            }
        }
        
        //Ejecuto las sentencias
        $consulta=Sistema::App()->BD()->crearConsulta($sentencia);
        //Devuelvo las filas
        $puntuaciones=$consulta->filas();
        
        // Obtengo la media de puntuación de ese restaurante
        $sentenciaValMedia="SELECT ROUND(AVG(puntuacion),0) as puntuacion ".
            "from artistas_restaurantes ".
            "where cod_restaurante = $id ".
            "group by cod_restaurante";
        
        //ejecuto la sentencia
        $consultaValMedia=Sistema::App()->BD()->crearConsulta($sentenciaValMedia);
        
        //devuelvo la fila
        $valMedia=$consultaValMedia->filas();
        
        if($cod_artista != -1){
            $consultaArtista=Sistema::App()->BD()->crearConsulta($sentenciaArtista);
        
            $puntuacionArtista[0] = $consultaArtista->fila();
        }
        else{
            $puntuacionArtista = [];
        }
         $this->dibujaVista("consultar", array(
             "modelo" => $res,
             "cod_artista" => $cod_artista,
             "sw" => $sw,
             "actualizado"=>$actualizado,
             "borrado"=>$borrado,
             "puntuaciones" => $puntuaciones,
             "puntuacionArtista" =>$puntuacionArtista,
             "valMedia" => $valMedia
         ), $res->nombre);
    }

}