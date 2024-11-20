<link rel="stylesheet" href="<? $path ?>views/assets/css/admin/admin.css">
<?php

if (!isset($_SESSION['admin'])) {
  include_once 'login/login.php';
} else {

  /* -------------------------------------------------------------------------- */
  /*                      VALIDAR SI EL TOKEN ESTA EXPIRADO                     */
  /* -------------------------------------------------------------------------- */

  if (isset($_SESSION['user'])) {
    date_default_timezone_set('America/Mexico_City');

    $url = 'admins?id=' . $_SESSION['admin']->id_admin . '&nameId=id_admin&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
    $method = 'PUT';
    $fields = 'date_updated_admin=' . date('Y-m-d G:i:s');

    $update = CurlController::request($url, $method, $fields);

    if ($update->status == 303) {
      session_destroy();

      echo '<script>
      window.location = "/admin";
    </script>';

      return;
    }
  }

  /* -------------------- VALIDAR SI EL TOKEN ESTA EXPIRADO ------------------- */

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
<script src="<?= $path ?>views/assets/js/tables/tables.js"></script>
<script src="<?= $path ?>views/assets/js/forms/forms.js"></script>