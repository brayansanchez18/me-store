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

        /* -------------------------------------------------------------------------- */
        /*                 QUITAR SUBCATEGORIAS VINCULADAS A CATEGORIA                */
        /* -------------------------------------------------------------------------- */

        $url = 'categories?equalTo=' . base64_decode($_POST['old_id_category_subcategory']) . '&linkTo=id_category&select=subcategories_category';
        $method = 'GET';
        $fields = [];

        $old_subcategories_category = CurlController::request($url, $method, $fields)->results[0]->subcategories_category;

        $url = 'categories?id=' . base64_decode($_POST['old_id_category_subcategory']) . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'subcategories_category=' . ($old_subcategories_category - 1);

        /* --------------- QUITAR SUBCATEGORIAS VINCULADAS A CATEGORIA -------------- */

        /* -------------------------------------------------------------------------- */
        /*                AGREGAR SUBCATEGORIAS VINCULADAS A CATEGORIAS               */
        /* -------------------------------------------------------------------------- */

        $updateOldCategory = CurlController::request($url, $method, $fields);

        $url = 'categories?equalTo=' . $_POST['id_category_subcategory'] . '&linkTo=id_category&select=subcategories_category';
        $method = 'GET';
        $fields = [];

        $subcategories_category = CurlController::request($url, $method, $fields)->results[0]->subcategories_category;

        $url = 'categories?id=' . $_POST['id_category_subcategory'] . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'subcategories_category=' . ($subcategories_category + 1);

        $updateCategory = CurlController::request($url, $method, $fields);

        /* -------------- AGREGAR SUBCATEGORIAS VINCULADAS A CATEGORIAS ------------- */

        if (
          $updateData->status == 200 &&
          $updateOldCategory->status == 200 &&
          $updateCategory->status == 200
        ) {

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

        /* -------------------------------------------------------------------------- */
        /*               AUMENTAR SUBCATEGORIAS VINCULADAS A CATEGORIAS               */
        /* -------------------------------------------------------------------------- */

        $url = 'categories?equalTo=' . $_POST['id_category_subcategory'] . '&linkTo=id_category&select=subcategories_category';
        $method = 'GET';
        $fields = [];

        $subcategories_category = CurlController::request($url, $method, $fields)->results[0]->subcategories_category;

        $url = 'categories?id=' . $_POST['id_category_subcategory'] . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'subcategories_category=' . ($subcategories_category + 1);

        $updateCategory = CurlController::request($url, $method, $fields);

        /* ------------- AUMENTAR SUBCATEGORIAS VIUNCULADAS A CATEGORIAS ------------ */

        if (
          $createData->status == 200 &&
          $updateCategory->status == 200
        ) {

          echo '<script>
                fncMatPreloader("off");
                fncFormatInputs();
                fncSweetAlert("success","Sub-Categoria creada con éxito","/admin/subcategorias");
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
