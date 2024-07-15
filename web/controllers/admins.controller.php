<?php

class AdminsControllers
{

  /* -------------------------------------------------------------------------- */
  /*                          LOGIN DE ADMINISTRADORES                          */
  /* -------------------------------------------------------------------------- */

  public function login()
  {
    if (isset($_POST['loginAdminEmail'])) {
      $url = 'admins?login=true&suffix=admin';
      $method = 'POST';
      $fields = [
        'email_admin' => $_POST['loginAdminEmail'],
        'password_admin' => $_POST['loginAdminPass']
      ];

      $login = CurlController::request($url, $method, $fields);

      if ($login->status == 200) {
        $_SESSION['admin'] = $login->results[0];

        echo '<script>location.reload();</script>';
      }
    }
  }

  /* ------------------------ LOGIN DE ADMINISTRADORES ------------------------ */
}
