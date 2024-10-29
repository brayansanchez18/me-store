<?php
$select = 'id_category,name_category,url_category,icon_category';
$url = 'categories?select=' . $select;
$method = 'GET';
$fields = [];

$dataCategories = CurlController::request($url, $method, $fields);

if ($dataCategories->status == 200) {
  $dataCategories = $dataCategories->results;
} else {
  $dataCategories = [];
}
?>
<div class="container py-2 py-lg-4">
  <div class="row">
    <div class="col-12 col-lg-2 mt-1">
      <div class="d-flex justify-content-center">
        <a href="<?= $path ?>" class="navbar-brand">
          <img src="<?= $path ?>views/assets/img/template/<?= $template->id_template ?>/<?= $template->logo_template ?>" class="brand-image img-fluid py-3 px-5 p-lg-0 pe-lg-3">
        </a>
      </div>
    </div>

    <div class="col-12 col-lg-7 col-xl-8 mt-1 px-3 px-lg-0">
      <?php if (isset($_SESSION['admin'])) : ?>
        <a href="#" class="nav-link float-start" data-widget="pushmenu" role="button">
          <i class="fas fa-bars"></i>
        </a>
      <?php endif ?>
      <div class="dropdown px-1 float-start templateColor">
        <a id="dropdownSubMenu1" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-uppercase">
          <span class="d-lg-block d-none">Categorias<i class="ps-lg-2 fas fa-th-list"></i></span>
          <span class="d-lg-none d-block"><i class="fas fa-th-list"></i></span>
        </a>

        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <?php foreach ($dataCategories as $key => $value): ?>
            <?php
            $select = 'name_subcategory,url_subcategory';
            $url = 'subcategories?linkTo=id_category_subcategory&equalTo=' . $value->id_category . '&select=' . $select;
            $method = 'GET';
            $fields = [];
            $dataSubcategories = CurlController::request($url, $method, $fields);

            if ($dataSubcategories->status == 200) {
              $dataSubcategories = $dataSubcategories->results;
            } else {
              $dataSubcategories = [];
            }
            ?>
            <li class="dropdown-submenu dropdown-hover">
              <a
                id="dropdownSubMenu<?= $key ?>"
                href="/<?= $value->url_category ?>"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                class="dropdown-item dropdown-toggle text-uppercase"
                onclick="redirect('/<?= $value->url_category ?>')">
                <i class="<?= $value->icon_category ?> pe-2 fa-xs"></i> <?= $value->name_category ?>
              </a>

              <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
                <?php foreach ($dataSubcategories as $index => $item): ?>
                  <li>
                    <a
                      tabindex="-1"
                      href="/<?= $item->url_subcategory ?>"
                      class="dropdown-item"><?= $item->name_subcategory ?></a>
                  </li>
                <?php endforeach ?>
              </ul>

              <ul aria-labelledby="dropdownSubMenu0" class="dropdown-menu border-0 shadow menuSubcategory">
                <?php foreach ($dataSubcategories as $index => $item): ?>
                  <li>
                    <a
                      tabindex="-1"
                      href="/<?= $item->url_subcategory ?>"
                      class="dropdown-item"><?= $item->name_subcategory ?></a>
                  </li>
                <?php endforeach ?>
              </ul>
            </li>
          <?php endforeach ?>
        </ul>
      </div>

      <form class="form-inline">
        <div class="input-group input-group w-100 me-0 me-lg-4">
          <input class="form-control rounded-0 p-3 pe-5 inputSearch" type="search" placeholder="Buscar..." style="height:40px">
          <div class="input-group-append px-2 templateColor">
            <button class="btn btn-navbar text-white btnSearch" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-12 col-lg-3 col-xl-2 mt-1 px-3 px-lg-0">
      <div class="my-2 my-lg-0 d-flex justify-content-center">
        <a href="/carrito">
          <button class="bt btn-default float-start rounded-0 border-0 py-2 px-3 templateColor">
            <i class="fa fa-shopping-cart"></i>
          </button>
        </a>

        <div class="small border float-start ps-2 pe-5 w-100">
          TU CESTA <span id="shoppingBasket">0</span><br> USD $<span id="totalShop">0.00</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function redirect(value) {
    window.location = value;
  }

  if (window.matchMedia("(max-width:768px)").matches) {
    $(".menuSubcategory").remove();
  }
</script>