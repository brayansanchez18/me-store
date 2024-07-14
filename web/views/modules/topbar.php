<?php

/* -------------------------------------------------------------------------- */
/*                         DATOS DE LAS REDES SOCIALES                        */
/* -------------------------------------------------------------------------- */

$url = 'socials';
$method = 'GET';
$fields = [];

$socials = CurlController::request($url, $method, $fields);

if ($socials->status == 200) {
  $socials = $socials->results;
}

/* ----------------------- DATOS DE LAS REDES SOCIALES ---------------------- */

?>
<div class="container-fluid topColor">
  <div class="container">
    <div class="d-flex justify-content-between">
      <div class="p-2">
        <div class="d-flex justify-content-center">

          <?php foreach ($socials as $key => $value) : ?>
            <div class="p-2">
              <a href="<?= $value->url_social ?>" target="_blank">
                <i class="<?= $value->icon_social ?> <?= $value->color_social ?>"></i>
              </a>
            </div>
          <?php endforeach ?>

        </div>
      </div>


      <div class="p-2">
        <div class="d-flex justify-content-center small">
          <div class="p-2">
            <a href="/perfil" class="text-white">
              Ingresar
            </a>
          </div>
          <div class="p-2">|</div>
          <div class="p-2">
            <a href="/salir" class="text-white">
              Crear Cuenta
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>