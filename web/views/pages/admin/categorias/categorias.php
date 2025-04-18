<div class="content-wrapper" style="min-height: 1504.06px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> <small>Categorias</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Tablero</a></li>
            <li class="breadcrumb-item">Inventario</li>
            <li class="breadcrumb-item active">Categorias</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <?php

  if (!empty($routesArray[2])) {
    if ($routesArray[2] == 'gestion') {
      include_once 'modules/' . $routesArray[2] . '.php';
    } else {
      echo '<script>window.location=' . $path . '404</script>';
    }
  } else {
    include_once 'modules/listado.php';
  }
  ?>
</div>

<script src="<?= $path ?>views/assets/js/slide/slide.js"></script>