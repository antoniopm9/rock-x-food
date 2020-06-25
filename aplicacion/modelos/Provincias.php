<?php

class Provincias extends CActiveRecord
{
    
    protected function fijarNombre()
    {
        return 'nombre';
    }
    
    protected function fijarTabla()
    {
        return "provincias";
    }
    
    protected function fijarId()
    {
        return "cod_provincia";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "cod_provincia",
            "nombre"
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "cod_provincia" => "Código",
            "nombre" => "Nombre",
        );
    }
    
    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_provincia",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_provincia",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
            array(
                "ATRI" => "nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            )
        );
    }
    
    protected function afterCreate()
    {
        $this->cod_provincia = 1;
        $this->nombre = "";
    }
    
    protected function fijarSentenciaInsert()
    {
        $nombre = CGeneral::addSlashes($this->nombre);
        
        return "insert into provincias (nombre) values ('$nombre')";
    }
    
    protected function fijarSentenciaUpdate()
    {
        $nombre = CGeneral::addSlashes($this->nombre);
       
        return "update provincias set " .
            " nombre='$nombre' " .
            "where cod_provincia={$this->cod_provincia}";
    }
    
}
