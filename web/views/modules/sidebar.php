<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin" class="brand-link">
    <img src="<?= $path ?>views/assets/img/template/1/icono.png" class="brand-image elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Administradores</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $path ?>views/assets/img/adminlte/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <?php if (isset($_SESSION['admin'])) : ?>
          <a href="#" class="d-block"><?= $_SESSION['admin']->name_admin ?></a>
        <?php endif ?>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-item">
          <a href="/admin/administradores" class="nav-link ">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Administradores
            </p>
          </a>
        </li>

        <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              General
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/plantillas" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Plantillas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/redes-sociales" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Redes Sociales</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>
              Promoción
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/slides" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Slides</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/banners" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Banners</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Inventario
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/categorias" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorías</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/subcategorias" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Subcategorías</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/productos" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-funnel-dollar"></i>
            <p>
              Ventas
              <i class="right fas fa-angle-left"></i>
              <span class="right badge badge-warning mr-1">7</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/admin/pedidos" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Pedidos</p>
                <span class="right badge badge-success">7</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/informes" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Informes</p>
              </a>
            <li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="/admin/clientes" class="nav-link ">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Clientes

            </p>
          </a>
        </li>



        <li class="nav-item">
          <a href="/salir" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Salir
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>