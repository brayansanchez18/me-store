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
            $url = 'v2/checkout/orders';
            $method = 'POST';
            $fields = '{
              "intent": "CAPTURE",
              "purchase_units": [
                {
                  "reference_id": "' . $ref . '",
                  "amount": {
                    "currency_code": "MXN",
                    "value": "' . $totalCart . '"
                  }
                }
              ],
              "payment_source": {
                "paypal": {
                  "experience_context": {
                    "payment_method_preference": "IMMEDIATE_PAYMENT_REQUIRED",
                    "user_action": "PAY_NOW",
                    "return_url": "' . TemplateController::path() . 'thanks?ref=' . $ref . '",
                    "cancel_url": "' . TemplateController::path() . 'checkout"
                  }
                }
              }
						}';

            $paypal = CurlController::paypal($url, $method, $fields);

            if ($paypal->status == 'PAYER_ACTION_REQUIRED') {
              $count = 0;

              foreach ($carts as $key => $value) {

                $url = 'carts?id=' . $value->id_cart . '&nameId=id_cart&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
                $method = 'PUT';
                $fields = 'ref_cart=' . $ref . '&order_cart=' . $paypal->id . '&method_cart=' . $_POST['optradio'] . '&price_cart=' . $totalCart;

                $updateCart = CurlController::request($url, $method, $fields);

                $count++;

                if ($count == count($carts)) {
                  echo '<script>
										window.location ="' . $paypal->links[1]->href . '"
									</script>';
                }
              }
            }
          }

          /* ----------------------- PASARELA DE PAGOS DLOCAL GO ---------------------- */
          if ($_POST['optradio'] == 'dlocal') {
            $url = 'v1/payments';
            $method = 'POST';
            $fields = '{
              "amount": ' . $totalCart . ',
              "currency": "MXN",
              "country": "MX",
              "success_url":"' . TemplateController::path() . 'thanks?ref=' . $ref . '",
              "back_url": "' . TemplateController::path() . 'checkout"
						}';

            $dlocal = CurlController::dlocal($url, $method, $fields);

            if ($dlocal->status == 'PENDING') {
              $count = 0;

              foreach ($carts as $key => $value) {
                $url = 'carts?id=' . $value->id_cart . '&nameId=id_cart&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
                $method = 'PUT';
                $fields = 'ref_cart=' . $ref . '&order_cart=' . $dlocal->id . '&method_cart=' . $_POST['optradio'] . '&price_cart=' . $totalCart;

                $updateCart = CurlController::request($url, $method, $fields);

                $count++;

                if ($count == count($carts)) {
                  echo '<script>
										window.location ="' . $dlocal->redirect_url . '"
									</script>';
                }
              }
            }
          }

          /* --------------------- PASARELA DE PAGOS MERCADO PAGO --------------------- */
          if ($_POST['optradio'] == 'mercado_pago') {
            $url = 'checkout/preferences';
            $method = 'POST';
            $fields = '{
                "auto_return":"approved",
                "back_urls": {
                  "success":"' . TemplateController::path() . 'thanks?ref=' . $ref . '",
                  "pending":"' . TemplateController::path() . 'thanks?ref=' . $ref . '",
                  "failure":"' . TemplateController::path() . 'checkout"
                },
                "expires": false,
                "items": [
                  {
                    "title": "Pago en ME-STORE",
                    "quantity": 1,
                    "currency_id": "MXN",
                    "unit_price": ' . round($totalCart) . '
                  }
                ],
              "notification_url":"' . TemplateController::path() . 'thanks"
            }';

            $mercadoPago = CurlController::mercadoPago($url, $method, $fields);

            if ($mercadoPago->auto_return == 'approved') {

              $count = 0;

              foreach ($carts as $key => $value) {
                $url = 'carts?id=' . $value->id_cart . '&nameId=id_cart&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
                $method = 'PUT';
                $fields = 'ref_cart=' . $ref . '&order_cart=' . null . '&method_cart=' . $_POST['optradio'] . '&price_cart=' . $totalCart;
                $updateCart = CurlController::request($url, $method, $fields);

                $count++;

                if ($count == count($carts)) {
                  echo '<script>
										window.location ="' . $mercadoPago->init_point . '"
									</script>';
                }
              }
            }
          }
        }
      }
    }
  }
  /* ------------------ ACTUALIZAR DATOS Y PASARELAS DE PAGO ------------------ */

  /* -------------------------------------------------------------------------- */
  /*                              EDITAR UNA ORDEN                              */
  /* -------------------------------------------------------------------------- */

  public function editOrder()
  {
    if (isset($_POST['process_order'])) {

      echo '<script>
				fncSweetAlert("loading", "procesando...", "");
			</script>';

      $url = 'orders?id=' . base64_decode($_POST['idOrder']) . '&nameId=id_order&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
      $method = 'PUT';
      $fields = 'process_order=' . $_POST['process_order'] . '&track_order=' . $_POST['track_order'] . '&start_date_order=' . $_POST['start_date_order'] . '&medium_date_order=' . $_POST['medium_date_order'] . '&end_date_order=' . $_POST['end_date_order'];
      $updateOrder = CurlController::request($url, $method, $fields);

      if ($updateOrder->status == 200) {
        echo '<script>
						fncFormatInputs();
						fncSweetAlert("success","Sus datos han sido actualizados con éxito","/admin/pedidos");
					</script>';
      } else {
        if ($updateOrder->status == 303) {
          echo '<script>
						fncFormatInputs();
						fncSweetAlert("error","Token expirado, vuelva a iniciar sesión","/salir");
					</script>';
        } else {
          echo '<script>
						fncFormatInputs();
						fncToastr("error","Ocurrió un error mientras se guardaban los datos, intente de nuevo");
					</script>';
        }
      }
    }
  }

  /* ---------------------------- EDITAR UNA ORDEN ---------------------------- */
}
