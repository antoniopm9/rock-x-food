<?php

class Artistas extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'nombre';
    }

    protected function fijarTabla()
    {
        return "artistas";
    }

    protected function fijarId()
    {
        return "cod_artista";
    }

    protected function fijarAtributos()
    {
        return array(
            "cod_artista",
            "nombre",
            "correo",
            "genero",
            "anio_inicio",
            "provincia",
            "municipio",
            "musica",
            "imagen",
            "borrado"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "cod_artista" => "Código",
            "nombre" => "Nombre",
            "correo"=> "Correo",
            "genero"=>"Género",
            "anio_inicio" => "Banda activa desde el año",
            "provincia" => "Provincia",
            "municipio" => "Municipio",
            "musica" => "Música",
            "imagen" => "Imagen",
            "borrado" => "Borrado"
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_artista",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_artista",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "correo",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "genero",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "anio_inicio",
                "TIPO" => "ENTERO",
                "MIN" => 1950
            ),
            array(
                "ATRI" => "provincia",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "municipio",
                "TIPO" => "CADENA",
                "TAMANIO" => 40
            ),
            array(
                "ATRI" => "musica",
                "TIPO" => "CADENA",
                "TAMANIO" => 100
            ),
            array(
                "ATRI" => "imagen",
                "TIPO" => "CADENA",
                "TAMANIO" => 50
            ),
            array(
                "ATRI" => "borrado",
                "TIPO" => "ENTERO",
                "MIN" => 0,
                "MAX" => 1
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_artista = 1;
        $this->nombre = "";
        $this->correo = "";
        $this->genero = "";
        $this->anio_inicio = 1950;
        $this->provincia = "";
        $this->municipio = "";
        $this->musica = "";
        $this->imagen = "";
        $this->borrado = false;
    }

    public static function listaPara($para = null)
    {
        $paras = [
            "Administrador" => "Administrador",
            "Usuario" => "Usuario",
            "Indiferente" => "Indiferente"
        ];
        if ($para == null)
            return $paras;

        if (isset($paras[$para]))
            return $paras[$para];
        else
            return false;
    }

    //protected function afterBuscar(){}

    protected function fijarSentenciaInsert()
    {
        $nombre = CGeneral::addSlashes($this->nombre);
        $correo = CGeneral::addSlashes($this->correo);
        $genero = CGeneral::addSlashes($this->genero);
        $anio_inicio = $this->anio_inicio;
        $provincia = CGeneral::addSlashes($this->provincia);
        $municipio = CGeneral::addSlashes($this->municipio);
        $musica = CGeneral::addSlashes($this->musica);
        $imagen = CGeneral::addSlashes($this->imagen);
        $borrado = $this->borrado;
        
        return "insert into artistas (" 
            . " nombre,correo,genero,anio_inicio, provincia, municipio, musica, imagen," . 
        " borrado" . 
        " ) values ( " . 
        " '$nombre','$correo','$genero',$anio_inicio, '$provincia', '$municipio', '$musica', '$imagen'," . 
        ($borrado ? "1" : "0") . 
        "     )";
    }

    protected function fijarSentenciaUpdate()
    {
        $nombre = CGeneral::addSlashes($this->nombre);
        $correo = CGeneral::addSlashes($this->correo);
        $genero = CGeneral::addSlashes($this->genero);
        $anio_inicio = $this->anio_inicio;
        $provincia = CGeneral::addSlashes($this->provincia);
        $municipio = CGeneral::addSlashes($this->municipio);
        $musica = CGeneral::addSlashes($this->musica);
        $imagen = CGeneral::addSlashes($this->imagen);
        $borrado = $this->borrado;

        return "update artistas set " . 
        " nombre='$nombre', " . 
        " correo='$correo', " . 
        " genero='$genero', " . 
        " anio_inicio=$anio_inicio, " . 
        " provincia='$provincia', " . 
        " municipio='$municipio', " . " musica='$musica', " . 
        " imagen='$imagen', " . " borrado= " . 
        ($borrado ? "1" : "0") . 
        "     where cod_artista={$this->cod_artista}";
    }
}
