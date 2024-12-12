<?php

require_once '../controllers/curl.controller.php';
require_once '../controllers/template.controller.php';

class DatatableController
{
  public function data()
  {

    if (!empty($_POST)) {

      /* ---------------- CAPTURAR Y ORGANIZAR VARIABLES POST DE DT --------------- */
      $draw = $_POST['draw'];
      $orderByColumnIndex = $_POST['order'][0]['column'];
      $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];
      $orderType = $_POST['order'][0]['dir'];
      $start = $_POST['start'];
      $length = $_POST['length'];

      /* ---------------------- TOTAL DE REGISTROS DE LA DATA --------------------- */
      $url = 'slides?select=id_slide';
      $method = 'GET';
      $fields = [];
      $response = CurlController::request($url, $method, $fields);

      if ($response->status == 200) {
        $totalData = $response->total;
      } else {
        echo '{
          "Draw": 1,
					"recordsTotal": 0,
          "recordsFiltered": 0,
          "data":[]}';
        return;
      }

      $select = 'id_slide,background_slide,direction_slide,img_png_slide,status_slide,date_created_slide';

      /* ---------------------- BUSQUEDA DE DATOS A REGRESAR ---------------------- */
      if (!empty($_POST['search']['value'])) {
        if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

          $linkTo = ['date_created_slide'];
          $search = str_replace(' ', '_', $_POST['search']['value']);

          foreach ($linkTo as $key => $value) {
            $url = 'slides?select=' . $select . '&linkTo=' . $value . '&search=' . $search . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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
          echo '{
          "Draw": 1,
					"recordsTotal": 0,
          "recordsFiltered": 0,
          "data":[]}';
          return;
        }
      } else {

        /* ---------------------------- SELECCIONAR DATOS --------------------------- */
        $url = 'slides?select=' . $select . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
        $data = CurlController::request($url, $method, $fields)->results;
        $recordsFiltered = $totalData;
      }

      /* ------------------------ CUANDO LA DATA ESTA VACIA ----------------------- */
      if (empty($data)) {
        echo '{
          "Draw": 1,
					"recordsTotal": 0,
          "recordsFiltered": 0,
          "data":[]}';
        return;
      }

      /* ------------------ CONTRUIMOS LOS DATOS JSON A REGRESAR ------------------ */
      $dataJson = '{
				"Draw": ' . intval($draw) . ',
				"recordsTotal": ' . $totalData . ',
				"recordsFiltered": ' . $recordsFiltered . ',
				"data": [';

      foreach ($data as $key => $value) {

        /* --------------------------------- STATUS --------------------------------- */
        if ($value->status_slide == 1) {
          $status_slide = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' checked='true' idItem='" . base64_encode($value->id_slide) . "' table='slides' column='slide'>";
        } else {
          $status_slide = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' idItem='" . base64_encode($value->id_slide) . "' table='slides' column='slide'>";
        }

        $background_slide =  "<img src='/views/assets/img/slide/" . $value->id_slide . "/" . $value->background_slide . "' class='img-thumbnail rounded' style='width:100px'>";

        if ($value->direction_slide == "opt1") {
          $direction_slide = "Opción 1";
        } else if ($value->direction_slide == "opt2") {
          $direction_slide = "Opción 2";
        } else {
          $direction_slide = "No aplica";
        }

        if (!empty($value->img_png_slide)) {
          $img_png_slide =  "<img src='/views/assets/img/slide/" . $value->id_slide . "/" . $value->img_png_slide . "' class='img-thumbnail rounded' style='width:100px'>";
        } else {
          $img_png_slide = "No aplica";
        }

        $date_created_slide = TemplateController::formatDate(4, $value->date_created_slide);

        $actions = "<div class='btn-group'>
									<a href='/admin/slides/gestion?slide=" . base64_encode($value->id_slide) . "' class='btn bg-warning border-0 rounded-pill mr-2 btn-sm px-3'>
										<i class='fas fa-pencil-alt text-white'></i>
									</a>
									<button class='btn btn-danger border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='slides' colum='slide' idItem='" . base64_encode($value->id_slide) . "'>
										<i class='fas fa-trash-alt text-white'></i>
									</button>
								</div>";

        $actions = TemplateController::htmlClean($actions);

        $dataJson .= '{ 
						"id_slide":"' . ($start + $key + 1) . '",
						"status_slide":"' . $status_slide . '",
						"background_slide":"' . $background_slide . '",
						"direction_slide":"' . $direction_slide . '",
						"img_png_slide":"' . $img_png_slide . '",
						"date_created_slide":"' . $date_created_slide . '",
						"actions":"' . $actions . '"
					},';
      }

      $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

      $dataJson .= ']}';

      echo $dataJson;
    }
  }
}

/* -------------------------------------------------------------------------- */
/*                           ACTIVAR FUNCION DATABLE                          */
/* -------------------------------------------------------------------------- */

$data = new DatatableController();
$data->data();

/* ------------------------- ACTIVAR FUNCION DATABLE ------------------------ */