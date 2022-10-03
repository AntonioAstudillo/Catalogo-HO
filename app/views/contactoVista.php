<!doctype html>
<html lang="es">
  <head>
  	<title>HO - Contacto</title>
     <link rel="shortcut icon" href="<?php echo RUTA; ?>img/RAHSA2.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
	  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!---Ponemos clave publica de recaptcha v3 -->
     <script src="https://www.google.com/recaptcha/api.js?render="></script>
	</head>

  <style media="screen">
  #contatti
  {
     background-color: #797D81;
     letter-spacing: 2px;
  }

  #contatti a{
     color: #fff;
     text-decoration: none;
   }


   @media (max-width: 575.98px)
   {

     #contatti{padding-bottom: 800px;}
     #contatti .maps iframe{
        width: 100%;
       height: 450px;
     }
   }


   @media (min-width: 576px)
   {

     #contatti{padding-bottom: 800px;}

     #contatti .maps iframe{
        width: 100%;
        height: 450px;
     }
   }

   @media (min-width: 768px)
   {

     #contatti{padding-bottom: 350px;}

     #contatti .maps iframe
     {
       width: 100%;
       height: 850px;
     }
   }

   @media (min-width: 992px)
   {
     #contatti{padding-bottom: 200px;}

     #contatti .maps iframe{
       width: 100%;
       height: 700px;
     }
   }


   #author a
   {
     color: #fff;
     text-decoration: none;

   }

   #loading
   {
      display: inline-block;
      width: 50px;
      height: 50px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: blue;
      animation: spin 1s ease-in-out infinite;
      -webkit-animation: spin 1s ease-in-out infinite;
      z-index: -1;
  }

  @keyframes spin
  {
     to { -webkit-transform: rotate(360deg); }
  }

  @-webkit-keyframes spin {
     to { -webkit-transform: rotate(360deg); }
  }

  .grecaptcha-badge
  {
     width: 70px !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    left: 4px !important;
 }

.grecaptcha-badge:hover {
   width: 256px !important;
 }
  </style>
	<body>
    <?php require_once 'templates/navbar.php'; ?>

    <div class="row mt-5" id="contatti">
<div class="container mt-5" >


    <div class="row" style="height:550px;">
      <div class="col-md-6 maps" >
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.2939665687704!2d-103.33783848467164!3d20.657616005719632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b222808b977b%3A0xf4909e22a3370177!2sRAHSA!5e0!3m2!1ses!2smx!4v1655936326833!5m2!1ses!2smx" frameborder="0" style="border:0;" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-capitalize mt-3 font-weight-bold text-white">Contáctanos</h2>
        <form id="formContacto" action="">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="nombreContact" type="text" class="form-control mt-2 p-3" placeholder="Nombre" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="apellidoContact" type="text" class="form-control mt-2 p-3" placeholder="Apellidos" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="correoContact" type="email" class="form-control mt-2 p-3" placeholder="Correo" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input id="telefonoContact" type="number" class="form-control mt-2 p-3" placeholder="Teléfono" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea id="mensajeContact" class="form-control ancho" id="exampleFormControlTextarea1" placeholder="Mensaje" rows="4" cols="4" required></textarea>
                </div>
              </div>
              <div class="col-12">
                <button id="btnContacto" class=" btn btn-primary text-center" type="button">Enviar</button>
                <div id="loading" class="invisible d-none"></div>
              </div>
            </div>
        </form>
        <div class="text-white">
        <h2 class="text-capitalize  text-white mt-4 font-weight-bold">Ubicación </h2>

        <i class="fa fa-phone" aria-hidden="true"></i><a href="tel:+">(+52) 33 36 19 00 61</a><br>
        <i class="fa fa-envelope mt-3 "></i> <a href="">ventas@hoautopartes.mx</a><br>
        <i class=""></i> <span class="text-white"> Calz. del Ejército 1282</span> <br>
        <i class=""></i> <span class="text-white"> Quinta Velarde, 44430 Guadalajara, Jal.</span> <br>
        </div>
      </div>
      </div>

    </div>
</div>
</div>



<?php require_once 'templates/footer.php'; ?>
<?php require_once 'templates/scripts.php'; ?>
</body>
</html>
