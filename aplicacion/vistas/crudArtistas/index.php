<?php 

echo CHTML::dibujaEtiqueta("h1", [], "Lista de artistas");

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],null, false).



"<br>";


    
    
    //dibujo el formulario de filtrado
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-sm-10 col-md-7 col-lg-4 col-xl-2"],null, false);
    
        echo CHTML::dibujaEtiqueta("fieldset",[],
                                CHTML::dibujaEtiqueta("legend",[],"Opciones de filtrado"),
                                false);
        echo CHTML::iniciarForm("","post",[]);
        echo CHTML::campoLabel("Nombre: ", "nombre").
            CHTML::campoText("nombre",$dat["nombre"],["class"=>"form-control","maxlength"=>30]).
            "<br>".PHP_EOL;
        echo CHTML::campoLabel("Género: ", "genero").
            CHTML::campoText("genero",$dat["genero"],["class"=>"form-control","maxlength"=>20]).
            "<br>".PHP_EOL;
        
        echo CHTML::campoLabel("Borrado: ", "bor").
             CHTML::campoListaDropDown("bor",$dat["bor"],
                                        ["S"=>"Borrado",
                                            "N"=>"Sin borrar"
                                        ],
                 ["linea"=>"","class"=>"form-control"]).
            "<br>".PHP_EOL;
                 echo CHTML::campoBotonSubmit("Filtrar",["class"=>"btn btn-danger"]);
        echo CHTML::finalizarForm();
        echo CHTML::dibujaEtiquetaCierre("fieldset");
        echo "<br><br>";
    
        
        echo CHTML::link(CHTML::imagen('/imagenes/24x24/nuevo.png').
            "nuevo",["crudArtistas","nuevo"],["class"=>"btn btn-danger"]).
             "<br><br>".PHP_EOL;
        
        $enlace = Sistema::app()->generaURL(["crudArtistas","exportar"], $dat);
        
        echo CHTML::link(CHTML::imagen('/imagenes/24x24/exportcsv.png').
            "Exportar",$enlace,["class"=>"btn btn-danger"]).
            "<br><br>".PHP_EOL;
        
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div",
            ["class"=>"col-12 col-sm-12 col-md-12 col-lg-12 col-xl-10"],null, false);
    
        $this->textoHead=CPager::requisitos();
    
        $tabla=new CGrid($cabe,$filas,
                        ["class"=>"tabla1"]);
        
        $pagi=new CPager($opcPag,array());
        
        
        //dibujo el paginador
        echo $pagi->dibujate();
        
        //se dibuja la tabla
        echo $tabla->dibujate();
    
        //dibujo el paginador
        echo $pagi->dibujate();
        
    echo CHTML::dibujaEtiquetaCierre("div");
    
    
    
echo CHTML::dibujaEtiquetaCierre("div");