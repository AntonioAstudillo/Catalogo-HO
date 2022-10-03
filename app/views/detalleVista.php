
<!doctype html>
<html lang="es">
<head>
   <title>HO | Detalle Producto</title>
   <link rel="shortcut icon" href="<?php echo RUTA;?>img/RAHSA2.ico">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="robots" content="noindex">

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
          <h6><?php echo $data['dataProducto'][0]['grupo']; ?> - <b><?php echo $data['dataProducto'][0]['familia'];  ?> <span class="text-dark text-uppercase"> - <?php echo $data['dataProducto'][0]['codigo']; ?> </span></b></h6>

          <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-sm-12 border-top">
                <div class="">

                    <div class="d-flex justify-content-center mt-5 responsive">
                      <?php if(file_exists('img/productos/'.$data['dataProducto'][0]['imagen'])): ?>
                         <img class="resposive"  alt="100%x280" src="<?php echo RUTA; ?>img/productos/<?php echo $data['dataProducto'][0]['imagen']?>">
                      <?php else: ?>
                         <img class="imgLogo"  alt="100%x280" height="20%" src="<?php echo RUTA; ?>img/404.jpg">
                      <?php endif; ?>
                    </div>
                </div>
            </div>

             <div class="col-sm-12 col-lg-6 col-md-12 mt-3">
              <div class="tab-content" id="pills-tabContent">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Información General</h5>
                    </div>
                    <div class="modal-content">
                      <div class="modal-body">
                         <div class="row">
                            <div class="col-md-12  col-md-12 col-12 table-responsive">
                                  <table class="table table-bordered table-primary table-sm text-center mb-0">
                                     <tbody>
                                        <tr>
                                          <td colspan="3">
                                             <div class="d-flex flex-column">
                                                <span class="heading d-block text-capitalize text-dark font-weight-bold text-dark font-weight-bold">Código</span>
                                                 <span id="codigoProducto" class="subheadings text-capitalize"><?php echo $data['dataProducto'][0]['codigo']; ?></span>
                                              </div>
                                          </td>
                                          <td colspan="3">
                                             <div class="d-flex flex-column">
                                                <span class="heading d-block text-capitalize text-dark font-weight-bold">Familia</span>
                                                <span id="grupoProducto" class="subheadings text-capitalize"><?php echo $data['dataProducto'][0]['familia']; ?></span>
                                             </div>
                                          </td>
                                          <td colspan="3">
                                            <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize text-dark font-weight-bold">SubFamilia</span>
                                               <?php if(!empty($data['dataProducto'][0]['grupo'])): ?>
                                                  <span  id="familiaProducto" class="subheadings text-capitalize"></i> <?php echo $data['dataProducto'][0]['grupo']; ?></span>
                                               <?php else: ?>
                                                  <span  id="familiaProducto" class="subheadings text-capitalize"></i>N/D</span>
                                               <?php endif; ?>
                                            </div>
                                          </td>
                                        </tr>
                                          <tr>
                                            <?php if(!empty($data['dataProducto'][0]['empaque'])): ?>
                                            <td colspan="3">
                                              <div class="d-flex flex-column">
                                                <span class="heading d-block text-capitalize">Empaque</span>
                                                <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo $data['dataProducto'][0]['empaque']; ?></span>
                                              </div>
                                            </td>
                                          <?php else: ?>
                                            <td colspan="3">
                                              <div class="d-flex flex-column">
                                                <span class="heading d-block text-capitalize">Empaque</span>
                                                <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                              </div>
                                            </td>
                                          <?php endif; ?>

                                          <?php if(!empty($data['dataProducto'][0]['uxv'])): ?>
                                          <td colspan="3">
                                            <div class="d-flex flex-column">
                                              <span class="heading d-block text-capitalize">UXV</span>
                                              <span id=""  class="d-block subheadings text-uppercase"><?php echo $data['dataProducto'][0]['uxv']; ?></span>
                                            </div>
                                          </td>
                                        <?php else: ?>
                                          <td colspan="3">
                                            <div class="d-flex flex-column">
                                              <span class="heading d-block text-capitalize">UXV</span>
                                              <span id=""  class="d-block subheadings text-uppercase">N/D</span>
                                            </div>
                                          </td>
                                        <?php endif; ?>

                                          <?php if(!empty($data['dataProducto'][0]['posicion'])): ?>
                                          <td colspan="3">
                                            <div class="d-flex flex-column">
                                              <span class="heading d-block text-capitalize">Posición</span>
                                              <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo $data['dataProducto'][0]['posicion']; ?></span>
                                            </div>
                                          </td>
                                        <?php else: ?>
                                          <td colspan="3">
                                            <div class="d-flex flex-column">
                                              <span class="heading d-block text-capitalize">Posición</span>
                                              <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                            </div>
                                          </td>
                                        <?php endif; ?>
                                          </tr>


                                          <tr>
                                             <?php if(!empty($data['dataProducto'][0]['tipoCubrePolvo'])): ?>
                                             <td colspan="3">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Cubre Polvo</span>
                                                 <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['tipoCubrePolvo']); ?></span>
                                               </div>
                                             </td>
                                           <?php else: ?>
                                             <td colspan="3">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Cubre Polvo</span>
                                                 <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                               </div>
                                             </td>
                                           <?php endif; ?>
                                           <?php if(!empty($data['dataProducto'][0]['tipoPiston'])): ?>
                                           <td colspan="3">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Tipo Pistón</span>
                                               <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['tipoPiston']); ?></span>
                                             </div>
                                           </td>
                                         <?php else: ?>
                                           <td colspan="3">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Tipo Pistón</span>
                                               <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                             </div>
                                           </td>
                                         <?php endif; ?>



                                         <?php if(!empty($data['dataProducto'][0]['codigoEquivalente'])): ?>
                                         <td colspan="3">
                                           <div class="d-flex flex-column">
                                             <span class="heading d-block text-capitalize">Código Equivalente</span>
                                             <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['codigoEquivalente']); ?></span>
                                           </div>
                                         </td>
                                       <?php else: ?>
                                         <td colspan="3">
                                           <div class="d-flex flex-column">
                                             <span class="heading d-block text-capitalize">Código Equivalente</span>
                                             <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                           </div>
                                         </td>
                                       <?php endif; ?>

                                          </tr>

                                          <tr>
                                             <?php if(!empty($data['dataProducto'][0]['lado'])): ?>
                                             <td colspan="5">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Lado</span>
                                                 <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['lado']); ?></span>
                                               </div>
                                             </td>
                                           <?php else: ?>
                                             <td colspan="5">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Lado</span>
                                                 <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                               </div>
                                             </td>
                                           <?php endif; ?>
                                           <?php if(!empty($data['dataProducto'][0]['diametroInterior'])): ?>
                                           <td colspan="5">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Diámetro Interior</span>
                                               <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['diametroInterior']); ?></span>
                                             </div>
                                           </td>
                                         <?php else: ?>
                                           <td colspan="5">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Diámetro Interior</span>
                                               <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                             </div>
                                           </td>
                                         <?php endif; ?>
                                          </tr>

                                          <tr>
                                             <?php if(!empty($data['dataProducto'][0]['altura'])): ?>
                                             <td colspan="5">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Altura</span>
                                                 <span  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['altura']); ?></span>
                                               </div>
                                             </td>
                                           <?php else: ?>
                                             <td colspan="5">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Altura</span>
                                                 <span   class="d-block subheadings text-uppercase">N/D</span>
                                               </div>
                                             </td>
                                           <?php endif; ?>
                                           <?php if(count($data['diametros'])>0): ?>
                                           <td colspan="5">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Diámetro Exterior</span>
                                               <?php foreach($data['diametros'] as $diametro): ?>
                                                  <span  class="d-block subheadings text-uppercase"><?php echo $diametro['diametro'];?></span>
                                               <?php endforeach; ?>
                                             </div>
                                           </td>
                                         <?php else: ?>
                                           <td colspan="5">
                                             <div class="d-flex flex-column">
                                               <span class="heading d-block text-capitalize">Diámetro Exterior</span>
                                               <span id="uxvProducto"  class="d-block subheadings text-uppercase">N/D</span>
                                             </div>
                                           </td>
                                         <?php endif; ?>
                                          </tr>

                                          <tr>
                                             <?php if(!empty($data['dataProducto'][0]['descripcion'])): ?>
                                             <td colspan="9">
                                               <div class="d-flex flex-column">
                                                 <span class="heading d-block text-capitalize">Descripción</span>
                                                 <span id="uxvProducto"  class="d-block subheadings text-uppercase"><?php echo ($data['dataProducto'][0]['descripcion']); ?></span>
                                               </div>
                                             </td>
                                           <?php endif; ?>
                                          </tr>
                                     </tr>
                                   </tbody>
                                </table>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
                <?php if(count($data['detalleProducto'])>0): ?>
                   <div class="container mt-3 table-resposive">
                  <table id="tablaProductos" class="table table-hover display table-primary table-bordered tablaEstilos" cellspacing="0" width="100%">
                      <thead class="">
                          <tr>
                              <th>#</th>
                              <th>APLICACIÓN</th>
                              <th>SUB-APLICACIÓN</th>
                              <th>MODELO</th>
                              <th>BALATA</th>
                              <th>FMSI</th>
                              <th></th>
                          </tr>
                      </thead>
                          <tbody>
                            <?php $contador = 0;  ?>
                            <?php foreach ($data['detalleProducto'] as $key): ?>
                              <tr>
                                 <td><?php echo ++$contador; ?></td>
                                 <?php if(!empty($key['marca'])): ?>
                                    <td><?php  echo ($key['marca']); ?></td>
                                 <?php else: ?>
                                    <td>N/D</td>
                                 <?php endif; ?>
                                 <?php if(!empty($key['submarca'])): ?>
                                    <td><?php  echo ($key['submarca']); ?></td>
                                 <?php else: ?>
                                    <td>N/D</td>
                                 <?php endif; ?>
                                 <?php if(!empty($key['modelo'])): ?>
                                    <td><?php  echo ($key['modelo']); ?></td>
                                 <?php else: ?>
                                    <td>N/D</td>
                                 <?php endif; ?>

                                  <?php if(!empty($key['noBalata'])): ?>
                                      <td><?php  echo ($key['noBalata']); ?></td>
                                  <?php else: ?>
                                      <td>N/D</td>
                                  <?php endif; ?>
                                  <?php if(!empty($key['fmsi'])): ?>
                                     <td><?php  echo ($key['fmsi']); ?></td>
                                  <?php else: ?>
                                     <td>N/D</td>
                                  <?php endif; ?>
                                  <td></td>
                              </tr>
                           <?php endforeach; ?>
                          </tbody>
                     </table>
                </div>
                <?php endif; ?>
              </div>
           </div>
             <?php if(count( $data['similares'] )>0): ?>
                  <div class="col-12 mt-5">
                    <section class="pt-5 pb-5 border-top mt-5">
                        <h2>OTROS PRODUCTOS DE  <b><?php echo $data['dataProducto'][0]['familia'];?></b></h2>
                        <div class="container">
                           <div class="col-12">
                               <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                   <div id="addCards" class="carousel-inner">
                                       <div class="carousel-item active">
                                           <div class="row">
                                              <?php foreach($data['similares'] as $producto): ?>
                                                 <div class="col-md-3 col-sm-6 mb-3">
                                                     <div class="card">
                                                         <?php if(file_exists('img/productos/'.$producto['codigo']. '.jpg')): ?>
                                                           <a href="<?php echo RUTA; ?>producto/detalle/<?php echo $producto['codigo']; ?>">
                                                              <img class="resposive" alt="100%x280" height="25%" src="<?php echo RUTA; ?>img/productos/<?php echo $producto['codigo'] . '.jpg'?>">
                                                           </a>
                                                         <?php else: ?>
                                                            <img class="imgLogo" alt="100%x280" height="20%" src="<?php echo RUTA; ?>img/404.jpg">
                                                         <?php endif; ?>
                                                         <div class="card-body">
                                                             <p class="card-title"><span class="text-dark">Código: </span> <span class="text-dark font-weight-bold"><?php echo $producto['codigo'];?></span></p>
                                                             <ul>
                                                               <li class="text-center">
                                                                  <a href="<?php echo RUTA; ?>producto/detalle/<?php echo $producto['codigo']; ?>" class="btn btn-primary text-center botonCarousel">Detalles</a>
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
                        </section>
                       </div>
                    <?php endif; ?>
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
