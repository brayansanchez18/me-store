<?php

class CategoriesController
{
  public function categoryManage()
  {
    if (isset($_POST['name_category'])) {
      /* -------------------------------- PRELOADER ------------------------------- */
      echo '<script>
        fncMatPreloader("on")
      </script>';

      if (isset($_POST['idCategory'])) {
        if (
          isset($_FILES['image_category']['tmp_name']) &&
          !empty($_FILES['image_category']['tmp_name'])
        ) {
          $image = $_FILES['image_category'];
          $folder = 'assets/img/categories/' . $_POST['url_category'];
          $name = $_POST['url_category'];
          $width = 1000;
          $height = 600;

          $saveImageCategory = TemplateController::saveImage($image, $folder, $name, $width, $height);
        } else {
          $saveImageCategory = $_POST['old_image_category'];
        }

        $fields = 'name_category=' . trim(TemplateController::capitalize($_POST['name_category'])) . '&url_category=' . $_POST['url_category'] . '&icon_category=' . $_POST['icon_category'] . '&image_category=' . $saveImageCategory . '&description_category=' . trim($_POST['description_category']) . '&keywords_category=' . strtolower($_POST['keywords_category']);

        $url = 'categories?id=' . base64_decode($_POST['idCategory']) . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $updateData = CurlController::request($url, $method, $fields);

        if ($updateData->status == 200) {

          echo '<script>
							fncMatPreloader("off");
							fncFormatInputs();
							fncSweetAlert("success","Categoria editada con éxito","/admin/categorias");
						</script>';
        } else {

          if ($updateData->status == 303) {

            echo '<script>
							fncFormatInputs();
							fncMatPreloader("off");
							fncSweetAlert("error","Token expirado, vuelva a iniciar sesión","/salir");
						</script>';
          } else {

            echo '<script>
							fncFormatInputs();
							fncMatPreloader("off");
							fncToastr("error","Ocurrió un error mientras se guardaban los datos, intente de nuevo");
						</script>';
          }
        }
      } else {

        /* -------------------------------------------------------------------------- */
        /*                         VALIDAR Y GUARDAR LA IMAGEN                        */
        /* -------------------------------------------------------------------------- */

        if (
          isset($_FILES['image_category']['tmp_name']) &&
          !empty($_FILES['image_category']['tmp_name'])
        ) {

          $image = $_FILES['image_category'];
          $folder = 'assets/img/categories/' . $_POST['url_category'];
          $name = $_POST['url_category'];
          $width = 1000;
          $height = 600;

          $saveImageCategory = TemplateController::saveImage($image, $folder, $name, $width, $height);
        } else {

          echo '<script>
            fncFormatInputs();
            fncToastr("error","El campo de la imagen no puede ir vacio");
          </script>';
          return;
        }

        /* ----------------------- VALIDAR Y GUARDAR LA IMAGEN ---------------------- */

        /* -------------------------------------------------------------------------- */
        /*                           VALIDAR Y GUARDAR INFO                           */
        /* -------------------------------------------------------------------------- */

        $fields = [
          'name_category' => trim(TemplateController::capitalize($_POST['name_category'])),
          'url_category' => $_POST['url_category'],
          'icon_category' => $_POST['icon_category'],
          'image_category' => $saveImageCategory,
          'description_category' => trim($_POST['description_category']),
          'keywords_category' => strtolower($_POST['keywords_category']),
          'date_created_category' => date('Y-m-d')
        ];

        $url = 'categories?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'POST';

        $createData = CurlController::request($url, $method, $fields);

        // echo '<pre>' . print_r($createData) . '</pre>';

        if ($createData->status == 200) {

          echo '<script>
                fncMatPreloader("off");
                fncFormatInputs();
                fncSweetAlert("success","Categoria creada con éxito","/admin/categorias");
              </script>';
        } else {

          if ($createData->status == 303) {

            echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncSweetAlert("error","Token expirado, vuelva a iniciar sesión","/salir");
              </script>';
          } else {

            echo '<script>
                fncFormatInputs();
                fncMatPreloader("off");
                fncToastr("error","Ocurrió un error mientras se guardaban los datos, intente de nuevo");
              </script>';
          }
        }

        /* ------------------------- VALIDAR Y GUARDAR INFO ------------------------- */
      }
    }
  }
}
