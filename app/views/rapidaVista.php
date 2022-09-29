<!doctype html>
<html lang="es">
<head>
   <title>HO | Búsqueda rápida</title>
   <link rel="shortcut icon" href="<?php echo RUTA;?>img/RAHSA2.ico">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">

   <style media="screen">

   </style>
</head>
<body>
   <?php require_once 'templates/navbar.php'; ?>

   <!-- CONTENIDO DE LA PAGINA busquedaRapida -->
       <div class="wrapper d-flex align-items-stretch marginProductos">

          <!-- Page Content  -->
          <div id="content" class="p-4 p-md-5 pt-5">

             <h6>BÚSQUEDA <b>RÁPIDA <span class="text-dark text-uppercase"> - <?php echo $data['identificador']; ?> </span></b></h6>
             <section class="pt-5 pb-5 border-top">
                <div class="container">
                   <div class="row">
                       <div class="col-12 col-lg-12">
                           <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                               <div id="addCards" class="carousel-inner">
                                   <div class="carousel-item active">
                                       <div class="row">
                                            <?php foreach($data['productos'] as $producto): ?>
                                               <div class="col-md-4 col-sm-6 col-lg-4 mb-3">
                                                   <div class="card">
                                                     <?php if(file_exists('img/productos/'.$producto['codigo'].'.jpg')): ?>
                                                        <img class="img-fluid" alt="100%x280" height="25%" src="<?php echo RUTA; ?>img/productos/<?php echo $producto['codigo']?>.jpg">
                                                     <?php else: ?>
                                                        <img class="img-fluid" alt="100%x280" height="20%" src="<?php echo RUTA; ?>img/404.jpg">
                                                     <?php endif; ?>
                                                       <div class="card-body">
                                                           <p class="card-title"><span class="text-dark">Código: </span><?php echo $producto['codigo']; ?></p>
                                                           <ul>
                                                              <input type="hidden" name="grupo" value="que onda">
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

             <!-- ESTE ES EL PAGINADOR -->
             <div class="container">
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example">
                       <ul class="pagination">
                          <?php if($data['total_pages'] > 1): ?>
                             <?php if($data['page'] != 1 ): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/rapida/?claveB=<?php echo $data['identificador']; ?>&page=<?php echo ($data['page']-1);?>">Anterior</a></li>
                             <?php endif; ?>

                             <?php for($i = 1 ; $i<=$data['total_pages']; $i++): ?>
                                <?php if($data['page'] == $i): ?>
                                   <li class="page-item active"><a class="page-link" href="#"><?php echo $data['page']; ?></a></li>
                                <?php else:?>
                                   <?php if($i <=4): ?>
                                         <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/rapida/?claveB=<?php echo $data['identificador']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                   <?php endif; ?>
                                <?php endif; ?>
                             <?php endfor; ?>



                             <?php if($data['page'] != $data['total_pages']): ?>
                                <?php if($data['total_pages'] > 4): ?>
                                  <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/rapida/?claveB=<?php echo $data['identificador']; ?>&page=<?php echo $data['total_pages']; ?>"><?php echo $data['total_pages']; ?></a></li>
                               <?php endif; ?>
                                <li class="page-item"><a class="page-link" href="<?php echo RUTA; ?>producto/rapida/?claveB=<?php echo $data['identificador']; ?>&page=<?php echo ($data['page']+1) ?>">Siguiente</a></li>
                             <?php endif; ?>
                          <?php endif; ?>
                       </ul>
                    </nav>
                   </div>
             </div>
             <!-- fin del paginador -->
          </div>
       </div>
   <!-- page content end -->
</body>
<?php require_once 'templates/footer.php'; ?>
<?php require_once 'templates/scripts.php'; ?>

</html>
