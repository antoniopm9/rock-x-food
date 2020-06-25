<?php


class mapaControlador extends CControlador
{
    
    
    public function accionIndex(){
        
        $this->dibujaVista("mapa",[],"Mapa del sitio");
        
    }
    
}