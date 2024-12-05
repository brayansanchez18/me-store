<?php

class CurlController
{
  /* -------------------------------------------------------------------------- */
  /*                             PETICION DE LA API                             */
  /* -------------------------------------------------------------------------- */

  static public function request($url, $method, $fields)
  {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://api.me-store.test/' . $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $fields,
      CURLOPT_HTTPHEADER => array(
        'Authorization: SSDFzdg235dsgsdfAsa44SDFGDFDadg',
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response);
    return $response;
  }

  /* --------------------------- PETICION DE LA API --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                        PETICIONES A LA API DE PAYPAL                       */
  /* -------------------------------------------------------------------------- */

  static public function paypal($url, $method, $fields)
  {
    $endpoint = 'https://api-m.sandbox.paypal.com/'; //TEST
    $clientId = 'ATMp5pdb1e0_TQ0IWemEaWgZekcdcJ_f--m-lDyara3vax4H4BhlOO-KtHP5yc_6jgRlbf3bhaD9L3I7'; //TEST
    $secretClient = 'EL_CuKTBKAGzBULaJIEA7maS1Y81U8AwaklXAVv6EELnazLuHhl_GPitdK5-dgyavx50VMjLxFmsEgpx'; //TEST

    $basic = base64_encode($clientId . ':' . $secretClient);

    /* ------------------------------ ACCESS TOKEN ------------------------------ */
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $endpoint . 'v1/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Basic ' . $basic,
        'Cookie: cookie_check=yes'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);

    $token = $response->access_token;

    if (!empty($token)) {

      /* -------------------------------------------------------------------------- */
      /*                                 CREAR ORDEN                                */
      /* -------------------------------------------------------------------------- */

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $endpoint . $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          'Authorization: Bearer ' . $token,
          'Cookie: cookie_check=yes'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $response = json_decode($response);
      return $response;

      /* ------------------------------- CREAR ORDEN ------------------------------ */
    }
  }

  /* ---------------------- PETICIONES A LA API DE PAYPAL --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                        PETICIONES A LA API DE DLOCAL                       */
  /* -------------------------------------------------------------------------- */

  static public function dlocal($url, $method, $fields)
  {

    $endpoint = 'https://api-sbx.dlocalgo.com/'; //TEST
    $apiKey = 'CmirPCuxoyTvlWmTMzFqUAbOYmrHpYVZ'; //TEST
    $secretKey = 'EXbOrOknCWy3gaMJcZY2grjm7sWXTyZjxuEqF0Xi'; //TEST


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $endpoint . $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $fields,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey . ':' . $secretKey
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);
    return $response;
  }

  /* ---------------------- PETICIONES A LA API DE DLOCAL --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     PETICIONES A LA API DE MERCADO PAGO                    */
  /* -------------------------------------------------------------------------- */

  static public function mercadoPago($url, $method, $fields)
  {

    $endpoint = 'https://api.mercadopago.com/'; //TEST Y LIVE
    $accessToken = 'APP_USR-1103946994170926-120422-907fa8d314ccf3b2d59e04b5668db5fd-2139240906'; //TEST

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $endpoint . $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $fields,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);
    return $response;
  }

  /* ------------------- PETICIONES A LA API DE MERCADO PAGO ------------------ */
}
