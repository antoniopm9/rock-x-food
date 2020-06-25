<?php

class perfilControlador extends CControlador
{
    
    public function accionPerfilArtista(){
        
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
        // o simplemente no hay usuario validado, lo mando a una página de
        // error. Los artistas tienen el rol 5
        if(!$sw || $codRole != 5){
                Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
                exit();
        }
        
        // Una vez comprobado que está accediendo un artista, procedo a
        // obtener los datos del artista
        $art = new Artistas();
        
        // El nick del usuario es el correo electrónico. Es un valor
        // único, por lo que puedo buscar al artista por
        // su dirección de correo
        if(!$art->buscarPor(["where"=>"correo='$nick'"])){
            
            Sistema::app()->paginaError(300,"Ha habido un problema al encontrar tu perfil.");
            return;
            
        }
        
        $imagenAntigua = $art->imagen;
        $nombre=$art->getNombre();
        
        // Si se modifican los datos del artista, esta variable
        // pasará a true para notificar a la vista
        $artistaModificado = false;
        if (isset($_POST[$nombre]))
        {
            $hayImagen = true;
            // Si ha subido una nueva imagen, recojo su nombre
            if($_FILES["nombre"]["name"]["imagen"]!=""){
                $_POST["nombre"]["imagen"] = $_FILES["nombre"]["name"]["imagen"];
            }
            else{
                $hayImagen = false;
                $_POST["nombre"]["imagen"] = $art->imagen;
            }
            // El coreo es una clave foránea, así que tengo
            // que cambiar el correo en la tabla ACLUsuarios
            Sistema::app()->ACL()->setNick($nick, $_POST["nombre"]["correo"]);
            
            $art->setValores($_POST[$nombre]);
            
            if ($art->validar())
            {
                // Si se ha guardado correctamente, actualizo la imagen de perfil
                // e inicio sesión con el nuevo correo automáticamente
                if ($art->guardar()){
                    $artistaModificado = true;
                    if($hayImagen){
                        // Obtengo la carpeta destino de la imagen
                        $carpetaDestino = $_SERVER['DOCUMENT_ROOT']."/imagenes/artistas/";
                        // Elimino la imagen antigua
                        unlink($carpetaDestino.$imagenAntigua);
                        
                        // Y guardo la nueva
                        move_uploaded_file($_FILES['nombre']['tmp_name']['imagen'], $carpetaDestino.$_POST["nombre"]["imagen"]);
                    }
                    Sistema::app()->Acceso()->registrarUsuario(
                        $_POST["nombre"]["correo"],
                        mb_strtolower($art->nombre),
                        0,
                        0,
                        [1,1,1,1,1,0,0,0,0,0]);
                }
                
            }
        }
        
        $this->dibujaVista("perfilArtista",
            ["art"=>$art, "artistaModificado"=>$artistaModificado],
            "Perfil");
        
    }
    
    public function accionPerfilRestaurante(){
        
        // Obtengo los datos del usuario que intenta acceder
        // (si es que hay alguno logueado)
        $sw = false;
        $codRole = 0;
        
        if(Sistema::app()->Acceso()->hayUsuario()){
            $sw = true;
            
            $nick = Sistema::app()->Acceso()->getNick();
            $codRole = Sistema::app()->ACL()->getUsuarioRole($nick);
            
        }
        
        // Si el usuario que intenta acceder es un artista, administrador
        // o simplemente no hay usuario validado, lo mando a una página de
        // error. Los restaurantes tienen el rol 6
        if(!$sw || $codRole != 6){
            Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
            exit();
        }
        
        // Una vez comprobado que está accediendo un restaurante, procedo a
        // obtener los datos del restaurante
        $res = new Restaurantes();
        
        // El nick del usuario es el correo electrónico. Es un valor
        // único, por lo que puedo buscar el restaurante por
        // su dirección de correo
        if(!$res->buscarPor(["where"=>"correo='$nick'"])){
            
            Sistema::app()->paginaError(300,"Ha habido un problema al encontrar tu perfil.");
            return;
            
        }
        
        $imagenAntigua = $res->imagen;
        $nombre=$res->getNombre();
        
        // Si se modifican los datos del restaurante, esta variable
        // pasará a true para notificar a la vista
        $resModificado = false;
        if (isset($_POST[$nombre]))
        {
            $hayImagen = true;
            // Si ha subido una nueva imagen, recojo su nombre
            if($_FILES[$nombre]["name"]["imagen"]!=""){
                $_POST[$nombre]["imagen"] = $_FILES[$nombre]["name"]["imagen"];
            }
            else{
                $hayImagen = false;
                $_POST["nombre"]["imagen"] = $res->imagen;
            }
           
            // El coreo es una clave foránea, así que tengo
            // que cambiar el correo en la tabla ACLUsuarios
            Sistema::app()->ACL()->setNick($nick, $_POST["nombre"]["correo"]);
            
            $res->setValores($_POST[$nombre]);
            
            if ($res->validar())
            {
                // Si se ha guardado correctamente, actualizo la imagen de perfil
                // e inicio sesión con el nuevo correo automáticamente
                if ($res->guardar()){
                    $resModificado = true;
                    if($hayImagen){
                        // Obtengo la carpeta destino de la imagen
                        $carpetaDestino = $_SERVER['DOCUMENT_ROOT']."/imagenes/restaurantes/";
                        // Elimino la imagen antigua
                        unlink($carpetaDestino.$imagenAntigua);
                        
                        // Y guardo la nueva
                        move_uploaded_file($_FILES['nombre']['tmp_name']['imagen'], $carpetaDestino.$_POST["nombre"]["imagen"]);
                    }
                    Sistema::app()->Acceso()->registrarUsuario(
                        $_POST["nombre"]["correo"],
                        mb_strtolower($res->nombre),
                        0,
                        0,
                        [0,0,0,0,0,1,1,1,1,1]);
                }
                
            }
        }
        
        $this->dibujaVista("perfilRestaurante",
            ["res"=>$res, "resModificado"=>$resModificado],
            "Perfil");
        
    }
    
}