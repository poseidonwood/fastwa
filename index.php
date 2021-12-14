<?php

function toast($message,$status='success'){
  $data = "const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: '$status',
    title: '$message'
  })";
}
$base_wa = "http://fekusa.xyz:4000";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FastWA By Fekusa</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/img-01.png"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">FastWA &nbsp; <a href="#" id="statuswa" onclick="modalDeviceFun()"></a>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <!-- <a class="nav-link" href="#" onclick="scanqr()">Scan QR</a> -->
        </li>
      </ul>
    </div>
  </nav>
  <div class="contact1">
    <div class="container-contact1">
      <div class="contact1-pic js-tilt" data-tilt>
        <img src="images/img-01.png" alt="IMG">
      </div>

      <div class="contact1-form validate-form" >
        <span class="contact1-form-title">
          FastWA by Fekusa
        </span>
        <div class="form-group" data-validate = "Number is required">
          <select class="form-control" id="pilihmode" onchange="mode()">
            <option value="pesan">Kirim Pesan</option>
            <option value="gambar">Kirim Pesan Bergambar</option>
          </select>
        </div>
        <div class="wrap-input1 validate-input" data-validate = "Number is required">
          <input class="input1" type="number" name="number" id="number" placeholder="628xxxx" required="">
          <span class="shadow-input1"></span>
        </div>
        <div class="wrap-input1 validate-input" data-validate = "Message is required">
          <textarea class="input1" name="message" id="message" placeholder="Tulis Pesan Disini" required=""></textarea>
          <span class="shadow-input1"></span>
        </div>
        <div class="wrap-input1 validate-input" data-validate = "Number is required">
          <input class="wrap-input1" type="file" name="file" id="file" placeholder="628xxxx" required="">
          <span class="shadow-input1"></span>
        </div>
        <div class="wrap-input1 validate-input" data-validate = "Message is required">
          <textarea class="input1" name="caption" id="caption" placeholder="Tulis Caption Disini" required=""></textarea>
          <span class="shadow-input1"></span>
        </div>
        <div class="container-contact1-form-btn">
          <button id="buttonsenda" class="contact1-form-btn" onclick="senddata()">
            <span>
              Send WA
              <i class="fa fa-whatsapp" aria-hidden="true"></i>
            </span>
          </button>
          <button id="buttonsendd" class="contact1-form-btn" onclick="senddata()" disabled="">
            <span>
              Send WA
              <i class="fa fa-whatsapp" aria-hidden="true"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Scan QR</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="scanqrshow">
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalDevice" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Device Info</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalDeviceInfo">
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script >
  $('.js-tilt').tilt({
    scale: 1.1
  })
  // Cek Status Wa
  setInterval(getstatus, 1000);
  // setInterval(scanqr, 3000);
  function scanqr() {
    $.ajax({
      url: "./scanqr.php",
    }).done(function(data) {
      var json = data,
      obj = JSON.parse(json)
      if(obj.status == true){
        console.log(obj.status);
        $("#scanqrshow").html("<img src='"+obj.qr+"' width ='100%'>");
        $("#staticBackdrop").modal('show');
      }
    });
  }
  function modalDeviceFun(){
    $("#modalDevice").modal('show');
  }
  function getstatus() {
    let url = "./status.php";
    let url1 = "./getdetail.php";
    $.ajax({
      url: url,
    }).done(function(data) {
      var json = data,
      obj = JSON.parse(json)
      if (obj.status == true && obj.msg == "READY") {
        $("#staticBackdrop").modal('hide');
        $.ajax({
          url: url1,
        }).done(function(data) {
          var json = data,
          obj = JSON.parse(json);
          $("#modalDeviceInfo").html("<p>"+obj.data+"</p>");
          $("#statuswa").html("<span class='badge bg-success'>Connected</span>");
        });
      } else {
        scanqr();
        $("#statuswa").html("<span class='badge bg-danger'>Disconnected</span>");
      }
    });
  }
  $(document).ready(function(){
    $("#buttonsendd").hide();
    $("#file").hide();
    $("#caption").hide();
  });
  function mode(){
    var mode = $("#pilihmode").val();
    if(mode === "gambar"){
      $("#file").show();
      $("#caption").show();
      $("#message").hide();
    }else{
      $("#file").hide();
      $("#caption").hide();
      $("#message").show();
    }
  }
  function senddata(){
    $("#buttonsenda").hide();
    $("#buttonsendd").show();
    var number = $("#number").val();
    var message = $("#message").val();
    $.ajax({
      type: 'POST',
      url: "./senddata.php",
      data: {number:number,message:message},
    }).done(function(data) {
      obj = JSON.parse(data);
      if(obj.status === true){
        $("#number").val("");
        $("#message").val("");
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: obj.message,
        })
        $("#buttonsenda").show();
        $("#buttonsendd").hide();
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Oopss..',
          text: obj.message,
        })
        $("#buttonsenda").show();
        $("#buttonsendd").hide();
      }
    });
  }

  </script>


  <!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>
