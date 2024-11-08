<?php if ($_SESSION['user']->verification_user == 0): ?>
  <div class="container my-5">
    <div class="jumbotron bg-white shadow-lg text-center">
      <h3>¡Tu cuenta aún no está verificada!</h3>
      <p class="lead">
        Revisa tu correo electrónico en bandeja de entrada o carpeta SPAM (No deseados) para verificar tu cuenta
      </p>
      <hr class="my-4">

      <p>
        Si aún no has recibido el correo electrónico de verificación haz clic en el siguiente botón
      </p>

      <form method="post">
        <input type="hidden" value="yes" name="new_verification">
        <button type="submit" class="btn btn-default templateColor border-0">
          Enviar nuevamente el correo
        </button>

        <?php
        require_once 'controllers/users.controller.php';
        $verification = new UsersController();
        $verification->verification();
        ?>
      </form>
    </div>
  </div>
<?php else: ?>
  <div class="container pt-3 pb-5">
    <ul class="nav nav-tabs justify-content-center">
      <li class="nav-item">
        <a class="nav-link <?= (!isset($routesArray[1])) ? 'active' : '' ?> <?php if (isset($routesArray[1]) && $routesArray[1] == 'shopping'): ?> active <?php endif ?>" data-bs-toggle="tab" href="#shopping">Mis compras</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#favorite">Favoritos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#data">Datos</a>
      </li>
    </ul>

    <div class="tab-content border-bottom border-left border-right">
      <div class="tab-pane container active" id="shopping">
        <?php include 'modules/compras.php' ?>
      </div>

      <div class="tab-pane container fade" id="favorite">
        <?php include 'modules/favoritos.php' ?>
      </div>

      <div class="tab-pane container fade" id="data">
        <?php include 'modules/datos.php' ?>
      </div>
    </div>
  </div>
<?php endif ?>