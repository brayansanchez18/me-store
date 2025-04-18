<?php

/* ------------------------ VISUALIZACIONES ARTICULOS ----------------------- */
$select = '*';
$url = 'products?linkTo=date_updated_product&between1=' . $between1 . '+00%3A00%3A00&between2=' . $between2 . '+23%3A59%3A59&select=' . $select . '&orderBy=sales_product&orderMode=DESC&startAt=0&endAt=10';
$method = 'GET';
$fields = [];
$salesProducts = CurlController::request($url, $method, $fields);

if ($salesProducts->status == 200) {
  $salesProducts = $salesProducts->results;
} else {
  $salesProducts = [];
}
?>

<div class="card mb-5">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Los Productos más pedidos
        <br><span class="small"><?php if (isset($_GET["from"]) && isset($_GET["untill"])) {
                                  echo "Entre el " . date("d/m/Y", strtotime($between1)) ?> y <?php echo date("d/m/Y", strtotime($between2));
                                                                                            } else {
                                                                                              echo "Histórico Total";
                                                                                            }  ?></span>
      </h3>
    </div>
  </div>

  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
        <tr>
          <th>Productos</th>
          <th>Ventas</th>
          <th>Ver</th>
        </tr>
      </thead>

      <tbody>
        <?php if (count($salesProducts) > 0): ?>
          <?php foreach ($salesProducts as $key => $value): ?>
            <tr>
              <td>
                <div class="media border-0 p-1">
                  <img src="/views/assets/img/products/<?= $value->url_product ?>/<?= $value->image_product ?>" class="mr-3 img-fluid" style="width:60px;">
                  <div class="media-body">
                    <p><?= $value->name_product ?></p>
                  </div>
                </div>
              </td>
              <td><?= $value->sales_product  ?></td>
              <td>
                <a href="/<?= $value->url_product ?>" target="_blank" class="text-muted">
                  <i class="fas fa-search"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  </tbody>
  </table>
</div>
<div class="card-footer">
  <div class="text-center">No hay pedidos en este rango de tiempo</div>
</div>
<?php endif ?>
</div>