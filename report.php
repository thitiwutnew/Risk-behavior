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

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/design.css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/jquery.datetimepicker.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
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
            <a href="main.php">หน้าแรก</a>
          </li>
          <li class="breadcrumb-item active">ออกรายงาน</li>
        </ol>
        <?php 
            date_default_timezone_set('UTC');
    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate));
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
            ออกรายงานข้อมูลผู้มีพฤติกรรมเสี่ยงทั้งหมด</div>
          <div class="card-body">
          <?php 
            if(  $_GET['formdate']==null){$formdate==null;} 
            if(  $_GET['todate']==null){$todate==null;} 
            if(  $_GET['age']==null){$age==null;} 
            if(  $_GET['gender']==null){$gender==null;} 
            if(  $_GET['location']==null){$location==null;} 
            
          ?>
                <form action="" method="get">
                              <div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-8">
                                         <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">จากวันที่ </span>
                                        </div>
                                        <input type="text" class="form-control" id="formdate" name="formdate" value="<?php echo $formdate?>"   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off">                                       
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ถึงวันที่</span>
                                        </div>
                                        <input type="text" class="form-control" id="enddate" name="todate" value="<?php echo $todate?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" autocomplete="off">                                       
                                  </div>
                                        <div class="input-group mb-5">
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">เลือกข้อมูลเพิ่มเติม</button>
                                        </div>

                                        <div id="demo" class="collapse">
                                        <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupSelect02">ออกรายงานตามช่วงอายุ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                        <select class="custom-select" name="age">
                                            <option selected>เลือกช่วงอายุ</option>
                                            <option value="1">ต่ำกว่า 20 ปี</option>
                                            <option value="2">21-30  ปี</option>
                                            <option value="3">31-40  ปี</option>
                                            <option value="4">มากกว่า 40  ปี</option>
                                        </select>
                                        </div>
                                        <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">ออกรายงานตามเพศ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        </div>
                                        <div class="form-check"  style="padding: 10px;margin-left: 5%;">
                                          <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="ชาย" checked>
                                          <label class="form-check-label" for="exampleRadios1"> ชาย</label>
                                        </div>
                                        <div class="form-check" style="padding: 10px;margin-left: 2%;">
                                          <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="หญิง">
                                          <label class="form-check-label" for="exampleRadios2">
                                          หญิง
                                          </label>
                                        </div>
                                        </div>
                                        <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">ออกรายงานจากสถานที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                        <select class="custom-select" name="location">
                                        <option selected>เลือกสถานที่</option> 
                                        <?php 
                                           include('db_connect.php');
                                           $sql = "SELECT DISTINCT dtd_location FROM dt_detailmanagement";
                                           $result = $connect->query($sql);
                                           if (mysqli_num_rows($result) > 0) {
                                               while($row = mysqli_fetch_assoc($result)) {
                                             ?>
                                            <option  value="<?php echo $row['dtd_location']?>"><?php echo $row['dtd_location']?></option>
                                           <?php }}
                                            else{ ?>
                                             <option selected>ไม่พบข้อมูล</option>
                                            <?php }
                                          ?>
                                        </select>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-md-2"></div>
                              </div>
                           <center>   <button type="submit" name="reports" class="btn btn-success">แสดงข้อมูล</button></center>
                </form>
               <?php
              if(!empty($_GET)){
                echo "<hr>";
                   $formdate = $_GET['formdate'];
                   $todate = $_GET['todate'];
                   $age = $_GET['age'];
                    $gender = $_GET['gender'];
                    $location = $_GET['location'];
                    include('db_connect.php');
                  if($formdate!=null){
                    $formday=substr($formdate,0,2);
                    if($formday==1){$formday="01";}
                    if($formday==2){$formday="02";}
                    if($formday==3){$formday="03";}
                    if($formday==4){$formday="04";}
                    if($formday==5){$formday="05";}
                    if($formday==6){$formday="06";}
                    if($formday==7){$formday="07";}
                    if($formday==8){$formday="08";}
                    if($formday==9){$formday="09";}
                    $formdate=substr($formdate,6,10).substr($formdate,2,4).$formday;
                  }
                    if($todate!=null){
                      $todays=substr($todate,0,2)+1;
                      if($todays==1){$todays="01";}
                      if($todays==2){$todays="02";}
                      if($todays==3){$todays="03";}
                      if($todays==4){$todays="04";}
                      if($todays==5){$todays="05";}
                      if($todays==6){$todays="06";}
                      if($todays==7){$todays="07";}
                      if($todays==8){$todays="08";}
                      if($todays==9){$todays="09";}
                      $todate=substr($todate,6,10).substr($todate,2,4).$todays;
                    }
                    date_default_timezone_set('UTC');
                    $year = date("Y")+543;
                    $mm = date("-m-d");
                    $nows= $year.$mm;

                if ($formdate==null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  $formdate="null";
                  $todate=$nows;
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id Order BY dtd.dtd_id DESC";
                  
                }
                else if($formdate!=null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  $todate=$nows;

                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear.$formdateday;
                  
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                 
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' Order BY dtd.dtd_id DESC";
                }
                //////////////////age///////////////////
                else if($formdate==null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' Order BY dtd.dtd_id DESC";
                }

                else if($formdate!=null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $todate=$nows;
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear.$formdateday;
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                 
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' Order BY dtd.dtd_id DESC";
                }
                 //////////////////gender///////////////////
                 else if($formdate==null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                }

                else if($formdate!=null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $todate=$nows;
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear.$formdateday;
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                 
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                
                }
                else if($formdate!=null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                 
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id 
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                
                }
                else if($formdate==null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;


                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                 }
                 else if($formdate!=null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $todate=$nows;
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear.$formdateday;
                  
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                 }
                 //////////////////location///////////////////
                 else if($formdate==null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }

                else if($formdate!=null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $todate=$nows;
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear.$formdateday;
                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' AND dt.dm_gender ='".$gender."' AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                 
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dt.dm_gender ='".$gender."' AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                /////////////////////////////////
                else if($formdate==null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location=="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."' AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location=="เลือกสถานที่"){
              
                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id 
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;

                  $formdate="null";
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }

                else if($formdate!=null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;

                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                 else if($formdate==null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;
                  $formdate="null";
                  
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;
                  $formdate="null";
                  
                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;
                  $formdate="null";
                  
                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate==null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;
                  
                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age=="เลือกช่วงอายุ" AND  $gender!="เลือกเพศ" AND  $location!="เลือกสถานที่"){
              
                  $todate=$nows;
                  
                
                  $formdate = "null";
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND dt.dm_gender ='".$gender."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate==null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $todate=$nows;
                  
                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate==null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}
                  $formdate="null";
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                else if($formdate!=null AND $todate!=null AND  $age!="เลือกช่วงอายุ" AND  $gender=="เลือกเพศ" AND  $location!="เลือกสถานที่"){
                  if($age==1){$startage=null;$endage=19;}
                  else if($age==2){$startage=21;$endage=30;}
                  else if($age==3){$startage=31;$endage=40;}
                  else if($age==4){$startage=41;$endage=120;}

                  $formdateday = substr("$formdate",4);
                  $formdateyear = substr("$formdate",0,4)-543;
                  $formdate =  $formdateyear."".$formdateday;
                  
                  $todateday = substr("$todate",4);
                  $todateeyear = substr("$todate",0,4)-543;
                  $todate =  $todateeyear."".$todateday;

                  $sql5 = " SELECT dt.*, dtd.*, att.*
                  FROM dt_management dt
                  INNER JOIN dt_detailmanagement dtd
                      on dt.dm_id = dtd.dm_id
                  INNER JOIN authorities att on dtd.at_id = att.at_id
                 where  dtd.dtd_date BETWEEN '".$formdate."' AND '".$todate."' AND  dt.dm_age BETWEEN '".$startage."' AND '".$endage."'  AND dtd.dtd_location ='".$location."' Order BY dtd.dtd_id DESC";
                }
                  $query5 = mysqli_query($connect, $sql5);
                  $objResult1 = mysqli_fetch_array($query5);
                  if($objResult1){
                        ?>
                        <form action="send_report.php" method="POST">
                        <input type="hidden" class="form-control" name="qurrydata" id="formdate" value="<?php echo  $sql5 ;?>" >
                        <?php
                                  $objQuery = mysqli_query($connect,$sql5);

                                  ?>
                                  <div class="table-responsive">
                                  <table class="table table-bordered" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead style="background-color: #721c24; color: #fff;">
                                        <tr>
                                            <th rowspan="2" style="padding: 2%; width: 240px;"><center>วันที่</center></th>
                                            <th rowspan="2" style="padding: 2%;"><center>ชื่อ - นามสกุล</center></th>
                                            <th rowspan="2" style="padding: 2%;"><center>เพศ</center></th>
                                            <th rowspan="2" style="padding: 2%;"><center>อายุ</center></th>
                                            <th colspan="3"><center>รายละเอียด</center></th>
                                        </tr>
                                        <tr>
                                            <td><center>ประเภท</center></td>
                                            <td><center>สถานที่</center></td>
                                            <td><center>สถานะ</center></td>       
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                      while($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC))
                                      { 
                                        
                                      ?>
                                            <tr>
                                                <td><?php echo substr($objResult["dtd_date"],8,2);?>-<?php echo substr($objResult["dtd_date"],5,3);?><?php echo substr($objResult["dtd_date"],0,4)+543;?>    เวลา : <?php echo substr($objResult["dtd_date"],10);?></td>
                                                <td><?php echo $objResult["dm_prefix"] .$objResult["dm_name"];?></td>
                                                <td><?php echo $objResult["dm_gender"];?></td>
                                                <td><?php echo $objResult["dm_age"];?></td>
                                                <td><?php echo $objResult["dtd_type"];?></td>
                                                <td><?php echo $objResult["dtd_location"];?></td>
                                                <td><?php echo $objResult["dtd_status"];?></td>
                                            </tr>
                                            <?php
                                           
                                               
                                                }
                                              ?>
                                        </tbody>
                                        </table>
                                        </div>
                                      <br>
                                  <br>
                                  <center><button type="submit" class="btn btn-primary btn-lg" >ออกรายงาน</button> </center>
                      </form>
                    <?php  }else{ ?>
                      <center>
                      <table class="table table-bordered" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                          <thead>
                          <tr>
                            <th rowspan="2" style="padding: 2%;"><center>วันที่</center></th>
                            <th rowspan="2" style="padding: 2%;"><center>ชื่อ - นามสกุล</center></th>
                            <th rowspan="2" style="padding: 2%;"><center>เพศ</center></th>
                            <th rowspan="2" style="padding: 2%;"><center>อายุ</center></th>
                            <th colspan="3"><center>รายละเอียด</center></th>
                        </tr>
                        <tr>
                            <td><center>ประเภท</center></td>
                            <td><center>สถานที่</center></td>
                            <td><center>สถานะ</center></td>       
                        </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td colspan="8"><div align="center"><?php echo "ไม่พบข้อมูล";?></div></td>
                            </tr>
                          </tbody>
                        </table>
                      </center>
                    <?php
                    }
                }
                ?>
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
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  </div>
  </div>
  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="js/sb-admin.min.js"></script>
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
                    onShow:thaiYear,                  
                    yearOffset:543,  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
                    closeOnDateSelect:true,
                    maxDate:'0',
                });  
                $("#enddate").datetimepicker({
                    timepicker:false,
                    format:'d/m/Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
                    lang:'th',  // แสดงภาษาไทย              
                    yearOffset:543,  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศf
                    maxDate:'0',
                    closeOnDateSelect:true,
                });  
});
</script>
</body>

</html>
