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
          $email = $_POST['email_user'];
          $title = 'CONFIRMAR CORREO ELECTRÓNICO';
          $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px">Dar clic en el siguiente botón para confirmar su correo electrónico y activar su cuenta</h4>';
          $link = TemplateController::path() . '?confirm=' . $confirm_user;

          // echo $link;
          // return;

          $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

          if ($sendEmail == 'ok') {

            echo '<script>
								fncFormatInputs();
								fncMatPreloader("off");
								fncSweetAlert("success", "Su cuenta ha sido creada, revisa tu correo electrónico ' . $email . ', para activar tu cuenta", "");
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

  /* -------------------------------------------------------------------------- */
  /*                             INGRESO DE USUARIO                             */
  /* -------------------------------------------------------------------------- */

  public function login()
  {
    if (isset($_POST['login_email_user'])) {
      echo '<script>
				fncMatPreloader("on");
				fncSweetAlert("loading", "procesando...", "");
			</script>';

      if (
        preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['login_email_user'])
      ) {
        $url = 'users?login=true&suffix=user';
        $method = 'POST';
        $fields = [
          'email_user' => $_POST['login_email_user'],
          'password_user' => $_POST['login_password_user']
        ];

        $login = CurlController::request($url, $method, $fields);

        if ($login->status == 200) {
          $_SESSION['user'] = $login->results[0];

          echo '<script>
						localStorage.setItem("token-user", "' . $login->results[0]->token_user . '")
						window.location="' . TemplateController::urlRedirect() . '"
					</script>';
        } else {

          $error = null;

          if ($login->results == 'Wrong email') {
            $error = 'Correo mal escrito';
          } else {
            $error = 'Contraseña mal escrita';
          }

          echo '<div class="alert alert-danger mt-3">Error al ingresar: ' . $error . '</div>
					<script>
						fncToastr("error","Error al ingresar: ' . $error . '");
						fncMatPreloader("off");
						fncFormatInputs();
					</script>';
        }
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

  /* --------------------------- INGRESO DE USUARIO --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                   VOLVER A ENVIAR VERIFICACION DE USUARIO                  */
  /* -------------------------------------------------------------------------- */

  public function verification()
  {
    if (
      isset($_POST['new_verification']) &&
      $_POST['new_verification'] == 'yes'
    ) {
      echo '<script>
				fncMatPreloader("on");
				fncSweetAlert("loading", "procesando...", "");
			</script>';

      $confirm_user = TemplateController::genPassword(20);

      $url = 'users?id=' . $_SESSION['user']->id_user . '&nameId=id_user&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
      $method = 'PUT';
      $fields = 'confirm_user=' . $confirm_user;

      $verification = CurlController::request($url, $method, $fields);

      if ($verification->status == 200) {

        /* -------------------------------------------------------------------------- */
        /*                       ENVIAMOS EL CORREO ELECTRONICO                       */
        /* -------------------------------------------------------------------------- */

        $subject = 'Verificación - Ecommerce';
        $email = $_SESSION['user']->email_user;;
        $title = 'CONFIRMAR CORREO ELECTRÓNICO';
        $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px">Dar clic en el siguiente botón para confirmar su correo electrónico y activar su cuenta</h4>';
        $link = TemplateController::path() . '?confirm=' . $confirm_user;

        $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

        if ($sendEmail == 'ok') {

          echo '<script>
								fncFormatInputs();
								fncMatPreloader("off");
								fncSweetAlert("success", "Se ha enviado la verificación su correo: ' . $email . ', para activar su cuenta", "");
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

        /* --------------------- ENVIAMOS EL CORREO ELECTRONICO --------------------- */
      }
    }
  }

  /* ----------------- VOLVER A ENVIAR VERIFICACION DE USUARIO ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                           MODIFICAR INFO USUARIO                           */
  /* -------------------------------------------------------------------------- */

  public function modify()
  {
    if (isset($_POST['state_user'])) {
      echo '<script>
        fncMatPreloader("on");
        fncSweetAlert("loading", "procesando...", "");
      </script>';

      $password_user = null;

      if (!empty($_POST['password_user'])) {

        $password_user = crypt($_POST['password_user'], '$2a$07$azybxcags23425sdg23sdfhsd$');

        $fields = 'name_user=' . TemplateController::capitalize(trim($_POST['name_user'])) . '&password_user=' . $password_user . '&state_user=' . TemplateController::capitalize(trim($_POST['state_user'])) . '&municipality_user=' . TemplateController::capitalize(trim($_POST['municipality_user'])) . '&zip_code_user=' . trim($_POST['zip_code_user']) . '&address_user=' . trim(urlencode($_POST['address_user'])) . '&phone_user=' . str_replace('-', '', $_POST['phone_user']);
      } else {

        $fields = 'name_user=' . TemplateController::capitalize(trim($_POST['name_user'])) . '&state_user=' . TemplateController::capitalize(trim($_POST['state_user'])) . '&municipality_user=' . TemplateController::capitalize(trim($_POST['municipality_user'])) . '&zip_code_user=' . trim($_POST['zip_code_user']) . '&address_user=' . trim(urlencode($_POST['address_user'])) . '&phone_user=' . str_replace('-', '', $_POST['phone_user']);
      }

      $url = 'users?id=' . $_SESSION['user']->id_user . '&nameId=id_user&token=' . $_SESSION['user']->token_user . '&table=users&suffix=user';
      $method = 'PUT';

      $modify = CurlController::request($url, $method, $fields);

      if ($modify->status == 200) {

        $_SESSION['user']->name_user = TemplateController::capitalize(trim($_POST['name_user']));
        $_SESSION['user']->state_user = TemplateController::capitalize(trim($_POST['state_user']));
        $_SESSION['user']->municipality_user = TemplateController::capitalize(trim($_POST['municipality_user']));
        $_SESSION['user']->zip_code_user = trim($_POST['zip_code_user']);
        $_SESSION['user']->address_user = trim($_POST['address_user']);
        $_SESSION['user']->phone_user = str_replace('-', '', $_POST['phone_user']);

        echo '<script>
						fncFormatInputs();
						fncMatPreloader("off");
						fncToastr("success", "Datos actualizado con exito");
					</script>
				';
      }
    }
  }

  /* ------------------------- MODIFICAR INFO USUARIO ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                            RECUPERAR CONTRASEÑA                            */
  /* -------------------------------------------------------------------------- */

  public function resetPassword()
  {
    if (isset($_POST['resetPassword'])) {

      /* -------------------------------------------------------------------------- */
      /*                              VALIDAR SINTAXIS                              */
      /* -------------------------------------------------------------------------- */

      if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['resetPassword'])) {

        /* -------------------------------------------------------------------------- */
        /*                        SI EL USUARIO ESTA REGISTRADO                       */
        /* -------------------------------------------------------------------------- */

        $url = 'users?linkTo=email_user&equalTo=' . $_POST['resetPassword'] . '&select=id_user';
        $method = 'GET';
        $fields = [];

        $user = CurlController::request($url, $method, $fields);

        if ($user->status == 200) {

          $newPassword = TemplateController::genPassword(11);

          $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

          /* -------------------------------------------------------------------------- */
          /*                         ACTUALIZAR EN BASE DE DATOS                        */
          /* -------------------------------------------------------------------------- */


          $url = 'users?id=' . $user->results[0]->id_user . '&nameId=id_user&token=no&except=password_user';
          $method = 'PUT';
          $fields = 'password_user=' . $crypt;

          $updatePassword = CurlController::request($url, $method, $fields);

          if ($updatePassword->status == 200) {

            $subject = 'Solicitud de nueva contraseña - Ecommerce';
            $email = $_POST['resetPassword'];
            $title = 'SOLICITUD DE NUEVA CONTRASEÑA';
            $message = '<h4 style="font-weight: 100; color:#999; padding:0px 20px"><strong>Su nueva contraseña: ' . $newPassword . '</strong></h4>
							<h4 style="font-weight: 100; color:#999; padding:0px 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>';
            $link = TemplateController::path();
            $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

            if ($sendEmail == 'ok') {

              echo '<script>
									fncFormatInputs();
									fncMatPreloader("off");
									fncToastr("success", "Su nueva contraseña ha sido enviada con éxito, por favor revise su correo electrónico ' . $email . '");
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
          }

          /* ----------------------- ACTUALIZAR EN BASE DE DATOS ---------------------- */
        } else {

          echo '<script>
          fncFormatInputs();
          fncNotie("error", "El correo no existe en la base de datos");
          fncMatPreloader("off");
						</script>
					';
        }

        /* ---------------------- SI EL USUARIO ESTA REGISTRADO --------------------- */
      }

      /* ---------------------------- VALIDAR SINTAXIS ---------------------------- */
    }
  }

  /* -------------------------- RECUPERAR CONTRASEÑA -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                         CONEXION CON REDES SOCIALES                        */
  /* -------------------------------------------------------------------------- */

  static public function socialConnect($type, $urlRedirect)
  {
    // if ($type == 'facebook') {

    //   /* -------------------------------------------------------------------------- */
    //   /*                       CONEXION CON LA APP DE FACEBOOK                      */
    //   /* -------------------------------------------------------------------------- */

    //   $fb = new \Facebook\Facebook([
    //     'app_id' => '1111047793596332',
    //     'app_secret' => 'd74fe710bdd7f09b42979dd0fa5f6fd6',
    //     'default_graph_version' => 'v2.10',
    //     //'default_access_token' => '{access-token}', // optional
    //   ]);

    //   /* --------------------- CONEXION CON LA APP DE FACEBOOK -------------------- */

    //   /* -------------------------------------------------------------------------- */
    //   /*                  CREAR LA REDIRECCION A LA API DE FACEBOOK                 */
    //   /* -------------------------------------------------------------------------- */

    //   $handler = $fb->getRedirectLoginHelper();

    //   /* ---------------- CREAR LA REDIRECCION A LA API DE FACEBOOK --------------- */

    //   /* -------------------------------------------------------------------------- */
    //   /* ACTIVAMOS LA URL DE FACEBOOK CON LOS DOS PARAMETROS:
    //   URL DE REGRESO
    //   Y LOS DATOS QUE SOLICITAMOS */
    //   /* -------------------------------------------------------------------------- */

    //   $data = ['email'];

    //   if (!isset($_GET['code'])) {

    //     $fullUrl = $handler->getLoginUrl(TemplateController::urlRedirect(), $data);

    //     /* ----------------------- REDIRECCIONAMOS A FACEBOOK ----------------------- */

    //     echo '<script>
    // 			window.location = "' . $fullUrl . '";
    // 		</script>';
    //   } else {

    //     /* ----------------- SOLICITAMOS EL ACCESS TOKEN DE FACEBOOK ---------------- */


    //     try {
    //       $accessToken = $handler->getAccessToken();
    //     } catch (\Facebook\Exceptions\FacebookResponseException $e) {

    //       echo '<script>
    // 					fncNotie("error", "Response Exception: ' . $e->getMessage() . '");
    // 				</script>
    // 			';
    //       exit();
    //     } catch (\Facebook\Exceptions\FacebookSDKException $e) {

    //       echo '<script>
    // 					fncNotie("error", "SDK Exception: ' . $e->getMessage() . '");
    // 				</script>
    // 			';
    //       exit();
    //     }

    //     $oAuth2Client = $fb->getOAuth2Client();
    //     $userData = null;

    //     if (!$accessToken->isLongLived()) {
    //       $accessToken = $oAuth2Client->getLongLivedAccesToken($accessToken);
    //       $response = $fb->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
    //       $userData = $response->getGraphNode()->asArray();
    //     }

    //     if (!empty($userData)) {

    //       /* -------------------------------------------------------------------------- */
    //       /*                PREGUNTAMOS SI EL USUARIO YA ESTA REGISTRADO                */
    //       /* -------------------------------------------------------------------------- */

    //       $url = 'users?linkTo=email_user&equalTo=' . $userData['email'];
    //       $method = "GET";
    //       $fields = array();

    //       $user = CurlController::request($url, $method, $fields);

    //       /* -------------------- SI EL USUARIO NO ESTA REGISTRADO -------------------- */

    //       if ($user->status != 200) {

    //         $url = 'users?register=true&suffix=user';
    //         $method = 'POST';
    //         $fields = [
    //           'name_user' => $userData['first_name'] . ' ' . $userData['last_name'],
    //           'email_user'  => $userData['email'],
    //           'method_user' => 'facebook',
    //           'verification_user' => 1,
    //           'date_created_user' => date('Y-m-d')
    //         ];

    //         $register = CurlController::request($url, $method, $fields);

    //         if ($register->status == 200) {

    //           $url = 'users?linkTo=email_user&equalTo=' . $userData['email'];
    //           $method = 'GET';
    //           $fields = [];

    //           $login = CurlController::request($url, $method, $fields);

    //           if ($login->status == 200) {
    //             $_SESSION['user'] = $login->results[0];

    //             echo '<script>
    // 							localStorage.setItem("token-user", "' . $login->results[0]->token_user . '")
    // 							window.location="' . $urlRedirect . '"
    // 						</script>';
    //           }
    //         }
    //       } else {

    //         if ($user->results[0]->method_user != 'facebook') {
    //           echo '<script>
    // 						fncFormatInputs();
    // 						fncMatPreloader("off");
    // 						fncSweetAlert("error", "Su correo electrónico ya está registrado con el método de ingreso ' . $user->results[0]->method_user . '","' . $urlRedirect . '");
    // 					</script>';
    //           return;
    //         }

    //         // $url = 'users?login=true&suffix=user';
    //         // $method = 'POST';
    //         // $fields = [
    //         //   'email_user' => $user->results[0]->email_user,
    //         //   'password_user' => ''
    //         // ];

    //         // $login = CurlController::request($url, $method, $fields);

    //         // if ($login->status == 200) {
    //         // $_SESSION['user'] = $login->results[0];
    //         $_SESSION['user'] = $user->results[0];

    //         echo '<script>
    // 							localStorage.setItem("token-user", "' . $user->results[0]->token_user . '")
    // 							window.location="' . $urlRedirect . '"
    // 						</script>';
    //         // }
    //       }

    //       /* -------------- PREGUNTAMOS SI EL USUARIO YA ESTA REGISTRADO -------------- */
    //     }
    //   }
    // }

    if ($type == 'google') {
    }
  }

  /* ----------------------- CONEXION CON REDES SOCIALES ---------------------- */
}
