<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

  /* -------------------------------------------------------------------------- */
  /*                  FUNCION PARA ENVIAR CORREOS ELECTRONICOS                  */
  /* -------------------------------------------------------------------------- */

  static public function sendEmail($subject, $email, $title, $message, $link)
  {
    date_default_timezone_set('America/Mexico_City');

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    // $mail->Encoding = 'base64'; // habilitar al subir el sistema a un hosting
    $mail->isMail();
    $mail->UseSendmailOptions = 0;
    $mail->setFrom('noreply@me-store.com');
    $mail->Subject = $subject;
    $mail->addAddress($email);
    $mail->msgHTML('<div
      style="
        width: 100%;
        background: #eee;
        position: relative;
        font-family: sans-serif;
        padding-top: 40px;
        padding-bottom: 40px;
      "
    >
      <div
        style="
          position: relative;
          margin: auto;
          width: 600px;
          background: white;
          padding: 20px;
        "
      >
        <center>
          <img
            src="' . TemplateController::path() . 'views/assets/img/template/1/logo.png"
            style="padding: 20px; width: 30%"
          />

          <h3 style="font-weight: 100; color: #999">
            ' . $title . '
          </h3>

          <hr style="border: 1px solid #ccc; width: 80%" />

          ' . $message . '

          <a
            href="' . TemplateController::path() . 'admin"
            target="_blank"
            style="text-decoration: none"
          >
            <div
              style="
                line-height: 25px;
                background: #000;
                width: 60%;
                padding: 10px;
                color: white;
                border-radius: 5px;
              "
            >
              Haz clic aquí
            </div>
          </a>

          <br />

          <hr style="border: 1px solid #ccc; width: 80%" />

          <h5 style="font-weight: 100; color: #999">
            Si no solicitó el envío de este correo, comuniquese con nosotros de
            inmediato.
          </h5>
          <h5 style="font-weight: 100; color: #999">
            <strong>emanuel.sanchez.contacto@me-studios.com</strong>
          </h5>
        </center>
      </div>
    </div>');
    $send = $mail->Send();

    if (!$send) {
      return $mail->ErrorInfo;
    } else {
      return 'ok';
    }
  }

  /* ---------------- FUNCION PARA ENVIAR CORREOS ELECTRONICOS ---------------- */

  /* -------------------------------------------------------------------------- */
  /*                            FUNCION LIMPIAR HTML                            */
  /* -------------------------------------------------------------------------- */

  static public function htmlClean($code)
  {
    $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
    $replace = array('>', '<', '\\1');
    $code = preg_replace($search, $replace, $code);
    $code = str_replace("> <", "><", $code);
    return $code;
  }

  /* -------------------------- FUNCION LIMPIAR HTML -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             FUNCION CAPITALIZE                             */
  /* -------------------------------------------------------------------------- */

  static public function capitalize($value)
  {
    $value = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    return $value;
  }

  /* --------------------------- FUNCION CAPITALIZE --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                         FUNCION PARA REDUCIR TEXTO                         */
  /* -------------------------------------------------------------------------- */

  static public function reduceText($value, $limit)
  {
    if (strlen($value) > $limit) {
      $value = substr($value, 0, $limit) . '...';
    }

    return $value;
  }

  /* ----------------------- FUNCION PARA REDUCIR TEXTO ----------------------- */
}
