<?php


class accesoControlador extends CControlador
{
    
    
    public function accionRegistro(){
        
        
        $this->dibujaVista("registro", [], "Registro");
        
    }
    
    public function accionValidaregistro(){
        
        // Obtengo los datos que son comunes tanto al artista como al restaurante
        $_POST["nombre"]["nombre"] = $_POST["nombreReg"];
        $_POST["nombre"]["correo"] = $_POST["correo"];
        $_POST["nombre"]["contra"] = $_POST["contra"];
        $_POST["nombre"]["provincia"] = $_POST["provincia"];
        $_POST["nombre"]["municipio"] = $_POST["municipio"];
        
        // Obtenemos el nombre de la imagen, que es el
        // nombre del archivo que ha subido
        $_POST["nombre"]["imagen"] = $_FILES["imagen"]["name"];
        
        // El borrado es igual a 0 porque acaba de crear la cuenta
        $_POST["nombre"]["borrado"] = 0;
        
        // Si el radio button indica que es un artista, procedemos a la
        // verificación y registro del mismo
        if($_POST["radioButton"]=="artista"){
            // Obtengo los datos relacionados con el artista
            $_POST["nombre"]["genero"] = $_POST["genero"];
            $_POST["nombre"]["anio_inicio"] = $_POST["anio"];
            $_POST["nombre"]["musica"] = $_POST["musica"];
            
            // Obtengo la carpeta destino de la imagen
            $carpetaDestino = $_SERVER['DOCUMENT_ROOT']."/imagenes/artistas/";
        
            $art =new Artistas();
            
            $nombre=$art->getNombre();
            if (isset($_POST[$nombre]))
            {
                $art->setValores($_POST[$nombre]);
                $art->cod_artista=1;
                
                // Si el artista es válido, procedo a guardarlo
                if ($art->validar())
                {
                    // Sentencia auxiliar para insertar un usuario.
                    // Cada artista tiene un usuario asociado con su correo
                    // electrónico.
                    
                    Sistema::app()->ACL()->anadirUsuario($_POST["nombre"]["nombre"],
                        $_POST["nombre"]["correo"],
                        $_POST["nombre"]["contra"], 5);
                    
                    // Si el registro no se completa de manera correcta, le mando
                    // a la página de error
                    if (!$art->guardar())
                    {
                        Sistema::app()->paginaError(400, "No hemos podido completar el registro. Por favor, inténtalo de nuevo.");
                        exit();
                    }
                }
            }
        
        }
        // REGISTRO PARA RESTAURANTE
        else{
            
            // Obtengo los datos relacionados con el restaurante
            $_POST["nombre"]["direccion"] = $_POST["direccion"];
            $_POST["nombre"]["descripcion"] = $_POST["descripcion"];
            $_POST["nombre"]["precio"] = $_POST["precio"];
            $_POST["nombre"]["grado_vegetariano"] = $_POST["grado_vegetariano"];
            $_POST["nombre"]["grado_vegano"] = $_POST["grado_vegano"];
            $_POST["nombre"]["ambiente"] = $_POST["ambiente"];
            if(isset($_POST["autovia_cerca"])){
                $_POST["nombre"]["autovia_cerca"] = true;
            }
            else{
                $_POST["nombre"]["autovia_cerca"] = false;
            }
            
            
            
            // Obtengo la carpeta destino de la imagen
            $carpetaDestino = $_SERVER['DOCUMENT_ROOT']."/imagenes/restaurantes/";
            
            $res =new Restaurantes();
            
            $nombre=$res->getNombre();
            if (isset($_POST[$nombre]))
            {
                $res->setValores($_POST[$nombre]);
                $res->cod_restaurante=1;
                
                // Si el restaurante es válido, procedo a guardarlo
                if ($res->validar())
                {
                    // Sentencia auxiliar para insertar un usuario.
                    // Cada restaurante tiene un usuario asociado con su correo
                    // electrónico.
                    
                    Sistema::app()->ACL()->anadirUsuario($_POST["nombre"]["nombre"],
                        $_POST["nombre"]["correo"],
                        $_POST["nombre"]["contra"], 6);
                    
                    // Si el registro no se completa de manera correcta, le mando
                    // a la página de error
                    if (!$res->guardar())
                    {
                        Sistema::app()->paginaError(400, "No hemos podido completar el registro. Por favor, inténtalo de nuevo.");
                        exit();
                    }
                }
            }
            
            
        }
        
        // La imagen se encuentra en una carpeta temporal. Una vez completado el registro,
        // muevo la imagen a la carpeta correspondiente
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaDestino.$_POST["nombre"]["imagen"]);
        
        // Si se ha registrado con éxito, inicio sesión con ese
        // usuario
        $log=new Login();
        
        $_POST["log"]["nick"] = $_POST["correo"];
        $_POST["log"]["contrasenia"] = $_POST["contra"];
       
        $log->setValores($_POST["log"]);
        
        if ($log->validar()){
            Sistema::app()->Acceso()->registrarUsuario(
                $log->nick,
                $log->nombre,
                $log->puedeAcceder,
                $log->puedeConfigurar,
                $log->otrosPermisos);
        }
        
        // Dibujo una vista para indicar al usuario que el registro ha
        // sido un éxito
        $this->dibujaVista("validaregistro", [], "Registro");
    }
    
    public function accionLogin(){
        
        
        $log=new Login();
        
        $nombre=$log->getNombre();
        if (isset($_POST[$nombre]))
        {
            $log->setValores($_POST[$nombre]);
            
            if ($log->validar())
            {
                Sistema::app()->Acceso()->registrarUsuario(
                    $log->nick,
                    $log->nombre,
                    $log->puedeAcceder,
                    $log->puedeConfigurar,
                    $log->otrosPermisos);
                
                Sistema::app()->irAPagina([],[]);
                return;
            }
            else {
                $log->contrasenia="";
            }
        }
        
        $this->dibujaVista("login",["log"=>$log],"Pagina de login");
        
        
    }
    
    public function accionLogout(){
        
        Sistema::app()->Acceso()->quitarRegistroUsuario();
        Sistema::app()->irAPagina(["acceso", "login"]);
        return;
        
    }
    
    
    
}