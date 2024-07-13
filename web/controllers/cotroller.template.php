<?php

class TemplateController
{
  /* -------------------------------------------------------------------------- */
  /*                            VISTA DE LA PLANTILLA                           */
  /* -------------------------------------------------------------------------- */

  public function index()
  {
    include_once 'views/template.php';
  }
  /* --------------------- VISTA PRINCIPAL DE LA PLANTILLA -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               RUTA DEL SITIO                               */
  /* -------------------------------------------------------------------------- */

  static public function path()
  {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      return 'https://' . $_SERVER['SERVER_NAME'] . '/';
    } else {

      return 'http://' . $_SERVER['SERVER_NAME'] . '/';
    }
  }

  /* ----------------------------- RUTA DEL SITIO ----------------------------- */
}
