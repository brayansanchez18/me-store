<?php

/* -------------------------------------------------------------------------- */
/*                               DEPURAR ERRORES                              */
/* -------------------------------------------------------------------------- */

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/htdocs/me-store/web/php_error_log');

/* ----------------------------- DEPURAR ERRORES ---------------------------- */

/* -------------------------------------------------------------------------- */
/*                                 CONTROLLERS                                */
/* -------------------------------------------------------------------------- */

require_once 'controllers/template.controller.php';
require_once 'controllers/curl.controller.php';

/* ------------------------------- CONTROLLERS ------------------------------ */

$index = new TemplateController();
$index->index();
