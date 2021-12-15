<?php 

if(isset($_POST['number'])){
    $number = $_POST['number'];
    if(!empty($_REQUEST['caption']) || $_REQUEST['caption'] != ""  ){

        $file = $_POST['file_url'];
        $caption = $_POST['caption'];
        $data = array();
        $response = sendMedia($number,$caption,$file);
        $dRespoonse = json_decode($response,true);
        if($dRespoonse['status'] == true){
            $data['status'] = true;
            $data['message'] = "Berhasil Terkirim";
        }else{
            if(is_array($dRespoonse['message'])){
                $pesan = $dRespoonse['message']['message'];
            }else{
                if($dRespoonse['message'] == null){
                 $pesan = "Pastikan Data Terisi";
                }else{
                 $pesan = $dRespoonse['message'];
                } 
            }
            $data['status'] = false;
            // $data['message'] = $dRespoonse['message'];
            $data['message'] = $pesan;
        }

    }else{

        $message = urlencode($_POST['message']);
        $data = array();
        $response = sendMSG($number,$message);
        $dRespoonse = json_decode($response,true);
        if($dRespoonse['status'] == true){
            $data['status'] = true;
            $data['message'] = "Berhasil Terkirim";
        }else{
            if(is_array($dRespoonse['message'])){
                $pesan = $dRespoonse['message']['message'];
            }else{
                if($dRespoonse['message'] == null){
                 $pesan = "Pastikan Data Terisi";
                }else{
                 $pesan = $dRespoonse['message'];
                } 
            }
            $data['status'] = false;
            // $data['message'] = $dRespoonse['message'];
            $data['message'] = $pesan;
        }
    }
    echo json_encode($data);
}else{
    echo json_encode(array('status'=>false,'message'=>'Wrong'));
}
function sendMedia($number,$caption,$file){
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fekusa.xyz/sendwa?number=$number&message=$caption&file=$file&mode=MEDIA",
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
    return $response;

}
function sendMSG($number,$message){
     $curl = curl_init();
     curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fekusa.xyz/sendwa?number=$number&message=$message",
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
    return $response;
}