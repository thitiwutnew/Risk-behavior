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
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/design.css">
  <link rel="stylesheet" href="css/jquery.datetimepicker.css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/charloader.js"></script>
</head>

<body id="page-top">

<?php
        include('header.php');
   date_default_timezone_set('UTC');
    $strdate = date("d");
    $strMonth2 = date("m");
    $strYear2 = date("Y")+543;
    $formdate= "01/".$strMonth2."/".$strYear2;
    $enddate= $strdate."/".$strMonth2."/".$strYear2;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $formdate= $_POST['formdate'];
      $enddate=  $_POST['enddate'];
    }

  function chart1($chart1)
  {
       $strYear = date("Y",strtotime($chart1))+543;
       $strMonth= date("n",strtotime($chart1));
       $strDay= date("j",strtotime($chart1));
       $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
       $strMonthThai=$strMonthCut[$strMonth];
       return "$strMonthThai $strYear";
  }

  function uptime($uptime)
  {
    $strYear = date("Y",strtotime($uptime))+543;
		$strMonth= date("n",strtotime($uptime));
		$strDay= date("j",strtotime($uptime));
		$strHour= date("H",strtotime($uptime))+7;
		$strMinute= date("i",strtotime($uptime));
		$strSeconds= date("s",strtotime($uptime));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute";
  }
  $uptime = date('j-n-Y H:i:s');
  $chart1 = date("Y");
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
          <h3>ระบบสารสนเทศเพื่อการจัดการความเสี่ยงต่อพฤติกรรมการกระทำผิดกฎหมาย</h3>
          </li>
        
        </ol>

        <!-- Icon Cards-->
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            กราฟแสดงข้อมูลผู้มีพฤติกรรมเสี่ยง</div>
          <div class="card-body">
                <form action="" method="post">
                <div class="row"> 
                      <div class="col-md-8"><h3 style="margin-top: 25px;margin-left:90px;">กราฟแสดงข้อมูลผู้มีพฤติกรรมเสี่ยง แบ่งตามประเภทพฤติกรรมเสี่ยง</h3></div>
                      <div class="col-md-1">
                            <span class="input-group">จากวันที่ :</span>
                            <input class="form-control" type="text" id="formdate" name="formdate" value='<?php echo $formdate;?>' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off" style="width: 110px; " />
                      </div>
                      <div class="col-md-1" style="margin-left: 10px;">
                            <span class="input-group">ถึงวันที่ :</span>
                            <input type="text" class="form-control " id="enddate"  name="enddate" value='<?php echo $enddate;?>' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off" style="width: 110px;" />
                            
                      </div>
                      <div class="col-md">
                        <button class="btn btn-success" style="margin-top: 24px;margin-left: 10px;">แสดงข้อมูล</button>
                      </div>
                    </div>
                </form>
              <div id="chart_div" style="height: 500px;"></div>
          </div>
          <div class="card-footer small text-muted">อัพเดทข้อมูลเมื่อ <?php echo uptime($uptime);?></div>
        </div>

        <!-- DataTables Example -->
      

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
  <?php
   $cluse1 = array();
   $cluse2 = array();
   $cluse3 = array();
   include('db_connect.php');
   $formdate=(substr($formdate,6,9)-543)."-".substr($formdate,3,2)."-".substr($formdate,0,2);
   $enddate=(substr($enddate,6,9)-543)."-".substr($enddate,3,2)."-".substr($enddate,0,2);
