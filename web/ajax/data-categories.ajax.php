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

      $url = 'categories?select=id_category';
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

      $select = 'id_category,status_category,name_category,url_category,image_category,description_category,keywords_category,subcategories_category,products_category,views_category,date_updated_category';

      /* ---------------------------- BUSQUEDA DE DATOS --------------------------- */

      if (!empty($_POST['search']['value'])) {
        if (preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/', $_POST['search']['value'])) {

          $linkTo = ['name_category', 'url_category', 'description_category', 'keywords_category', 'date_updated_category'];
          $search = str_replace(' ', '_', $_POST['search']['value']);

          foreach ($linkTo as $key => $value) {
            $url = 'categories?select=' . $select . '&linkTo=' . $value . '&search=' . $search . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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
        $url = 'categories?select=' . $select . '&orderBy=' . $orderBy . '&orderMode=' . $orderType . '&startAt=' . $start . '&endAt=' . $length;
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
        return;
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

        if ($value->status_category == 1) {
          $status_category = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' checked='true' idItem='" . base64_encode($value->id_category) . "' table='categories' column='category'>";
        } else {
          $status_category = "<input type='checkbox' data-size='mini' data-bootstrap-switch data-off-color='danger' data-on-color='dark' idItem='" . base64_encode($value->id_category) . "' table='categories' column='category'>";
        }

        /* --------------------------------- STATUS --------------------------------- */

        /* -------------------------------------------------------------------------- */
        /*                                   TEXTOS                                   */
        /* -------------------------------------------------------------------------- */

        $name_category = $value->name_category;
        $url_category = "<a href='/" . $value->url_category . "' target='_blank' class='badge badge-light px-3 py-1 border rounded-pill'>/" . $value->url_category . "</a>";
        $image_category =  "<img src='/views/assets/img/categories/" . $value->url_category . "/" . $value->image_category . "' class='img-thumbnail rounded'>";
        $description_category = templateController::reduceText($value->description_category, 25);
        $keywords_category = "";
        $keywordsArray = explode(",", $value->keywords_category);
        foreach ($keywordsArray as $index => $item) {
          $keywords_category .= "<span class='badge badge-primary rounded-pill px-3 py-1'>" . $item . "</span>";
        }
        $subcategories_category = $value->subcategories_category;
        $products_category = $value->products_category;
        $views_category = "<span class='badge badge-warning rounded-pill px-3 py-1'><i class='fas fa-eye'></i> " . $value->views_category . "</span>";
        $date_updated_category = $value->date_updated_category;

        /* --------------------------------- TEXTOS --------------------------------- */

        $actions = "<div class='btn-group'>
									<a href='/admin/categorias/gestion?category=" . base64_encode($value->id_category) . "' class='btn bg-yellow border-0 rounded-pill mr-2 btn-sm px-3'>
										<i class='fas fa-pencil-alt text-white'></i>
									</a>
									<button class='btn btn-danger border-0 rounded-pill mr-2 btn-sm px-3 deleteItem' rol='admin' table='categories' colum='category' idItem='" . base64_encode($value->id_category) . "'>
										<i class='fas fa-trash-alt text-white'></i>
									</button>
								</div>";

        $actions = TemplateController::htmlClean($actions);

        $dataJson .= '{ 
						"id_category":"' . ($start + $key + 1) . '",
						"status_category":"' . $status_category . '",
						"name_category":"' . $name_category . '",
						"url_category":"' . $url_category . '",
						"image_category":"' . $image_category . '",
						"description_category":"' . $description_category . '",
						"keywords_category":"' . $keywords_category . '",
						"subcategories_category":"' . $subcategories_category . '",
						"products_category":"' . $products_category . '",
						"views_category":"' . $views_category . '",
						"date_updated_category":"' . $date_updated_category . '",
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