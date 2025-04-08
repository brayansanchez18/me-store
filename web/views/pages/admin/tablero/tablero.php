<?php

if ($_SESSION['admin']->rol_admin == 'admin') {
  include 'modules/top.php';
}

include 'modules/date-range.php';

if ($_SESSION['admin']->rol_admin == 'admin') {
  include 'modules/sales-chart.php';
}

?>

<div class="container">
  <div class="row row-col">
    <div class="col">
      <?php include 'modules/sales_products.php' ?>
    </div>
  </div>
</div>