

<!-- CARROUSEL DE CARDS -->
<main class="pt-5 pb-5">
    <div class=" d-flex justify-content-center mb-5">
      <div class="">
        <a class="btn btn-primary  mt-5 mr-3" href="#carouselExampleIndicators2" role="button" data-slide="prev">
           <i class="fa fa-arrow-left"></i>
       </a>
      </div>

      <div class="">
          <h2>PRODUCTOS DESTACADOS</h2>
      </div>

      <div class="">
        <a id="btnNext" class="btn btn-primary  mt-5 ml-3" href="#carouselExampleIndicators2" role="button" data-slide="next">
           <i class="fa fa-arrow-right"></i>
        </a>
      </div>



   </div>
   <div class="container">
       <div class="row">
           <div class="col-6">
               <h3 class="mb-3"></h3>
           </div>

     <!-- CON PHP VAMOS A GENERAR ESTE SEGMENTO DE CODIGO -->
     <!-- AQUI COMIENZA EL CODIGO DE LOS CARDS DE PRODUCTOS -->
       <div class="col-12">
           <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
               <div id="addCards" class="carousel-inner">
                   <div class="carousel-item active">
                       <div class="row">
                          <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                          <?php foreach($productos as $producto): ?>
                             <div class="col-md-3 col-sm-6 mb-3">
                                 <div class="card">
                                     <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                        <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                     <?php else: ?>
                                        <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                     <?php endif; ?>
                                     <div class="card-body">
                                         <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                         <ul>
                                           <li class="text-center">
                                              <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                          <?php endforeach; ?>
                       </div>

                       <div class="row">
                          <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                          <?php foreach($productos as $producto): ?>
                             <div class="col-md-3 col-sm-6 mb-3">
                                 <div class="card">
                                     <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')):?>
                                        <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                     <?php else: ?>
                                        <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                     <?php endif; ?>
                                     <div class="card-body">
                                         <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                         <ul>
                                           <li class="text-center">
                                              <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                          <?php endforeach; ?>
                       </div>
                   </div>
                   <div class="carousel-item">
                     <div class="row">
                        <?php $productos = $data['objProducto']->obtenerDestacados(); ?>
                        <?php foreach($productos as $producto): ?>
                           <div class="col-md-3 col-sm-6 mb-3">
                               <div class="card">
                                   <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                      <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                   <?php else: ?>
                                      <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                   <?php endif; ?>
                                   <div class="card-body">
                                       <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                       <ul>
                                         <li class="text-center">
                                            <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                        <?php endforeach; ?>
                     </div>

                     <div class="row">
                        <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                        <?php foreach($productos as $producto): ?>
                           <div class="col-md-3 col-sm-6 mb-3">
                               <div class="card">
                                   <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                      <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                   <?php else: ?>
                                      <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                   <?php endif; ?>
                                   <div class="card-body">
                                       <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                       <ul>
                                         <li class="text-center">
                                            <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                        <?php endforeach; ?>
                     </div>
                 </div>
                 <div class="carousel-item">
                   <div class="row">
                      <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                      <?php foreach($productos as $producto): ?>
                         <div class="col-md-3 col-sm-6 mb-3">
                             <div class="card">
                                 <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                    <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                 <?php else: ?>
                                    <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                 <?php endif; ?>
                                 <div class="card-body">
                                     <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                     <ul>
                                       <li class="text-center">
                                          <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                      <?php endforeach; ?>
                   </div>

                   <div class="row">
                      <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                      <?php foreach($productos as $producto): ?>
                         <div class="col-md-3 col-sm-6 mb-3">
                             <div class="card">
                                 <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                    <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                 <?php else: ?>
                                    <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                 <?php endif; ?>
                                 <div class="card-body">
                                     <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                     <ul>
                                       <li class="text-center">
                                          <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                      <?php endforeach; ?>
                   </div>
                  </div>
                  <div class="carousel-item">
                    <div class="row">
                       <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                       <?php foreach($productos as $producto): ?>
                          <div class="col-md-3 col-sm-6 mb-3">
                              <div class="card">
                                  <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                     <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                  <?php else: ?>
                                     <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                  <?php endif; ?>
                                  <div class="card-body">
                                      <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                      <ul>
                                        <li class="text-center">
                                           <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                       <?php endforeach; ?>
                    </div>

                    <div class="row">
                       <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                       <?php foreach($productos as $producto): ?>
                          <div class="col-md-3 col-sm-6 mb-3">
                              <div class="card">
                                  <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                     <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                  <?php else: ?>
                                     <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                  <?php endif; ?>
                                  <div class="card-body">
                                      <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                      <ul>
                                        <li class="text-center">
                                           <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                       <?php endforeach; ?>
                    </div>
                   </div>
                   <div class="carousel-item">
                     <div class="row">
                        <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                        <?php foreach($productos as $producto): ?>
                           <div class="col-md-3 col-sm-6 mb-3">
                               <div class="card">
                                   <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                      <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                   <?php else: ?>
                                      <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                   <?php endif; ?>
                                   <div class="card-body">
                                       <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                       <ul>
                                         <li class="text-center">
                                            <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                        <?php endforeach; ?>
                     </div>

                     <div class="row">
                        <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                        <?php foreach($productos as $producto): ?>
                           <div class="col-md-3 col-sm-6 mb-3">
                               <div class="card">
                                   <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                      <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                   <?php else: ?>
                                      <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                   <?php endif; ?>
                                   <div class="card-body">
                                       <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                       <ul>
                                         <li class="text-center">
                                            <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                        <?php endforeach; ?>
                     </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row">
                         <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                         <?php foreach($productos as $producto): ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card">
                                    <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                       <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                    <?php else: ?>
                                       <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                        <ul>
                                          <li class="text-center">
                                             <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                      </div>

                      <div class="row">
                         <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                         <?php foreach($productos as $producto): ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card">
                                    <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                       <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                    <?php else: ?>
                                       <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                        <ul>
                                          <li class="text-center">
                                             <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row">
                         <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                         <?php foreach($productos as $producto): ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card">
                                    <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                       <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                    <?php else: ?>
                                       <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                        <ul>
                                          <li class="text-center">
                                             <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                      </div>

                      <div class="row">
                         <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                         <?php foreach($productos as $producto): ?>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card">
                                    <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                       <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                    <?php else: ?>
                                       <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                        <ul>
                                          <li class="text-center">
                                             <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                      </div>

                     </div>
                     <div class="carousel-item">
                       <div class="row">
                          <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                          <?php foreach($productos as $producto): ?>
                             <div class="col-md-3 col-sm-6 mb-3">
                                 <div class="card">
                                     <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                       <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                     <?php else: ?>
                                        <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                     <?php endif; ?>
                                     <div class="card-body">
                                         <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                         <ul>
                                           <li class="text-center">
                                              <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                          <?php endforeach; ?>
                       </div>

                       <div class="row">
                          <?php $productos = $data['objProducto']->obtenerDestacados();  ?>
                          <?php foreach($productos as $producto): ?>
                             <div class="col-md-3 col-sm-6 mb-3">
                                 <div class="card">
                                     <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                        <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA . "img/productos/".$producto['codigo'].".jpg";?>">
                                     <?php else: ?>
                                        <img class="imgLogo" alt="100%x280" height="40%" src="<?php echo RUTA; ?>img/404.jpg">
                                     <?php endif; ?>
                                     <div class="card-body">
                                         <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo']; ?></span></p>
                                         <ul>
                                           <li class="text-center">
                                              <button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary text-center botonCarousel botonDet" name="button">Detalles</button>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                          <?php endforeach; ?>
                       </div>
                  </div>
               </div>
           </div>
       </div>
     </div>
   </div>
</main>
