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

    <title>HOAutopartes | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo RUTA;?>js/libs/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                       <div class="card-header py-3">
                           <!-- <h6 id="agregarProducto" class="m-0 font-weight-bold text-primary">Agregar Producto</h6> -->
                           <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#modalRegistroMarca">Agregar Marca </button>
                       </div>
                       <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-bordered" id="dataTableMarcas" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>Código</th>
                                           <th>Marca</th>
                                           <th>SubMarca</th>
                                           <th>Modelo</th>
                                           <th>FMSI</th>
                                           <th>Balata</th>
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

      <!-- MODAL DE EDITAR DATOS -->
<div id="modalEditar" class="modal fade bd-example-modal-lg p-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Marca Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
          <div class="container">
            <form id="formEditarModal" method="post">
              <div class="row mt-3">
                <div class="col-12 col-md-12">
                  <label for="codigoE">Código</label>
                  <input readonly id="codigoE" name="codigoE" type="text" class="form-control">
                  <input type="hidden" id="idRegistro" name="idRegistro" value="">
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12 col-md-6">
                  <label for="marcaE">Marca</label>
                  <select id="marcaE" name="marcaE" type="text" class="form-control"></select>
                </div>
                <div class="col-12 col-md-6">
                  <label for="subMarcaE">Submarca</label>
                  <select id="subMarcaE" name="subMarcaE" type="text" class="form-control"></select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12 col-md-6">
                  <label for="modeloE">Modelo</label>
                  <input id="modeloE" name="modeloE" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                  <label for="fmsiE">Fmsi</label>
                  <input id="fmsiE" name="fmsiE" type="text" class="form-control">
                </div>
              </div>
              <div class='row mt-3'>
                <div class="col-12 col-md-12">
                  <label for="balataE">Balata</label>
                  <input id="balataE" name="balataE" type="text" class="form-control">
                </div>
              </div>
            </form>
          </div>
     </div>
    <div class="modal-footer">
      <button id="btnEditarModal" type="button" disabled class="btn btn-primary" data-dismiss="modal">Guardar Cambios</button>
      <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>
<!-- FIN DE MODAL EDITAR DATOS -->




<!-- MODAL DE ELIMINACION -->
<div class="modal fade" id="modalEliminacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body">
      ¿Desea eliminar esta marca?
    </div>
    <div class="modal-footer">
      <button id="btnDeleteProduct" type="button" class="btn btn-danger">Si</button>
      <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

    </div>
  </div>
</div>
</div>
<!-- FIN MODAL ELIMINACION -->


<!-- MODAL DE REGISTRAR DATOS -->
<div id="modalRegistroMarca" class="modal fade bd-example-modal-lg p-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Marca Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
        <form class="" id="registroMarca" action="index.html" method="post">
          <div class="mb-2">
             <div class="border p-5 mb-2">
               <div class="row mb-4">
                 <div class="col-12">
                   <label for="codigoP">Código</label>
                  <input type="text" name="codigoP" id="codigoP" class="form-control" value="" placeholder="Ingresa el código del producto" >
                 </div>
               </div>
                <div class="row">
                  <div class="col-6">
                     <div class="form-group">
                       <label for="marcaR">Marca</label>
                      <select name="marcaR" class="custom-select" id="marcaR">
                        <option selected disabled value="">Elige una Marca</option>
                        <?php foreach ($data['marcas'] as $marca): ?>
                         <option value="<?php echo $marca['marca']; ?>"><?php echo $marca['marca']; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                     <div class="form-group">
                       <label for="submarcasR">Submarca</label>
                      <select name="submarcasR" class="custom-select" id="submarcasR">
                        <option selected disabled value="">Elige una submarca</option>
                        <?php foreach ($data['submarcas'] as $submarca): ?>
                         <option value="<?php echo $submarca['submarca']; ?>"><?php echo $submarca['submarca']; ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
               </div>
               <div class="row informaciónSecudaria">
                  <div class="col-4">
                       <label for="modeloR">Modelo</label>
                      <input type="text" name="modeloR"  class="form-control" value="" placeholder="Ingresa el modelo" >
                  </div>
                  <div class="col-4">
                       <label for="fmsiR">Fmsi</label>
                       <input type="text" name="fmsiR"  class="form-control" value=""  placeholder="Ingresa FMSI" >
                  </div>
                  <div class="col-4">
                       <label for="balataR">Balata</label>
                      <input type="text" name="balataR"  class="form-control" value=""  placeholder="Ingresa balata" >
                  </div>
               </div>
             </div>
          </div>
        </form>

     </div>
    <div class="modal-footer">
      <button id="btnRegistrarMarca" type="button" class="btn btn-primary">Agregar Marca</button>
      <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>
<!-- FIN DE MODAL REGISTRAR DATOS -->

      <?php  require_once 'templates/footerAdmin.php';?>


   </div>
   <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

    <?php require_once 'templates/botonScroll.php'; ?>
   <?php require_once 'templates/scriptsAdmin.php'; ?>

   <script src="<?php echo RUTA; ?>js/marcas.js" type="module"></script>


</body>

</html>
