
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
<!--
@page rotated { size: landscape; }
.style1 {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
	font-weight: bold;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	font-weight: bold;
}
.style3 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	
}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 12px}
.style13 {font-size: 9}
.style16 {font-size: 9; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }

</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
<head>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/design.css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    require_once('/mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
    ob_start(); // ทำการเก็บค่า html นะครับ
    ?>  <?php 
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
    
                                      <table width="704" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <thead>
                                          <tr>
                                          <td>  <center><img src="./image/logo.png" alt="" srcset="" width="150px"></center></td>
                                          </tr>
                                              <tr>
                                                  <td width="291" align="center"><span class="style2"><h2>รายงานสรุปข้อมูลผู้มีพฤติกรรมเสี่ยง</h2></span></td>
                                              </tr>
                                              <tr>
                                                  <td height="25" align="center"><span class="style2"> <br>
                                              <br><h3>สถานีตำรวจภูธรวังขอนแดง จังหวัดปราจีนบุรี</h3></span></td>
                                              </tr>
                                              <tr>
                                             <td> <center>
                                              <br>ณ. วันที่ <?php echo DateThai($strDate);?></center></td>
                                              </tr>
                                            </thead>
                                          </table>
                                      <br>
                                      <br>
                                      <table  width="704"  class="table table-bordered" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info" border="1">
                                        <thead style="background-color: #721c24; color: #fff;">
                                        <tr>
                                            <th rowspan="2" style="padding: 2%;" width="90"><center>วันที่</center></th>
                                            <th rowspan="2" style="padding: 2%;" width="250"><center>ชื่อ - นามสกุล</center></th>
                                            <th rowspan="2" style="padding: 2%;" width="40"><center>เพศ</center></th>
                                            <th rowspan="2" style="padding: 2%;" width="40"><center>อายุ</center></th>
                                            <th colspan="3"><center>รายละเอียด</center></th>
                                        </tr>
                                        <tr>
                                            <td width="150"><center>ประเภท</center></td>
                                            <td width="250"><center>สถานที่</center></td>
                                            <td width="170"><center>สถานะ</center></td>       
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                        require 'db_connect.php';
                                       $qurrydata = $_POST['qurrydata'];
                                      $query5 = mysqli_query($connect,$qurrydata);
                                      while($objResult = mysqli_fetch_array($query5,MYSQLI_ASSOC))
                                      { 
                                        
                                      ?>
                                            <tr>
                                            <td style="padding:10px" width="90"><center><?php echo substr($objResult["dtd_date"],8,2);?>-<?php echo substr($objResult["dtd_date"],5,3);?><?php echo substr($objResult["dtd_date"],0,4)+543;?>    เวลา : <?php echo substr($objResult["dtd_date"],10);?></center></td>
                                                <td style="padding:10px" width="250"><?php echo $objResult["dm_prefix"] .$objResult["dm_name"];?></td>
                                                <td style="padding:10px" width="40"><center><?php echo $objResult["dm_gender"];?></center></td>
                                                <td style="padding:10px" width="40"><center><?php echo $objResult["dm_age"];?></center></td>
                                                <td style="padding:10px" width="150"><center><?php echo $objResult["dtd_type"];?></center></td>
                                                <td style="padding:10px" width="250"><?php echo $objResult["dtd_location"];?></td>
                                                <td style="padding:10px" width="170"><center><?php echo $objResult["dtd_status"];?></center></td>
                                            </tr>
                                            <?php
                                                }
                                              ?>
                                        </tbody>
                                        </table>
</body>
</html>
<?php
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
ob_end_clean();
$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban');   
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
?>