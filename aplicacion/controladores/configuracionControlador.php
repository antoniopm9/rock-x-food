<?php


class configuracionControlador extends CControlador
{
    
    
    public function accionIndex(){
        
        
        
        $this->dibujaVista("configuracion", [], "Configuración");
        
    }
    
    public function accionApodo(){
        
        $apodo = "";
        
        if (isset($_POST["apodo"])){
            
            $apodo = $_POST["apodo"];
            
            // Si el usuario ha escrito un apodo lo almaceno
            // en la sesión
            if($apodo!=""){
                $_SESSION["apodo"] = $apodo;
            }
            
            
        }
        
        $this->dibujaVista("apodo",["apodo"=>$apodo],"Elegir apodo");
        
        
    }
    
    
    
    
}