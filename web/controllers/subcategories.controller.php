<?php

class SubcategoriesController
{
  public function subcategoryManage()
  {
    if (isset($_POST['name_subcategory'])) {
      /* -------------------------------- PRELOADER ------------------------------- */
      echo '<script>
        fncMatPreloader("on")
      </script>';

      if (isset($_POST['idSubcategory'])) {
        if (
          isset($_FILES['image_subcategory']['tmp_name']) &&
          !empty($_FILES['image_subcategory']['tmp_name'])
        ) {
          $image = $_FILES['image_subcategory'];
          $folder = 'assets/img/subcategories/' . $_POST['url_subcategory'];
          $name = $_POST['url_subcategory'];
          $width = 1000;
          $height = 600;

          $saveImageSubcategory = TemplateController::saveImage($image, $folder, $name, $width, $height);
        } else {
          $saveImageSubcategory = $_POST['old_image_subcategory'];
        }

        $fields = 'name_subcategory=' . trim(TemplateController::capitalize($_POST['name_subcategory'])) . '&url_subcategory=' . $_POST['url_subcategory'] . '&image_subcategory=' . $saveImageSubcategory . '&description_subcategory=' . trim($_POST['description_subcategory']) . '&keywords_subcategory=' . strtolower($_POST['keywords_subcategory']);

        $url = 'subcategories?id=' . base64_decode($_POST['idSubcategory']) . '&nameId=id_subcategory&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $updateData = CurlController::request($url, $method, $fields);

        if ($updateData->status == 200) {

          echo '<script>
							fncMatPreloader("off");
							fncFormatInputs();
							fncSweetAlert("success","Categoria editada con éxito","/admin/subcategorias");
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
          isset($_FILES['image_subcategory']['tmp_name']) &&
          !empty($_FILES['image_subcategory']['tmp_name'])
        ) {

          $image = $_FILES['image_subcategory'];
          $folder = 'assets/img/subcategories/' . $_POST['url_subcategory'];
          $name = $_POST['url_subcategory'];
          $width = 1000;
          $height = 600;

          $saveImageSubcategory = TemplateController::saveImage($image, $folder, $name, $width, $height);
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
          'name_subcategory' => trim(TemplateController::capitalize($_POST['name_subcategory'])),
          'url_subcategory' => $_POST['url_subcategory'],
          'image_subcategory' => $saveImageSubcategory,
          'description_subcategory' => trim($_POST['description_subcategory']),
          'keywords_subcategory' => strtolower($_POST['keywords_subcategory']),
          'id_category_subcategory' => $_POST['id_category_subcategory'],
          'date_created_subcategory' => date('Y-m-d')
        ];

        $url = 'subcategories?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'POST';

        $createData = CurlController::request($url, $method, $fields);

        // echo '<pre>' . print_r($createData) . '</pre>';

        if ($createData->status == 200) {

          echo '<script>
                fncMatPreloader("off");
                fncFormatInputs();
                fncSweetAlert("success","Categoria creada con éxito","/admin/subcategorias");
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
