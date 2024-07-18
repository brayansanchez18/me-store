<div class="content-wrapper" style="min-height: 1504.06px;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> <small>Slides</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Tablero</a></li>
            <li class="breadcrumb-item">Promoción</li>
            <li class="breadcrumb-item active">Slides</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="content pb-5">

    <div class="container">

      <div class="card">

        <div class="card-header">

          <h3 class="card-title">
            <a href="/admin/slides/gestion" class="btn bg-default templateColor py-2 px-3 btn-sm rounded-pill">Agregar Slide</a>
          </h3>

        </div>

        <div class="card-body">

          <table id="tables" class="table table-bordered table-striped slidesTable">

            <thead>
              <tr>
                <th>#</th>
                <th>Estado</th>
                <th>Fondo</th>
                <th>Posición</th>
                <th>Imagen Flotante</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>

            </thead>
            <tbody>
              <tr>
                <td>1</td>

                <td>
                  <input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' checked='true'>
                </td>

                <td><img class="img-thumbnail" src="/views/assets/img/slide/1/back_default.jpg" style="width:100px"></td>

                <td>Opción 1</td>

                <td><img class="img-thumbnail" src="/views/assets/img/slide/1/calzado.png" style="width:100px"></td>

                <td>10/05/2024</td>

                <td>
                  <div class="btn-group">
                    <a href="" class="btn bg-purple border-0 rounded-pill mr-2 btn-sm px-3">
                      <i class="fas fa-pencil-alt text-white"></i>
                    </a>
                    <a href="" class="btn btn-dark border-0 rounded-pill mr-2 btn-sm px-3">
                      <i class="fas fa-trash-alt text-white"></i>
                    </a>
                  </div>
                </td>
              </tr>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

  <!-- /.content -->
</div>

<script src="<?= $path ?>views/assets/js/slide/slide.js"></script>