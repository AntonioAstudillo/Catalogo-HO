

<!-- MODALS -->
<!-- MODAL VISTA GENERAL -->
<div id="modalVista" class="modal fade bd-example-modal-lg p-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos generales del producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
          <div class="container">
            <form>
              <div class="row">
                <div class="col-12 col-md-3">
                  <label for="codigoVista">Código</label>
                  <input readonly id="codigoVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="familiaVista">Lado</label>
                  <input readonly id="ladoVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-5">
                  <label for="subFamiliaVista">Empaque</label>
                  <input readonly id="empaqueVista" type="text" class="form-control">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-6">
                  <label for="familiaVista">Familia</label>
                  <input readonly id="familiaVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                  <label for="subFamiliaVista">SubFamilia</label>
                  <input readonly id="subFamiliaVista" type="text" class="form-control">
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-6">
                  <label for="diamIntVista">Diámetro Interior</label>
                  <input readonly id="diamIntVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                  <label for="posicionVista">Posición</label>
                  <input readonly id="posicionVista" type="text" class="form-control">
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-4">
                  <label for="pistonVista">Pistón</label>
                  <input readonly id="pistonVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="cubrePolvoVista">CubrePolvo</label>
                  <input readonly id="cubrePolvoVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="oemVista">OEM</label>
                  <input readonly id="oemVista" type="text" class="form-control">
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-4">
                  <label for="equivalenteVista">Código equivalente</label>
                  <input readonly id="equivalenteVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="uxvVista">Uxv</label>
                  <input readonly id="uxvVista" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="catalogoVista">Catálogo</label>
                  <input readonly id="catalogoVista" type="text" class="form-control">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-12">
                  <label for="catalogoVista">Altura</label>
                  <input readonly id="alturaVista" type="text" class="form-control">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-12">
                  <label for="subFamiliaVista">Descripción</label>
                  <textarea readonly class="form-control" id="descripcionVista" rows="2"></textarea>
                </div>
              </div>
            </form>
            <div class="container border-top">
              <div class="table-responsive">
                <table class="table table-sm table-bordered mt-4">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Aplicación</th>
                        <th scope="col">SubAplicación</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Fmsi</th>
                        <th scope="col">No Balata</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla"></tbody>
               </table>
              </div>
            </div>
          </div>
     </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
</div>
<!-- FIN DE MODAL VISTA GENERAL -->
<!-- MODAL DE EDITAR DATOS -->
<div id="modalEditar" class="modal fade bd-example-modal-lg p-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
          <div class="container">
            <form id="formEditarModal" method="post">
              <div class="row">
                <div class="col-12 col-md-4">
                  <label for="codigoEditar">Código</label>
                  <input id="codigoEditar" name="codigo" type="text" class="form-control">
                  <input type="hidden" id="idRegistro" name="idRegistro" value="">
                  <input type="hidden" name="nameImg" value="">
                </div>
                <div class="col-12 col-md-4">
                  <label for="familiaEditar">Lado</label>
                  <select id="ladoEditar" name="lado" type="text" class="form-control"></select>
                </div>
                <div class="col-12 col-md-4 p-0">
                  <label for="subFamiliaEditar">Empaque</label>
                  <input id="empaqueEditar" name="empaque" type="text" class="form-control">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-6">
                  <label for="familiaEditar">Familia</label>
                  <select id="familiaEditar" name='familia' class="form-control"></select>
                </div>
                <div class="col-12 col-md-6">
                  <label for="subFamiliaEditar">SubFamilia</label>
                  <select id="subFamiliaEditar"name='grupo' class="form-control"></select>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-6">
                  <label for="diamIntEditar">Diámetro Interior</label>
                  <input id="diamIntEditar" name="diametroInterior" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-6">
                  <label for="posicionEditar">Posición</label>
                  <select id="posicionEditar" name="posicion" type="text" class="form-control"></select>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-4">
                  <label for="pistonEditar">Pistón</label>
                  <select id="pistonEditar" name="pistonEditar" type="text" class="form-control"></select>
                </div>
                <div class="col-12 col-md-4">
                  <label for="cubrePolvoEdit">CubrePolvo</label>
                  <select id="cubrePolvoEdit" name="cubrePolvoEdit" type="text" class="form-control"></select>
                </div>
                <div class="col-12 col-md-4">
                  <label for="oemEditar">OEM</label>
                  <input id="oemEditar" name="oem" type="text" class="form-control">
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-12 col-md-4">
                  <label for="equivalenteEditar">Equivalente</label>
                  <input id="equivalenteEditar" name="equivalente" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="uxvEditar">Uxv</label>
                  <input id="uxvEditar" name="uxv" type="text" class="form-control">
                </div>
                <div class="col-12 col-md-4">
                  <label for="catalogoEditar">Catálogo</label>
                  <select id="catalogoEditar" name="catalogo" class="form-control"></select>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-12">
                  <label for="catalogoVista">Altura</label>
                  <input id="alturaEditar" name="alturaEditar" type="text" class="form-control">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 col-md-12">
                  <label for="descripcionEditar">Descripción</label>
                  <textarea class="form-control" name="descripcion" id="descripcionEditar" rows="2"></textarea>
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


