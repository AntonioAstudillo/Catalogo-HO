<!-- Page Wrapper -->
<div id="wrapper">

<?php require_once 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

         <?php require_once 'navbarAdmin.php'; ?>

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
                            <button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#modalRegistroProducto">Agregar Producto</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Familia</th>
                                            <th>SubFamilia</th>
                                            <th>Lado</th>
                                            <th>Empaque</th>
                                            <th>Uxv</th>
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

        <?php require_once 'modals.php'; ?>
        <?php  require_once 'footerAdmin.php';?>


    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
