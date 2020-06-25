<?php
echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

  ?>
  	<div class="col-12">
        <div class="info-template">
            <h1>
                ¡Genial!
            </h1>
            <div class="info-details">
                <?php echo "El registro se ha realizado correctamente";?>
            </div>
            <div class="info-actions">
                <a href="<?php echo Sistema::app()->generaURL(["inicial", "index"])?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                    Volver a la página principal
                 </a>
                   
            </div>
        </div>
    </div>
  




