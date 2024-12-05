<?php

if (isset($_GET['ref'])) {
  $status = 'pending';

  /* -------------------------------------------------------------------------- */
  /*                            CONSULTAR REFERENCIA                            */
  /* -------------------------------------------------------------------------- */

  $url = 'carts?linkTo=ref_cart&equalTo=' . $_GET['ref'];
  // $url = "relations?rel=carts,variants,products&type=cart,variant,product&linkTo=ref_cart&equalTo=" . $_GET["ref"];
  $method = 'GET';
  $fields = [];

  $refs = CurlController::request($url, $method, $fields);
  // $carts = CurlController::request($url, $method, $fields);

  if ($refs->status == 200) {

    /* ----------------------- VALIDAR EL PAGO CON PAYPAL ----------------------- */
    if ($refs->results[0]->method_cart == 'paypal') {
      $url = 'v2/checkout/orders/' . $refs->results[0]->order_cart;
      $paypal = CurlController::paypal($url, $method, $fields);

      if ($paypal->status == 'APPROVED') {
        $status = 'ok';
      }
    }

    /* ------------------------- VALIDAR PAGO CON DLOCAL ------------------------ */
    if ($refs->results[0]->method_cart == 'dlocal') {
      $url = 'v1/payments/' . $refs->results[0]->order_cart;
      $dlocal = CurlController::dlocal($url, $method, $fields);

      if ($dlocal->status == 'PAID') {
        $status = 'ok';
      }
    }

    /* -------------------- VALIDAR EL PAGO CON MERCADO PAGO -------------------- */
    if ($refs->results[0]->method_cart == 'mercado_pago') {
      if ($refs->results[0]->order_cart == '') {
        if (isset($_GET['payment_id'])) {
          $count = 0;

          foreach ($carts as $key => $value) {
            $count++;
            $url = 'carts?id=' . $value->id_cart . '&nameId=id_cart&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
            $method = 'PUT';
            $fields = 'order_cart=' . $_GET['payment_id'];
            // $value->order_cart = $_GET['payment_id'];
            $updateCart = CurlController::request($url, $method, $fields);

            if ($count == count($carts)) {
              $url = 'v1/payments/' . $_GET['payment_id'];
              $method = 'GET';
              $fields = [];

              $mercadoPago = CurlController::mercadoPago($url, $method, $fields);

              if ($mercadoPago->status == 'approved') {
                $status = 'ok';
              }
            }
          }
        }
      } else {
        $url = 'v1/payments/' . $refs->results[0]->order_cart;
        $method = 'GET';
        $fields = [];
        $mercadoPago = CurlController::mercadoPago($url, $method, $fields);

        if ($mercadoPago->status == 'approved') {
          $status = 'ok';
        }
      }
    }
  }

  /* -------------------------- CONSULTAR REFERENCIA -------------------------- */
} else {
  echo '<script>
    window.location = "' . $path . '404";
  </script>';
}
?>

<div class="container-fluid bg-light border mb-2">
  <div class="container py-3">
    <div class="d-flex flex-row-reverse lead small">
      <div class="px-1 font-weight-bold">¡Gracias por su compra!</div>
      <div class="px-1">/</div>
      <div class="px-1"><a href="/">Inicio</a></div>
    </div>
  </div>
</div>

<div class="container my-4">
  <div class="card">
    <div class="card-body bg-light">
      <div class="row row-cols-1 row-cols-lg-2">
        <div class="col">
          <?php include 'modules/datos.php' ?>
        </div>

        <div class="col">
          <?php include 'modules/carrito.php' ?>
        </div>
      </div>
    </div>
  </div>
</div>