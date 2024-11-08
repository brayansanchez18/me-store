<div class="container py-3">
  <form method="post" class="needs-validation" novalidate>
    <div class="row mb-3">
      <div class="col-12 col-lg-6 text-center text-lg-left">
        <h4 class="mt-3">Editar Datos</h4>
      </div>

      <div class="col-12 col-lg-6 mt-2 d-none d-lg-block">
        <button type="submit" class="btn border-0 templateColor float-right py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
      </div>

      <div class="col-12 text-center d-flex justify-content-center mt-2 d-block d-lg-none">
        <div>
          <button type="submit" class="btn border-0 templateColor py-2 px-3 btn-sm rounded-pill">Guardar Información</button>
        </div>
      </div>
    </div>

    <?php
    require_once 'controllers/users.controller.php';
    $modify = new UsersController();
    $modify->modify();
    ?>

    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="mb-3 mt-3">
              <label for="text" class="form-label">Nombre:</label>

              <input
                type="text"
                class="form-control"
                id="text"
                value="<?= $_SESSION['user']->name_user ?>"
                name="name_user"
                onchange="validateJS(event,'text')"
                required>

              <div class="valid-feedback">Válido.</div>
              <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
            </div>

            <div class="mb-3 mt-3">
              <label for="email" class="form-label">Email:</label>

              <input
                type="email"
                class="form-control"
                id="email"
                value="<?= $_SESSION['user']->email_user ?>"
                readonly>
            </div>

            <?php if ($_SESSION['user']->method_user == 'directo'): ?>
              <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>

                <input
                  type="password"
                  class="form-control"
                  id="pwd"
                  placeholder="Modificar contraseña"
                  onchange="validateJS(event,'password')"
                  name="password_user">

                <div class="valid-feedback">Válido.</div>
                <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
              </div>
            <?php endif ?>

            <div class="mb-3 mt-3">
              <label for="mehtod" class="form-label">Método de registro:</label>

              <input
                type="text"
                class="form-control text-capitalize"
                id="mehtod"
                value="<?= $_SESSION['user']->method_user ?>"
                readonly>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="mb-3 mt-3">

              <?php
              $data = file_get_contents('views/assets/json/estados.json');
              $states = json_decode($data, true);
              ?>

              <label for="state" class="form-label">Estado:</label>

              <select
                id="state"
                class="form-control select2"
                style="text-transform: capitalize;"
                name="state_user">

                <?php if ($_SESSION['user']->state_user != null): ?>
                  <option value="<?= $_SESSION['user']->state_user ?>">
                    <?= $_SESSION['user']->state_user ?>
                  </option>
                <?php else: ?>
                  <option value="">Seleccionar Estado</option>

                  <?php foreach ($states as $key => $value): ?>
                    <option value="<?= $value['nombre'] ?>"><?= $value['nombre'] ?></option>
                  <?php endforeach ?>
                <?php endif ?>

              </select>

              <div class="valid-feedback">Válido.</div>
              <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
            </div>

            <div class="mb-3 mt-3">
              <label for="municipality" class="form-label">Municipio:</label>

              <input
                type="text"
                class="form-control"
                id="municipality"
                value="<?= $_SESSION['user']->municipality_user ?>"
                name="municipality_user"
                onchange="validateJS(event,'text')"
                required>

              <div class="valid-feedback">Válido.</div>
              <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
            </div>

            <div class="mb-3 mt-3">
              <label for="zip_code" class="form-label">Codigo Postal:</label>

              <input
                type="text"
                class="form-control"
                id="zip_code"
                value="<?= $_SESSION['user']->zip_code_user ?>"
                name="zip_code_user"
                onchange="validateJS(event,'number')"
                required>

              <div class="valid-feedback">Válido.</div>
              <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
            </div>

            <div class="mb-3 mt-3">
              <label for="phone" class="form-label">Número celular:</label>

              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  id="phone"
                  value="<?= $_SESSION['user']->phone_user ?>"
                  name="phone_user"
                  required
                  data-inputmask="'mask': ['999-999-9999']"
                  data-mask>

                <div class="valid-feedback">Válido.</div>
                <div class="invalid-feedback">Por favor llena este campo correctamente.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="mb-3 mt-3">
              <label for="address" class="form-label">Dirección:</label>

              <textarea
                class="form-control p-2"
                id="address"
                rows="5"
                onchange="validateJS(event,'complete')"
                name="address_user"><?= $_SESSION['user']->address_user ?></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="<?= $path ?>views/assets/js/forms/forms.js"></script>