<?php 
   session_start();
   $chk=null;
   if(isset($_POST['submit'])){
    include("db_connect.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
       // username and password sent from form 
       
       $acc_newpassword = mysqli_real_escape_string($connect,$_POST['acc_newpassword']);
       $acc_confirmnewpassword = mysqli_real_escape_string($connect,$_POST['acc_confirmnewpassword']);
      if( $_SESSION['oldpassword'] ==$_POST['acc_oldpassword']){
        if( $acc_newpassword==$acc_confirmnewpassword ){

          $mypassword = mysqli_real_escape_string($connect,md5($_POST['acc_newpassword']));
          $acc_chk=0;
          $query = "  
          UPDATE account   
          SET acc_password='$mypassword',
          acc_chk='$acc_chk'
          WHERE acc_name='".$_SESSION['user_id']."'"; 
     
              if(mysqli_query($connect, $query))  
              { 
                    session_start();
                    session_destroy();
                    header("location:index.php");
              }
  
        }
        else{
              $chk="กรุณากรอกรหัสผ่านให้ตรงกัน !!!";
        }
      }
      else{
        $chk="รหัสผ่านเก่าไม่ถูกต้อง !!!";
      }
    }
}
  
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="image/favicon.ico" type="image/icon" sizes="32x32">
  <title>ระบบสารสนเทศเพื่อการจัดการความเสี่ยงต่อพฤติกรรมการกระทำผิดกฎหมาย</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/design.css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/jquery-3.1.1.min.js"></script>
  <!-- Custom styles for this template-->
  <script src="js/bootstrap.min.js"></script>
  <style>
      
/* BASIC */

html {
  background-color: #56baed;
}

body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #e4e4e4;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
  margin-top: 100px;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

  </style>
</head>

<body id="page-top">
<nav class="navbar navbar-expand navcolor static-top text-center" style="height: 80px;">
<img src="image/logo.png" style="height: 67px;width: 84px;"><h3  style="color: #fff;    margin-top: 10px;"> ระบบสารสนเทศเพื่อการจัดการความเสี่ยงต่อพฤติกรรมการกระทำผิดกฎหมาย</h3>
  </nav>

  <div id="wrapper">
      <div class="container">
      <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first" style="padding: 10px;color: #000;">
      <p class="text-left">
      &nbsp;&nbsp;เนื่องจากเป็นการเข้าใช้งานครั้งแรกของผู้ใช้งาน เพื่อความปลอดภัยของบัญชีผู้ใช้งาน กรุณาเปลี่ยนรหัสผ่านเข้าใช้งานใหม่
      </p>
    </div>

    <!-- Login Form -->
    <form  method="POST"  enctype="multipart/form-data">
    <div class="input-group footers col-md-12" >
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">รหัสผ่านเก่า &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
          </div>
            <input type="password" class="form-control" id="acc_newpassword"  name="acc_oldpassword" required>
      </div>
      <div class="input-group footers col-md-12" >
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">รหัสผ่านใหม่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
          </div>
            <input type="password" class="form-control" id="acc_newpassword"  name="acc_newpassword" required>
      </div>
      <div class="input-group footers col-md-12" >
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">ยืนยันรหัสผ่านใหม่ &nbsp;:</span>
          </div>
            <input type="password" class="form-control" id="acc_confirmnewpassword"  name="acc_confirmnewpassword" required>
      </div>
      <p>
                                <div style="color:#000;">
                                    <?php 
                                        if($chk!=null){
                                            echo "<center>".$chk."</center>";
                                        }
                                    ?>
                                </div>
                                </p>
      <p>
        <a href="./index.php"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
        <button type="submit" name="submit" class="btn btn-success">เปลี่ยนรหัสผ่าน</button>
      </p>
    </form>
  </div>
</div>
      </div>
  <footer class="sticky-footer" style="width: 100%;">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
          <span>Copyright © ระบบสารสนเทศเพื่อการจัดการความเสี่ยงต่อพฤติกรรมการกระทำผิดกฎหมาย 2019</span>
          </div>
        </div>
      </footer>
   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
