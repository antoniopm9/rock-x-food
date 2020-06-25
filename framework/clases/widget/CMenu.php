<?php


	class CMenu extends CWidget
	{
		private $_opciones=array();
		private $_atributosHTML=array();
		
		public function __construct($opciones,$atributosHTML=array())
		{
			
			$this->_opciones=array("NOMBRE_PAG"=>"NOMBRE_PAG",
									"URL_SECCIONES"=>array("Opción 1"=>"#","Opción 2"=>"#"),
									"TITULO_DERECHA"=>"Opción 3",
									"URL_DERECHA"=>"#");
			
			
			
			
			//valido los datos que me pasen		
			if (isset($opciones["URL_SECCIONES"]) &&
			    is_array($opciones["URL_SECCIONES"]))
			{
			    $this->_opciones["URL_SECCIONES"]=$opciones["URL_SECCIONES"];
			    
			}
			
			if (isset($opciones["NOMBRE_PAG"]) &&
					is_string($opciones["NOMBRE_PAG"]))
				 $this->_opciones["NOMBRE_PAG"]=$opciones["NOMBRE_PAG"];
					
    		if (isset($opciones["TITULO_DERECHA"]) &&
    		     is_string($opciones["TITULO_DERECHA"]))
    		     $this->_opciones["TITULO_DERECHA"]=$opciones["TITULO_DERECHA"];
    		 
		    if (isset($opciones["URL_DERECHA"]) &&
		         is_string($opciones["URL_DERECHA"]))
		         $this->_opciones["URL_DERECHA"]=$opciones["URL_DERECHA"];
    	
					
			
		}
		
		public static function requisitos(){}
		
		public function dibujate()
		{
			return $this->dibujaApertura().$this->dibujaFin();
		}
		
		public function dibujaApertura()
		{
			ob_start();

			echo CHTML::dibujaEtiqueta("nav",["class"=>"navbar navbar-expand-lg col-12 navbar-light"],"",false);
			
    			// Etiqueta del título de la página
    		      echo CHTML::dibujaEtiqueta("a", [
    		          "class"=>"navbar-brand pl-4 titulo",
    		          "style"=>"color: #4A3715;",
    		          "href"=>Sistema::app()->generaURL([])
    		      ], $this->_opciones["NOMBRE_PAG"]) ; 
    			
    		    // Botón que se mostrará cuando la página tenga un tamaño pequeño
    		    echo CHTML::dibujaEtiqueta("button", [
    		        "class"=>"navbar-toggler",
    		        "type"=>"button",
    		        "data-toggle"=>"collapse",
    		        "data-target"=>"#navbarSupportedContent",
    		        "aria-controls"=>"navbarSupportedContent",
    		        "aria-expanded"=>"false",
    		        "aria-label"=>"Toggle navigation"
    		    ],"", false);
    		    
    		    echo CHTML::dibujaEtiqueta("span",["class"=>"navbar-toggler-icon"]);
    		    
    		    echo CHTML::dibujaEtiquetaCierre("button");
    		    
    		    // Las opciones disponibles
    		    echo CHTML::dibujaEtiqueta("div",[
    		        "class"=>"collapse navbar-collapse pl-4",
    		        "id"=>"navbarSupportedContent"
    		    ],"",false);
    		    
        		    echo CHTML::dibujaEtiqueta("ul",[
        		        "class"=>"navbar-nav mr-auto"
        		    ],"",false);
        		    
        		    
        		    foreach ($this->_opciones["URL_SECCIONES"] as $titulo =>$enlace) {
        		        
        		        echo CHTML::dibujaEtiqueta("li",["class"=>"nav-item active"],"",false);
        		        
        		          echo CHTML::dibujaEtiqueta("a",[
        		              "class"=>"nav-link",
        		              "href"=>$enlace
        		          ],
        		          $titulo);
        		        
        		        echo CHTML::dibujaEtiquetaCierre("li");
        		    }
        		    echo CHTML::dibujaEtiquetaCierre("ul");
    		    
    		    
        		    // La opción de la derecha
        		    echo CHTML::dibujaEtiqueta("div",[
        		        "class"=>"cmy-2 my-lg-0"],"",false);
            		    
            		    echo CHTML::dibujaEtiqueta("ul",[
            		        "class"=>"navbar-nav mr-auto"
            		    ],"",false);
            		    
            		    
                		    echo CHTML::dibujaEtiqueta("li",["class"=>"nav-item active"],"",false);
                		    
                    		    echo CHTML::dibujaEtiqueta("a",[
                    		        "class"=>"nav-link",
                    		        "href"=>$this->_opciones["URL_DERECHA"]
                    		    ],
                    		        $this->_opciones["TITULO_DERECHA"]);
                		    
                		    echo CHTML::dibujaEtiquetaCierre("li");
            		    
            		    echo CHTML::dibujaEtiquetaCierre("ul");
            		    
            		    
        		    echo CHTML::dibujaEtiquetaCierre("div");
        		    
    		    echo CHTML::dibujaEtiquetaCierre("div");
    		    
    		   
    			
			echo CHTML::dibujaEtiquetaCierre("nav");			
						
			$escrito=ob_get_contents();
			ob_end_clean();
			
			return $escrito;		
		}
				
		public function dibujaFin()
		{
			return "";
		}
		
	}
