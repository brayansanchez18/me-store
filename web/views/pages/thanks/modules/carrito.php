<div class="card bg-white">
  <?php if (!empty($carts)): $totalCart = 0; ?>
    <div class="card-body">
      <?php foreach ($carts as $key => $value): ?>
        <div class="row" style="position:relative;">
          <!-- -------------------------------- PRODUCTO -------------------------------- -->

          <div class="col-12 col-lg-8 text-left">
            <a href="/<?= $value->url_product ?>">
              <div class="media">
                <figure class="imgProduct">
                  <?php if ($value->type_variant == 'gallery'): ?>
                    <img src="<?= $path ?>views/assets/img/products/<?= $value->url_product ?>/<?= json_decode($value->media_variant)[0] ?>" class="img-thumbnail mr-3" style="width:80px">
                  <?php else: $arrayYT = explode('/', $value->media_variant) ?>
                    <img src="http://img.youtube.com/vi/<?= end($arrayYT) ?>/maxresdefault.jpg" class="img-thumbnail mr-3" style="width:80px">
                  <?php endif ?>
                </figure>

                <div class="media-body">
                  <p class="m-0 font-weight-bold"><?php echo $value->name_product ?> </p>
                  <small class="m-0"><?= $value->description_variant ?></small> x
                  <small class="m-0"><?= $value->quantity_cart ?></small>
                </div>
              </div>
            </a>
          </div>

          <!-- -------------------------------- SUBTOTAL -------------------------------- -->
          <div class="col-6 col-lg-4 text-center mt-3">
            <span class="d-block d-lg-none">Subtotal:</span>
            $<span class="subtotalCart_<?= $key ?> subtotalCart">

              <?php
              if ($value->offer_variant > 0) {
                echo number_format(($value->quantity_cart * $value->offer_variant), 2);
              } else {
                echo number_format(($value->quantity_cart * $value->price_variant), 2);
              }
              ?>
            </span>
          </div>

          <?php if ($key < count($carts) - 1): ?>
            <hr class="mt-3  px-0" style="border:1px solid #ccc">
          <?php endif ?>
        </div>

        <?php
        if ($value->offer_variant > 0) {
          $totalCart += $value->quantity_cart * $value->offer_variant;
        } else {
          $totalCart += $value->quantity_cart * $value->price_variant;
        }
        ?>
      <?php endforeach ?>
    </div>

    <!-- ---------------------------------- TOTAL --------------------------------- -->
    <div class="card-footer bg-light">
      <div class="row">
        <div class="col-3 col-lg-8 text-right font-weight-bold">TOTAL:</div>
        <div class="col-3 col-lg-4 text-center font-weight-bold">
          MXN$ <span class="totalCart"><?= number_format($totalCart, 2)  ?></span>
        </div>
      </div>
    </div>
  <?php endif ?>
</div>


<?php if (isset($_SESSION["user"])): ?>
  <a href="/perfil/shopping" class="mt-4 btn btn-default btn-block templateColor border-0 rounded py-2 text-uppercase">Ir a mis compras</a>
<?php else: ?>
  <a href="#login" class="mt-4 btn btn-default btn-block templateColor border-0 rounded py-2 text-uppercase" data-bs-toggle="modal">Ir a mis compras</a>
<?php endif ?>