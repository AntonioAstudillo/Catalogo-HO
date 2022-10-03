<!doctype html>
<html lang="es">
<head>
   <title>HO | Catálogo Suspensión</title>
   <link rel="shortcut icon" href="<?php echo RUTA;?>img/RAHSA2.ico">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="robots" content="noindex">
   <meta name="description" content="Cátalogo HO frenos"/>
   <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
</head>
<body>
   <?php require_once 'templates/navbar.php'; ?>


   <div class="wrapper d-flex align-items-stretch marginProductos">

      <nav id="sidebar">
         <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
               <i class="fa fa-bars"></i>
               <span class="sr-only">Toggle Menu</span>
            </button>
         </div>
         <?php if($data['bandera'] !== false): ?>
            <div class="p-5 pt-2">
               <ul class="list-unstyled components mb-5">
                  <?php foreach ($data['familias'] as $familia ): ?>
                     <?php if($data['objeto']->comprobrarSubfamilias($familia['familia'])): ?>
                        <li class="">
                           <a href="#<?php echo "a" . ++$data['contador']; ?>" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle letraPequeña"><?php echo ($familia['familia']); ?></a>
                              <ul class="collapse show" id="<?php echo "a" . $data['contador'] ?>">
                                 <?php $subfamilias = $data['objeto']->getGrupoForFamilia($familia['familia']);  ?>
                                 <?php foreach ($subfamilias as $subfamilia): ?>
                                    <li>
                                       <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($subfamilia['grupo']);?>&page=0" class="letraPequeña"  ><?php echo ($subfamilia['grupo']); ?></a>
                                    </li>
                                 <?php endforeach; ?>
                              </ul>
                           </a>
                        </li>
                     <?php else:?>
                        <li>
                           <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($familia['familia']); ?>&page=0" class="letraPequeña"><?php echo ($familia['familia']); ?></a>
                        </li>

                     <?php endif; ?>
                 <?php endforeach;  ?>
              </ul>
            </div>
         <?php else: ?>
            <div class="p-5 pt-2">
               <!-- ul 1 -->
               <ul class="list-unstyled components mb-5">

                  <?php foreach ($data['familias'] as $familia ): ?>
                     <!-- li 1 -->
                     <li>

                           <?php if($data['objeto']->comprobrarSubfamilias($familia['familia'])): ?>
                                 <a href="#<?php echo "a" . ++$data['contador']; ?>" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle letraPequeña"><?php echo ($familia['familia']); ?></a>
                                 <ul class="collapse show" id="<?php echo "a" . $data['contador']; ?>">
                              <?php $subfamilias = $data['objeto']->getGrupoForFamilia(($familia['familia']));  ?>

                              <?php foreach ($subfamilias as $subfamilia): ?>

                                 <li>
                                    <?php if($data['grupo'] === $subfamilia['grupo']): ?>
                                       <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($subfamilia['grupo']);?>&page=0" class="letraPequeña selecionadoColor"  ><?php echo ($subfamilia['grupo']); ?></a>

                                    <?php else: ?>

                                       <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($subfamilia['grupo']);?>&page=0" class="letraPequeña"><?php echo ($subfamilia['grupo']); ?></a>

                                    <?php endif; ?>

                                 </li>

                              <?php endforeach; ?>

                              </ul> <!-- cerramos ul de subfamilias -->

                           <?php else:?>

                              <?php if($data['grupo'] == $familia['familia']   ): ?>
                                 <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($familia['familia']); ?>&page=0" class="letraPequeña selecionadoColor"><?php echo ($familia['familia']); ?></a>
                              <?php else: ?>
                                 <a href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo ($familia['familia']); ?>&page=0" class="letraPequeña"><?php echo ($familia['familia']); ?></a>
                              <?php endif; ?>

                           <?php endif; ?>
                        </li>
                 <?php endforeach;  ?>
              </ul>
            </div>
         <?php endif; ?>
      </nav>


      <!-- Page Content  -->
   <div id="content" class="p-4 p-md-5 pt-5">
      <?php if(isset($data['grupo'])): ?>
         <h6>CÁTALOGO SUSPENSIÓN  <?php echo isset($data['familia'][0]) ? '-' . $data['familia'][0] : ''; ?>  - <b> <span class="text-uppercase"> <?php echo $data['grupo']; ?> </span></b)></h6>
      <?php else: ?>
         <h6>CÁTALOGO SUSPENSIÓN - <b>SUSPENSIÓN <span class="text-dark text-uppercase">  </span></b></h6>
      <?php endif; ?>
   <section class="pt-5 pb-5 border-top">
      <div class="container">
         <div class="row">
             <div class="col-12">
                 <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                     <div id="addCards" class="carousel-inner">
                         <div class="carousel-item active">
                             <div class="row">
                                <?php foreach($data['productos'] as $producto): ?>
                                   <div class="col-md-4 col-sm-6 col-lg-4 mb-3">
                                       <div class="card">
                                           <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                              <img class="img-fluid" alt="100%x280" height="25%" src="<?php echo RUTA; ?>img/productos/<?php echo $producto['codigo'];?>.jpg">
                                           <?php else: ?>
                                              <img class="img-fluid" alt="100%x280" height="20%" src="<?php echo RUTA; ?>img/404.jpg">
                                           <?php endif; ?>
                                           <div class="card-body">
                                               <p class="card-title"><span class="text-dark">Código: </span><?php echo $producto['codigo']; ?></p>
                                               <ul>
                                                 <li class="text-center"><button  value="<?php echo $producto['codigo']; ?>"  type="button" class="btn btn-primary botonCatalogos text-center botonDet" name="button">Detalles</button></li>
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
      <?php if($data['paginador']): ?>
         <!-- ESTE ES EL PAGINADOR -->
         <div class="container">
        <div class="d-flex justify-content-center mt-4">
             <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php if($data['total_pages'] > 1): ?>
                      <?php if($data['page'] != 1 ): ?>
                         <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo $data['grupo']; ?>&page=<?php echo ($data['page']-1);?>">Anterior</a></li>
                      <?php endif; ?>

                      <?php for($i = 1 ; $i<=$data['total_pages']; $i++): ?>
                         <?php if($data['page'] == $i): ?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $data['page']; ?></a></li>
                         <?php else:?>
                            <?php if($i <=4): ?>
                                  <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo $data['grupo']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endif; ?>
                         <?php endif; ?>
                      <?php endfor; ?>



                      <?php if($data['page'] != $data['total_pages']): ?>
                         <?php if($data['total_pages'] > 4): ?>
                           <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo $data['grupo']; ?>&page=<?php echo $data['total_pages']; ?>"><?php echo $data['total_pages']; ?></a></li>
                        <?php endif; ?>
                         <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?grupo=<?php echo $data['grupo']; ?>&page=<?php echo ($data['page']+1) ?>">Siguiente</a></li>
                      <?php endif; ?>
                  <?php endif; ?>
                </ul>
             </nav>
           </div></div>
      <?php else: ?>
         <!-- ESTE ES EL PAGINADOR -->
         <div class="container">
        <div class="d-flex justify-content-center mt-4">
             <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php if($data['total_pages'] > 1): ?>
                      <?php if($data['page'] != 1 ): ?>
                         <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?page=<?php echo ($data['page']-1);?>">Anterior</a></li>
                      <?php endif; ?>

                      <?php for($i = 1 ; $i<=$data['total_pages']; $i++): ?>
                         <?php if($data['page'] == $i): ?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $data['page']; ?></a></li>
                         <?php else:?>
                            <?php if($i <=4): ?>
                                  <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php endif; ?>
                         <?php endif; ?>
                      <?php endfor; ?>



                      <?php if($data['page'] != $data['total_pages']): ?>
                         <?php if($data['total_pages'] > 4): ?>
                           <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?page=<?php echo $data['total_pages']; ?>"><?php echo $data['total_pages']; ?></a></li>
                        <?php endif; ?>
                         <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/suspension/?page=<?php echo ($data['page']+1) ?>">Siguiente</a></li>
                      <?php endif; ?>
                  <?php endif; ?>
                </ul>
             </nav>
           </div></div>
      <?php endif; ?>
      <!-- fin del paginador -->
   </section>

      </div>
      <!-- page content end -->

   </div>


   </body>
<?php require_once 'templates/footer.php'; ?>
<?php require_once 'templates/scripts.php'; ?>

</html>
