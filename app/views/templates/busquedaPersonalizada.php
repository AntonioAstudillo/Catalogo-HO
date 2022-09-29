
<div class="container">
  <section class="container p-0 colorRapida mb-4 colorPersonalizada">
      <div class="row mb-2">
        <div class="col-sm-12 col-lg-12">
          <div class="headerBR">
            <p>Búsqueda rápida</p>
          </div>
          <form id="formRapida2"  action="<?php echo RUTA; ?>producto/rapida" class="form-inline d-flex justify-content-start  md-form form-sm active-pink active-pink-2 mt-3 ml-2" autocomplete="off">
             <input disabled name="claveB" id="listSearch" class="form-control mr-2  w-50 p-3" type="text" placeholder="Subfamilia/Código/FMSI/Balata" maxlength="35">
             <div id="spinner" class="spinner-border text-primary" role="status">
                 <span class="sr-only">Loading...</span>
             </div>
             <button id="btnSearchFast" type="button" class="btn btn-primary invisible d-flex none" name="button"><i class="fa fa-search text-white font-weight-bold"></i></button>
          </form>
          <div class="d-flex justify-content-star">
             <ul class="list-group esconder" id="myList"></ul>
          </div>
        </div>
      </div>
  </section>

  <section class="container p-0 colorPersonalizada">

      <form class="p-0">
        <div class="headerBP">
          <p>Búsqueda personalizada</p>
        </div>

         <div class="row">
            <div class="col-11 col-lg-5">
               <div class="form-group">
                  <div class="form-group">
                     <label class="ml-2">Aplicación</label>
                     <select id="aplicacionPrs" class="form-control ml-1" >
                       <option>-- Selecciona una aplicación  -- </option>
                     </select>
                 </div>
              </div>
            </div>
            <div class="col-11 col-lg-5">
               <div class="form-group">
                  <label for="subaplicacionPrs" class="ml-2">Subaplicación</label>
                  <select id="subaplicacionPrs" disabled class="form-control ml-1">
                     <option>-- Selecciona una subaplicación  -- </option>
                  </select>
               </div>
            </div>

           <div>
              <div class="col-12 col-lg-2">
                 <button id="buscarPrs" disabled type="button" class="btn btn-primary btnBuscarM" name="button"><i class="fa fa-search text-white font-weight-bold"></i></button>
              </div>
           </div>
        </div>
     </form>
  </section>
</div>
