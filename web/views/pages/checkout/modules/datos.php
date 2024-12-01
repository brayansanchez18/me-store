<div class="card bg-white p-4">

  <!-- --------------------------------- NOMBRE --------------------------------- -->

  <div class="mt-3">
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

  <!-- ---------------------------------- EMAIL --------------------------------- -->

  <div class="mt-3">
    <label for="email" class="form-label">Email:</label>

    <input
      type="email"
      class="form-control"
      id="email"
      value="<?= $_SESSION['user']->email_user ?>"
      readonly>
  </div>

  <!-- --------------------------------- ESTADO --------------------------------- -->

  <div class="mt-3">
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

        <?php foreach ($states as $key => $value): ?>
          <option value="<?= $value['nombre'] ?>"><?= $value['nombre'] ?></option>
        <?php endforeach ?>
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

  <!-- ------------------------------- MUNICIOPIO ------------------------------- -->

  <div class="mt-3">
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

  <!-- ------------------------------ CODIGO POSTAL ----------------------------- -->

  <div class="mt-3">
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

  <!-- -------------------------------- TELEFONO -------------------------------- -->

  <div class="mt-3">
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

  <!-- -------------------------------- DIRECCION ------------------------------- -->

  <div class="mt-3">
    <label for="address" class="form-label">Dirección:</label>

    <textarea
      class="form-control p-2"
      id="address"
      rows="5"
      onchange="validateJS(event,'complete')"
      name="address_user"><?php echo $_SESSION["user"]->address_user ?></textarea>
  </div>
</div>