$query = "SELECT DISTINCT dtd_date FROM dt_detailmanagement WHERE dtd_date  BETWEEN '".$formdate."' AND '".$enddate."' AND dtd_status='ผู้มีพฤติกรรมเสี่ยง'";
$result = $connect->query($query);
$data = array();
   $count=0;
   $check;
    $typecluse[10][2];
    $count1=1;
    $count2=1;
    $count3=1;
    $count4=1;
    $count5=1;
    $count6=1;
    $count7=1;
    $count8=1;
    $count9=1;
    $typecluse[0][0]="สถานบริการ";
    $typecluse[0][1]=0;
    $typecluse[1][0]="การค้าประเวณี";
    $typecluse[1][1]=0;
    $typecluse[2][0]="ยาเสพติด";
    $typecluse[2][1]=0;
    $typecluse[3][0]="การพนันทั่วไป";
    $typecluse[3][1]=0;
    $typecluse[4][0]="อาวุธและวัตถุระเบิด";
    $typecluse[4][1]=0;
    $typecluse[5][0]="ลักทรัพย์";
    $typecluse[5][1]=0;
    $typecluse[6][0]="รับของโจร";
    $typecluse[6][1]=0;
    $typecluse[7][0]="ปล้นทรัพย์";
    $typecluse[7][1]=0;
    $typecluse[8][0]="อื่นๆ";
    $typecluse[8][1]=0;
  while($row = mysqli_fetch_assoc($result)) {

    $query1 = "SELECT dtd_status,dtd_date,dtd_type FROM dt_detailmanagement where dtd_date='".$row['dtd_date']."' AND dtd_status='ผู้มีพฤติกรรมเสี่ยง'";
    $result1= $connect->query($query1);
        while($row1 = mysqli_fetch_assoc($result1)) {

          if($row1['dtd_type']=="สถานบริการ"){ $typecluse[0][1]=$count1;  $count1++;}
          else if($row1['dtd_type']=="การค้าประเวณี"){  $typecluse[1][1]=$count2; $count2++; }
          else if($row1['dtd_type']=="ยาเสพติด"){  $typecluse[2][1]=$count3; $count3++; }
          else if($row1['dtd_type']=="การพนันทั่วไป"){ $typecluse[3][1]=$count4; $count4++; }
          else if($row1['dtd_type']=="อาวุธและวัตถุระเบิด"){  $typecluse[4][1]=$count5; $count5++;}
          else if($row1['dtd_type']=="ลักทรัพย์"){  $typecluse[5][1]=$count6; $count6++;}
          else if($row1['dtd_type']=="รับของโจร"){  $typecluse[6][1]=$count7; $count7++; }
          else if($row1['dtd_type']=="ปล้นทรัพย์"){  $typecluse[7][1]=$count8; $count8++; }
          else{  $typecluse[8][1]=$count9; $count9++; }


        }
}
  $totalcount=0;
  $maxvalue=50;
  $countscore[9];
  for($i=0;$i<9;$i++){
    $countscore[$i]=$typecluse[$i][1];
  }
  $countscore=max($countscore);
  if($countscore<=14){
    $countscore=14;
  }

  $result->close();
  $connect->close();
  ?>
	<script>
	google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['ประเภทพฤติกรรมเสี่ยง', 'จำนวนครั้ง',{ role: 'style' }],
        ['<?php echo $typecluse[0][0]?>',<?php echo $typecluse[0][1]?>,'color: #f22613'],
        ['<?php echo $typecluse[1][0]?>', <?php echo $typecluse[1][1]?>,'color: #f62459'],
        ['<?php echo $typecluse[2][0]?>', <?php echo $typecluse[2][1]?>,'color: #736598'],
        ['<?php echo $typecluse[3][0]?>', <?php echo $typecluse[3][1]?>,'color: #9a12b3'],
        ['<?php echo $typecluse[4][0]?>', <?php echo $typecluse[4][1]?>,'color: #00b5cc'],
        ['<?php echo $typecluse[5][0]?>', <?php echo $typecluse[5][1]?>,'color: #1f3a93'],
        ['<?php echo $typecluse[6][0]?>', <?php echo $typecluse[6][1]?>,'color: #2ecc71'],
        ['<?php echo $typecluse[7][0]?>', <?php echo $typecluse[7][1]?>,'color: #00e640'],
        ['<?php echo $typecluse[8][0]?>', <?php echo $typecluse[8][1]?>,'color: #f7ca18']
      ]);

      var options = {
        title: '',
        legend: { position: 'none' },
        chartArea: {width: '75%'},
        hAxis: {
          title: 'จำนวนผู้มีพฤติกรรมเสี่ยง',
          minValue: 0,
          maxValue:<?php echo $countscore;?>
        },
        vAxis: {
          title: 'ประเภทพฤติกรรมเสี่ยง'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	</script>
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
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/jquery.datetimepicker.js"></script>
  <script type="text/javascript">   
            $(function(){
            
                var thaiYear = function (ct) {
                    var leap=3;  
                    var dayWeek=["พฤ.", "ศ.", "ส.", "อา.","จ.", "อ.", "พ."];  
                    if(ct){  
                        var yearL=new Date(ct).getFullYear()-543;  
                        leap=(((yearL % 4 == 0) && (yearL % 100 != 0)) || (yearL % 400 == 0))?2:3;  
                        if(leap==2){  
                            dayWeek=["ศ.", "ส.", "อา.", "จ.","อ.", "พ.", "พฤ."];  
                        }  
                    }              
                    this.setOptions({  
                        i18n:{ th:{dayOfWeek:dayWeek}},dayOfWeekStart:leap,  
                    })                
                };    
                
                $("#formdate").datetimepicker({
                    timepicker:false,
                    format:'d/m/Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                    lang:'th',  // แสดงภาษาไทย
                    onChangeMonth:thaiYear,          
                    onShow:thaiYear,     // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
                    closeOnDateSelect:true,
                });  
                $("#enddate").datetimepicker({
                    timepicker:false,
                    format:'d/m/Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                    lang:'th',  // แสดงภาษาไทย
                    onChangeMonth:thaiYear,          
                    onShow:thaiYear, // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
                    closeOnDateSelect:true,
                });  
});
</script>
</body>

</html>
