<?php
$path = TemplateController::path();

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
  # code...
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
  <!-- Bootstrap 4 -->
  <!-- <script src="<?= $path ?>views/assets/js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $path ?>views/assets/js/plugins/jdSlider/jdSlider.js"></script>
  <!-- KNOB -->
  <script src="<?= $path ?>views/assets/js/plugins/knob/knob.js"></script>

  <!-- ------------------------------- JS PLUGINS ------------------------------- -->

</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <?php
    include_once 'modules/topbar.php';
    include_once 'modules/navbar.php';
    include_once 'modules/sidebar.php';
    include_once 'pages/home/home.php';
    include_once 'modules/footer.php';
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- AdminLTE App -->
  <script src="<?= $path ?>views/assets/js/plugins/adminlte/adminlte.min.js"></script>
  <script src="<?= $path ?>views/assets/js/products/products.js"></script>
</body>

</html>