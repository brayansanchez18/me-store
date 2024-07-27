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

      $url = 'relations?rel=subcategories,categories&type=subcategory,category&select=id_subcategory';
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


      /* -------------------- EL TOTAL DE REGISTROS DE LA DATA -------------------- */

      /* -------------------------------------------------------------------------- */
      /*                              SELECCIONAR DATOS                             */
      /* -------------------------------------------------------------------------- */

      $select = '*';

      /* ---------------------------- BUSQUEDA DE DATOS --------------------------- */

      if (!empty($_POST['search']['value'])) {
        if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

          $linkTo = ['name_subcategory', 'url_subcategory', 'description_subcategory', 'keywords_subcategory', 'date_updated_subcategory', 'name_category'];
          $search = str_replace(' ', '_', $_POST['search']['value']);

          foreach ($linkTo as $key => $value) {
            $url = 'relations?rel=subcategories,categories&type=subcategory,category&select=' . $select . '&linkTo=' . $value . '&search=' . $search . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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
        $url = 'relations?rel=subcategories,categories&type=subcategory,category&select=' . $select . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
        $data = CurlController::request($url, $method, $fields)->results;
        // echo '<pre>' . print_r($data) . '</pre>';

        $recordsFiltered = $totalData;
      }



      /* ---------------------------- SELECCIONAR DATOS --------------------------- */

      /* -------------------------------------------------------------------------- */
      /*                         CUANDO LA DATA VIENE VACIA                         */
      /* -------------------------------------------------------------------------- */

      if (empty($data)) {
        echo '{
          "Draw": 1,
          "recordsTotal": 0,
          "recordsFiltered": 0,
          "data":[]}';
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

        /* -------------------------------------------------------------------------- */
        /*                                   STATUS                                   */
        /* -------------------------------------------------------------------------- */

        if ($value->status_subcategory == 1) {
          $status_subcategory = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' checked='true' idItem='" . base64_encode($value->id_subcategory) . "' table='subcategories' column='subcategory'>";
        } else {
          $status_subcategory = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' idItem='" . base64_encode($value->id_subcategory) . "' table='subcategories' column='subcategory'>";
        }

        /* --------------------------------- STATUS --------------------------------- */

        /* -------------------------------------------------------------------------- */
        /*                                   TEXTOS                                   */
        /* -------------------------------------------------------------------------- */

        $name_subcategory = $value->name_subcategory;
        $url_subcategory = "<a href='/" . $value->url_subcategory . "' target='_blank' class='badge badge-light px-3 py-1 border rounded-pill'>/" . $value->url_subcategory . "</a>";
        $image_subcategory =  "<img src='/views/assets/img/subcategories/" . $value->url_subcategory . "/" . $value->image_subcategory . "' class='img-thumbnail rounded'>";
        $description_subcategory = templateController::reduceText($value->description_subcategory, 25);
        $keywords_subcategory = "";
        $keywordsArray = explode(",", $value->keywords_subcategory);
        foreach ($keywordsArray as $index => $item) {
          $keywords_subcategory .= "<span class='badge badge-primary rounded-pill px-3 py-1'>" . $item . "</span>";
        }
        $name_category = $value->name_category;
        $products_subcategory = $value->products_subcategory;
        $views_subcategory = "<span class='badge badge-warning rounded-pill px-3 py-1'><i class='fas fa-eye'></i> " . $value->views_subcategory . "</span>";
        $date_updated_subcategory = $value->date_updated_subcategory;

        /* --------------------------------- TEXTOS --------------------------------- */

        $actions = "<div class='btn-group'>
									<a href='/admin/subcategorias/gestion?subcategory=" . base64_encode($value->id_subcategory) . "' class='btn bg-yellow border-0 rounded-pill mr-2 btn-sm px-3'>
										<i class='fas fa-pencil-alt text-white'></i>
									</a>
									<button class='btn btn-danger border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='subcategories' colum='subcategory' idItem='" . base64_encode($value->id_subcategory) . "'>
										<i class='fas fa-trash-alt text-white'></i>
									</button>
								</div>";

        $actions = TemplateController::htmlClean($actions);

        $dataJson .= '{ 
						"id_subcategory":"' . ($start + $key + 1) . '",
						"status_subcategory":"' . $status_subcategory . '",
						"name_subcategory":"' . $name_subcategory . '",
						"url_subcategory":"' . $url_subcategory . '",
						"image_subcategory":"' . $image_subcategory . '",
						"description_subcategory":"' . $description_subcategory . '",
						"keywords_subcategory":"' . $keywords_subcategory . '",
						"name_category":"' . $name_category . '",
						"products_subcategory":"' . $products_subcategory . '",
						"views_subcategory":"' . $views_subcategory . '",
						"date_updated_subcategory":"' . $date_updated_subcategory . '",
						"actions":"' . $actions . '"
					},';
      }

      $dataJson = substr($dataJson, 0, -1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

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