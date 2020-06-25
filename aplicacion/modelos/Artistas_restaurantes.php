<?php

class Artistas_restaurantes extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'nombre';
    }

    protected function fijarTabla()
    {
        return "artistas_restaurantes";
    }

    protected function fijarId()
    {
        return "cod_artista_restaurante";
    }

    protected function fijarAtributos()
    {
        return array(
            "cod_artista_restaurante",
            "cod_artista",
            "cod_restaurante",
            "puntuacion",
            "plato_favorito",
            "resena"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "cod_artista_restaurante" => "Código valoración",
            "cod_artista" => "Código de artista",
            "cod_restaurante"=> "Código de restaurante",
            "puntuacion"=>"Puntuación",
            "plato_favorito" => "Plato favorito",
            "resena" => "Reseña"
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_artista_restaurante",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_artista_restaurante",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
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
                "ATRI" => "cod_restaurante",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "cod_restaurante",
                "TIPO" => "ENTERO",
                "MIN" => 0
            ),
            array(
                "ATRI" => "puntuacion",
                "TIPO" => "ENTERO",
                "MIN" => 1,
                "MAX" => 5
            ),
            array(
                "ATRI" => "plato_favorito",
                "TIPO" => "CADENA",
                "TAMANIO" => 30
            ),
            array(
                "ATRI" => "resena",
                "TIPO" => "CADENA",
                "TAMANIO" => 300
            )
        );
    }

    protected function afterCreate()
    {
        $this->cod_artista_restaurante = 1;
        $this->cod_artista = 1;
        $this->cod_restaurante = 1;
        $this->puntuacion = 1;
        $this->plato_favorito = "";
        $this->resena = "";
    }

    protected function fijarSentenciaInsert()
    {
        $cod_artista = $this->cod_artista;
        $cod_restaurante = $this->cod_restaurante;
        $puntuacion = $this->puntuacion;
        $plato_favorito = CGeneral::addSlashes($this->plato_favorito);
        $resena = CGeneral::addSlashes($this->resena);
        
        return "insert into artistas_restaurantes (" 
            . " cod_artista,cod_restaurante,puntuacion,plato_favorito,resena" .
        " ) values ( " . 
        " '$cod_artista','$cod_restaurante','$puntuacion','$plato_favorito', '$resena'" .
        "     )";
    }

    protected function fijarSentenciaUpdate()
    {
        $cod_artista = $this->cod_artista;
        $cod_restaurante = $this->cod_restaurante;
        $puntuacion = $this->puntuacion;
        $plato_favorito = CGeneral::addSlashes($this->plato_favorito);
        $resena = CGeneral::addSlashes($this->resena);

        return "update artistas_restaurantes set " . 
        " cod_artista='$cod_artista', " . 
        " cod_restaurante='$cod_restaurante', " . 
        " puntuacion='$puntuacion', " . 
        " plato_favorito='$plato_favorito', " . 
        " resena='$resena' " .  
        " where cod_artista_restaurante={$this->cod_artista_restaurante}";
    }
}
