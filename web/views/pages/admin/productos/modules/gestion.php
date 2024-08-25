<?php
if (isset($_GET['product'])) {
  $select = 'id_subcategory,name_subcategory,url_subcategory,image_subcategory,description_subcategory,keywords_subcategory,id_category_subcategory';

  $url = 'subcategories?linkTo=id_subcategory&equalTo=' . base64_decode($_GET['subcategory']) . '&select=' . $select;
  $method = 'GET';
  $fields = [];

  $subcategory = CurlController::request($url, $method, $fields);

  if ($subcategory->status == 200) {
    $subcategory = $subcategory->results[0];
  } else {
    $subcategory = null;
  }
} else {
  $subcategory = null;
}

?>
<div class="content pb-5">
  <div class="container">
    <div class="card">
      <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <?php if (!empty($subcategory)) : ?>
          <input type="hidden" name="idSubcategory" value="<?= base64_encode($subcategory->id_subcategory) ?>">
        <?php endif ?>
        <div class="card-header">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-6 text-center text-lg-left">
                <h4 class="mt-3">Agregar Producto</h4>
              </div>

              <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill saveBtn">Guardar Información</button>

                <a href="/admin/productos" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div><a href="/admin/productos" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                <div><button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill saveBtn">Guardar Información</button></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">

          <?php
          require_once 'controllers/products.controller.php';
          $manage = new ProductsController();
          $manage->productManage();
          ?>

          <!-- ------------------------------ PRIMER BLOQUE ----------------------------- -->

          <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ---------------------- Seleccionar la categoría ---------------------- -->

                  <div class="form-group pb-3">
                    <label for="id_category_product">Seleccionar Categoría<sup class="text-danger">*</sup></label>

                    <?php
                    $url = 'categories?select=id_category,name_category';
                    $method = 'GET';
                    $fields = [];

                    $categories = CurlController::request($url, $method, $fields);

                    if ($categories->status == 200) {
                      $categories = $categories->results;
                    } else {
                      $categories = [];
                    }

                    ?>

                    <select
                      class="custom-select"
                      name="id_category_product"
                      id="id_category_product"
                      onchange="changeCategory(event)"
                      required>
                      <option value="">Selecciona Categoría</option>
                      <?php foreach ($categories as $key => $value) : ?>
                        <option value="<?= $value->id_category ?>" <?php if (!empty($subcategory) && $subcategory->id_category_subcategory == $value->id_category) : ?> selected <?php endif ?>>
                          <?= $value->name_category ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <!-- --------------------- Seleccionar la subcategoría -------------------- -->

                  <div class="form-group pb-3">
                    <label for="id_subcategory_product">Seleccionar Subcategoría<sup class="text-danger">*</sup></label>

                    <select
                      class="custom-select"
                      name="id_subcategory_product"
                      id="id_subcategory_product" required>
                      <option value="">Selecciona primero una Categoría</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ------------------------- Título del Producto ------------------------ -->

                  <div class="form-group pb-3">
                    <label for="name_product">Título <sup class="text-danger font-weight-bold">*</sup></label>

                    <input
                      type="text"
                      class="form-control"
                      placeholder="Ingresar el título"
                      id="name_product"
                      name="name_product"
                      onchange="validateDataRepeat(event,'product')"
                      <?php if (!empty($subcategory)) : ?> readonly <?php endif ?> value="<?= (!empty($subcategory) ? $subcategory->name_subcategory : '') ?>"
                      required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- ------------------------- URL del producto ------------------------- -->

                  <div class="form-group pb-3">
                    <label for="url_product">
                      URL <sup class="text-danger font-weight-bold">*</sup>
                    </label>

                    <input
                      type="text"
                      class="form-control"
                      id="url_product"
                      name="url_product"
                      value="<?= (!empty($subcategory) ? $subcategory->url_subcategory : '') ?>"
                      readonly
                      required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- -------------------------- SEGUNDO BLOQUE -------------------------- -->

          <div class="row row-cols-1 row-cols-md-2 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- --------------------- Descripción del producto --------------------- -->

                  <div class="form-group pb-3">
                    <label for="description_product">
                      Descripción<sup class="text-danger font-weight-bold">*</sup>
                    </label>

                    <textarea
                      rows="9"
                      class="form-control mb-3"
                      placeholder="Ingresar la descripción"
                      id="description_product"
                      name="description_product"
                      onchange="validateJS(event,'complete')"
                      required><?= (!empty($subcategory) ? $subcategory->description_subcategory : '') ?></textarea>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- ------------------ Palabras claves del producto ------------------ -->

                  <div class="form-group pb-3">
                    <label for="keywords_product">
                      Palabras claves<sup class="text-danger font-weight-bold">*</sup>
                    </label>

                    <input
                      type="text"
                      class="form-control tags-input"
                      data-role="tagsinput"
                      placeholder="Ingresar las palabras claves"
                      id="keywords_product"
                      name="keywords_product"
                      onchange="validateJS(event,'complete-tags')"
                      value="<?= (!empty($subcategory) ? $subcategory->keywords_subcategory : '') ?>"
                      required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ----------------------- Imagen del producto ---------------------- -->

                  <div class="form-group pb-3 text-center">
                    <label class="pb-3 float-left">Imagen del Producto<sup class="text-danger">*</sup></label>

                    <label for="image_product">
                      <?php if (!empty($subcategory)) : ?>
                        <input
                          type="hidden"
                          value="<?= $subcategory->image_product ?>"
                          name="old_image_product">
                        <img
                          src="/views/assets/img/products/<?= $subcategory->url_product ?>/<?= $subcategory->image_product ?>"
                          class="img-fluid changeImage">
                      <?php else : ?>
                        <img
                          src="/views/assets/img/products/default/default-image.jpg"
                          class="img-fluid changeImage">
                      <?php endif ?>

                      <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>
                    </label>

                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id="image_product"
                        name="image_product"
                        accept="image/*"
                        maxSize="2000000"
                        onchange="validateImageJS(event,'changeImage')"
                        <?php if (empty($subcategory)) : ?> required <?php endif ?>>

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                      <label class="custom-file-label" for="image_product">Buscar Archivo</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- -------------------------- TERCER BLOQUE ------------------------- -->

          <div class="row row-cols-1 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <div class="form-group mx-auto" style="max-width:700px">

                    <!-- -------------------- Información del producto -------------------- -->

                    <label for="info_product">Información del Producto<sup class="text-danger">*</sup></label>

                    <textarea class="summernote" name="info_product" id="info_product" required>
                    </textarea>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ------------------------------ CUARTO BLOQUE ----------------------------- -->

          <div class="row row-cols-1 pt-2 variantList">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <input type="hidden" name="totalVariants" value="1">

                  <!-- ---------------------------- Variantes --------------------------- -->

                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                      <label for="info_product">Variante 1<sup class="text-danger">*</sup></label>

                      <div>
                        <button type="button" class="btn btn-default btn-sm rounded-pill px-3 addVariant">
                          <i class="fas fa-plus fa-xs"></i> Agregar otra variante
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">

                      <!-- ------------------------ Tipo de variante ------------------------ -->

                      <div class="form-group">
                        <select class="custom-select" name="type_variant_1" onchange="changeVariant(event, 1)">
                          <option value="gallery">Galería de fotos</option>
                          <option value="video">Video</option>
                        </select>
                      </div>

                      <!--  ---------------------- Galería del Producto ---------------------- -->

                      <div class="dropzone dropzone_1 mb-3">
                        <!-- ------------------------- Plugin Dropzone ------------------------ -->

                        <div class="dz-message">
                          Arrastra tus imágenes acá, tamaño máximo 400px * 450px
                        </div>
                      </div>

                      <input type="hidden" name="galleryProduct_1" class="galleryProduct_1">

                      <!-- --------------------- Insertar video Youtube --------------------- -->

                      <div class="input-group mb-3 inputVideo_1" style="display:none">
                        <span class="input-group-text">
                          <i class="fas fa-clipboard-list"></i>
                        </span>

                        <input type="text" class="form-control" name="videoProduct_1" placeholder="Ingresa la URL de YouTube" onchange="changeVideo(event, 1)">
                      </div>

                      <iframe width="100%" height="280" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="mb-3 iframeYoutube_1" style="display:none"></iframe>

                    </div>

                    <div class="col">

                      <!-- ------------------- Descripción de la variante ------------------- -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fas fa-clipboard-list"></i>
                        </span>

                        <input type="text" class="form-control" name="description_variant_1" placeholder="Descripción: Color Negro, talla S, Material Goma">
                      </div>

                      <!-- ---------------------- Costo de la variante ---------------------- -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fas fa-hand-holding-usd"></i>
                        </span>

                        <input type="number" step="any" class="form-control" name="cost_variant_1" placeholder="Costo de compra">
                      </div>

                      <!-- ---------------------- Precio de la variante --------------------- -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fas fa-funnel-dollar"></i>
                        </span>

                        <input type="number" step="any" class="form-control" name="price_variant_1" placeholder="Precio de venta">
                      </div>

                      <!-- ---------------------- Oferta de la variante --------------------- -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fas fa-tag"></i>
                        </span>

                        <input type="number" step="any" class="form-control" name="offer_variant_1" placeholder="Precio de descuento">
                      </div>

                      <!-- ------------------ Fin de Oferta de la variante ------------------ -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">Fin del descuento</span>
                        <input type="date" class="form-control" name="date_variant_1">
                      </div>


                      <!-- ---------------------- Stock de la variante ---------------------- -->

                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fas fa-list"></i>
                        </span>

                        <input type="number" class="form-control" name="stock_variant_1" placeholder="Stock disponible">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- -------------------------- QUINTO BLOQUE ------------------------- -->

          <div class="row row-cols-1 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body col-md-6 offset-md-3">

                  <!-- ------------------------- Visor metadatos ------------------------ -->

                  <div class="form-group pb-3 text-center">
                    <label>Visor Metadatos</label>

                    <div class="d-flex justify-content-center">
                      <div class="card">
                        <div class="card-body">

                          <!-- -------------------------- Visor imagen -------------------------- -->

                          <figure class="mb-2">
                            <?php if (!empty($subcategory)) : ?>
                              <img
                                src="/views/assets/img/products/<?= $subcategory->url_subcategory ?>/<?= $subcategory->image_subcategory ?>"
                                class="img-fluid metaImg"
                                style="width:100%">
                            <?php else : ?>
                              <img src="/views/assets/img/products/default/default-image.jpg" class="img-fluid metaImg" style="width:100%">
                            <?php endif ?>
                          </figure>

                          <!-- -------------------------- Visor título -------------------------- -->

                          <h6 class="text-left text-primary mb-1 metaTitle">
                            <?= (!empty($subcategory)) ? $subcategory->name_subcategory : 'Lorem ipsum dolor sit' ?>
                          </h6>

                          <!-- ---------------------------- Visor URL --------------------------- -->

                          <p class="text-left text-success small mb-1">
                            <?= $path ?><span class="metaURL"><?= (!empty($subcategory)) ? $subcategory->url_subcategory : 'lorem' ?></span>
                          </p>

                          <!-- ------------------------ Visor Descripción ----------------------- -->

                          <p class="text-left small mb-1 metaDescription">
                            <?= (!empty($subcategory)) ? $subcategory->description_subcategory : 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus impedit ipsam obcaecati voluptas unde error quod odit ad sapiente vitae.' ?>
                          </p>

                          <!-- ---------------------- Visor Palabras claves --------------------- -->

                          <p class="small text-left text-secondary metaTags">
                            <?= (!empty($subcategory)) ? $subcategory->keywords_subcategory : 'lorem, ipsum, dolor, sit' ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-6 text-center text-lg-left mt-lg-3">
                <label class="font-weight-light"><sup class="text-danger">*</sup> Campos obligatorios</label>
              </div>

              <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill saveBtn">Guardar Información</button>

                <a href="/admin/productos" class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div><a href="/admin/productos" class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">Regresar</a></div>

                <div><button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill saveBtn">Guardar Información</button></div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>