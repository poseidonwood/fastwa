<?php
include_once ("config.php");
print_r($port);
if(is_array($port)){
  foreach ($port as $datanya => $key) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://fekusa.xyz:{$key}/getdetail",
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
