<?php
/* -------------------------------------------------------------------------- */
/*                         INICIAR VARIABLES DE SESION                        */
/* -------------------------------------------------------------------------- */

ob_start();
session_start();

/* ----------------------- INICIAR VARIABLES DE SESION ---------------------- */

/* -------------------------------------------------------------------------- */
/*                      VALIDAR SI EL TOKEN ESTA EXPIRADO                     */
/* -------------------------------------------------------------------------- */

if (isset($_SESSION['user'])) {
  date_default_timezone_set('America/Mexico_City');

  $url = 'users?id=' . $_SESSION['user']->id_user . '&nameId=id_user&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
  $method = 'PUT';
  $fields = 'date_updated_user=' . date('Y-m-d G:i:s');

  $update = CurlController::request($url, $method, $fields);

  if ($update->status == 303) {
    session_destroy();

    echo '<script>
      window.location = "/";
    </script>';

    return;
  }
}

/* -------------------- VALIDAR SI EL TOKEN ESTA EXPIRADO ------------------- */

/* -------------------------------------------------------------------------- */
/*                                VARIABLE PATH                               */
/* -------------------------------------------------------------------------- */

$path = TemplateController::path();

/* ------------------------------ VARIABLE PATH ----------------------------- */

/* -------------------------------------------------------------------------- */
/*                           CAPTURAR LAS RUTAS URL                           */
/* -------------------------------------------------------------------------- */

$routesArray = explode('/', $_SERVER['REQUEST_URI']);
array_shift($routesArray);

foreach ($routesArray as $key => $value) {
  $routesArray[$key] = explode('?', $value)[0];
}

/* ------------------------- CAPTURAR LAS RUTAS URL ------------------------- */

/* -------------------------------------------------------------------------- */
/*                         CUANDO UTILIZAMOS LOCALHOST                        */
/* -------------------------------------------------------------------------- */

if ($_SERVER['SERVER_NAME'] == 'localhost') {
  $routesArray = array_slice($routesArray, 2);
  $path = $path . 'me-store/web/';
  // echo '<pre>'; print_r($routesArray); echo '</pre>';
}

foreach ($routesArray as $key => $value) {
  $routesArray[$key] = explode('?', $value)[0];
}

/* ----------------------- CUANDO UTILIZAMOS LOCALHOST ---------------------- */

/* -------------------------------------------------------------------------- */
/*                        INGRESO CON FACEBOOK Y GOOGLE                       */
/* -------------------------------------------------------------------------- */

// if (!empty($routesArray[0])) {

//   // https://github.com/facebookarchive/php-graph-sdk/
//   if ($routesArray[0] == 'facebook') {

//     require_once 'controllers/users.controller.php';
//     $response = UsersController::socialConnect($routesArray[0], $_GET['urlRedirect']);
//     echo '<pre>';
//     print_r($response);
//     echo '</pre>';
//   }
// }

/* ---------------------- INGRESO CON FACEBOOK Y GOOGLE --------------------- */

/* -------------------------------------------------------------------------- */
/*                          SOLICITUD GET DE TEMPLATE                         */
/* -------------------------------------------------------------------------- */

$url = 'templates?linkTo=active_template&equalTo=ok';
$method = 'GET';
$fields = [];

$template = CurlController::request($url, $method, $fields);

if ($template->status == 200) {
  $template = $template->results[0];
} else {
  echo '<!DOCTYPE html>
        <html lang="en">
        <head>
        <link rel="stylesheet" href="' . $path . 'views/assets/css/plugins/adminlte/adminlte.min.css">
        </head>
        <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">';
  include "pages/500/500.php";
  echo '</div>
        </body>
        </html>';

  return;
}

/* ------------------------ SOLICITUD GET DE TEMPLATE ----------------------- */

/* -------------------------------------------------------------------------- */
/*                              Datos en Arreglo                              */
/* -------------------------------------------------------------------------- */

$keywords = $template->keywords_template;

/* -------------------------------------------------------------------------- */
/*                               Datos en Objeto                              */
/* -------------------------------------------------------------------------- */

$fontFamily = json_decode($template->fonts_template)->fontFamily;
$fontBody = json_decode($template->fonts_template)->fontBody;
$fontSlide = json_decode($template->fonts_template)->fontSlide;

