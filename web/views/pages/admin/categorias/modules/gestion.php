<?php
if (isset($_GET['category'])) {
  $select = 'id_category,name_category,url_category,icon_category,image_category,description_category,keywords_category';

  $url = 'categories?linkTo=id_category&equalTo=' . base64_decode($_GET['category']) . '&select=' . $select;
  $method = 'GET';
  $fields = [];

  $category = CurlController::request($url, $method, $fields);

  if ($category->status == 200) {
    $category = $category->results[0];
  } else {
    $category = null;
  }
} else {
  $category = null;
}

?>
<div class="content pb-5">
  <div class="container">
    <div class="card">
      <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <?php if (!empty($category)) : ?>
          <input type="hidden" name="idCategory" value="<?= base64_encode($category->id_category) ?>">
        <?php endif ?>
        <div class="card-header">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-6 text-center text-lg-left">
                <h4 class="mt-3"><?= (!empty($category)) ? 'Editar' : 'Agregar' ?> Categoría</h4>
              </div>

              <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                <a href="/admin/categorias" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div><a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>
                <div><button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">Guardar Información</button></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">

          <?php
          require_once 'controllers/categories.controller.php';
          $manage = new CategoriesController();
          $manage->categoryManage();
          ?>
          <!-- -------------------------------------------------------------------------- */
          /*                                PRIMER BLOQUE                               */
          /* -------------------------------------------------------------------------- -->

          <div class="row row-cols-1">
            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ---------------------------- TITULO CATEGORIA ----------------------- -->

                  <div class="form-group pb-3">
                    <label for="name_category">Título <sup class="text-danger font-weight-bold">*</sup></label>
                    <input type="text" class="form-control" placeholder="Ingresar el título" id="name_category" name="name_category" onchange="validateDataRepeat(event,'category')" <?php if (!empty($category)) : ?> readonly <?php endif ?> value="<?= (!empty($category) ? $category->name_category : '') ?>" required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- ---------------------------- URL CATEGORIA --------------------------- -->

                  <div class="form-group pb-3">
                    <label for="url_category">URL <sup class="text-danger font-weight-bold">*</sup></label>
                    <input type="text" class="form-control" id="url_category" name="url_category" value="<?= (!empty($category) ? $category->url_category : '') ?>" readonly required>
                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- --------------------------- ICONO CATEGORIA -------------------------- -->

                  <div class="form-group pb-3">
                    <label for="icon_category">Icono <sup class="text-danger font-weight-bold">*</sup></label>
                    <div class="input-group">
                      <span class="input-group-text iconView">
                        <i class="<?= (!empty($category) ? $category->icon_category : 'fas fa-shopping-bag') ?>"></i>
                      </span>

                      <input type="text" class="form-control" id="icon_category" name="icon_category" onfocus="addIcon(event)" value="<?= (!empty($category) ? $category->icon_category : 'fas fa-shopping-bag') ?>" required>

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ------------------------------ PRIMER BLOQUE ----------------------------- -->

          <!-- -------------------------------------------------------------------------- */
          /*                               SEGUNDO BLOQUE                               */
          /* -------------------------------------------------------------------------- -->

          <div class="row row-cols-1 row-cols-md-2 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ------------------------ DESCRIPCION CATEGORIA ----------------------- -->

                  <div class="form-group pb-3">
                    <label for="description_category">Descripción<sup class="text-danger font-weight-bold">*</sup></label>
                    <textarea rows="9" class="form-control mb-3" placeholder="Ingresar la descripción" id="description_category" name="description_category" onchange="validateJS(event,'complete')" required><?= (!empty($category) ? $category->description_category : '') ?></textarea>
                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- --------------------------- PALABRAS CLAVE --------------------------- -->

                  <div class="form-group pb-3">
                    <label for="keywords_category">Palabras claves<sup class="text-danger font-weight-bold">*</sup></label>
                    <input type="text" class="form-control tags-input" data-role="tagsinput" placeholder="Ingresar las palabras claves" id="keywords_category" name="keywords_category" onchange="validateJS(event,'complete-tags')" value="<?= (!empty($category) ? $category->keywords_category : '') ?>" required>
                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ---------------------------- IMG CATEGORIA --------------------------- -->

                  <div class="form-group pb-3 text-center">
                    <label class="pb-3 float-left">Imagen de la Categoría<sup class="text-danger">*</sup></label>
                    <label for="image_category">
                      <?php if (!empty($category)) : ?>
                        <input type="hidden" value="<?php echo $category->image_category ?>" name="old_image_category">
                        <img src="/views/assets/img/categories/<?php echo $category->url_category ?>/<?php echo $category->image_category ?>" class="img-fluid changeImage">
                      <?php else : ?>
                        <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid changeImage">
                      <?php endif ?>

                      <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>
                    </label>

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image_category" name="image_category" accept="image/*" maxSize="2000000" onchange="validateImageJS(event,'changeImage')" <?php if (empty($category)) : ?> required <?php endif ?>>
                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                      <label class="custom-file-label" for="image_category">Buscar Archivo</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ----------------------------- SEGUNDO BLOQUE ----------------------------- -->

          <!-- ------------------------------------------------------------------------ */
          /*                                TERCER BLOQUE                               */
          /* -------------------------------------------------------------------------- -->

          <div class="row row-cols-1 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body col-md-6 offset-md-3">

                  <!-- --------------------------- VISOR METADATOS -------------------------- -->

                  <div class="form-group pb-3 text-center">
                    <label>Visor Metadatos</label>

                    <div class="d-flex justify-content-center">
                      <div class="card">
                        <div class="card-body">

                          <!-- -------------------------------- VISOR IMG ------------------------------- -->

                          <figure class="mb-2">
                            <?php if (!empty($category)) : ?>
                              <img src="/views/assets/img/categories/<?php echo $category->url_category ?>/<?php echo $category->image_category ?>" class="img-fluid metaImg" style="width:100%">
                            <?php else : ?>
                              <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid metaImg" style="width:100%">
                            <?php endif ?>
                          </figure>

                          <!-- ------------------------------ VISOR TITULO ------------------------------ -->

                          <h6 class="text-left text-primary mb-1 metaTitle">
                            <?php if (!empty($category)) : ?>
                              <?= $category->name_category ?>
                            <?php else : ?>
                              Lorem ipsum dolor sit
                            <?php endif ?>
                          </h6>

                          <!-- -------------------------------- VISOR URL ------------------------------- -->

                          <p class="text-left text-success small mb-1">
                            <?= $path ?><span class="metaURL"><?= (!empty($category)) ? $category->url_category : 'lorem' ?></span>
                          </p>

                          <!-- ---------------------------- VISOR DESCRIPCION --------------------------- -->

                          <p class="text-left small mb-1 metaDescription">
                            <?= (!empty($category)) ? $category->description_category : 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus impedit ipsam obcaecati voluptas unde error quod odit ad sapiente vitae.' ?>
                          </p>

                          <!-- ----------------------------- VISOR KEYWORDS ----------------------------- -->

                          <p class="small text-left text-secondary metaTags">
                            <?= (!empty($category)) ? $category->keywords_category : 'lorem, ipsum, dolor, sit' ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ------------------------------ TERCER BLOQUE ----------------------------- -->

        </div>

        <div class="card-footer">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-6 text-center text-lg-left mt-lg-3">
                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos obligatorios</label>
              </div>

              <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
                <a href="/admin/categorias" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div><a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>
                <div><button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">Guardar Información</button></div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- -------------------------------------------------------------------------- */
/*                        Modal con librería de iconos                        */
/* -------------------------------------------------------------------------- -->

<div class="modal" id="myIcon">
  <div class="modal-dialog modal-lg modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cambiar Icono</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body mx-3">
        <?php
        $data = file_get_contents($path . 'views/assets/json/fontawesome1.json');
        $icons = json_decode($data);
        ?>

        <input type="text" class="form-control mt-4 mb-3 myInputIcon" placeholder="Buscar Icono">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-3" style="overflow-y: scroll; overflow-x: hidden; height:500px">
          <?php foreach ($icons as $key => $value) : ?>
            <div class="col text-center py-4 btn btnChangeIcon" mode="<?= $value ?>">
              <i class="<?= $value ?> fa-2x"></i>
            </div>
          <?php endforeach ?>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ---------------------- Modal con librería de iconos ---------------------- -->