<!-- MODAL DE IMAGEN  -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modal foto" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container d-flex justify-content-center">
          <img id="imgProductModal" height="100%" width="100%" alt="Este producto no tiene imagen">
        </div>
      </div>
      <div class="container p-4 d-flex justify-content-between">
        <form id="formFotoModal" action="procesar.php" method="post">
          <div class="mt-4">
              <input id="newFoto" type="file" name="newFoto" class="form-control" value=''>
          </div>
          <div class="mt-4">
            <button id="btnCambiarImg" type="submit" class="btn btn-primary">Cambiar Imagen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL IMAGEN -->

<!-- MODAL DE ELIMINACION -->
<div class="modal fade" id="modalEliminacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body">
      ¿Desea eliminar este producto?
    </div>
    <div class="modal-footer">
      <button id="btnDeleteProduct" type="button" class="btn btn-danger">Si</button>
      <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>

    </div>
  </div>
</div>
</div>
<!-- FIN MODAL ELIMINACION -->



<!-- MODAL DE REGISTRO PRODUCTO  -->
<!-- Modal -->
<div class="modal fade" id="modalRegistroProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div  class="container">
          <form id="formRegistroProducts" class="formRegistro">
             <div id="divProductGeneral">
                <div class="row">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="codigoR">Código</label>
                     <input type="text" class="form-control" id="codigoR" name="codigoR" placeholder="Ingresa código">
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="familiaR">Familia</label>
                    <select name="familiaR" class="form-control" id="familiaR">
                      <option selected disabled value="">Elige una familia</option>
                      <?php foreach ($data['familias'] as $familia): ?>
                         <option value="<?php echo $familia['familia']; ?>"><?php echo $familia['familia']; ?></option>
                      <?php  endforeach; ?>
                    </select>
                  </div>
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="subfamiliar">Subfamilia</label>
                    <select name="subfamiliaR" class="form-control" id="subfamiliaR">
                      <option selected disabled value="">Elige una subfamilia</option>
                      <?php foreach ($data['subfamilias']  as $subfamilia): ?>
                         <option value="<?php echo $subfamilia['subfamilia']; ?>"><?php echo $subfamilia['subfamilia']; ?></option>
                      <?php  endforeach; ?>
                    </select>
                  </div>
                 </div>
               </div>

               <div class="row">
                 <div class="col-6">
                   <div class="form-group">
                     <label for="posicionR">Posición</label>
                     <select name="posicionR" class="form-control" id="posicionR">
                        <option selected  value="">Elige una posición</option>
                       <?php foreach ( $data['posiciones']  as $posicion): ?>
                          <option value="<?php echo $posicion['posicion']; ?>"><?php echo $posicion['posicion']; ?></option>
                       <?php  endforeach; ?>
                     </select>
                   </div>
                 </div>
                 <div class="col-6">
                   <div class="form-group">
                     <label for="ladoR">Lado</label>
                     <select name="ladoR" class="form-control" id="ladoR">
                        <option selected  value="">Elige un lado</option>
                       <?php foreach ( $data['lados']  as $lado): ?>
                          <option value="<?php echo $lado['lado']; ?>"><?php echo $lado['lado']; ?></option>
                       <?php  endforeach; ?>
                     </select>
                   </div>
                 </div>
               </div>

               <div class="row mt-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label for="empaqueR">Empaque</label>
                     <input name="empaqueR" type="text" class="form-control" id="empaqueR"  placeholder="Ingresa empaque">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="form-group">
                     <label for="uxvR">UXV</label>
                     <input name="uxvR" type="text" class="form-control" id="uxvR"  placeholder="Ingresa  uxv">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="form-group">
                     <label for="diamIntR">Diámetro Interior</label>
                     <input name="diamIntR" type="text" class="form-control" id="diamIntR"  placeholder="Ingresa diámetro interior">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>

               <div class="row mt-2">
                 <div class="col-4">
                   <div class="form-group">
                     <label for="equivalenteR">Código equivalente</label>
                     <input name="equivalenteR" type="text" class="form-control" id="equivalenteR"  placeholder="Ingresa equivalente">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="form-group">
                     <label for="oemR">OEM</label>
                     <input name="oemR" type="text" class="form-control" id="oemR"  placeholder="Ingresa oem">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-4">
                   <div class="form-group">
                     <label for="pistonR">Pistón</label>
                     <input name="pistonR" type="text" class="form-control" id="pistonR"  placeholder="Ingresa pistón">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
               </div>
               <div class="row mt-2">
                 <div class="col-6">
                   <div class="form-group">
                     <label for="cubrePolvoR">Cubre Polvo</label>
                     <input name="cubrePolvoR" type="text" class="form-control" id="cubrePolvoR"  placeholder="Ingresa cubre polvo">
                     <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                   </div>
                 </div>
                 <div class="col-6">
                   <div class="form-group">
                     <label for="equivalenteR">Catálogo</label>
                     <select name="catalogosR" class="form-control" id="catalogosR">
                       <?php foreach ( $data['catalogos'] as $catalogo): ?>
                          <option value="<?php echo $catalogo['catalogo']; ?>"><?php echo $catalogo['catalogo']; ?></option>
                       <?php  endforeach; ?>
                     </select>
                   </div>
                 </div>
               </div>

               <div class="row mt-2">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="alturaR">Altura</label>
                     <input type="text" class="form-control"  name="alturaR" value="" placeholder="Ingresa una altura">
                   </div>
                 </div>
               </div>

               <div class="row mt-2">
                 <div class="col-12">
                   <div class="form-group">
                     <label for="descripcionR">Descripción</label>
                      <textarea name="descripcionR" class="form-control" id="descripcionR" rows="4" cols="10" placeholder="Ingresa una descripción"></textarea>
                   </div>
                 </div>
               </div>

               <div class="form-group">
                 <label for="imagenProductoR">Imagen</label>
                 <input name="imagenProductR" type="file" class="form-cont rol-file" id="imagenProductoR">
              </div>

              <div class="form-check">
               <input type="checkbox"  name="destacadoR" class="form-check-input" id="destacadoR">
               <label class="form-check-label" for="destacadoR">Producto Destacado</label>
               </div>
            </div>
             <div id="divMarcas" class="desactive">
                <button id="addMarcasDom" type="button" name="button" class="btn btn-success mb-4">+</button>
                <button id="delMarcasDom" type="button" name="button" class="btn btn-danger mb-4">-</button>
                <div id="padreMarcas" class="mb-2">
                   <div id="hijoMarca" class="border p-2 mb-2">
                      <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                             <label for="marcaR">Marca</label>
                            <select name="marcaR[]" class="custom-select custom-select-sm" id="marcaR">
                              <option selected disabled value="">Elige una Marca</option>
                              <?php foreach ( $data['marcas']  as $marca): ?>
                               <option value="<?php echo $marca['marca']; ?>"><?php echo $marca['marca']; ?></option>
                            <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                             <label for="submarcasR[]">Submarca</label>
                            <select name="submarcasR[]" class="custom-select custom-select-sm" id="submarcasR[]">
                              <option selected disabled value="">Elige una submarca</option>
                              <?php foreach ( $data['submarcas']  as $submarca): ?>
                               <option value="<?php echo $submarca['submarca']; ?>"><?php echo $submarca['submarca']; ?></option>
                            <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                     </div>
                     <div class="row informaciónSecudaria">
                        <div class="col-4">
                             <label for="modeloR">Modelo</label>
                            <input type="text" name="modeloR[]"  class="form-control form-control-sm" value="" placeholder="Ingresa el modelo" >
                        </div>
                        <div class="col-4">
                             <label for="fmsiR">Fmsi</label>
                             <input type="text" name="fmsiR[]"  class="form-control form-control-sm" value=""  placeholder="Ingresa FMSI" >
                        </div>
                        <div class="col-4">
                             <label for="balataR">Balata</label>
                            <input type="text" name="balataR[]"  class="form-control form-control-sm" value=""  placeholder="Ingresa balata" >
                        </div>
                     </div>
                   </div>
                </div>
             </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
         <button  id="btnNext" type="button" class="btn btn-info">Siguiente</button>
         <button  id="btnPrevious" type="button" class="btn btn-info desactive">Anterior</button>

        <button  id="btnCreateProduct" type="button" class="btn btn-primary desactive">Crear Producto</button>
      </div>
    </div>
  </div>
</div>
