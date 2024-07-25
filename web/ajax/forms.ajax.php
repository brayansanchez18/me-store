<?php

require_once '../controllers/curl.controller.php';

class FormsController
{
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
}

if (isset($_POST['table'])) {
  $forms = new FormsController();
  $forms->table = $_POST['table'];
  $forms->equalTo = $_POST['equalTo'];
  $forms->linkTo = $_POST['linkTo'];
  $forms->ajaxForms();
}
