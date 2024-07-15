<?php

if (!isset($_SESSION['admin'])) {
  include_once 'login/login.php';
} else {
  include_once 'tablero/tablero.php';
}
