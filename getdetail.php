<?php
include_once ("config.php");
if(is_array($port)){
  foreach ($data as $datanya) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://fekusa.xyz:{$datanya}/getdetail",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
  }
}
