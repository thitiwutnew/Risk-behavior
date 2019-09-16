<?php   session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="image/favicon.ico" type="image/icon" sizes="32x32">
  <title>ระบบสารสนเทศเพื่อการจัดการความเสี่ยงต่อพฤติกรรมการกระทำผิดกฎหมาย</title>

   <!-- Custom fonts for this template-->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/design.css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <SCRIPT type="text/javascript">
function searchSel() {
  var input=document.getElementById('realtxt').value.toLowerCase();
  var output=document.getElementById('realitems').options;
  for(var i=0;i<output.length;i++) {
    if(output[i].value.indexOf(input)==0){
      output[i].selected=true;
    }
    if(document.getElementById('realtxt').value==''){
      output[0].selected=true;
    }
  }
}
</SCRIPT>
</head>

<body id="page-top">

<?php
        include('header.php');
    ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php
        include('menu.php');
    ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">พนักงาน</a>
          </li>
          <li class="breadcrumb-item active"> เพิ่มข้อมูลพนักงาน</li>
        </ol>
        <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-address-card"></i>
            เพิ่มข้อมูลพนักงาน</div>
          <div class="card-body">
                    <div class="row">
                    <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <?php 
                                if($_SESSION['status']=="success"){
                                    ?>
                            <div class="alert alert-success alert-dismissible fade show  success-alert" role="alert" id="success-alert">
                            <strong>ข้อมูลถูกบันทึกเรียบร้อย</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                                <?php  unset($_SESSION["status"]);  }
                                  if($_SESSION['status']=="fault"){
                                    
                                    ?>
                            <div class="alert alert-danger alert-dismissible fade show success-alert" role="alert" id="success-alert">
                            <strong>เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                                <?php   unset($_SESSION["status"]);  } ?>

                           
                          
                                 <script type="text/javascript">
                                    window.setTimeout(function() {
                                    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
                                        $(this).remove(); 
                                    });
                                }, 2000);
                                    </script>
                        <form action="" method="post">
                        <div id="showdata" class="alert alert-warning" role="alert" style="display:none">
                              <strong>รหัสประจำตัว  <b id="showid"></b> มีข้อมูลอยู่แล้ว กรุณากรอกข้อมูลใหม่</strong> 
                              </button>
                              </div>
                        <div class="input-group footers">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">รหัสประจำตัว &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="number" class="form-control" id="idcode" name="code" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off"  required>
                        </div>
                       <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">ยศ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</label>
                            </div>
                            <select class="custom-select"  name="rank" id="ranks" required>
                                                                        <option  value="">เลือก....</option>
                                                                        <option  value="พล.ต.ท.">พลตำรวจโท</option>
                                                                        <option  value="พล.ต.ต." >พลตำรวจตรี</option>
                                                                        <option value="พล.ต.จ." >พลตำรวจจัตวา</option>
                                                                        <option  value="พ.ต.อ.(พิเศษ)">พันตำรวจเอก(พิเศษ)</option>
                                                                        <option  value="พ.ต.อ."  >พันตำรวจเอก</option>
                                                                        <option  value="พ.ต.ท." >พันตำรวจโท</option>
                                                                        <option  value="พ.ต.ต.">พันตำรวจตรี</option>
                                                                        <option  value="ร.ต.อ." >ร้อยตำรวจเอก</option>
                                                                        <option  value="ร.ต.ท.">ร้อยตำรวจโท</option>
                                                                        <option  value="ร.ต.ต." >ร้อยตำรวจตรี</option>
                                                                        <option  value="ด.ต." >ดาบตำรวจ</option>
                                                                        <option  value="จ.ส.ต." >จ่าสิบตำรวจ</option>
                                                                        <option  value="ส.ต.อ." >สิบตำรวจเอก</option>
                                                                        <option  value="ส.ต.ท." >สิบตำรวจโท</option>
                                                                        <option  value="ส.ต.ต.">สิบตำรวจตรี</option>
                                                                        <option  value="พลฯ" >พลตำรวจ</option>
                            </select>
                            </div>
                        <div class="input-group footers" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ - นามสกุล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control"   id="names"  name="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off" required>
                        </div>
                        <div class="input-group footers">
                            <input type="text" id="realtxt" class="form-control" onkeyup="searchSel()" placeholder="ค้นหาตำแหน่งงาน">
                          </div>
                        <div class="input-group footers">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ตำแหน่งงานรับผิดชอบ :</span>
                            </div>
                        <SELECT id="realitems"  class="form-control"  name="position" >
                              <OPTION value="ผกก.">ผกก.
                              <OPTION value="รอง ผกก.ปป.">รอง ผกก.ปป.
                              <OPTION value="รอง ผกก.สส.">รอง ผกก.สส.
                              <optgroup label="งานอำนวยการ">
                              <OPTION value="สว.อก.">สว.อก.
                              <OPTION value="รอง สว.อก.">รอง สว.อก.
                              <OPTION value="รอง สว.กศ.">รอง สว.กศ.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="งานปกครองป้องกัน">
                              <OPTION value="สวป.">สวป.
                              <OPTION value="รอง สวป.">รอง สวป.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="งานจราจร">
                              <OPTION value="สว.จร.">สว.จร.
                              <OPTION value="รอง สว.จร">รอง สว.จร.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="งานสืบสวนปราบปราม">
                              <OPTION value="สว.สป.">สว.สป.
                              <OPTION value="รอง สว.สป.">รอง สว.สป.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="งานสืบสวนสอบสวน">
                              <OPTION value="สว.สส.">สว.สส.
                              <OPTION value="รอง สว.สส.">รอง สว.สส.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="พนักงานสอบสวน">
                              <OPTION value="สบ ๑.">สบ ๑.
                              <OPTION value="สบ ๒.">สบ ๒.
                              <OPTION value="สบ ๓.">สบ ๓.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              <optgroup label="หน่วยปฏิบัติการพิเศษ">
                              <OPTION value="หน.นปพ.(สบ ๒)">หน.นปพ.(สบ ๒)
                              <OPTION value="รอง หน.นปพ.">รอง หน.นปพ.
                              <OPTION value="ผบ.หมู่">ผบ.หมู่
                              </optgroup>
                              </SELECT>
                        </div>
                        <div class="text-center">
                        <button type="reset" class="btn btn-primary">ล้างข้อมูล</button>  
                        <button type="submit" id="insert" name="insert" class="btn btn-success"  onclick="return confirm('คุณต้องการบันทึกข้อมูล หรือไม่');">บันทึกข้อมูล</button>  
                        </div>
                        </form>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
          </div>
        </div>
      </div>
     <?php 
        include('db_connect.php');
        if(isset($_POST['insert'])){
            $code = $_POST['code'];
            $name = $_POST['name'];
            $rank = $_POST['rank'];
            $position = $_POST['position'];

            $sql = "SELECT * FROM authorities WHERE at_code = '$code'";
            $result = mysqli_query($connect,$sql);
            $count = mysqli_num_rows($result);

            if($count!=0){
              $_SESSION['status']="code";
              $_SESSION['code']=   $code;
              echo '<script>window.location.href="addpersonal.php"</script>';
            }
            else{

              $sqlinsert = "INSERT INTO authorities (at_code, at_rank, at_name, at_position)VALUES ('$code','$rank','$name','$position')";
              if ($connect->query($sqlinsert) === TRUE) {

                  $sqllast  ="SELECT at_id FROM authorities ORDER BY at_id DESC LIMIT 1";
                  $resultlast = mysqli_query($connect,$sqllast);
                  $rowlast = mysqli_fetch_array($resultlast,MYSQLI_ASSOC);

                  $username  ="P".$code;
                  $password =md5($code);

                  $sqlinsertuser = "INSERT INTO account (acc_rank, acc_name, acc_username, acc_password,acc_status,acc_chk)VALUES ('$rank','".$rowlast['at_id']."','$username','$password','Authorities','1')";
                  if ($connect->query($sqlinsertuser) === TRUE) {
                    $_SESSION['status']="success";
                    echo '<script>window.location.href="addpersonal.php"</script>';
                  }

                } else {
                  $_SESSION['status']="fault";
                      echo '<script>window.location.href="addpersonal.php"</script>';
                }

            }
        }
     ?>
     <footer class="sticky-footer">
      <?php   include('footer.php');  ?>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script type='text/javascript'>
  $(document).ready(function(){
        $("#idcode").keyup(function(){ 
        var idcode = $(this).val();
        $.ajax({  
            url:"checkidpolice.php",  
                method:"POST",  
                data:{at_id:idcode},  
                dataType:"json",  
                success:function(data){  
                  if(data==1){ 
                    document.getElementById("showdata").style.display = "block";
                    document.getElementById('ranks').setAttribute("disabled","disabled");
                    document.getElementById('names').setAttribute("disabled","disabled");
                    document.getElementById('realitems').setAttribute("disabled","disabled");
                    document.getElementById('insert').setAttribute("disabled","disabled");
                    document.getElementById('realtxt').setAttribute("disabled","disabled");
                    $( "#showid" ).text( idcode );
                  }
                  else{
                    document.getElementById("showdata").style.display = "none";
                    document.getElementById('ranks').removeAttribute("disabled");
                    document.getElementById('names').removeAttribute("disabled");
                    document.getElementById('realitems').removeAttribute("disabled");
                    document.getElementById('insert').removeAttribute("disabled");
                    document.getElementById('realtxt').removeAttribute("disabled");
                  }
                }  
           });  

      })
  })
   </script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->

</body>

</html>
