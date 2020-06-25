<?php

class Restaurantes extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'nombre';
    }

    protected function fijarTabla()
    {
        return "restaurantes";
    }

    protected function fijarId()
    {
        return "cod_restaurante";
    }

    protected function fijarAtributos()
    {
        return array(
            "cod_restaurante",
            "nombre",
            "correo",
            "descripcion",
            "precio",
            "direccion",
            "provincia",
            "municipio",
            "grado_vegetariano",
            "grado_vegano",
            "ambiente",
            "autovia_cerca",
            "imagen",
            "borrado"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "cod_restaurante" => "Código",
            "nombre" => "Nombre",
            "correo"=> "Correo",
            "descripcion"=>"Descripción",
            "precio" => "Precio",
            "direccion" => "Direccion",
            "provincia" => "Provincia",
            "municipio" => "Municipio",
            "grado_vegetariano" => "Oferta vegetariana",
            "grado_vegano" => "Oferta vegana",
            "ambiente"=>"Ambiente",
            "autovia_cerca"=>"Cerca de la autovía",
            "imagen"=>"Imagen",
            "borrado" => "Borrado"
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_restaurante",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_restaurante",
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
                "ATRI" => "descripcion",
                "TIPO" => "CADENA",
                "TAMANIO" => 500
            ),
            array(
                "ATRI" => "precio",
                "TIPO" => "ENTERO",
                "MIN" => 1
            ),
            array(
                "ATRI" => "direccion",
                "TIPO" => "CADENA",
                "TAMANIO" => 50
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
                "ATRI" => "grado_vegetariano",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
            array(
                "ATRI" => "grado_vegano",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
            array(
                "ATRI" => "ambiente",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "autovia_cerca",
                "TIPO" => "ENTERO",
                "MIN" => 0,
                "MAX" => 1
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
        $this->cod_restaurante = 1;
        $this->nombre = "";
        $this->correo = "";
        $this->descripcion = "";
        $this->precio = 1;
        $this->direccion = "";
        $this->provincia = "";
        $this->municipio = "";
        $this->grado_vegetariano = 0;
        $this->grado_vegano = 0;
        $this->ambiente = "";
        $this->autovia_cerca = false;
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
        $descripcion = CGeneral::addSlashes($this->descripcion);
        $precio = $this->precio;
        $direccion = CGeneral::addSlashes($this->direccion);
        $provincia = CGeneral::addSlashes($this->provincia);
        $municipio = CGeneral::addSlashes($this->municipio);
        $grado_vegetariano = $this->grado_vegetariano;
        $grado_vegano = $this->grado_vegano;
        $ambiente = CGeneral::addSlashes($this->ambiente);
        $autovia_cerca = $this->autovia_cerca;
        $imagen = CGeneral::addSlashes($this->imagen);
        $borrado = $this->borrado;

        return "insert into restaurantes (" 
            . " nombre,correo,descripcion,precio, direccion, provincia, municipio, grado_vegetariano," . 
        " grado_vegano, ambiente, autovia_cerca, imagen, borrado" . 
        " ) values ( " . 
        " '$nombre','$correo','$descripcion','$precio', '$direccion', '$provincia', '$municipio', '$grado_vegetariano', ".
        "'$grado_vegano','$ambiente', ".($autovia_cerca ? "1" : "0") . ",'$imagen',".
        ($borrado ? "1" : "0") . 
        "     )";
    }

    protected function fijarSentenciaUpdate()
    {
        $nombre = CGeneral::addSlashes($this->nombre);
        $correo = CGeneral::addSlashes($this->correo);
        $descripcion = CGeneral::addSlashes($this->descripcion);
        $precio = $this->precio;
        $direccion = CGeneral::addSlashes($this->direccion);
        $provincia = CGeneral::addSlashes($this->provincia);
        $municipio = CGeneral::addSlashes($this->municipio);
        $grado_vegetariano = $this->grado_vegetariano;
        $grado_vegano = $this->grado_vegano;
        $ambiente = CGeneral::addSlashes($this->ambiente);
        $autovia_cerca = $this->autovia_cerca;
        $imagen = CGeneral::addSlashes($this->imagen);
        $borrado = $this->borrado;

        return "update restaurantes set " . 
        " nombre='$nombre', " . 
        " correo='$correo', " . 
        " descripcion='$descripcion', " . 
        " precio=$precio, " . 
        "direccion='$direccion', " .
        "provincia='$provincia', " . 
        " municipio='$municipio', " . " grado_vegetariano='$grado_vegetariano', " . 
        " grado_vegano='$grado_vegano', ambiente='$ambiente', " . 
        " autovia_cerca=".($autovia_cerca?"1":"0").", imagen='$imagen',".
        " borrado= " . 
        ($borrado ? "1" : "0") . 
        "     where cod_restaurante={$this->cod_restaurante}";
    }
}
