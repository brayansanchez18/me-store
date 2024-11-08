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
            href="' . $link . '"
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

  /* -------------------------------------------------------------------------- */
  /*                       FUNCION PARA ALMACENAR IMAGENES                      */
  /* -------------------------------------------------------------------------- */

  static public function saveImage($image, $folder, $name, $width, $height)
  {
    if (isset($image['tmp_name']) && !empty($image['tmp_name'])) {

      /* -------------------------------------------------------------------------- */
      /*                       CONFUGURAR RUTA DEL DIRECTORIO                       */
      /* -------------------------------------------------------------------------- */

      $directory = strtolower('views/' . $folder);

      /* --------------------- CONFIGURAR RUTA DEL DIRECTORIO --------------------- */

      /* -------------------------------------------------------------------------- */
      /*                     PREGUNTAR SI NO EXISTE EL DIRECOTIO                    */
      /* -------------------------------------------------------------------------- */

      if (!file_exists($directory)) {
        mkdir($directory, 0775);
      }

      /* ------------------- PREGUNTAR SI NO EXISTE EL DIRECOTIO ------------------ */

      /* -------------------------------------------------------------------------- */
      /*                  CAPTURAR <W> Y <H> ORIGINAL DE LA IMAGEN                  */
      /* -------------------------------------------------------------------------- */

      list($lastWidth, $lastHeight) = getimagesize($image['tmp_name']);

      if ($lastWidth < $width || $lastHeight < $height) {
        $lastWidth  = $width;
        $lastHeight = $height;
      }

      /* ---------------- CAPTURAR <W> Y <H> ORIGINAL DE LA IMAGEN ---------------- */

      /* -------------------------------------------------------------------------- */
      /*                  APLICAR FUNCIONES SEGUN EL TIPO DE IMAGEN                 */
      /* -------------------------------------------------------------------------- */

      if ($image['type'] == 'image/jpeg') {
        # definimos nombre del archivo
        $newName = $name . '.jpg';
        # definimos el destino donde queremos guardar el archivo
        $folderPath = $directory . '/' . $newName;

        if (isset($image['mode']) && $image['mode'] == 'base64') {
          file_put_contents($folderPath, file_get_contents($image['tmp_name']));
        } else {
          # Crear una copia de la imagen
          $start = imagecreatefromjpeg($image['tmp_name']);
          # Instrucciones para aplicar a la imagen definitiva
          $end = imagecreatetruecolor($width, $height);
          # redimencionar imagen
          imagecopyresized($end,  $start,  0, 0,  0, 0, $width, $height, $lastWidth, $lastHeight);
          # guardamos la imagen en el directorio establecido
          imagejpeg($end, $folderPath);
        }
      }

      if ($image['type'] == 'image/png') {
        $newName  = $name . '.png';
        $folderPath = $directory . '/' . $newName;

        if (isset($image['mode']) && $image['mode'] == 'base64') {
          file_put_contents($folderPath, file_get_contents($image['tmp_name']));
        } else {
          $start = imagecreatefrompng($image['tmp_name']);
          $end = imagecreatetruecolor($width, $height);
          imagealphablending($end, FALSE);
          imagesavealpha($end, TRUE);
          imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);
          imagepng($end, $folderPath);
        }
      }

      if ($image['type'] == 'image/gif') {
        $newName = $name . '.gif';
        $folderPath = $directory . '/' . $newName;
        if (isset($image['mode']) && $image['mode'] == 'base64') {
          file_put_contents($folderPath, file_get_contents($image['tmp_name']));
        } else {
          move_uploaded_file($image['tmp_name'], $folderPath);
        }
      }

      /* ---------------- APLICAR FUNCIONES SEGUN EL TIPO DE IMAGEN --------------- */

      return $newName;
    } else {
      return 'error';
    }
  }

  /* --------------------- FUNCION PARA ALMACENAR IMAGENES -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                           GENERAR TEXTO ALEATORIO                          */
  /* -------------------------------------------------------------------------- */

  static public function genPassword($length)
  {
    $password = '';
    $chain = '0123456789abcdefghijklmnopqrstuvwxyz';
    $password = substr(str_shuffle($chain), 0, $length);
    return $password;
  }

  /* ------------------------- GENERAR TEXTO ALEATORIO ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                   REDIRECCIONAR A LA PAGINA DONDE ESTABA                   */
  /* -------------------------------------------------------------------------- */

  static public function urlRedirect()
  {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      return 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    } else {
      return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
  }

  /* ----------------- REDIRECCIONAR A LA PAGINA DONDE ESTABA ----------------- */
}
