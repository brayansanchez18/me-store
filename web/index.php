<?php

/* -------------------------------------------------------------------------- */
/*                               DEPURAR ERRORES                              */
/* -------------------------------------------------------------------------- */

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/htdocs/me-store/web/php_error_log');

/* ----------------------------- DEPURAR ERRORES ---------------------------- */

require_once 'controllers/cotroller.template.php';

$index = new TemplateController();
$index->index();
