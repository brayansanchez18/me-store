<?php

require_once '../controllers/curl.controller.php';

class TemplatesController
{
  public $token;
  public $idTemplate;

  public function ajaxTemplates()
  {

    /* -------------------- SELECCIONAR TODAS LAS PLANTILLAS -------------------- */
    $url = 'templates';
    $method = 'GET';
    $fields = [];
    $templates = CurlController::request($url, $method, $fields);

    if ($templates->status == 200) {
      $countTemplate = 0;

      foreach ($templates->results as $key => $value) {

        /* ---------------------- APAGAMOS TODAS LAS PLANTILLAS --------------------- */
        $url = 'templates?id=' . $value->id_template . '&nameId=id_template&token=' . $this->token . '&table=admins&suffix=admin';
        $method = 'PUT';
        $fields = 'active_template=Null';
        $updateTemplates = CurlController::request($url, $method, $fields);

        if ($updateTemplates->status == 200) {
          $countTemplate++;

          if ($countTemplate == count($templates->results)) {

            /* -------------------- ENCENDEMOS LA PLANTILLA A ELEGIR -------------------- */
            $url = 'templates?id=' . $this->idTemplate . '&nameId=id_template&token=' . $this->token . '&table=admins&suffix=admin';
            $method = 'PUT';
            $fields = 'active_template=ok';
            $updateTemplate = CurlController::request($url, $method, $fields);

            if ($updateTemplate->status == 200) {
              echo $updateTemplate->status;
            }
          }
        }
      }
    }
  }
}

if (isset($_POST['idTemplate'])) {
  $ajax = new TemplatesController();
  $ajax->token = $_POST['token'];
  $ajax->idTemplate = $_POST['idTemplate'];
  $ajax->ajaxTemplates();
}
