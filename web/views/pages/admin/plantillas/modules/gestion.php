<div class="content pb-5">
  <div class="container">
    <div class="card">
      <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        <div class="card-header">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-6 text-center text-lg-left">
                <h4 class="mt-3">Agregar Plantilla</h4>
              </div>

              <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
                <button
                  type="submit"
                  class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">
                  Guardar Información
                </button>
                <a
                  href="/admin/plantillas"
                  class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">
                  Regresar
                </a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div>
                  <a href="/admin/plantillas"
                    class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">
                    Regresar
                  </a>
                </div>
                <div>
                  <button
                    type="submit"
                    class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">
                    Guardar Información
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <?php
          require_once 'controllers/templates.controller.php';
          $manage = new TemplatesController();
          $manage->templatesManage();
          ?>

          <!-- ------------------------------ PRIMER BLOQUE ----------------------------- -->
          <div class="row row-cols-1 row-cols-md-2 pt-2">
            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- ------------------------- TITULO DE LA PLANTILLA ------------------------- -->
                  <div class="form-group pb-3">
                    <label for="title_template">Título <sup class="text-danger font-weight-bold">*</sup></label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Ingresar el título"
                      id="title_template"
                      name="title_template"
                      onchange="validateJS(event,'text')"
                      value=""
                      required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- ----------------------- DESCRIPCION DE LA PLANTILLA ---------------------- -->
                  <div class="form-group pb-3">
                    <label for="description_template">Descripción<sup class="text-danger font-weight-bold">*</sup></label>

                    <textarea
                      rows="9"
                      class="form-control"
                      placeholder="Ingresar la descripción"
                      id="description_template"
                      name="description_template"
                      onchange="validateJS(event,'complete')"
                      required></textarea>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- --------------------- PALABRAS CLAVE DE LA PLANTILLA --------------------- -->
                  <div class="form-group pb-3">
                    <label for="keywords_template">Palabras claves<sup class="text-danger font-weight-bold">*</sup></label>

                    <input
                      type="text"
                      class="form-control tags-input"
                      data-role="tagsinput"
                      placeholder="Ingresar las palabras claves"
                      id="keywords_template"
                      name="keywords_template"
                      onchange="validateJS(event,'complete-tags')"
                      value=""
                      required>

                    <div class="valid-feedback">Válido.</div>
                    <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                  </div>

                  <!-- ------------------------- FUENTES DE LA PLANTILLA ------------------------ -->
                  <div class="form-group pb-3">
                    <label>Fuentes <sup class="text-danger font-weight-bold">*</sup></label>
                    <div class="input-group">
                      <span class="input-group-text">Google Fonts:</span>

                      <textarea
                        type="text"
                        class="form-control"
                        id="fontFamily"
                        rows="7"
                        required></textarea>

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                      <input type="hidden" name="fontFamily">
                    </div>

                    <div class="row my-3">
                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Body:</span>

                          <input type="text"
                            class="form-control"
                            placeholder="Font Family"
                            id="fontBody"
                            name="fontBody"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Slide:</span>

                          <input
                            type="text"
                            class="form-control"
                            placeholder="Font Family"
                            id="fontSlide"
                            name="fontSlide"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- ------------------------- COLORES DE LA PLANTILLA ------------------------ -->
                  <div class="form-group pb-3">
                    <label>Colores <sup class="text-danger font-weight-bold">*</sup></label>

                    <div class="row mb-3">
                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Texto Superior:</span>

                          <input
                            type="color"
                            class="form-control form-control-color border"
                            id="topColor"
                            name="topColor"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Fondo Superior:</span>

                          <input
                            type="color"
                            class="form-control form-control-color border"
                            id="topBackground"
                            name="topBackground"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Texto Botón:</span>

                          <input
                            type="color"
                            class="form-control form-control-color border"
                            id="templateColor"
                            name="templateColor"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="input-group">
                          <span class="input-group-text">Fondo Botón:</span>

                          <input
                            type="color"
                            class="form-control form-control-color border"
                            id="templateBackground"
                            name="templateBackground"
                            value=""
                            required>

                          <div class="valid-feedback">Válido.</div>
                          <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card">
                <div class="card-body">

                  <!-- -------------------------- LOGO DE LA PLANTILLA -------------------------- -->
                  <div class="form-group pb-3 text-center">
                    <label class="pb-3 float-left">Logo de la plantilla<sup class="text-danger">*</sup></label>

                    <label for="logo_template">
                      <img src="/views/assets/img/template/default/default-logo.jpg" class="img-fluid changeLogo">

                      <p class="help-block small mt-3">Dimensiones recomendadas: 500 x 100 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>
                    </label>

                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id="logo_template"
                        name="logo_template"
                        accept="image/*"
                        maxSize="2000000"
                        onchange="validateImageJS(event,'changeLogo')">

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                      <label class="custom-file-label" for="logo_template">Buscar Archivo</label>
                    </div>
                  </div>

                  <!-- -------------------------- ICONO DE LA PLANTILLA ------------------------- -->
                  <div class="form-group pb-3 text-center">
                    <label class="pb-3 float-left">Icono de la plantilla<sup class="text-danger">*</sup></label>

                    <label for="icon_template">
                      <img src="/views/assets/img/template/default/default-icon.jpg" class="img-fluid changeIcon">
                      <p class="help-block small mt-3">Dimensiones recomendadas: 100 x 100 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>
                    </label>

                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id="icon_template"
                        name="icon_template"
                        accept="image/*"
                        maxSize="2000000"
                        onchange="validateImageJS(event,'changeIcon')">

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                      <label class="custom-file-label" for="icon_template">Buscar Archivo</label>
                    </div>
                  </div>

                  <!-- ------------------------- IMAGEN DE LA PLANTILLA ------------------------- -->
                  <div class="form-group pb-3 text-center">
                    <label class="pb-3 float-left">Imagen de la plantilla<sup class="text-danger">*</sup></label>

                    <label for="cover_template">
                      <img src="/views/assets/img/template/default/default-image.jpg" class="img-fluid changeCover">

                      <p class="help-block small mt-3">Dimensiones recomendadas: 1000 x 600 pixeles | Peso Max. 2MB | Formato: PNG o JPG</p>
                    </label>

                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        id="cover_template"
                        name="cover_template"
                        accept="image/*"
                        maxSize="2000000"
                        onchange="validateImageJS(event,'changeCover')">

                      <div class="valid-feedback">Válido.</div>
                      <div class="invalid-feedback">Por favor llena este campo correctamente.</div>

                      <label class="custom-file-label" for="cover_template">Buscar Archivo</label>
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
                <button
                  type="submit"
                  class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">
                  Guardar Información
                </button>
                <a
                  href="/admin/plantillas"
                  class="btn btn-default float-right py-2 px-3 btn-sm rounded-pill mr-2">
                  Regresar
                </a>
              </div>

              <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
                <div>
                  <a
                    href="/admin/plantillas"
                    class="btn btn-default py-2 px-3 btn-sm rounded-pill mr-2">
                    Regresar
                  </a>
                </div>
                <div>
                  <button
                    type="submit"
                    class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">
                    Guardar Información
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>