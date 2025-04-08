<div class="container-fluid bg-dark small footerBlock">
  <div class="container py-5 text-light">
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col row">
        <?php foreach ($dataCategories as $key => $value): ?>
          <?php
          $select = 'name_subcategory,url_subcategory,status_subcategory';
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
          <?php if ($value->status_category != 0) : ?>
            <div class="col-12  col-md-6 col-lg-6">
              <h4 class="lead">
                <a href="/<?= $value->url_category ?>" class="text-uppercase"><?= $value->name_category ?></a>
              </h4>

              <hr class="border-white">

              <ul>
                <?php foreach ($dataSubcategories as $index => $item): ?>
                  <?php if ($item->status_subcategory != 0): ?>
                    <li>
                      <a href="/<?= $item->url_subcategory ?>"><?= $item->name_subcategory ?></a>
                    </li>
                  <?php endif ?>
                <?php endforeach ?>
              </ul>
            </div>
          <?php endif ?>
        <?php endforeach ?>
      </div>

      <div class="col my-3 my-lg-0 px-lg-5 text-light">
        <h1 class="lead small">Dudas e inquietudes, contáctenos en:</h1>

        <br>

        <h1 class="lead small">
          <i class="fa fa-phone-square pe-2"></i> (555) 555-55-55
          <br><br>
          <i class="fa fa-envelope pe-2"></i> soporte@tiendavirtual.com
          <br><br>
          <i class="fa fa-map-marker pe-2"></i> Calle 45F 82 - 31 Local 102
          <br><br>
          Estado de Mexico | Mexico
        </h1>

        <!-- <iframe class="mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.061210342917!2d-75.60279258568647!3d6.255666795471985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4429739f2122e9%3A0x4812b922f0ad8f18!2sCl.+45f+%2382-31%2C+Medell%C3%ADn%2C+Antioquia!5e0!3m2!1ses!2sco!4v1511900955540" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen=""></iframe> -->

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1927728.9230052438!2d-100.92450201536921!3d19.321659536850703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd8992c0eb0a3b%3A0xc2fef9be9fc5a857!2sEstado%20de%20M%C3%A9xico!5e0!3m2!1ses-419!2smx!4v1735077003386!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</div>

<!-- Main Footer -->
<footer class="main-footer topColor">
  <div class="container">
    <!-- To the right -->
    <div class="float-end">
      <div class="d-flex justify-content-center" style="line-height:0px">

        <?php foreach ($socials as $key => $value) : ?>
          <div class="p-2">
            <a href="<?= $value->url_social ?>" target="_blank">
              <i class="<?= $value->icon_social ?> <?= $value->color_social ?>"></i>
            </a>
          </div>
        <?php endforeach ?>

      </div>
    </div>
    <!-- Default to the left -->
    <small>&copy; 2024 Todos los derechos reservados. Sitio elaborado por la Compañía.</small>
  </div>
</footer>