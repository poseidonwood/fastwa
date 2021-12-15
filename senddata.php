<?php 

if(isset($_POST['number'])){
    $number = $_POST['number'];
    if(!empty($_REQUEST['caption']) || $_REQUEST['caption'] != ""  ){

        $file = urlencode($_POST['file']);
        $caption = urlencode($_POST['caption']);
        // $datanya = array(
        //     'file' => $file,
        //     'caption' => $caption
        //     );
        // echo json_encode($datanya); exit;
        $data = array();
        $response = sendMedia($number,$caption,$file);
        // echo $response; exit;
        $dRespoonse = json_decode($response,true);
        if($dRespoonse['status'] == true){
            $data['status'] = true;
            $data['message'] = "Berhasil Terkirim";
        }else{
            if(is_array($dRespoonse['message'])){
                $pesan = $dRespoonse['message']['message'];
            }else{
                if($dRespoonse['message'] == null){
                 $pesan = $response;
                }else{
                 $pesan = $dRespoonse['message'];
                } 
            }
            $data['status'] = false;
            // $data['message'] = $dRespoonse['message'];
            $data['message'] = $pesan;
        }

    }else{
        if($_REQUEST['checker'] == "url"){
            $geturl = shorter(utf8_encode($_POST['message']));
            $decodeurl = json_decode($geturl,true);
            // $message = $decodeurl['result'];
            $message = urlencode($_POST['message']);
            // echo $geturl; exit;
        }else{
            $message = urlencode($_POST['message']);
        }
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
      CURLOPT_URL => "https://fekusa.xyz/sendwa/?number=$number&file=$file&message=$caption&mode=MEDIA",
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
     $url = "https://fekusa.xyz/sendwa?number=$number&message=$message";
     $curl = curl_init();
     curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => "number=$number&message=$message",
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return $response;
}
function shorter($url){
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api-xcoders.xyz/api/tools/shorturl?url=$url&apikey=cAsjTQCOE9",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Cookie: connect.sid=s%3A49S2bCSrbHIdffuXATNGwjHiR45lMAv5.e7iGDU3EvMD1B0QuGoOlJDV19OvUscyo8bz8pm%2FEdw8'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return $response;


}