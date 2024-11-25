<?php

$select = 'id_product,name_product,url_product,info_product,views_product';
$url = 'relations?rel=variants,products&type=variant,product&linkTo=url_product&equalTo=' . $routesArray[0] . '&select=' . $select;
$method = 'GET';
$fields = [];

$product = CurlController::request($url, $method, $fields);

if ($product->status == 200) {
  $product = $product->results[0];
} else {
  echo '<script>
  window.location = "/404";
  </script>';
}

/* -------------------------------------------------------------------------- */
/*                   TREEMOS LAS VARIANTES DE LOS PRODUCTOS                   */
/* -------------------------------------------------------------------------- */

if (!empty($product)) {
  $select = '*';
  $url = 'variants?linkTo=id_product_variant&equalTo=' . $product->id_product . '&select=' . $select;
  $variants = CurlController::request($url, $method, $fields)->results;

  $product->variants = $variants;
}

/* ----------------- TRAEMOS LAS VARIANTES DE LOS PRODUCTOS ----------------- */
?>

<link rel="stylesheet" href="<?= $path ?>views/assets/css/product/product.css">

<div class="container-fluid bg-white">
  <hr style="color:#000">

  <div class="container py-4">
    <div class="row row-cols-1 row-cols-md-2">
      <!-- -------------------------------------------------------------------------- */
      /*                           TITULLO PRODUCTO MOVIL                           */
      /* -------------------------------------------------------------------------- -->

      <h1 class="d-block d-md-none text-center">
        <?= $product->name_product ?>
      </h1>

      <!-- -------------------------- TITULO PRODUCTO MOVIL ------------------------- -->

      <!-- -------------------------------------------------------------------------- */
      /*                               BLOQUE GALERIA                               */
      /* -------------------------------------------------------------------------- -->

      <div class="col">
        <figure class="blockMedia" style="z-index: 200 !important;">
          <?php if ($product->variants[0]->type_variant == 'gallery'): ?>
            <div id="slider" class="flexslider" style="margin-bottom:-2px">
              <ul class="slides">
                <?php foreach (json_decode($product->variants[0]->media_variant) as $key => $value): ?>
                  <li>
                    <img
                      src="/views/assets/img/products/<?= $product->url_product ?>/<?= $value ?>"
                      class="img-thumbnail">
                  </li>
                <?php endforeach ?>
              </ul>
            </div>

            <div id="carousel" class="flexslider d-none d-md-block" style="margin-bottom:20px">
              <ul class="slides">
                <?php foreach (json_decode($product->variants[0]->media_variant) as $key => $value): ?>
                  <li>
                    <img
                      src="/views/assets/img/products/<?= $product->url_product ?>/<?= $value ?>"
                      class="img-thumbnail">
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
          <?php else: $video = explode("/", $product->variants[0]->media_variant); ?>
            <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= end($video) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          <?php endif ?>
        </figure>
      </div>

      <!-- ----------------------------- BLOQUE GALERIA ----------------------------- -->

      <!-- -------------------------------------------------------------------------- */
      /*                               BLOQUE PRODUCTO                              */
      /* -------------------------------------------------------------------------- -->

      <div class="col">
        <!-- --------------------------------- TITULO --------------------------------- -->
        <h1 class="d-none d-md-block text-center">
          <?= $product->name_product ?>
        </h1>
        <!-- --------------------------------- TITULO --------------------------------- -->

        <!-- ----------------------------- PRECIO Y OFERTA ---------------------------- -->

        <?php if ($product->variants[0]->offer_variant > 0): ?>
          <div class="blockPrice">
            <h5 class="my-3 text-center font-weight-bold text-danger">
              ¡Aprovecha la PROMO y llévalo a un increíble precio!
              <br>
              ↓↓↓
            </h5>

            <h4 class="text-center">
              ANTES
              <s>
                $<?= number_format($product->variants[0]->price_variant, 2) ?>
              </s>
            </h4>

            <h3 class="text-center">
              <span class="text-success pt-4">
                AHORA $<?= number_format($product->variants[0]->offer_variant, 2) ?>
              </span>
              <span class="ml-2 px-2 p-1 small rounded-pill"
                style="font-size: 16px; position:relative; top:-4px; border:2px solid #000 !important">
                AHORRE $<?= number_format(($product->variants[0]->price_variant - $product->variants[0]->offer_variant), 2) ?>
              </span>
            </h3>
          </div>

          <!-- -------------------------- DESCONTADOR DE TIEMPO ------------------------- -->
          <div
            class="container-fluid countdown"
            dsize="col-12"
            dlanguage="es"
            dtimezone="America/Mexico_City"
            ddate="<?php if ($product->variants[0]->end_offer_variant != "0000-00-00"): ?><?php echo $product->variants[0]->end_offer_variant ?><?php else: ?><?php echo date("Y-m-d") ?><?php endif ?> 00:00"
            dbackground="#009B9D"
            ddigitscolor="#333"
            dunitscolor="#333"
            dcycle="1"
            style="position:relative;">
            <div class="container">
              <div class="row">
                <div class="sizeCountdown col">
                  <h5 class="medium colorText text-dark text-center font-weight-light">
                    La oferta termina en:
                  </h5>
                  <iframe class="frame-countdown w-100" src="" frameborder="0" scrolling="no"></iframe>
                </div>
              </div>
            </div>
          </div>

          <script src="<?= $path ?>views/assets/js/plugins/countdown/countdown.min.js"></script>
          <!-- -------------------------- DESCONTADOR DE TIEMPO ------------------------- -->
        <?php else: ?>

          <div class="blockPrice">
            <h2 class="text-center">
              <span class="text-success pt-4">
                MXN $<?= number_format($product->variants[0]->price_variant, 2) ?>
              </span>
            </h2>
          </div>
          <div id="contenedor-contador" class="d-none">
            <div
              class="container-fluid countdown"
              dsize="col-12"
              dlanguage="es"
              dtimezone="America/Mexico_City"
              ddate="<?php if ($product->variants[0]->end_offer_variant != "0000-00-00"): ?><?php echo $product->variants[0]->end_offer_variant ?><?php else: ?><?php echo date("Y-m-d") ?><?php endif ?> 00:00"
              dbackground="#009B9D"
              ddigitscolor="#333"
              dunitscolor="#333"
              dcycle="1"
              style="position:relative;">
              <div class="container">
                <div class="row">
                  <div class="sizeCountdown col">
                    <h5 class="medium colorText text-dark text-center font-weight-light">
                      La oferta termina en:
                    </h5>
                    <iframe class="frame-countdown w-100" src="" frameborder="0" scrolling="no"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script src="<?= $path ?>views/assets/js/plugins/countdown/countdown.min.js"></script>
        <?php endif ?>

        <!-- ----------------------------- PRECIO Y OFERTA ---------------------------- -->

        <!-- -------------------------------- VARIANTES ------------------------------- -->

        <?php if (count($product->variants) > 1): ?>
          <div class="my-4">
            <?php foreach ($product->variants as $key => $value): ?>
              <label class="form-check-label" for="radio_<?= $key ?>">
                <h4 class="text-center border rounded-pill py-2 px-4 btn bg-light">
                  <div class="form-check font-weight-bold">
                    <input
                      type="radio"
                      class="form-check-input changeVariant"
                      variant='<?= json_encode($product->variants[$key]) ?>'
                      url="<?= $product->url_product ?>"
                      id="radio_<?= $key ?>"
                      value="option_<?= $key ?>"
                      name="optradio"
                      <?= ($key == 0) ? 'checked' : '' ?>>
                    <?= $value->description_variant ?>
                  </div>
                </h4>
              </label>
            <?php endforeach ?>
          </div>
        <?php endif ?>

        <!-- -------------------------------- VARIANTES ------------------------------- -->

        <!-- ---------------------------------- STOCK --------------------------------- -->

        <?php if ($product->variants[0]->type_variant == "gallery"): ?>
          <div class="blockStock">
            <p class="lead font-weight-bold">
              Unidades disponibles: <?= $product->variants[0]->stock_variant ?>
            </p>
          </div>
        <?php endif ?>

        <!-- ---------------------------------- STOCK --------------------------------- -->

        <!-- ----------------------------- BOTON DE COMPRA ---------------------------- -->
        <div class="row my-4">
          <?php if ($product->variants[0]->type_variant == "gallery"): ?>
            <div class="col-12 col-md-3 blockQuantity">
              <div class="input-group mb-3 mt-2">
                <span class="input-group-text btnInc" type="btnMin">
                  <i class="fas fa-minus"></i>
                </span>
                <input
                  type="number"
                  class="form-control text-center showQuantity"
                  onwheel="return false;"
                  value="1">
                <span class="input-group-text btnInc" type="btnMax">
                  <i class="fas fa-plus"></i>
                </span>
              </div>
            </div>

            <div class="col-12 col-md-9">
              <button
                class="btn btn-dark btn-block font-weight-bold py-3 pulseAnimation 
                <?= (isset($_SESSION['user'])) ? 'addCart' : '' ?>"
                <?= (!isset($_SESSION['user'])) ? 'data-bs-toggle="modal" data-bs-target="#login"' : '' ?>
                idProduct="<?= $product->id_product ?>"
                idVariant="<?= $product->variants[0]->id_variant ?>"
                priceVariant="<?= ($product->variants[0]->offer_variant > 0) ? $product->variants[0]->offer_variant : $product->variants[0]->price_variant ?>"
                quantity="1">AGREGAR AL CARRITO</button>
            </div>
          <?php else: ?>
            <div class="col-12">
              <button
                class="btn btn-dark btn-block font-weight-bold py-3 pulseAnimation 
                <?= (isset($_SESSION['user'])) ? 'addCart' : '' ?>"
                <?= (!isset($_SESSION['user'])) ? 'data-bs-toggle="modal" data-bs-target="#login"' : '' ?>
                idProduct="<?= $product->id_product ?>"
                idVariant="<?= $product->variants[0]->id_variant ?>"
                priceVariant="<?= ($product->variants[0]->offer_variant > 0) ? $product->variants[0]->offer_variant : $product->variants[0]->price_variant ?>"
                quantity="1">AGREGAR AL CARRITO</button>
            </div>
          <?php endif ?>
        </div>
        <!-- ----------------------------- BOTON DE COMPRA ---------------------------- -->

        <!-- ------------------------- DESCIPCION DEL PRODUCTO ------------------------ -->
        <div class="text-center">
          <?= $product->info_product ?>
        </div>
        <!-- ------------------------- DESCIPCION DEL PRODUCTO ------------------------ -->
      </div>
      <!-- ----------------------------- BLOQUE PRODUCTO ---------------------------- -->
    </div>
  </div>
</div>

<script src="<?= $path ?>views/assets/js/product/product.js"></script>