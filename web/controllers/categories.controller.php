<?php

class CategoriesController
{
  public function categoryManage()
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
}
