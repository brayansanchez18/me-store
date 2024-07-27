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

    $url = $this->table . "?id=" . base64_decode($this->id) . "&nameId=" . $this->nameId . "&token=" . $this->token . "&table=admins&suffix=admin";
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
  $Delete->idAdmin = $_POST['idAdmin'];
  $Delete->table = $_POST['table'];
  $Delete->id = $_POST['id'];
  $Delete->nameId = $_POST['nameId'];
  $Delete->ajaxDelete();
}
