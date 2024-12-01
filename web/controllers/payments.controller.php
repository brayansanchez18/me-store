<?php

class PaymentsController
{

  /* -------------------------------------------------------------------------- */
  /*                    ACTUALIZAR DATOS Y PASARELAS DE PAGO                    */
  /* -------------------------------------------------------------------------- */

  public function payment()
  {
    if (isset($_POST['optradio'])) {
      // echo '<script>
      // 	fncMatPreloader("on");
      // 	fncSweetAlert("loading", "procesando para pagar...", "");
      // </script>';

      /* -------------------------------------------------------------------------- */
      /*                     ACTUALIZAR DATOS DEL USUARIO EN BD                     */
      /* -------------------------------------------------------------------------- */

      $url = 'users?id=' . $_SESSION['user']->id_user . '&nameId=id_user&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
      $method = 'PUT';
      $fields = 'name_user=' . TemplateController::capitalize(trim($_POST['name_user'])) . '&state_user=' . TemplateController::capitalize(trim($_POST['state_user'])) . '&municipality_user=' . TemplateController::capitalize(trim($_POST['municipality_user'])) . '&zip_code_user=' . trim($_POST['zip_code_user']) . '&address_user=' . trim(urlencode($_POST['address_user'])) . '&phone_user=' . str_replace('-', '', $_POST['phone_user']);

      $updateUser = CurlController::request($url, $method, $fields);

      /* ------------------- ACTUALIZAR DATOS DEL USUARIO EN BD ------------------- */

      if ($updateUser->status == 200) {

        /* -------------------------------------------------------------------------- */
        /*                          TRAER CARRITO DE COMPRAS                          */
        /* -------------------------------------------------------------------------- */

        $url = "relations?rel=carts,variants,products&type=cart,variant,product&linkTo=id_user_cart&equalTo=" . $_SESSION['user']->id_user;
        $method = 'GET';
        $fields = [];

        $carts = CurlController::request($url, $method, $fields);

        /* ------------------------ TRAER CARRITO DE COMPRAS ------------------------ */

        if ($carts->status == 200) {
          $carts = $carts->results;
          $totalCart = 0;

          foreach ($carts as $key => $value) {
            if ($value->offer_variant == 0) {
              $totalCart += $value->price_variant * $value->quantity_cart;
            } else {
              $totalCart += $value->offer_variant * $value->quantity_cart;
            }
          }

          $ref = TemplateController::genCodec(1000);

          /* ------------------------- PASARELA DE PAGO PAYPAL ------------------------ */
          if ($_POST['optradio'] == 'paypal') {
            echo '<script>
              window.location ="' . TemplateController::path() . 'thanks?ref=' . $ref . '"
            </script>';
          }

          /* ----------------------- PASARELA DE PAGOS DLOCAL GO ---------------------- */
          if ($_POST['optradio'] == 'dlocal') {
            echo '<script>
              window.location ="' . TemplateController::path() . 'thanks?ref=' . $ref . '"
            </script>';
          }

          /* --------------------- PASARELA DE PAGOS MERCADO PAGO --------------------- */
          if ($_POST['optradio'] == 'mercado_pago') {
            echo '<script>
              window.location ="' . TemplateController::path() . 'thanks?ref=' . $ref . '"
            </script>';
          }
        }
      }
    }
  }
  /* ------------------ ACTUALIZAR DATOS Y PASARELAS DE PAGO ------------------ */
}
