

<div class="container text-center my-3">
  <div class="row mx-auto my-auto">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <div class="d-flex flex-row">
                <?php for ($i=0; $i <=5 ; $i++): ?>
                  <div class="col-lg-3 col-md-12 col-sm-12 col-12 p-0">
                     <p class="caja"><a href="<?php echo RUTA;?>producto/catalogos/?grupo=<?php echo $data['familias'][$i]['familia']; ?>"><?php echo substr($data['familias'][$i]['familia'],0,35 ); ?></a>  </p>
                  </div>
                <?php endfor; ?>
                </div>
              </div>
              <?php while($data['contador']<$data['tam']): ?>
                <div class="carousel-item">
                  <div class="d-flex flex-row">
                    <?php for($i = 0; $i<=5; $i++): ?>
                      <div class="col-lg-3 col-md-12 col-sm-12 col-12 p-0">
                          <p class="caja"><a href="<?php echo RUTA;?>producto/catalogos/?grupo=<?php echo $data['familias'][$data['contador']]['familia']; ?>"><?php echo substr($data['familias'][$data['contador']]['familia'],0,35 ); ?></a>  </p>
                      </div>
                      <?php $data['contador']++; ?>
                    <?php endfor; ?>
                   </div>
                </div>
             <?php endwhile;?>
             <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                  <span class="anterior" aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                  <span class="sr-only ">Anterior</span>
             </a>
             <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
              <span class="anterior" aria-hidden="true"><i class="fa fa-angle-right"></i></span>
               <span class="sr-only ">Siguiente</span>
             </a>
          </div>
      </div>
  </div>
</div>
