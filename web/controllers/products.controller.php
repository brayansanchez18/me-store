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

        /* -------------------------------------------------------------------------- */
        /*            MOVER TODOS LOS ARCHIVOS TEMPORALES AL DESTINO FINAL            */
        /* -------------------------------------------------------------------------- */

        if (is_dir('views/assets/img/temp')) {
          $start = glob('views/assets/img/temp/*');

          foreach ($start as $file) {
            $archive = explode('/', $file);
            copy($file, 'views/assets/img/products/' . $_POST['url_product'] . '/' . $archive[count($archive) - 1]);
            unlink($file);
          }
        }

        /* ---------- MOVER TODOS LOS ARCHIVOS TEMPORALES AL DESTINO FINAL ---------- */

        $fields = 'name_product=' . trim(TemplateController::capitalize($_POST['name_product'])) . '&url_product=' . $_POST['url_product'] . '&image_product=' . $saveImageProduct . '&description_product=' . trim($_POST['description_product']) . '&keywords_product=' . strtolower($_POST['keywords_product']) . '&id_category_product=' . $_POST['id_category_product'] . '&id_subcategory_product=' . $_POST['id_subcategory_product'] . '&info_product=' . urlencode(trim(str_replace('src="/views/assets/img/temp', 'src="/views/assets/img/products/' . $_POST['url_product'], $_POST['info_product'])));


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

        /* -------------------------------------------------------------------------- */
        /*                                  VARIANTES                                 */
        /* -------------------------------------------------------------------------- */

        $totalVariants = $_POST['totalVariants'];
        $countVariant = 0;
        $readyVariant = 0;

        for ($i = 1; $i <= $totalVariants; $i++) {

          $countVariant++;

          if ($_POST['type_variant_' . $i] == 'gallery') {

            $galleryProduct = [];
            $galleryCount = 0;
            $galleryOldCount = 0;

            if (!empty($_POST['galleryProduct_' . $i])) {
              foreach (json_decode($_POST['galleryProduct_' . $i], true) as $key => $value) {
                // echo '<pre>' . print_r($value) . '</pre>';

                $galleryCount++;

                $image['tmp_name'] = $value['file'];
                $image['type'] = $value['type'];
                $image['mode'] = 'base64';

                $folder = 'assets/img/products/' . $_POST['url_product'];
                $name = mt_rand(10000, 99999);
                $width = $value['width'];
                $height = $value['height'];

                $saveImageGallery = TemplateController::saveImage($image, $folder, $name, $width, $height);

                array_push($galleryProduct, $saveImageGallery);

                if (count(json_decode($_POST['galleryProduct_' . $i], true)) == $galleryCount) {
                  if ($_POST['galleryOldProduct_' . $i] != '[]') {
                    foreach (json_decode($_POST['galleryProduct_' . $i], true) as $index => $item) {
                      $galleryOldCount++;
                      array_push($galleryProduct, $item);

                      if (count(json_decode($_POST['galleryOldProduct_' . $i], true)) == $galleryOldCount) {
                        $media_variant = json_encode($galleryProduct);
                      }
                    }
                  } else {
                    $media_variant = json_encode($galleryProduct);
                  }
                }
              }
            } else {

              /* -------------------------------------------------------------------------- */
              /*                      CUANDO NO SUBIMOS IMAGENES NUEVAS                     */
              /* -------------------------------------------------------------------------- */

              if ($_POST['galleryOldProduct_' . $i] != '[]') {
                foreach (json_decode($_POST['galleryOldProduct_' . $i], true) as $index => $item) {
                  $galleryOldCount++;
                  array_push($galleryProduct, $item);

                  if (count(json_decode($_POST['galleryOldProduct_' . $i], true)) == $galleryOldCount) {
                    $media_variant = json_encode($galleryProduct);
                  }
                }
              }

              /* -------------------- CUANDO NO SUBIMOS IMAGENES NUEVAS ------------------- */
            }

            /* -------------------------------------------------------------------------- */
            /*                    ELIMINAR ARCHIVOS BASURA DEL SERVIDOR                   */
            /* -------------------------------------------------------------------------- */

            if (!empty($_POST['deleteGalleryProduct_' . $i])) {
              foreach (json_decode($_POST['deleteGalleryProduct_' . $i], true) as $key => $value) {
                unlink('views/assets/img/products/' . $_POST['url_product'] . '/' . $value);
              }
            }

            /* ------------------ ELIMINAR ARCHIVOS BASURA DEL SERVIDOR ----------------- */
          } else {
            $media_variant = $_POST['videoProduct_' . $i];
          }

          /* -------------------------------- VARIANTES ------------------------------- */

          /* -------------------------------------------------------------------------- */
          /*                            CAMPOS DE LA VARIANTE                           */
          /* -------------------------------------------------------------------------- */

          if (isset($_POST['idVariant_' . $i])) {
            $fields = 'id_product_variant=' . base64_decode($_POST['idProduct']) . '&type_variant=' . $_POST['type_variant_' . $i] . '&media_variant=' . $media_variant . '&description_variant=' . $_POST['description_variant_' . $i] . '&cost_variant=' . $_POST['cost_variant_' . $i] . '&price_variant=' . $_POST['price_variant_' . $i] . '&offer_variant=' . $_POST['offer_variant_' . $i] . '&end_offer_variant=' . $_POST['date_variant_' . $i] . '&stock_variant=' . $_POST['stock_variant_' . $i];

            $url = 'variants?id=' . $_POST['idVariant_' . $i] . '&nameId=id_variant&token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
            $method = 'PUT';


            $editVariant = CurlController::request($url, $method, $fields);
          } else {
            $fields = [
              'id_product_variant' => base64_decode($_POST['idProduct']),
              'type_variant' => $_POST['type_variant_' . $i],
              'media_variant' => $media_variant,
              'description_variant' => $_POST['description_variant_' . $i],
              'cost_variant' => $_POST['cost_variant_' . $i],
              'price_variant' => $_POST['price_variant_' . $i],
              'offer_variant' => $_POST['offer_variant_' . $i],
              'end_offer_variant' => $_POST['date_variant_' . $i],
              'stock_variant' => $_POST['stock_variant_' . $i],
              'date_created_variant' => date('Y-m-d')
            ];

            $url = 'variants?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
            $method = 'POST';
            $editVariant = CurlController::request($url, $method, $fields);
          }

          /* -------------------------- CAMPOS DE LA VARIANTE ------------------------- */

          if ($countVariant == $totalVariants) {
            $readyVariant = 200;
          }
        }

        // echo '<pre>' . print_r($updateData) . '</pre>';
        // return;

        if (
          $updateData->status == 200 &&
          $readyVariant == 200 &&
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

        /* -------------------------------------------------------------------------- */
        /*            MOVER TODOS LOS ARCHIVOS TEMPORALES AL DESTINO FINAL            */
        /* -------------------------------------------------------------------------- */


        if (is_dir('views/assets/img/temp')) {
          $start = glob('views/assets/img/temp/*');
          foreach ($start as $file) {
            $archive = explode('/', $file);
            copy($file, 'views/assets/img/products/' . $_POST['url_product'] . '/' . $archive[count($archive) - 1]);
            unlink($file);
          }
        }

        /* ---------- MOVER TODOS LOS ARCHIVOS TEMPORALES AL DESTINO FINAL ---------- */

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
          'info_product' => trim(str_replace('src="/views/assets/img/temp', 'src="/views/assets/img/products/' . $_POST['url_product'], $_POST['info_product'])),
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

        $url = 'categories?equalTo=' . $_POST['id_category_product'] . '&linkTo=id_category&select=products_category';
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

        /* -------------------------------------------------------------------------- */
        /*                                  VARIANTES                                 */
        /* -------------------------------------------------------------------------- */

        $totalVariants = $_POST['totalVariants'];
        $countVariant = 0;
        $readyVariant = 0;

        for ($i = 1; $i <= $totalVariants; $i++) {

          $countVariant++;

          if ($_POST['type_variant_' . $i] == 'gallery') {

            $galleryProduct = [];
            $galleryCount = 0;

            if (!empty($_POST['galleryProduct_' . $i])) {
              foreach (json_decode($_POST['galleryProduct_' . $i], true) as $key => $value) {
                // echo '<pre>' . print_r($value) . '</pre>';

                $galleryCount++;

                $image['tmp_name'] = $value['file'];
                $image['type'] = $value['type'];
                $image['mode'] = 'base64';

                $folder = 'assets/img/products/' . $_POST['url_product'];
                $name = mt_rand(10000, 99999);
                $width = $value['width'];
                $height = $value['height'];

                $saveImageGallery = TemplateController::saveImage($image, $folder, $name, $width, $height);

                array_push($galleryProduct, $saveImageGallery);

                if (count(json_decode($_POST['galleryProduct_' . $i], true)) == $galleryCount) {
                  $media_variant = json_encode($galleryProduct);
                }
              }
            }
          } else {
            $media_variant = $_POST['videoProduct_' . $i];
          }

          // return;

          /* -------------------------------- VARIANTES ------------------------------- */

          /* -------------------------------------------------------------------------- */
          /*                            CAMPOS DE LA VARIANTE                           */
          /* -------------------------------------------------------------------------- */

          $fields = [
            'id_product_variant' => $createData->results->lastId,
            'type_variant' => $_POST['type_variant_' . $i],
            'media_variant' => $media_variant,
            'description_variant' => $_POST['description_variant_' . $i],
            'cost_variant' => $_POST['cost_variant_' . $i],
            'price_variant' => $_POST['price_variant_' . $i],
            'offer_variant' => $_POST['offer_variant_' . $i],
            'end_offer_variant' => $_POST['date_variant_' . $i],
            'stock_variant' => $_POST['stock_variant_' . $i],
            'date_created_variant' => date('Y-m-d')
          ];

          $url = 'variants?token=' . $_SESSION['admin']->token_admin . '&table=admins&suffix=admin';
          $method = 'POST';
          $createVariant = CurlController::request($url, $method, $fields);

          /* -------------------------- CAMPOS DE LA VARIANTE ------------------------- */

          if ($countVariant == $totalVariants) {
            $readyVariant = 200;
          }
        }


        if (
          $createData->status == 200 &&
          $readyVariant == 200 &&
          $createVariant->status == 200 &&
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
