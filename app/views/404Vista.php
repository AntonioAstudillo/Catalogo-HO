<!doctype html>
<html lang="es">
<head>
   <title>HO - Catálogo Frenos</title>
   <link rel="shortcut icon" href="<?php echo RUTA;?>img/RAHSA2.ico">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="robots" content="noindex">

   <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">

   <style media="screen">

   </style>
</head>
<body>
   <?php require_once 'templates/navbar.php'; ?>
   <div class="wrapper d-flex align-items-stretch marginProductos">
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
         <div class="container">
            <header class="top-header"></header>

            <!--dust particel-->
            <div>
               <div class="starsec"></div>
               <div class="starthird"></div>
               <div class="starfourth"></div>
               <div class="starfifth"></div>
            </div>
            <!--Dust particle end--->

            <div class="lamp__wrap">
               <div class="lamp">
                 <div class="cable"></div>
                 <div class="cover"></div>
                 <div class="in-cover">
                   <div class="bulb"></div>
                 </div>
                 <div class="light"></div>
               </div>
            </div>
            <!-- END Lamp -->
            <section class="error">
               <!-- Content -->
               <div class="error__content">
                 <div class="error__message message">
                   <h1 class="message__title">Sin Resultados</h1>
                   <p class="message__text">Lo sentimos, el producto que buscaba no se encuentra aquí.</p>
                 </div>
                 <div class="error__nav e-nav">
                   <a href="<?php echo RUTA; ?>"  class="e-nav__link"></a>
                 </div>
               </div>
               <!-- END Content -->

            </section>
         </div>

      </div>
   </div>
   <!-- page content end -->
</body>
<?php require_once 'templates/footer.php'; ?>
<?php require_once 'templates/scripts.php'; ?>

</html>
