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
          <li class="breadcrumb-item active">ข้อมูลพนักงาน</li>
        </ol>
        <?php 
            date_default_timezone_set('UTC');
    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate))+7;
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute";
	}

      $strDate = date('j-n-Y H:i:s');
        ?>
        <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            ข้อมูลพนักงานทั้งหมด</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable"  cellspacing="0" >
                <thead>
                  <tr>
                    <th class="text-center" style=" width: 119px;">รหัสพนักงาน</th>
                    <th class="text-center" style=" width: 119px;">ยศ</th>
                    <th class="text-center"  style=" width: 270px;">ชื่อ - นามสกุล</th>
                    <th class="text-center" style=" width: 270px;">ตำแหน่งงานรับผิดชอบ</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        include('db_connect.php');
                      $sql = "SELECT * FROM authorities";
                      $result = $connect->query($sql);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            
                    ?>
                    <tr>
                    <td class="text-center"><?php echo $row['at_code']; ?></td>
                    <td class="text-center"><?php echo $row['at_rank'] ; ?></td>
                    <td ><?php echo $row['at_name'] ?></td>
                    <td><?php echo $row['at_position'] ?></td>
                  
                          <?php }}?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">อัพเดทข้อมูลเมื่อ  <?php echo DateThai($strDate);?></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
      <?php   include('footer.php');  ?>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
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
