<link rel="stylesheet" href="<? $path ?>views/assets/css/admin/admin.css">
<?php

if (!isset($_SESSION['admin'])) {
  include_once 'login/login.php';
} else {

  if (!empty($routesArray[1])) {
    if (
      $routesArray[1] == 'administradores' ||
      $routesArray[1] == 'plantillas' ||
      $routesArray[1] == 'redes-sociales' ||
      $routesArray[1] == 'slides' ||
      $routesArray[1] == 'banners' ||
      $routesArray[1] == 'categorias' ||
      $routesArray[1] == 'subcategorias' ||
      $routesArray[1] == 'productos' ||
      $routesArray[1] == 'pedidos' ||
      $routesArray[1] == 'informes' ||
      $routesArray[1] == 'clientes'
    ) {
      include_once $routesArray[1] . '/' . $routesArray[1] . '.php';
    } else {
      echo '<script>window.location="' . $path . '404"</script>';
    }
  } else {
    include_once 'tablero/tablero.php';
  }
}

?>
<!-- <script src="<?= $path ?>views/assets/js/tables/tables.js"></script> -->
<script src="<?= $path ?>views/assets/js/forms/forms.js"></script>