/* -------------------------------------------------------------------------- */
/*                                Datos en JSON                               */
/* -------------------------------------------------------------------------- */

$topColor = json_decode($template->colors_template)[0]->top;
$templateColor = json_decode($template->colors_template)[1]->template;
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $template->title_template ?></title>

  <!-- -------------------------------------------------------------------------- */
  /*                                    ICONO                                   */
  /* -------------------------------------------------------------------------- -->

  <link rel="icon" href="<?= $path ?>/views/assets/img/template/<?= $template->id_template ?>/<?= $template->icon_template ?>">

  <!-- ---------------------------------- ICONO --------------------------------- -->

  <!-- -------------------------------------------------------------------------- */
  /*                                   FUENTES                                  */
  /* -------------------------------------------------------------------------- -->

  <!-- Google Font: Source Sans Pro -->
  <?= urldecode($fontFamily) ?>

  <!-- --------------------------------- FUENTES -------------------------------- -->

  <!-- -------------------------------------------------------------------------- */
  /*                                    METAS                                   */
  /* -------------------------------------------------------------------------- -->

  <meta name="description" content="<?= $template->description_template ?>">
  <meta name="keywords" content="<?= $keywords ?>">

  <!-- ---------------------------------- METAS --------------------------------- -->

  <!-- -------------------------------------------------------------------------- */
  /*                                 CSS PLUGINS                                */
  * -------------------------------------------------------------------------- -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/fontawesome-free/css/all.min.css">
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- JDSlider -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/jdSlider/jdSlider.css">
  <!-- Notie Alert -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/notie/notie.min.css">
  <!-- Toastr Alert -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/toastr/toastr.min.css">
  <!-- Material Preloader -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/material-preloader/material-preloader.css">
  <!-- Tags Input -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/tags-input/tags-input.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Summernote -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/summernote/emoji.css">

  <!-- CodeMirror -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/codemirror/codemirror.min.css">

  <!-- Dropzone -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/dropzone/dropzone.css">

  <!-- FlexSlider -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/flexslider/flexslider.css">

  <!-- Preload -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/preload/preload.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/select2/select2-bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/plugins/adminlte/adminlte.min.css">
  <link rel="stylesheet" href="<?= $path ?>views/assets/css/template/template.css">
  <link rel="stylesheet" href="<?= $path ?>/views/assets/css/products/products.css">


  <style>
    body {
      font-family: '<?= $fontBody ?>', sans-serif;
    }

    .slideOpt h1,
    .slideOpt h2,
    .slideOpt h3 {
      font-family: '<?= $fontSlide ?>', sans-serif;
    }

    .topColor {
      background: <?= $topColor->background ?>;
      color: <?= $topColor->color ?>;
    }

    .templateColor,
    .templateColor:hover,
    a.templateColor {
      background: <?= $templateColor->background ?> !important;
      color: <?= $templateColor->color ?> !important;
    }
  </style>

  <!-- ------------------------------- CSS PLUGINS ------------------------------ -->

  <!-- -------------------------------------------------------------------------- */
  /*                                 JS PLUGINS                                 */
  /* -------------------------------------------------------------------------- -->

  <!-- jQuery -->
  <script src="<?= $path ?>views/assets/js/plugins/jquery/jquery.min.js"></script>
  <?php if (
    !empty($routesArray[0]) && $routesArray[0] == 'admin' &&
    !empty($routesArray[1]) && $routesArray[1] == 'productos' &&
    !empty($routesArray[2]) && $routesArray[2] == 'gestion'
  ) : ?>
    <!-- Bootstrap 4 -->
    <script src="<?= $path ?>views/assets/js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php else: ?>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php endif ?>
  <script src="<?= $path ?>views/assets/js/plugins/jdSlider/jdSlider.js"></script>
  <!-- KNOB -->
  <script src="<?= $path ?>views/assets/js/plugins/knob/knob.js"></script>
  <script src="<?= $path ?>views/assets/js/alerts/alerts.js"></script>
  <!-- Notie Alert -->
  <!-- https://jaredreich.com/notie/ -->
  <script src="<?= $path ?>views/assets/js/plugins/notie/notie.min.js"></script>
  <!-- Sweet Alert 2 -->
  <!-- https://sweetalert2.github.io/ -->
  <script src="<?= $path ?>views/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
  <!-- Toastr Alert-->
  <script src="<?= $path ?>views/assets/js/plugins/toastr/toastr.min.js"></script>
  <!-- Material Preloader -->
  <!-- https://www.jqueryscript.net/demo/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3/ -->
  <script src="<?= $path ?>views/assets/js/plugins/material-preloader/material-preloader.js"></script>
  <!-- Tags-Input -->
  <!-- https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/ -->
  <script src="<?= $path ?>views/assets/js/plugins/tags-input/tags-input.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= $path ?>views/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/jszip/jszip.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Bootstrap Switch -->
  <!-- https://bttstrp.github.io/bootstrap-switch/examples.html -->
  <script src="<?= $path ?>views/assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
  <!-- Summernote -->
  <!-- https://summernote.org/getting-started/#run-summernote -->
  <script src="<?= $path ?>views/assets/js/plugins/summernote/summernote-bs4.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/summernote/summernote-code-beautify-plugin.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/summernote/emoji.config.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/summernote/tam-emoji.min.js"></script>

  <!-- CodeMirror -->
  <script src="<?= $path ?>views/assets/js/plugins/codemirror/codemirror.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/codemirror/xml.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/codemirror/formatting.min.js"></script>

  <!-- Dropzone -->
  <!-- https://www.dropzone.dev/ -->
  <script src="<?= $path ?>views/assets/js/plugins/dropzone/dropzone.js"></script>

  <!-- pagination -->
  <!-- http://josecebe.github.io/twbs-pagination/ -->
  <script src="<?= $path ?>views/assets/js/plugins/twbs-pagination/twbs-pagination.min.js"></script>

  <!-- FlexSlider -->
  <!-- http://flexslider.woothemes.com/thumbnail-controlnav.html -->
  <script src="<?= $path ?>views/assets/js/plugins/flexslider/jquery.flexslider.js"></script>

  <!-- Preload -->
  <!-- https://codepen.io/tutorialesatualcance/pen/oNqObGL -->
  <!-- https://youtu.be/6_lg2D_-GSk -->
  <script src="<?= $path ?>views/assets/js/plugins/preload/preload.js"></script>

  <!-- Select2 -->
  <!-- https://github.com/select2/select2 -->
  <script src="<?= $path ?>views/assets/js/plugins/select2/select2.full.min.js"></script>

  <!-- InputMask -->
  <!-- https://github.com/RobinHerbots/Inputmask -->
  <script src="<?= $path ?>views/assets/js/plugins/input-mask/moment.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/input-mask/jquery.inputmask.min.js"></script>

  <!-- sticky -->
  <!-- https://rgalus.github.io/sticky-js/ -->
  <script src="<?= $path ?>views/assets/js/plugins/sticky/sticky.min.js"></script>

  <!-- ------------------------------- JS PLUGINS ------------------------------- -->

</head>

<body class="hold-transition sidebar-collapse layout-top-nav">

  <!-- -------------------------------------------------------------------------- */
  /*                          VERIFICACION DE USUARIOS                          */
  /* -------------------------------------------------------------------------- -->

  <?php

  if (isset($_GET['confirm'])) {

    $url = 'users?linkTo=confirm_user&equalTo=' . $_GET['confirm'];
    $method = 'GET';
    $fields = [];

    $confirm = CurlController::request($url, $method, $fields);

    if ($confirm->status == 200) {

      if (isset($_SESSION['user'])) {
        $_SESSION['user']->verification_user = 1;
      }

      $url = 'users?id=' . $confirm->results[0]->id_user . '&nameId=id_user&token=no&except=verification_user';
      $method = 'PUT';
      $fields = 'verification_user=1';

      $verification = CurlController::request($url, $method, $fields);

      if ($verification->status == 200) {
        if (isset($_SESSION['user'])) {
          $_SESSION['user']->verification_user = 1;
        }

        echo '<script>
        fncSweetAlert("success", "Felicidades su cuenta ha sido verificada, ya puede ingresar al sistema!", "/");
        </script>';
      }
    } else {

      echo '<script>
        fncSweetAlert("error", "El código de verificación esta mal escrito", "");
        </script>';
    }
  }

  ?>

  <!-- ------------------------ VERIFICACION_DE_USUARIOS ------------------------ -->

  <input type="hidden" id="urlPath" value="<?= $path ?>">
  <div class="wrapper">

    <?php
    include_once 'modules/topbar.php';
    include_once 'modules/navbar.php';
    include_once 'modules/sidebar.php';

    if (!empty($routesArray[0])) {
      if (
        $routesArray[0] == 'admin' ||
        $routesArray[0] == 'perfil' ||
        $routesArray[0] == 'salir' ||
        $routesArray[0] == 'carrito' ||
        $routesArray[0] == 'checkout' ||
        $routesArray[0] == 'thanks' ||
        $routesArray[0] == 'no-found'
      ) {
        include_once 'pages/' . $routesArray[0] . '/' . $routesArray[0] . '.php';
      } else {
        /* -------------------------------------------------------------------------- */
        /*                      BUSCAR COINCIDENCIA CON PRODUCTO                      */
        /* -------------------------------------------------------------------------- */

        $url = 'products?linkTo=url_product&equalTo=' . $routesArray[0] . '&select=url_product';
        $product = CurlController::request($url, $method, $fields);

        if ($product->status == 200) {
          include_once 'pages/product/product.php';

          /* ----------------- BUSCAR CONINCIDENCIA CON URL CATEGORIA ----------------- */
        } else {

          /* -------------------- BUSCAR COINCIDENCIA CON PRODUCTO -------------------- */

          /* -------------------------------------------------------------------------- */
          /*                   BUSCAR CONINCIDENCIA CON URL CATEGORIA                   */
          /* -------------------------------------------------------------------------- */

          $url = 'categories?linkTo=url_category&equalTo=' . $routesArray[0] . '&select=url_category';
          $category = CurlController::request($url, $method, $fields);

          if ($category->status == 200) {
            include_once 'pages/products/products.php';

            /* ----------------- BUSCAR CONINCIDENCIA CON URL CATEGORIA ----------------- */
          } else {

            /* -------------------------------------------------------------------------- */
            /*                  BUSCAR COINCIDENCIA CON URL SUBCATEGORIAS                 */
            /* -------------------------------------------------------------------------- */

            $url = 'subcategories?linkTo=url_subcategory&equalTo=' . $routesArray[0] . '&select=url_subcategory';
            $subcategory = CurlController::request($url, $method, $fields);

            if ($subcategory->status == 200) {
              include_once 'pages/products/products.php';
            } else {
              if (
                $routesArray[0] == 'free' ||
                $routesArray[0] == 'most-seen' ||
                $routesArray[0] == 'most-sold'
              ) {
                include_once 'pages/products/products.php';

                /* ---------------- BUSCAR COINCIDENCIA CON URL SUBCATEGORIAS --------------- */
              } else {

                /* -------------------------------------------------------------------------- */
                /*                             FILTRO DE BUSQUEDA                             */
                /* -------------------------------------------------------------------------- */

                //TODO: MEJORAR EL FILTRO DE BUSQUEDA

                $linkTo = [
                  'name_product',
                  'keywords_product',
                  'name_category',
                  'keywords_category',
                  'name_subcategory',
                  'keywords_subcategory'
                ];
                $totalSearch = 0;

                foreach ($linkTo as $key => $value) {
                  $totalSearch++;

                  $url = 'relations?rel=products,subcategories,categories&type=product,subcategory,category&linkTo=' . $value . '&search=' . $routesArray[0] . '&select=id_product';
                  $search = CurlController::request($url, $method, $fields);

                  if ($search->status == 200) {
                    include 'pages/products/products.php';
                    break;
                  }
                }

                if ($totalSearch == count($linkTo)) {
                  include 'pages/404/404.php';
                }

                /* --------------------------- FILTRO DE BUSQUEDA --------------------------- */
              }
            }
          }
        }
      }
    } else {
      include_once 'pages/home/home.php';
    }

    include_once 'modules/footer.php';
    include_once 'modules/modals.php';
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- AdminLTE App -->
  <script src="<?= $path ?>views/assets/js/plugins/adminlte/adminlte.min.js"></script>
  <script src="<?= $path ?>views/assets/js/products/products.js"></script>
</body>

</html>