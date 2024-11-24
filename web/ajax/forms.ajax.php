<?php

require_once '../controllers/curl.controller.php';

class FormsController
{

  /* -------------------------------------------------------------------------- */
  /*                          VALIDAR TITULOS REPETIDOS                         */
  /* -------------------------------------------------------------------------- */

  public $table;
  public $equalTo;
  public $linkTo;

  public function ajaxForms()
  {
    $url = $this->table . '?equalTo=' . urlencode($this->equalTo) . '&linkTo=' . $this->linkTo . '&select=' . $this->linkTo;
    $method = 'GET';
    $fields  = [];

    $data = CurlController::request($url, $method, $fields);
    echo $data->status;
  }

  /* ------------------------ VALIDAR TITULOS REPETIDOS ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              SELECTOR ANIDADO                              */
  /* -------------------------------------------------------------------------- */

  public $idCategory;

  public function listarSubCategories()
  {
    $select = 'id_subcategory,name_subcategory';
    $url = 'subcategories?linkTo=id_category_subcategory&equalTo=' . $this->idCategory . '&select=' . $select;
    $method = 'GET';
    $fields = [];
    $data = CurlController::request($url, $method, $fields)->results;
    echo json_encode($data);
  }

  /* ---------------------------- SELECTOR ANIDADO ---------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             AGREGAR A FAVORITOS                            */
  /* -------------------------------------------------------------------------- */

  public $idProduct;
  public $token;

  public function addFavorites()
  {

    $select = 'id_user';
    $url = 'users?linkTo=token_user&equalTo=' . $this->token . '&select=' . $select;
    $method = 'GET';
    $fields = [];

    $data = CurlController::request($url, $method, $fields);

    if ($data->status == 200) {
      $url = 'favorites?token=' . $this->token . '&table=users&suffix=user';
      $method = 'POST';
      $fields = [
        'id_user_favorite' => $data->results[0]->id_user,
        'id_product_favorite' => $this->idProduct,
        'date_created_favorite' => date('Y-m-d')
      ];

      $addFavorite = CurlController::request($url, $method, $fields);

      if ($addFavorite->status == 200) {
        echo json_encode($addFavorite->results);
      }
    }
  }

  /* --------------------------- AGREGAR A FAVORITOS -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                        QUITAR PRODUCTO DE FAVORITOS                        */
  /* -------------------------------------------------------------------------- */

  public $idFavorite;

  public function remFavorite()
  {
    $url = 'favorites?id=' . $this->idFavorite . '&nameId=id_favorite&token=' . $this->token . '&table=users&suffix=user';
    $method = 'DELETE';
    $fields = [];
    $remFavorite = CurlController::request($url, $method, $fields);
    echo $remFavorite->status;
  }

  /* ---------------------- QUITAR PRODUCTO DE FAVORITOS ---------------------- */
}

/* -------------------------------------------------------------------------- */
/*                          VALIDAR TITULOS REPETIDOS                         */
/* -------------------------------------------------------------------------- */

if (isset($_POST['table'])) {
  $forms = new FormsController();
  $forms->table = $_POST['table'];
  $forms->equalTo = $_POST['equalTo'];
  $forms->linkTo = $_POST['linkTo'];
  $forms->ajaxForms();
}

/* ------------------------ VALIDAR TITULOS REPETIDOS ----------------------- */

/* -------------------------------------------------------------------------- */
/*                              SELECTOR ANIDADO                              */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idCategory'])) {
  $data = new FormsController();
  $data->idCategory = $_POST['idCategory'];
  $data->listarSubCategories();
}

/* ---------------------------- SELECTOR ANIDADO ---------------------------- */

/* -------------------------------------------------------------------------- */
/*                             GREGAR A FAVORITOS                             */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idProduct'])) {
  $addFavorites = new FormsController();
  $addFavorites->token = $_POST['token'];
  $addFavorites->idProduct = $_POST['idProduct'];
  $addFavorites->addFavorites();
}

/* --------------------------- AGREGAR A FAVORITOS -------------------------- */

/* -------------------------------------------------------------------------- */
/*                        QUITAR PRODUCTO DE FAVORITOS                        */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idFavorite'])) {
  $remFavorites = new FormsController();
  $remFavorites->token = $_POST['token'];
  $remFavorites->idFavorite = $_POST['idFavorite'];
  $remFavorites->remFavorite();
}

/* ---------------------- QUITAR PRODUCTO DE FAVORITOS ---------------------- */