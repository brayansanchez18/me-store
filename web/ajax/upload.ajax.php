<?php

if (isset($_FILES['file']['name'])) {
  if (!$_FILES['file']['error']) {
    /* --------------------- VALIDAR EL FORMATO DE LA IMAGEN -------------------- */

    if (
      $_FILES['file']['type'] == 'image/jpeg' ||
      $_FILES['file']['type'] == 'image/png' ||
      $_FILES['file']['type'] == 'image/gif'
    ) {

      /* --------------------- VALIDAMOS EL PESO DE LA IMAGEN --------------------- */
      /* ---------------------------------- 10MB ---------------------------------- */
      if ($_FILES['file']['size'] < 10000000) {

        /* ------------------- CONFIGURAMOS LA RUTA DEL DIRECTORIO ------------------ */
        /* --------------------- DONDE SE VA A GUARDAR LA IMAGEN -------------------- */
        $directory = strtolower('../views/assets/img/temp');

        /* ------------- PREGUNTAMOS PRIMERO SI NO EXISTE EL DIRECTORIO ------------- */
        /* ------------------------- SI NO EXISTE LO CREAMOS ------------------------ */

        if (!file_exists($directory)) {
          mkdir($directory, 0775);
        }

        /* --------------------- CREAMOS EL NOMBRE DE LA IMAGEN --------------------- */
        $name = rand(10000000, 99999999) . getdate()['seconds'];

        /* ------------------- CAPTURAMOS LA EXTENSION DEL ARCHIVO ------------------ */
        $extension = explode('.', $_FILES['file']['name']);

        /* ---------------------- ASIGNAMOS NOMBRE Y EXTENSION ---------------------- */
        $file = $name . '.' . $extension[count($extension) - 1];

        /* ----------------- MOVEMOS EL ARCHIVO AL DIRECTORIO NUEVO ----------------- */
        $end = $_FILES['file']['tmp_name'];
        $start = $directory . '/' . $file;
        move_uploaded_file($end, $start);
        echo '/views/assets/img/temp/' . $file;
      } else {
        echo 'size';
      }
    } else {
      echo 'type';
    }
  } else {
    echo 'process';
  }
}
