<?php

class UsersController
{

  /* -------------------------------------------------------------------------- */
  /*                            REGISTRO DE USUARIOS                            */
  /* -------------------------------------------------------------------------- */

  public function register()
  {
    if (isset($_POST['email_user'])) {
      echo '<script>
				fncMatPreloader("on");
				fncSweetAlert("loading", "procesando...", "");
			</script>';

      if (
        preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name_user"]) &&
        preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_user"])
      ) {

        /* -------------------------------------------------------------------------- */
        /*                            REGISTRO DE USUARIOS                            */
        /* -------------------------------------------------------------------------- */

        $confirm_user = TemplateController::genPassword(20);

        $url = 'users?register=true&suffix=user';
        $method = 'POST';
        $fields = [
          'name_user' => TemplateController::capitalize(trim($_POST['name_user'])),
          'email_user'  => $_POST['email_user'],
          'password_user' => $_POST['password_user'],
          'method_user' => 'directo',
          'confirm_user' => $confirm_user,
          'date_created_user' => date('Y-m-d')
        ];

        $register = CurlController::request($url, $method, $fields);

        if ($register->status == 200) {

          /* -------------------------------------------------------------------------- */
          /*                     ENVIAMOS EL CORREO DE CONFIRMACION                     */
          /* -------------------------------------------------------------------------- */

          $subject = 'Registro - Ecommerce';
          $email = $_POST["email_user"];
          $title = 'CONFIRMAR CORREO ELECTRÓNICO';
          $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px">Dar clic en el siguiente botón para confirmar su correo electrónico y activar su cuenta</h4>';
          $link = TemplateController::path() . '?confirm=' . $confirm_user;

          // echo $link;
          // return;

          $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

          if ($sendEmail == "ok") {

            echo '<script>
								fncFormatInputs();
								fncMatPreloader("off");
								fncSweetAlert("success", "Su cuenta ha sido creada, revisa tu correo electrónico para activar tu cuenta", "");
							</script>
						';
          } else {

            echo '<script>
							fncFormatInputs();
							fncMatPreloader("off");
							fncNotie("error", "' . $sendEmail . '");
							</script>
						';
          }

          /* ------------------- ENVIAMOS EL CORREO DE CONFIRMACION ------------------- */
        }

        /* -------------------------- REGISTRO DE USUARIOS -------------------------- */
      } else {
        echo '<div class="alert alert-danger mt-3">Error de sintaxis en los campos</div>
        <script>
          fncToastr("error","Error de sintaxis en los campos");
          fncMatPreloader("off");
          fncFormatInputs();
        </script>
				';
      }
    }
  }

  /* -------------------------- REGISTRO DE USUARIOS -------------------------- */
}
