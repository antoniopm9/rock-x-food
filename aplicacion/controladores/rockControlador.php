<?php


class rockControlador extends CControlador
{

    public function __construct()
    {
        $this->accionDefecto="index";
    }
    
    public function accionIndex(){
        
        $art = new Artistas();
        
        // Obtengo todos los artistas que NO
        // están borrados (borrado=0)
        $filas = $art->buscarTodos([
            "where"=> "borrado=0"
            
        ]);
        
        // Obtengo el número de restaurantes en los que ha comido cada artista
        $sentencia = "select COUNT(cod_restaurante) as contador, cod_artista ".
	                   "from artistas_restaurantes ".
                       "group by cod_artista";
        
        $consulta = Sistema::app()->BD()->crearConsulta($sentencia);
        
        $contador = $consulta->filas();
        
        foreach ($filas as $clave=>$artista) {
            
            foreach ($contador as $cont) {
                
                if($artista["cod_artista"] == $cont["cod_artista"]){
                    
                    $filas[$clave]["contador"] = $cont["contador"];
                }
            }
            
        }
        
        $this->dibujaVista("rock", ["filas"=> $filas], "rock");
    }
    
    public function accionConsultar()
    {
        $art = new Artistas();
        
        $id = $_GET["id"];
        
        // obtengo totales y opciones de filtrado
        $fila = $art->buscarPorId($id);
        
        $sentencia = "SELECT r.nombre, r.cod_restaurante, r.municipio, ar.puntuacion, ar.plato_favorito, ar.resena ".
            "FROM artistas_restaurantes ar ".
            "join restaurantes r using (cod_restaurante) ".
            "where cod_artista = $id";
        
        //Ejecuto la sentencia
        $consulta=Sistema::App()->BD()->crearConsulta($sentencia);
        
        //Devuelvo las filas
        $puntuaciones=$consulta->filas();
        
         $this->dibujaVista("consultar", array(
             "modelo" => $art,
             "puntuaciones"=>$puntuaciones
         ), $art->nombre);
    }

}