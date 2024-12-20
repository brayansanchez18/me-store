<?php

class AdminsControllers
{

  /* -------------------------------------------------------------------------- */
  /*                          LOGIN DE ADMINISTRADORES                          */
  /* -------------------------------------------------------------------------- */

  public function login()
  {
    if (isset($_POST['loginAdminEmail'])) {

      /* -------------------------------- PRELOADER ------------------------------- */
      echo '<script>
        fncMatPreloader("on")
      </script>';

      /* -------------------------- PRELOADER SWEET ALERT ------------------------- */
      // echo '<script>
      //   fncSweetAlert("loading", "", "");
      // </script>';

      if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['loginAdminEmail'])) {

        $url = 'admins?login=true&suffix=admin';
        $method = 'POST';
        $fields = [
          'email_admin' => $_POST['loginAdminEmail'],
          'password_admin' => $_POST['loginAdminPass']
        ];

        $login = CurlController::request($url, $method, $fields);

        if ($login->status == 200) {
          $_SESSION['admin'] = $login->results[0];

          echo '<script>fncFormatInputs();
          localStorage.setItem("token-admin", "' . $login->results[0]->token_admin . '");
          localStorage.setItem("id_admin", "' . base64_encode($login->results[0]->id_admin) . '");
          location.reload();</script>';
        } else {
          $error = null;

          if ($login->results == 'Wrong email') {
            $error = 'Correo erroneo';
          } else {
            $error = 'Contraseña erronea';
          }

          /* ------------------------------- ALERTA DIV ------------------------------- */
          // echo '<div class="alert alert-danger mt-3">Error al ingresar: ' . $error . '</div>
          // <script>
          // fncMatPreloader("off")
          // fncFormatInputs()
          // </script>';

          /* ------------------------------- NOTI ALERT ------------------------------- */
          // echo '<script>
          // fncNotie("error", "Error al ingresar: ' . $error . '");
          // fncMatPreloader("off");
          // fncFormatInputs();
          // </script>';

          /* ------------------------------- SWEERALERT ------------------------------- */
          // echo '<script>
          // fncSweetAlert("error", "Error al ingresar: ' . $error . '", "");
          // fncMatPreloader("off");
          // fncFormatInputs();
          // </script>';

          /* ------------------------------- TOAST ALERT ------------------------------ */
          echo '<script>
          fncToastr("error", "Error al ingresar: ' . $error . '");
          fncMatPreloader("off");
          fncFormatInputs();
          </script>';
        }
      } else {
        echo '<script>
          fncToastr("error", "Error al ingresar: Error de sintaxis en los campos");
          fncMatPreloader("off");
          fncFormatInputs();
          </script>';
      }
    }
  }

  /* ------------------------ LOGIN DE ADMINISTRADORES ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                            RECUPERAR CONTRASEÑA                            */
  /* -------------------------------------------------------------------------- */

  public function resetPassword()
  {
    if (isset($_POST['resetPassword'])) {

      /* -------------------------------------------------------------------------- */
      /*                      VALIDAR LA SINTAXIS DE LOS CAMPOS                     */
      /* -------------------------------------------------------------------------- */

      if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['resetPassword'])) {

        /* -------------------------------------------------------------------------- */
        /*                  PREGUNTAMOS SI EL USUARIO ESTA REGISTRADO                 */
        /* -------------------------------------------------------------------------- */

        $url = 'admins?linkTo=email_admin&equalTo=' . $_POST['resetPassword'] . '&select=id_admin';
        $method = 'GET';
        $fields = [];

        $admin = CurlController::request($url, $method, $fields);

        if ($admin->status == 200) {

          $newPassword = TemplateController::genPassword(11);
          $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

          /* -------------------------------------------------------------------------- */
          /*                   ACTUALIZAR CONTRASEÑA EN BASE DE DATOS                   */
          /* -------------------------------------------------------------------------- */

          $url = 'admins?id=' . $admin->results[0]->id_admin . '&nameId=id_admin&token=no&except=password_admin';
          $method = 'PUT';
          $fields = 'password_admin=' . $crypt;

          $updatePassword = CurlController::request($url, $method, $fields);

          if ($updatePassword->status == 200) {
            $subject = 'Solicitud de nueva contraseña - ME-STORE';
            $email = $_POST['resetPassword'];
            $title = 'Solicitud de nueva contraseña';
            $message = '<h4 style="font-weight: 100; color: #999; padding: 0px 20px">
                        <strong>Su nueva contraseña: ' . $newPassword . '</strong>
                      </h4>

                      <h4 style="font-weight: 100; color: #999; padding: 0px 20px">
                        Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla
                        en el panel de perfil de usuario
                      </h4>';
            $link = TemplateController::path() . 'admin';
            $sendEmail = TemplateController::sendEmail($subject, $email, $title, $message, $link);

            if ($sendEmail == 'ok') {
              echo '<script>
              fncMatPreloader("off");
              fncToastr("success", "Su contraseña ha sido enviada con exito, por favor revise su correo electronico");
              fncFormatInputs();
              </script>';
            } else {
              echo '<script>
              fncMatPreloader("off");
              fncToastr("error", "' . $sendEmail . '");
              fncFormatInputs();
              </script>';
            }
          }

          /* ----------------- ACTUALIZAR CONTRASEÑA EN BASE DE DATOS ----------------- */
        } else {
          echo '<script>
          fncMatPreloader("off");
          fncToastr("error", "Error: El correo no forma parte del panel administrador");
          fncFormatInputs();
          </script>';
        }


        /* ---------------- PREGUNTAMOS SI EL USUARIO ESTA REGISTRADO --------------- */
      }

      /* -------------------- VALIDAR LA SINTAXIS DE LOS CAMPOS ------------------- */
    }
  }

  /* -------------------------- RECUPERAR CONTRASEÑA -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                         GESTION DE ADMINISTRADORES                         */
  /* -------------------------------------------------------------------------- */

  public function adminManage()
  {
    if (isset($_POST['name_admin'])) {
      echo '<script>
        fncMatPreloader("on");
        fncSweetAlert("loading", "", "");
      </script>';

      if (
        preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email_admin"])
        && preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name_admin"])
      ) {
        if (isset($_POST['idAdmin'])) {
          if ($_POST['password_admin'] != '') {
            if (preg_match('/^[*\\$\\!\\¡\\?\\¿\\.\\_\\#\\-\\0-9A-Za-z]{1,}$/', $_POST['password_admin'])) {
              $crypt = crypt($_POST['password_admin'], '$2a$07$azybxcags23425sdg23sdfhsd$');
            } else {
              echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncToastr("error","La contraseña no puede llevar ciertos caracteres especiales");
              </script>';
            }
          } else {
            $crypt = $_POST['oldPassword'];
          }

          $url = 'admins?id=' . base64_decode($_POST['idAdmin']) . '&nameId=id_admin&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
          $method = 'PUT';
          $fields = 'name_admin=' . trim(TemplateController::capitalize($_POST['name_admin'])) . '&rol_admin=' . $_POST['rol_admin'] . '&email_admin=' . $_POST['email_admin'] . '&password_admin=' . $crypt;

          $updateData = CurlController::request($url, $method, $fields);

          if ($updateData->status == 200) {
            echo '<script>
              fncFormatInputs();
              fncMatPreloader("off");
              fncSweetAlert("success", "Administrador editado con exito", "/admin/administradores");
            </script>';
          } else {
            if ($updateData->status == 303) {
              echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncSweetAlert("error", "La sesion expiro, vuelva a ingresar", "/salir");
              </script>';
            } else {
              echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncToastr("error", "Ocurrio un error al editar al administrador, por favor intentelo de nuevo");
              </script>';
            }
          }
        } else {
          $nameCapitalize  = trim(TemplateController::capitalize($_POST['name_admin']));
          if (preg_match('/^[*\\$\\!\\¡\\?\\¿\\.\\_\\#\\-\\0-9A-Za-z]{1,}$/', $_POST['password_admin'])) {
            $crypt = crypt($_POST['password_admin'], '$2a$07$azybxcags23425sdg23sdfhsd$');
          } else {
            echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncToastr("error","La contraseña no puede llevar ciertos caracteres especiales");
              </script>';
          }

          $url = 'admins?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
          $method = 'POST';
          $fields = [
            'name_admin' => $nameCapitalize,
            'rol_admin' => $_POST['rol_admin'],
            'email_admin' => $_POST['email_admin'],
            'password_admin' => $crypt,
            'date_created_admin' => date('Y-m-d')
          ];

          $createData = CurlController::request($url, $method, $fields);

          if ($createData->status == 200) {
            echo '<script>
              fncFormatInputs();
              fncMatPreloader("off");
              fncSweetAlert("success", "Administrador creado con exito", "/admin/administradores");
            </script>';
          } else {
            if ($createData->status == 303) {
              echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncSweetAlert("error", "La sesion expiro, vuelva a ingresar", "/salir");
              </script>';
            } else {
              echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncToastr("error", "Ocurrio un error al crear al administrador, por favor intentelo de nuevo");
              </script>';
            }
          }
        }
      } else {
        echo '<script>
					fncFormatInputs();
					fncMatPreloader("off");
					fncToastr("error","Error en los campos del formulario");
				</script>';
      }
    }
  }

  /* ----------------------- GESTION DE ADMINISTRADORES ----------------------- */
}
