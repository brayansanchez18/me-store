<?php

class ProductsController
{
  public function productManage()
  {
    if (isset($_POST['name_product'])) {
      /* -------------------------------- PRELOADER ------------------------------- */
      echo '<script>
        fncMatPreloader("on")
      </script>';

      if (isset($_POST['idProduct'])) {
        if (
          isset($_FILES['image_product']['tmp_name']) &&
          !empty($_FILES['image_product']['tmp_name'])
        ) {
          $image = $_FILES['image_product'];
          $folder = 'assets/img/products/' . $_POST['url_product'];
          $name = $_POST['url_product'];
          $width = 1000;
          $height = 600;

          $saveImageProduct = TemplateController::saveImage($image, $folder, $name, $width, $height);
        } else {
          $saveImageProduct = $_POST['old_image_product'];
        }

        $fields = 'name_product=' . trim(TemplateController::capitalize($_POST['name_product'])) . '&url_product=' . $_POST['url_product'] . '&image_product=' . $saveImageProduct . '&description_product=' . trim($_POST['description_product']) . '&keywords_product=' . strtolower($_POST['keywords_product']) . '&id_category_product=' . $_POST['id_category_product'] . '&id_subcategory_product=' . $_POST['id_subcategory_product'];

        $url = 'products?id=' . base64_decode($_POST['idProduct']) . '&nameId=id_product&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $updateData = CurlController::request($url, $method, $fields);

        // echo '<pre>' . print_r($updateData) . '</pre>';
        // return;

        /* -------------------------------------------------------------------------- */
        /*                    QUITAR PRODUCTO VINCULADO A CATEGORIA                   */
        /* -------------------------------------------------------------------------- */

        $url = 'categories?equalTo=' . base64_decode($_POST['old_id_category_product']) . '&linkTo=id_category&select=products_category';
        $method = 'GET';
        $fields = [];
        $old_products_category = CurlController::request($url, $method, $fields)->results[0]->products_category;

        $url = 'categories?id=' . base64_decode($_POST['old_id_category_product']) . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_category=' . ($old_products_category - 1);
        $updateOldCategory = CurlController::request($url, $method, $fields);

        /* ------------------ QUITAR PRODUCTO VINCULADO A CATEGORIA ----------------- */

        /* -------------------------------------------------------------------------- */
        /*                  AGREGAR PRODUCTO VINCULADO A LA CATEGORIA                 */
        /* -------------------------------------------------------------------------- */

        $url = 'categories?equalTo=' . $_POST['id_category_product'] . '&linkTo=id_category&select=products_category';
        $method = 'GET';
        $fields = [];

        $products_category = CurlController::request($url, $method, $fields)->results[0]->products_category;

        $url = 'categories?id=' . $_POST['id_category_product'] . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_category=' . ($products_category + 1);
        $updateCategory = CurlController::request($url, $method, $fields);

        /* ---------------- AGREGAR PRODUCTO VINCULADO A LA CATEGORIA --------------- */

        /* -------------------------------------------------------------------------- */
        /*                  QUITAR PRODUCTO VINCULADO A SUBCATEGORIA                  */
        /* -------------------------------------------------------------------------- */

        $url = 'subcategories?equalTo=' . base64_decode($_POST['old_id_subcategory_product']) . '&linkTo=id_subcategory&select=products_subcategory';
        $method = 'GET';
        $fields = [];
        $old_products_subcategory = CurlController::request($url, $method, $fields)->results[0]->products_subcategory;

        $url = 'subcategories?id=' . base64_decode($_POST['old_id_subcategory_product']) . '&nameId=id_subcategory&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_subcategory=' . ($old_products_subcategory - 1);
        $updateOldSubcategory = CurlController::request($url, $method, $fields);

        /* ---------------- QUITAR PRODUCTO VINCULADO A SUBCATEGORIA ---------------- */

        /* -------------------------------------------------------------------------- */
        /*                AGREGAR PRODUCTO VINCULADO A LA SUBCATEGORIA                */
        /* -------------------------------------------------------------------------- */

        $url = 'subcategories?equalTo=' . $_POST['id_subcategory_product'] . '&linkTo=id_subcategory&select=products_subcategory';
        $method = 'GET';
        $fields = [];

        $products_subcategory = CurlController::request($url, $method, $fields)->results[0]->products_subcategory;

        $url = 'subcategories?id=' . $_POST['id_subcategory_product'] . '&nameId=id_subcategory&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_subcategory=' . ($products_subcategory + 1);
        $updateSubcategory = CurlController::request($url, $method, $fields);

        /* -------------- AGREGAR PRODUCTO VINCULADO A LA SUBCATEGORIA -------------- */

        if (
          $updateData->status == 200 &&
          $updateOldCategory->status == 200 &&
          $updateCategory->status == 200 &&
          $updateOldSubcategory->status == 200 &&
          $updateSubcategory->status == 200
        ) {

          echo '<script>
							fncMatPreloader("off");
							fncFormatInputs();
							fncSweetAlert("success","Product editado con éxito","/admin/productos");
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
          isset($_FILES['image_product']['tmp_name']) &&
          !empty($_FILES['image_product']['tmp_name'])
        ) {

          $image = $_FILES['image_product'];
          $folder = 'assets/img/products/' . $_POST['url_product'];
          $name = $_POST['url_product'];
          $width = 1000;
          $height = 600;

          $saveImageProduct = TemplateController::saveImage($image, $folder, $name, $width, $height);
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
          'name_product' => trim(TemplateController::capitalize($_POST['name_product'])),
          'url_product' => $_POST['url_product'],
          'image_product' => $saveImageProduct,
          'description_product' => trim($_POST['description_product']),
          'keywords_product' => strtolower($_POST['keywords_product']),
          'id_category_product' => $_POST['id_category_product'],
          'id_subcategory_product' => $_POST['id_subcategory_product'],
          'date_created_product' => date('Y-m-d')
        ];

        $url = 'products?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'POST';

        $createData = CurlController::request($url, $method, $fields);

        // echo '<pre>' . print_r($createData) . '</pre>';
        // return;

        /* -------------------------------------------------------------------------- */
        /*                 AUMENTAR PRODUCTOS VINCULADOS EN CATEGORIA                 */
        /* -------------------------------------------------------------------------- */

        $url = 'categories?equalTo=' . $_POST['id_category_product'] . '&linkTo=id_category$select=products_category';
        $method = 'GET';
        $fields = [];
        $products_category = CurlController::request($url, $method, $fields)->results[0]->products_category;

        $url = 'categories?id=' . $_POST['id_category_product'] . '&nameId=id_category&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_category=' . ($products_category + 1);

        $updateCategory = CurlController::request($url, $method, $fields);

        /* --------------- AUMENTAR PRODUCTOS VINCULADOS EN CATEGORIA --------------- */

        /* -------------------------------------------------------------------------- */
        /*                AUMENTAR PRODUCTOS VINCULADOS A SUBCATEGORIA                */
        /* -------------------------------------------------------------------------- */

        $url = 'subcategories?equalTo=' . $_POST['id_subcategory_product'] . '&linkTo=id_subcategory&select=products_subcategory';
        $method = 'GET';
        $fields = [];

        $products_subcategory = CurlController::request($url, $method, $fields)->results[0]->products_subcategory;

        $url = 'subcategories?id=' . $_POST['id_subcategory_product'] . '&nameId=id_subcategory&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'products_subcategory=' . ($products_subcategory + 1);

        $updateSubcategory = CurlController::request($url, $method, $fields);

        /* -------------- AUMENTAR PRODUCTOS VINCULADOS A SUBCATEGORIA -------------- */

        if (
          $createData->status == 200 &&
          $updateCategory->status == 200 &&
          $updateSubcategory->status == 200
        ) {

          echo '<script>
                fncMatPreloader("off");
                fncFormatInputs();
                fncSweetAlert("success","Producto creado con éxito","/admin/productos");
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
