<?php
require_once '../controllers/curl.controller.php';
require_once '../controllers/template.controller.php';

class DatatableController
{
  public function data()
  {
    if (!empty($_POST)) {
      # cotnador utilizado por datatables para garantizar que los retornos de ajax de las solicitues de procesamiento de lado del servidor sean dibujados en secuencia por datatables #
      $draw = $_POST['draw'];
      // echo '<pre>' . print_r($draw) . '</pre>';

      # indice de la conlumna de clasificacion (0 basado en el indice, es decir, 0 es el primer registro) #
      $orderByColumnIndex = $_POST['order'][0]['column'];
      // echo '<pre>' . print_r($orderByColumnIndex) . '</pre>';

      # obtener el nombre de la columna de clasificacion de su indice #
      $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];
      // echo '<pre>' . print_r($orderBy) . '</pre>';

      # obtener el orden ADC o DESC #
      $orderType = $_POST['order'][0]['dir'];
      // echo '<pre>' . print_r($orderType) . '</pre>';

      # indicador de primer registro de paginacion #
      $start = $_POST['start'];
      // echo '<pre>' . print_r($start) . '</pre>';

      # indicador de la longitud de la paginacion #
      $length = $_POST['length'];
      // echo '<pre>' . print_r($length) . '</pre>';

      /* -------------------------------------------------------------------------- */
      /*                      EL TOTAL DE REGISTROS DE LA DATA                      */
      /* -------------------------------------------------------------------------- */

      $url = 'admins?select=id_admin';
      $method = 'GET';
      $fields = [];

      $response = CurlController::request($url, $method, $fields);

      if ($response->status == 200) {
        $totalData = $response->total;
      } else {
        echo '{"data": []}';
        return;
      }


      /* -------------------- EL TOTAL DE REGISTROS DE LA DATA -------------------- */

      /* -------------------------------------------------------------------------- */
      /*                              SELECCIONAR DATOS                             */
      /* -------------------------------------------------------------------------- */

      $select = 'id_admin,rol_admin,name_admin,email_admin,date_updated_admin';

      /* ---------------------------- BUSQUEDA DE DATOS --------------------------- */

      if (!empty($_POST['search']['value'])) {
        if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

          $linkTo = ['name_admin', 'email_admin', 'rol_admin'];
          $search = str_replace(' ', '_', $_POST['search']['value']);

          foreach ($linkTo as $key => $value) {
            $url = 'admins?select=' . $select . '&linkTo=' . $value . '&search=' . $search . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
            $data = CurlController::request($url, $method, $fields)->results;

            if ($data == 'Not Found') {
              $data = [];
              $recordsFiltered = 0;
            } else {
              $recordsFiltered = count($data);
              break;
            }
          }
        } else {
          echo '{"data": []}';
          return;
        }
      } else {
        $url = 'admins?select=' . $select . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
        $data = CurlController::request($url, $method, $fields)->results;
        // echo '<pre>' . print_r($data) . '</pre>';

        $recordsFiltered = $totalData;
      }



      /* ---------------------------- SELECCIONAR DATOS --------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                         CUANDO LA DATA VIENE VACIA                         */
      /* -------------------------------------------------------------------------- */

      if (empty($data)) {
        echo '{"data":[]}';
      }

      /* ----------------------- CUANDO LA DATA VIENE VACIA ----------------------- */

      /* -------------------------------------------------------------------------- */
      /*                    CONSTRUIMOS EL DATOS JSON A REGRESAR                    */
      /* -------------------------------------------------------------------------- */

      $dataJson = '{
      "Draw": ' . intval($draw) . ',
      "recordsTotal": ' . $totalData . ',
      "recordsFiltered": ' . $recordsFiltered . ',
      "data": [';

      foreach ($data as $key => $value) {

        $name_admin = $value->name_admin;
        $email_admin = $value->email_admin;
        $rol_admin = $value->rol_admin;
        $date_updated_admin = $value->date_updated_admin;
        $actions = "<div class='btn-group'>
                  <a href='/admin/administradores/gestion?admin=" . base64_encode($value->id_admin) . "' class='btn bg-yellow border-0 rounded-pill mr-2 btn-sm px-3'>
                    <i class='fas fa-pencil-alt text-white'></i>
                  </a>
                  <button class='btn btn-danger border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='admins' colum='admin' idItem='" . base64_encode($value->id_admin) . "'>
                    <i class='fas fa-trash-alt text-white'></i>
                  </button>
                </div>";

        $actions = TemplateController::htmlClean($actions);

        $dataJson .= '{
          "id_admin": "' . ($start + $key + 1) . '",
          "name_admin": "' . $name_admin . '",
          "email_admin": "' . $email_admin . '",
          "rol_admin": "' . $rol_admin . '",
          "date_updated_admin": "' . $date_updated_admin . '",
          "actions": "' . $actions . '"
        },';
      }

      $dataJson = substr($dataJson, 0, -1);
      $dataJson .= ']}';
      echo $dataJson;

      /* ------------------- CONTRUIMOS EL DATOS JSON A REGRESAR ------------------ */
    }
  }
}

/* -------------------------------------------------------------------------- */
/*                         ACTIVAR FUNCION DATA TABLE                         */
/* -------------------------------------------------------------------------- */

$data = new DatatableController();
$data->data();

/* ----------------------- ACTIVAR FUNCION DATA TABLE ----------------------- */