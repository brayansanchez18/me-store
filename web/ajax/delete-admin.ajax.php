<?php
require_once '../controllers/curl.controller.php';

class DeleteController
{
  public $token;
  public $idAdmin;
  public $table;
  public $id;
  public $nameId;

  public function ajaxDelete()
  {

    /* -------------------------------------------------------------------------- */
    /*                                BORRAR ADMIN                                */
    /* -------------------------------------------------------------------------- */

    if (
      $this->table == "admins" && base64_decode($this->id) == '4' ||
      $this->table == "admins" && base64_decode($this->id) == base64_decode($this->idAdmin)
    ) {
      echo "no-borrar";
      return;
    }

    /* ------------------------------ BORRAR ADMIN ------------------------------ */

    /* -------------------------------------------------------------------------- */
    /*                              BORRAR CATEGORIA                              */
    /* -------------------------------------------------------------------------- */

    if ($this->table == 'categories') {

      $select = 'url_category,image_category,subcategories_category';
      $url = 'categories?linkTo=id_category&equalTo=' . base64_decode($this->id) . '&select=' . $select;
      $method = 'GET';
      $fields = [];

      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      /* --------- NO BORRAR CATEGORIAS SI TIENE SUBCATEGORIAS VINCULADAS --------- */

      if ($dataItem->subcategories_category > 0) {
        echo 'no-borrar';
        return;
      }

      /* ------------------------------ BORRAR IMAGE ------------------------------ */

      unlink('../views/assets/img/categories/' . $dataItem->url_category . '/' . $dataItem->image_category);

      /* ---------------------------- BORRAR DIRECTORIO --------------------------- */

      rmdir('../views/assets/img/categories/' . $dataItem->url_category);
    }

    /* ---------------------------- BORRAR CATEGORIAS --------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                             BORRAR SUBCATEGORIA                            */
    /* -------------------------------------------------------------------------- */

    if ($this->table == 'subcategories') {

      $select = 'url_subcategory,image_subcategory,products_subcategory,id_category_subcategory';
      $url = 'subcategories?linkTo=id_subcategory&equalTo=' . base64_decode($this->id) . '&select=' . $select;
      $method = 'GET';
      $fields = [];
      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      /* ---------------------- NO BORRAR SI TIENE PRODUCTOS ---------------------- */

      if ($dataItem->products_subcategory > 0) {
        echo 'no-borrar';
        return;
      }

      /* ------------------------------ BORRAR IMAGEN ----------------------------- */

      unlink('../views/assets/img/subcategories/' . $dataItem->url_subcategory . '/' . $dataItem->image_subcategory);

      /* ---------------------------- BORRAR DIRECTORIO --------------------------- */

      rmdir('../views/assets/img/subcategories/' . $dataItem->url_subcategory);

      /* ---------------- QUITAR SUBCATEGORIA VICULADA A CATEGORIA ---------------- */

      $url = 'categories?equalTo=' . $dataItem->id_category_subcategory . '&linkTo=id_category&select=subcategories_category';
      $method = 'GET';
      $fields = [];

      $subcategories_category = CurlController::request($url, $method, $fields)->results[0]->subcategories_category;

      $url = 'categories?id=' . $dataItem->id_category_subcategory . '&nameId=id_category&token=' . $this->token . '&table=admins&suffix=admin';
      $method = 'PUT';
      $fields = 'subcategories_category=' . ($subcategories_category - 1);
      $updateCategory = CurlController::request($url, $method, $fields);
    }

    /* --------------------------- BORRAR SUBCATEGORIA -------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                               BORRAR PRODUCTO                              */
    /* -------------------------------------------------------------------------- */

    if ($this->table == 'products') {

      $select = 'url_product,image_product,id_category_product,id_subcategory_product';
      $url = 'products?linkTo=id_product&equalTo=' . base64_decode($this->id) . '&select=' . $select;
      $method = 'GET';
      $fields = [];

      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      /* ------------------------------ Borrar Imagen ----------------------------- */

      unlink('../views/assets/img/products/' . $dataItem->url_product . '/' . $dataItem->image_product);

      /* ---------------------------- Borrar Directorio --------------------------- */

      rmdir('../views/assets/img/products/' . $dataItem->url_product);

      /* ------------------ Quitar producto vinculado a categoria ----------------- */

      $url = 'categories?equalTo=' . $dataItem->id_category_product . '&linkTo=id_category&select=products_category';
      $method = 'GET';
      $fields = [];

      $products_category = CurlController::request($url, $method, $fields)->results[0]->products_category;

      $url = 'categories?id=' . $dataItem->id_category_product . '&nameId=id_category&token=' . $this->token . '&table=admins&suffix=admin';
      $method = 'PUT';

      $fields = 'products_category=' . ($products_category - 1);

      $updateCategory = CurlController::request($url, $method, $fields);

      /* ---------------- Quitar producto vinculado a subcategoria ---------------- */

      $url = 'subcategories?equalTo=' . $dataItem->id_subcategory_product . '&linkTo=id_subcategory&select=products_subcategory';
      $method = 'GET';
      $fields = [];

      $products_subcategory = CurlController::request($url, $method, $fields)->results[0]->products_subcategory;

      $url = 'subcategories?id=' . $dataItem->id_subcategory_product . '&nameId=id_subcategory&token=' . $this->token . '&table=admins&suffix=admin';
      $method = 'PUT';

      $fields = 'products_subcategory=' . ($products_subcategory - 1);

      $updateSubcategory = CurlController::request($url, $method, $fields);
    }

    /* ----------------------------- BORRAR PRODUCTO ---------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                               BORRAR VARIANTE                              */
    /* -------------------------------------------------------------------------- */

    if ($this->table == 'variants') {

      $select = 'type_variant,media_variant,url_product';
      $url = 'relations?rel=variants,products&type=variant,product&linkTo=id_variant&equalTo=' . base64_decode($this->id) . '&select=' . $select;
      $method = 'GET';
      $fields = [];

      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      /* -------------------------------------------------------------------------- */
      /*                        BORRAR IMAGENES DE LA GALERIA                       */
      /* -------------------------------------------------------------------------- */

      if ($dataItem->type_variant == 'gallery') {
        foreach (json_decode($dataItem->media_variant) as $file) {
          unlink('../views/assets/img/products/' . $dataItem->url_product . '/' . $file);
        }
      }

      /* ---------------------- BORRA IMAGENES DE LA GALERIA ---------------------- */
    }

    /* ----------------------------- BORRAR VARIANTE ---------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                              BORRAR PLANTILLAS                             */
    /* -------------------------------------------------------------------------- */

    if ($this->table == "templates") {

      $url = "templates?select=id_template";
      $method = "GET";
      $fields = array();

      $totalTemplates = CurlController::request($url, $method, $fields)->total;

      if ($totalTemplates == 1) {

        echo "no-borrar";
        return;
      }

      $select = "id_template,logo_template,icon_template,cover_template,active_template";
      $url = "templates?linkTo=id_template&equalTo=" . base64_decode($this->id) . "&select=" . $select;
      $method = "GET";
      $fields = array();

      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      if ($dataItem->active_template == "ok") {

        echo "no-borrar";
        return;
      }

      /*=============================================
            Borrar Imagenes
            =============================================*/

      unlink("../views/assets/img/template/" . $dataItem->id_template . "/" . $dataItem->logo_template);
      unlink("../views/assets/img/template/" . $dataItem->id_template . "/" . $dataItem->icon_template);
      unlink("../views/assets/img/template/" . $dataItem->id_template . "/" . $dataItem->cover_template);

      /*=============================================
            Borrar Directorio
            =============================================*/

      rmdir("../views/assets/img/template/" . $dataItem->id_template);
    }

    /* ---------------------------- BORRAR PLANTILLAS --------------------------- */

    /* -------------------------------------------------------------------------- */
    /*                                BORRAR SLIDE                                */
    /* -------------------------------------------------------------------------- */

    if ($this->table == 'slides') {
      $url = 'slides?select=id_slide';
      $method = 'GET';
      $fields = [];
      $totalSlides = CurlController::request($url, $method, $fields)->total;

      if ($totalSlides == 1) {
        echo 'no-borrar';
        return;
      }

      $select = 'id_slide,background_slide,img_png_slide';
      $url = 'slides?linkTo=id_slide&equalTo=' . base64_decode($this->id) . '&select=' . $select;
      $method = 'GET';
      $fields = [];
      $dataItem = CurlController::request($url, $method, $fields)->results[0];

      /* ----------------------------- BORRAR IMAGENES ---------------------------- */
      unlink('../views/assets/img/slide/' . $dataItem->id_slide . '/' . $dataItem->background_slide);

      if ($dataItem->img_png_slide != null) {
        unlink('../views/assets/img/slide/' . $dataItem->id_slide . '/' . $dataItem->img_png_slide);
      }

      /* ---------------------------- BORRAR DIRECTORIO --------------------------- */
      rmdir('../views/assets/img/slide/' . $dataItem->id_slide);
    }

    /* ------------------------------ BORRAR SLIDE ------------------------------ */

    $url = $this->table . '?id=' . base64_decode($this->id) . '&nameId=' . $this->nameId . '&token=' . $this->token . '&table=admins&suffix=admin';
    $method = 'DELETE';
    $fields = [];
    $delete = CurlController::request($url, $method, $fields);
    echo $delete->status;
    // echo $url;
  }
}

if (isset($_POST['token'])) {
  $Delete = new DeleteController();
  $Delete->token = $_POST['token'];
  if (isset($_POST['idAdmin'])) {
    $Delete->idAdmin = $_POST['idAdmin'];
  }
  $Delete->table = $_POST['table'];
  $Delete->id = $_POST['id'];
  $Delete->nameId = $_POST['nameId'];
  $Delete->ajaxDelete();
}
