<?php
echo CHTML::scriptFichero("/javascript/almacenamiento.js", ["defer"=>""]);

echo CHTML::dibujaEtiqueta("h1",[],"Mapa del sitio");

?>

 <!-- Grid row -->
                <div class="row pl-5 pr-5 pt-3">
            
                
            
                  <!-- Grid column -->
                  <div class="col-12 col-md-4">
            
                    <!-- Links -->
                    <h5>PÁGINAS PRINCIPALES</h5>
            
                    <ul class="list-unstyled">
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["rock"]);?>">Artistas</a>
                      </li>
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["food"]);?>">Restaurantes</a>
                      </li>
                    </ul>
            
                  </div>
                  <!-- Grid column -->
            
                  <!-- Grid column -->
                  <div class="col-12 col-md-4">
            
                    <!-- Links -->
                    <h5>ACCESO Y OTROS</h5>
            
                    <ul class="list-unstyled">
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["acceso","login"]);?>">Login</a>
                      </li>
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["acceso", "logout"]);?>">Logout</a>
                      </li>
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["acceso","registro"]);?>">Registrarse</a>
                      </li>
                      <li>
                        <a class="enlacesFooter" style="color:black;" href="<?php echo Sistema::app()->generaURL(["mapa"]);?>">Mapa del sitio</a>
                      </li>
                    </ul>
            
                  </div>
                  <!-- Grid column -->
            
                </div>
                <!-- Grid row -->
            
              