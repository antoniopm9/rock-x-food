<?php

class crudArtistasControlador extends CControlador
{

    public function accionIndex()
    {
        // Si el usuario no tiene permisos para acceder a esta página,
        // no le dejo entrar
        if(!Sistema::app()->Acceso()->puedeConfigurar()||
            !Sistema::app()->Acceso()->puedeAcceder()){
            Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
            exit();
        }
        
        $art = new Artistas();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "anio_inicio desc";

        $datos = [
            "nombre" => "",
            "genero" => "",
            "bor" => - 1
        ];

        $fil = [];
        if (isset($_REQUEST["nombre"])) {
            $nombre = $_REQUEST["nombre"];
            if ($nombre != "") {
                $datos["nombre"] = $nombre;
                $fil["nombre"] = $nombre;

                $nombre = CGeneral::addSlashes($nombre);
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                $sentWhere .= "nombre like '%$nombre%'";
            }
        }
        if (isset($_REQUEST["genero"])) {
            $genero = $_REQUEST["genero"];
            if ($genero != "") {
                $datos["genero"] = $genero;
                $fil["genero"] = $genero;

                if ($sentWhere != "")
                    $sentWhere .= " and ";
                $sentWhere .= "genero like '%$genero%'";
            }
        }

        if (isset($_REQUEST["bor"])) {
            $bor = trim($_REQUEST["bor"]);

            if ($bor == 'S' || $bor == 'N') {
                $datos["bor"] = $bor;
                $fil["bor"] = $bor;

                if ($sentWhere != "")
                    $sentWhere .= " and ";
                if ($bor == 'S')
                    $sentWhere .= "borrado=1";
                else
                    $sentWhere .= "borrado=0";
            }
        }

        // obtengo totales y opciones de filtrado
        $filas = $art->buscarTodos([
            "select" => "count(*) as n_filas",
            "where" => $sentWhere
        ]);

        $sentencia = "select count(*) as n_filas" . "     from artistas";
        if ($sentWhere != "")
            $sentencia .= "    where $sentWhere";

        $resultado = Sistema::app()->BD()->crearConsulta($sentencia);
        if ($resultado->error()) {
            Sistema::app()->paginaError(300, "Error en el acceso a datos");
            exit();
        }

        $filas = $resultado->filas();

        $total = $filas[0]["n_filas"];
        $pagina = 1;
        if (isset($_REQUEST["pag"]))
            $pagina = intval($_REQUEST["pag"]);

        $regPagina = 5;
        if (isset($_REQUEST["reg_pag"]))
            $regPagina = intval($_REQUEST["reg_pag"]);
        if ($regPagina <= 0)
            $regPagina = 10;

        $paginas = ceil($total * 1.0 / $regPagina);

        if ($pagina < 1)
            $pagina = 1;

        if ($pagina > $paginas)
            $pagina = 1;

        $sentLimit = "" . (($pagina - 1) * $regPagina) . ",$regPagina";

        $filas = $art->buscarTodos([
            "where" => $sentWhere,
            "order" => $sentOrder,
            "limit" => $sentLimit
        ]);

        foreach ($filas as $clave => $valor) {

            $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
            $filas[$clave]["musica"] = "<a class='enlaces' href='".$filas[$clave]["musica"]."'>".
            mb_substr($filas[$clave]["musica"], 0, 20)."...</a>";
            $filas[$clave]["imagen"] = CHTML::dibujaEtiqueta("img",[
                                    "src"=>"/imagenes/artistas/".$filas[$clave]["imagen"],
                                    "alt"=>$filas[$clave]["nombre"],
                                    "width"=>"50px"
                                        ]);
            
            
            // botones
            $cadena = CHTML::link(CHTML::imagen("/imagenes/24x24/ver.png", "Ver"), Sistema::app()->generaURL(array(
                "crudArtistas",
                "consultar"
            ), array(
                "id" => $filas[$clave]["cod_artista"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png', "Modificar"), Sistema::app()->generaURL(array(
                "crudArtistas",
                "modificar"
            ), array(
                "id" => $filas[$clave]["cod_artista"]
            )));
            $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png', "Borrar"), Sistema::app()->generaURL(array(
                "crudArtistas",
                "borrar"
            ), array(
                "id" => $filas[$clave]["cod_artista"]
            )), array(
                "onclick" => "return confirm('¿Está seguro de borrar el artista?');"
            ));
            $filas[$clave]["opciones"] = $cadena;
        }
        // definiciones de las cabeceras de las
        // columnas para el CGrid
        $cabecera = array(
            array(
                "ETIQUETA" => "NOMBRE",
                "CAMPO" => "nombre"
            ),/*
            array(
                "ETIQUETA" => "CORREO",
                "CAMPO" => "correo"
            ),
            array(
                "ETIQUETA" => "GÉNERO",
                "CAMPO" => "genero"
            ),
            array(
                "ETIQUETA" => "AÑO INICIO",
                "CAMPO" => "anio_inicio"
            ),
            array(
                "ETIQUETA" => "PROVINCIA",
                "CAMPO" => "provincia"
            ),
            array(
                "ETIQUETA" => "MUNICIPIO",
                "CAMPO" => "municipio"
            ),
            array(
                "ETIQUETA" => "MÚSICA",
                "CAMPO" => "musica"
            ),
            array(
                "ETIQUETA" => "IMAGEN",
                "CAMPO" => "imagen"
            ), */
            array(
                "ETIQUETA" => "BORRADO",
                "CAMPO" => "borrado_texto"
            ),
            array(
                "CAMPO" => "opciones",
                "ETIQUETA" => " operaciones"
            )
            
        );

        $urlPaginador = Sistema::app()->generaURL([
            "crudArtistas",
            "index"
        ], $fil);

        $opcPaginador = array(
            "URL" => $urlPaginador,
            "TOTAL_REGISTROS" => $total,
            "PAGINA_ACTUAL" => $pagina,
            "REGISTROS_PAGINA" => $regPagina,
            "TAMANIOS_PAGINA" => array(
                5 => "5",
                10 => "10",
                20 => "20",
                30 => "30",
                40 => "40",
                50 => "50"
            ),
            "MOSTRAR_TAMANIOS" => true,
            "PAGINAS_MOSTRADAS" => 5
        );
        $this->dibujaVista("index", [
            "dat" => $datos,
            "filas" => $filas,
            "cabe" => $cabecera,
            "opcPag" => $opcPaginador
        ], "Lista de artistas");
    }

    public function accionNuevo()
    {
        // Si el usuario no tiene permisos para acceder a esta página,
        // no le dejo entrar
        if(!Sistema::app()->Acceso()->puedeConfigurar()||
            !Sistema::app()->Acceso()->puedeAcceder()){
                Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
                exit();
        }
        
        $art =new Artistas();
        
        $nombre=$art->getNombre();
        if (isset($_POST[$nombre]))
        {
            $art->setValores($_POST[$nombre]);
            $art->cod_artista=1;
            
            if ($art->validar())
            {
                // Sentencia auxiliar para insertar un usuario.
                // Dado que hay una relación de clave foránea entre
                // acl_usuarios y Artistas necesito crear un
                // usuario nuevo que tendrá de contraseña el nombre
                
                Sistema::app()->ACL()->anadirUsuario($_POST["nombre"]["nombre"],
                    $_POST["nombre"]["correo"],
                    $_POST["nombre"]["nombre"], 5);
                
                if ($art->guardar())
                {
                    Sistema::app()->irAPagina(["crudArtistas","consultar"],
                        ["id"=>$art->cod_artista]);
                    return;
                }
            }
        }
        
        $this->dibujaVista("nuevo", [
            "art" => $art
        ], "Nuevo artista");
    }
    
    public function accionConsultar()
    {
        // Si el usuario no tiene permisos para acceder a esta página,
        // no le dejo entrar
        if(!Sistema::app()->Acceso()->puedeConfigurar()||
            !Sistema::app()->Acceso()->puedeAcceder()){
                Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
                exit();
        }
        
        $art =new Artistas();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$art->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El artista no se ha encontrado");
            return;
        }
        
        $this->dibujaVista("consultar", [
            "art" => $art
        ], "Consultar artista");
    }
    
    public function accionModificar()
    {
        // Si el usuario no tiene permisos para acceder a esta página,
        // no le dejo entrar
        if(!Sistema::app()->Acceso()->puedeConfigurar()||
            !Sistema::app()->Acceso()->puedeAcceder()){
                Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
                exit();
        }
        
        $art =new Artistas();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$art->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El artista no se ha encontrado");
            return;
        }
        
        $nombre=$art->getNombre();
        if (isset($_POST[$nombre]))
        {
            $art->setValores($_POST[$nombre]);
            
            if ($art->validar())
            {
                if ($art->guardar())
                {
                    // Además de actualizar el artista, debo actualizar el usuario
                    // asociado a ese artista
                    // Si el artista está borrado, el usuario también
                    if($art->borrado == "1"){
                        $sw = true;
                    }
                    else{
                        $sw = false;
                    }
                    
                    Sistema::app()->ACL()->setBorrado($art->correo, $sw);
                    Sistema::app()->irAPagina(["crudArtistas","consultar"],
                                                ["id"=>$art->cod_artista]);
                    return;
                }
            }
        }
        
        $this->dibujaVista("modificar", [
            "art" => $art
        ], "Modificar artista");
    }
    
    public function accionBorrar()
    {
        // Si el usuario no tiene permisos para acceder a esta página,
        // no le dejo entrar
        if(!Sistema::app()->Acceso()->puedeConfigurar()||
            !Sistema::app()->Acceso()->puedeAcceder()){
                Sistema::app()->paginaError(403, "No tiene permiso para acceder a esta página.");
                exit();
        }
        
        $art =new Artistas();
        
        $id=-1;
        if (isset($_REQUEST["id"]))
        {
            $id=intval($_REQUEST["id"]);
        }
        
        if (!$art->buscarPorId($id))
        {
            Sistema::app()->paginaError(300,"El artista no se ha encontrado");
            return;
        }
        
        
        if (isset($_POST["borrar"]))
        {
            // Pongo el borrado a 1 en la tabla de usuarios
            Sistema::app()->ACL()->setBorrado($art->correo, true);
            
            $sentencia="update artistas set borrado=1 ".
                        "    where cod_artista=".$art->cod_artista;
            $resultado=Sistema::app()->BD()->crearConsulta($sentencia);
            if ($resultado)
            {
                Sistema::app()->irAPagina(["crudArtistas","consultar"],
                    ["id"=>$art->cod_artista]);
                return;
            }
        }
        
        $this->dibujaVista("borrar", [
            "art" => $art
        ], "Borrar artista");
    }
    
    public function accionExportar(){
        
        $art = new Artistas();
        // opciones de filtrado
        $sentWhere = "";
        $sentOrder = "cod_artista asc";
        
        // Recojo los datos del filtrado para exportar
        // solo lo que el usuario ve en ese momento
        $datos = [
            "nombre" => "",
            "genero" => "",
            "bor" => - 1
        ];
        
        $fil = [];
        if (isset($_REQUEST["nombre"])) {
            $nombre = $_REQUEST["nombre"];
            if ($nombre != "") {
                $datos["nombre"] = $nombre;
                $fil["nombre"] = $nombre;
                
                $nombre = CGeneral::addSlashes($nombre);
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    $sentWhere .= "nombre like '%$nombre%'";
            }
        }
        if (isset($_REQUEST["genero"])) {
            $genero = $_REQUEST["genero"];
            if ($genero != "") {
                $datos["genero"] = $genero;
                $fil["genero"] = $genero;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    $sentWhere .= "genero like '%$genero%'";
            }
        }
        
        if (isset($_REQUEST["bor"])) {
            $bor = trim($_REQUEST["bor"]);
            
            if ($bor == 'S' || $bor == 'N') {
                $datos["bor"] = $bor;
                $fil["bor"] = $bor;
                
                if ($sentWhere != "")
                    $sentWhere .= " and ";
                    if ($bor == 'S')
                        $sentWhere .= "borrado=1";
                        else
                            $sentWhere .= "borrado=0";
            }
        }
        
        
            $filas = $art->buscarTodos([
                "where" => $sentWhere,
                "order" => $sentOrder
            ]);
            
            $resultadoCodificado = json_encode($filas, JSON_UNESCAPED_UNICODE);
        
            $this->dibujaVistaParcial("exportar", [
                "resultado" => $resultadoCodificado
            ], false);
            
    }
    
}

	
	