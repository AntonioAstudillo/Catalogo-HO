
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
            <div class="sidebar-brand-text mx-3">HOAutopartes<sup>mx</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <i class="fa fa-building" aria-hidden="true"></i>
                <span>Departamentos</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">

        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Compras</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Productos</h6> -->
                    <a class="collapse-item" href="admin.php">Productos</a>
                    <a class="collapse-item" href="<?php echo RUTA; ?>administrador/marcas">Marcas</a>
                    <a class="collapse-item" href="<?php echo RUTA; ?>administrador/exterior">Diámetro Exterior</a>
                    <a class="collapse-item" href="<?php echo RUTA; ?>administrador/contacto">Contacto</a>
                </div>
            </div>
        </li>

        <?php if(isset($_SESSION['avatarHO']) && $_SESSION['avatarHO'] == 'A'): ?>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li  class="nav-item ">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-user-secret"></i>
                    <span>Administradores</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tareas</h6>
                        <a class="collapse-item" href="<?php echo RUTA; ?>administrador/users">Administrar Usuarios</a>
                    </div>
                </div>
            </li>
        <?php else: ?>
          <!-- Nav Item - Utilities Collapse Menu -->
          <li  class="nav-item disabled ">
              <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities"
                  aria-expanded="false" aria-controls="collapseUtilities">
                  <i class="fa-solid fa-user-secret"></i>
                  <span>Administradores</span>
              </a>
          </li>
        <?php endif; ?>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
