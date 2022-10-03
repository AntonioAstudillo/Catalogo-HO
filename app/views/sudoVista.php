 <!DOCTYPE html>
 <html lang="es">

 <head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <meta name="robots" content="noindex">

     <title>HOAutopartes | Administradores</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 id="agregarProducto" class="m-0 font-weight-bold text-primary">Agregar Producto</h6> -->
                            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#modalRegistroProducto">Agregar Usuario</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataSudo" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Password</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Opciones</th>
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

        <div class="modal fade" id="modalRegistroProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="container">
          <form id="formRegistroUser" class="">
             <div id="divProductGeneral">
                <div class="row">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="nombreA">Nombre</label>
                     <input type="text" class="form-control" id="nombreA" name="nombreA" placeholder="Ingresa nombre">
                   </div>
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-6">
                   <div class="form-group">
                     <label for="userA">User</label>
                     <input name="userA" type="text" class="form-control" id="userA"  placeholder="Ingresa usuario">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-6">
                   <div class="form-group">
                     <label for="passwordA">Password</label>
                     <input name="passwordA" type="password" class="form-control" id="passwordA"  placeholder="Ingresa contraseña">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="uxvR">Tipo</label>
                     <select class="form-control" name="tipoA">
                       <option selected disabled  value="">Elige una opcion</option>
                       <option value="A">A</option>
                       <option value="M">M</option>
                       <option value="H">H</option>
                     </select>
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button  id="btnCrearUserA" type="button" class="btn btn-primary">Crear Usuario</button>
      </div>
    </div>
  </div>
</div>




<!-- MODAL DE ELIMINACION -->
<div class="modal fade" id="modalEliminacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body">
      ¿Desea eliminar a este usuario?
    </div>
    <div class="modal-footer">
      <button id="btnDeleteProduct" type="button" class="btn btn-danger" data-dismiss="modal">Si</button>
      <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

    </div>
  </div>
</div>
</div>
<!-- FIN MODAL ELIMINACION -->


<!-- MODAL DE EDITAR  -->
<div class="modal fade" id="modalEditarU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="container">
          <form id="formUpdateUser" class="">
             <div id="divProductGeneral">
                <div class="row">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="nombreE">Nombre</label>
                     <input type="text" class="form-control" id="nombreE" name="nombreE" placeholder="Ingresa nombre">
                     <input type="hidden" id="idRegistro" name="idRegistro">
                   </div>
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="userE">User</label>
                     <input name="userE" type="text" class="form-control" id="userE"  placeholder="Ingresa usuario">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-12 col-md-10">
                   <div class="form-group">
                     <label for="passwordE">Password</label>
                     <input name="passwordE" type="password" class="form-control" id="passwordE"  value='********************' disabled placeholder="Ingresa contraseña">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                   <div class="col-12 col-md-2 mt-4">
                     <div class="form-group">
                       <button type="button" name="button" id="btnRestablecer" class="btn btn-outline-success mt-resU">Restablecer</button>
                     </div>
                   </div>
                </div>
               <div class="row mt-2">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="tipoA">Tipo</label>
                     <select class="form-control" id="tipoA" name="tipoA">
                     </select>
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button  id="btnUpdateU" type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

        <?php  require_once 'templates/footerAdmin.php';?>


    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

   <?php require_once 'templates/scriptsAdmin.php'; ?>
   <!-- Page level custom scripts -->
   <script src="<?php echo RUTA; ?>js/sudo.js" type="module"></script>


 </body>

 </html>
