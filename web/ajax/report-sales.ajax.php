<?php

require_once '../controllers/curl.controller.php';
require_once '../controllers/template.controller.php';

class DatatableController
{

  public function data()
  {

    if (!empty($_POST)) {

      /* -------------------- CAPTURAR Y ORGANIZAR DATOS DE DT -------------------- */
      $draw = $_POST['draw'];
      $orderByColumnIndex = $_POST['order'][0]['column'];
      $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];
      $orderType = $_POST['order'][0]['dir'];
      $start = $_POST['start'];
      $length = $_POST['length'];

      /* ------------------------ TOTAL DE REGISTROS DE DT ------------------------ */
      $url = 'relations?rel=orders,users,products,variants&type=order,user,product,variant&linkTo=start_date_order&between1=' . $_GET['between1'] . '&between2=' . $_GET['between2'] . '&select=id_order&filterTo=process_order&inTo=2';
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

      $select = 'id_order,ref_order,description_variant,quantity_order,price_order,name_user,email_user,state_user,municipality_user,zip_code_user,method_order,number_order,track_order,start_date_order,end_date_order';

      /* ---------------------------- BUSQUEDA DE DATOS --------------------------- */
      if (!empty($_POST['search']['value'])) {
        if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

          $linkTo = [
            'ref_order',
            'description_variant',
            'quantity_order',
            'price_order',
            'name_user',
            'email_user',
            'state_user',
            'municipality_user',
            'zip_code_user',
            'method_order',
            'number_order',
            'track_order',
            'start_date_order',
            'end_date_order'
          ];

          $search = str_replace(' ', '_', $_POST['search']['value']);

          foreach ($linkTo as $key => $value) {
            $url = 'relations?rel=orders,users,products,variants&type=order,user,product,variant&select=' . $select . '&linkTo=' . $value . ',process_order&search=' . $search . ',2&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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
        $url = 'relations?rel=orders,users,products,variants&type=order,user,product,variant&linkTo=start_date_order&between1=' . $_GET['between1'] . '&between2=' . $_GET['between2'] . '&select=' . $select . '&filterTo=process_order&inTo=2&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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

      /* ------------------ CONSTRUIMOS LOS DATOS JSON A RETORNAR ----------------- */
      $dataJson = '{
				"Draw": ' . intval($draw) . ',
				"recordsTotal": ' . $totalData . ',
				"recordsFiltered": ' . $recordsFiltered . ',
				"data": [';

      // var_dump($url);
      // return;

      foreach ($data as $key => $value) {
        $ref_order = $value->ref_order;
        $description_variant = $value->description_variant;
        $quantity_order = $value->quantity_order;
        $price_order = number_format($value->price_order, 2);
        $name_user = $value->name_user;
        $email_user = $value->email_user;
        $country_user = $value->state_user;
        $department_user = $value->municipality_user;
        $city_user = $value->zip_code_user;
        $method_order = $value->method_order;
        $number_order = $value->number_order;
        $track_order = $value->track_order;
        $start_date_order = $value->start_date_order;
        $end_date_order = $value->end_date_order;

        $dataJson .= '{ 
						"id_order":"' . ($start + $key + 1) . '",
						"ref_order":"' . $ref_order . '",
            "description_variant":"' . $description_variant . '",
						"quantity_order":"' . $quantity_order . '",
						"price_order":"' . $price_order . '",
						"name_user":"' . $name_user . '",
						"email_user":"' . $email_user . '",
						"country_user":"' . $country_user . '",
						"department_user":"' . $department_user . '",
						"city_user":"' . $city_user . '",
						"method_order":"' . $method_order . '",
						"number_order":"' . $number_order . '",
						"track_order":"' . $track_order . '",
						"start_date_order":"' . $start_date_order . '",
						"end_date_order":"' . $end_date_order . '"
					},';
      }

      $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

      $dataJson .= ']}';

      echo $dataJson;
    }
  }
}

/* -------------------------------------------------------------------------- */
/*                        ACTIVAMOS FUNCION DATA TABLE                        */
/* -------------------------------------------------------------------------- */

$data = new DatatableController();
$data->data();

/* ---------------------- ACTIVAMOS FUNCION DATA TABLE ---------------------- */
