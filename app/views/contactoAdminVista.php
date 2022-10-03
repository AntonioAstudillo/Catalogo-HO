<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="robots" content="noindex">

    <title>HOAutopartes | Contacto</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTA;?>js/libs/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="<?php echo RUTA;?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo RUTA;?>js/libs/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo RUTA;?>css/estilosAdmin.css">
</head>

<body id="page-top">

   <!-- Page Wrapper -->
<div id="wrapper">

<?php require_once 'templates/sidebar.php'; ?>

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php require_once 'templates/navbarAdmin.php'; ?>

           <!-- Begin Page Content -->
           <div class="container-fluid">

               <!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Compras</h1>
               </div>
               <!-- Begin Page Content -->
               <div class="container-fluid">

                   <!-- DataTales Example -->
                   <div class="card shadow mb-4">
                       <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-bordered" id="tableContacto" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>Id</th>
                                           <th>Correo</th>
                                           <th>Nombre</th>
                                           <th>Teléfono</th>
                                           <th>Fecha</th>
                                           <th>Mensaje</th>
                                       </tr>
                                   </thead>
                                   <tbody class="text-dark"></tbody>
                              </table>
                           </div>
                       </div>
                   </div>

               </div>
               <!-- /.container-fluid -->
           </div>
           <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php //require_once 'modalDiametros.php'; ?>
      <?php  require_once 'templates/footerAdmin.php';?>


   </div>
   <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


    <div id="modalVista" class="modal fade bd-example-modal-lg p-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Contacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
              <div class="container">
                <form>
                  <div class="row mt-4">
                    <div class="col-12 col-md-12">
                      <label for="mensajeModal">Mensaje</label>
                      <textarea readonly class="form-control" id="mensajeModal" rows="8"></textarea>
                    </div>
                  </div>
                </form>
              </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
    </div>
    </div>
    <?php require_once 'templates/botonScroll.php'; ?>
   <?php require_once 'templates/scriptsAdmin.php'; ?>

   <script src="<?php echo RUTA; ?>js/contacto.js" type="module"></script>


</body>

</html>
