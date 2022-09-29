
<!-- NAVBAR -->
 <header id="navHeader" class="fixed-top d-flex align-items-center" style="font-size:15px !important;">
  <!-- DEBO MANTENER FIJO ESTE NAV -->
    <nav class="navbar navbar-expand-lg navbar-primary ftco_navbar bg-primary ftco-navbar-light fixed-top position-absolute" id="ftco-navbar">
     <div class="container-fluid fixed">
      <a href="<?php echo RUTA; ?>" class="d-flex align-items-center">
          <h5 class="text-white font-weight-bold logo-ho"><span class="ho">AUTO</span>PARTES<span class="mx">MX</span></h5>
      </a>

       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="fa fa-bars text-white"></span> <span class="text-white">Menú</span>
       </button>
       <div class="collapse navbar-collapse" id="ftco-nav">
         <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <div class="nav-item mt-3 ml-3">
                <form action="<?php echo RUTA; ?>producto/rapida" id="formNavRapida" method="get"  autocomplete="off">
                  <div class="searchbar">
                     <input maxlength="25" name="claveB" id="claveB" type="text" placeholder="Palabra clave/Código/FMSI">
                     <div id="bRapida" class="icon">
                        <i class="fa fa-search"></i>
                     </div>
                  </div>
                </form>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a  class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nosotros</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/nosotros">QUIÉNES SOMOS</a>
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/informacion">INFORMACIÓN</a>
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/politica">POLÍTICA</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/frenos">CÁTALOGO HO FRENOS</a>
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/suspension">CATÁLOGO HO SUSPENSIÓN</a>
             <a class="dropdown-item" href="<?php echo RUTA; ?>catalogo/descargas">DESCARGAR CATÁLOGOS</a>
            </div>
          </li>
          <li class="nav-item"><a href="<?php echo RUTA; ?>catalogo/videos" class="nav-link">Videos</a></li>
          <li class="nav-item mr-4"><a href="<?php echo RUTA; ?>catalogo/contacto" class="nav-link">Contacto</a></li>
          <li class="nav-item"><a href="<?php echo RUTA; ?>catalogo/privacidad" class="nav-link">Privacidad</a></li>
         </ul>
       </div>
     </div>
   </nav>
  <!-- END nav -->
</header>
