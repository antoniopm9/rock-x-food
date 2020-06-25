<?php


class apiControlador extends CControlador
{
    
    
    public function accionProvincias(){
        
        $prov = new Provincias();
        
        if($_SERVER["REQUEST_METHOD"] == "GET"){
        
            
            // Obtengo todas las provincias
            $filas = $prov->buscarTodos();
            
            header("Content-type: application/json");
            
            echo json_encode($filas, JSON_UNESCAPED_UNICODE);
        
        
        }
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if (isset($_POST["vieja"]) && isset($_POST["nueva"]))
            {
                $id = intval($_POST["vieja"]);
                $arrayValores ["nombre"] = $_POST["nueva"];
                
                if(!$prov->buscarPorId($id)){
                    Sistema::app()->paginaError(300,"La provincia no se ha encontrado");
                    return;
                }
                
                $prov->setValores($arrayValores);
                
                
                if ($prov->validar())
                {
                    $prov->guardar();
                    
                    
                }
                
            }
            
        }
        
        if($_SERVER["REQUEST_METHOD"] == "PUT"){
            
            if (isset($_POST["provincia"]))
            {
                $arrayValores ["nombre"] = $_POST["provincia"];
                
                
                $prov->setValores($arrayValores);
                
                
                if ($prov->validar())
                {
                    $prov->guardar();
                    
                    
                }
                
            }
            
        }
    }
    
    // Acción que busca todos los municipios de una provincia determinada
    // en el catastro
    public function accionMunicipios(){
        
        $nombreProvincia = $_POST["provincia"];
        
        LibreriaMetodos::dameMunicipios($nombreProvincia);
        
    }
    
    public function accionPut(){
        
        if(isset($_POST["provinciaAInsertar"])){
            
            if($_POST["provinciaAInsertar"]!=""){
                
                LibreriaMetodos::anadeProvincia($_POST["provinciaAInsertar"]);
                
            }
            
        }
        
        $this->dibujaVista("accionPut",[],"Acción PUT");
        
    }
    
    public function accionPost(){
        
        if(isset($_POST["nuevoNombre"]) && isset($_POST["provincia"])){
            
            // Compruebo que se ha escogido provincia y que se ha
            // escrito el nuevo nombre de la provincia
            if($_POST["provincia"]!="" && $_POST["nuevoNombre"]!=""){
                
                LibreriaMetodos::modificaProvincia($_POST["provincia"], $_POST["nuevoNombre"]);
                
            }
            
        }
        
        $this->dibujaVista("post",[],"Acción POST");
        
    }
    
}