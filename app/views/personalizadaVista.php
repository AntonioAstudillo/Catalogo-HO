<!doctype html>
<html lang="es">
<head>
   <title>HO | Búsqueda Personalizada</title>
   <link rel="shortcut icon" href="<?php echo RUTA;?>img/RAHSA2.ico">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/datatables.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/responsive.datatable.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/jqueryDatatable.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
</head>
<body>
   <?php require_once 'templates/navbar.php'; ?>
   <div class="wrapper d-flex align-items-stretch marginProductos">
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
         <h6>BÚSQUEDA <b>PERSONALIZADA <span class="text-dark text-uppercase"> - <?php echo $data['marca'] . ' - ' . $data['submarca'];  ?> </span></b></h6>
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
                                          <?php if(file_exists('img/productos/'.$producto['producto'].'.jpg')): ?>
                                             <img class="img-fluid" alt="100%x280" height="25%" src="<?php echo RUTA; ?>img/productos/<?php echo $producto['producto']?>.jpg">
                                          <?php else: ?>
                                             <img class="img-fluid" alt="100%x280" height="20%" src="<?php echo RUTA; ?>img/404.jpg">
                                          <?php endif; ?>
                                          <div class="card-body">
                                             <p class="card-title"><span class="text-dark">Código: </span><?php echo $producto['producto']; ?></p>
                                                <ul>
                                                   <li class="text-center">
                                                      <button  value="<?php echo $producto['producto']; ?>"  type="button" class="btn btn-primary text-center botonCatalogos botonDet" name="button">Detalles</button>
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
         </div>
   </div>
   <!-- page content end -->
</body>
<?php require_once 'templates/footer.php'; ?>
<?php require_once 'templates/scripts.php'; ?>


</html>
