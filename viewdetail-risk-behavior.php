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
            <a href="#">ผู้มีพฤติกรรมเสี่ยง</a>
          </li>
          <li class="breadcrumb-item active">ข้อมูลผู้มีพฤติกรรมเสี่ยง</li>
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
      include('db_connect.php');
        ?>
        <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <?php
                  $sql = "
                  SELECT * FROM dt_management WHERE dm_id='".$_REQUEST["id"]."'"; 
                  $result = $connect->query($sql);
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        $name= $row['dm_name'];
                        $dm_prefix = $row['dm_prefix'];
                        $dm_idcard = $row['dm_idcard'];
                        $dm_gender = $row['dm_gender'];
                        $dm_age = $row['dm_age'];
                        $dm_image = $row['dm_image'];
                      }}
            ?>
            ข้อมูลผู้มีพฤติกรรมเสี่ยง </div>
          <div class="card-body">
          <table > 
     <tr>
          <th class="col-md-7">
               <div class="form-group">
               <label for="id-cards">รหัสบัตรประชาชน</label>
               <input type="text" class="form-control"  readonly = true  value="<?php echo  $dm_idcard;?>">
               </div>
          </th>
          <th class="col-md-4" rowspan="4"><img src="http://wangkhondaeng.prachinburi.police.go.th/img/risk-img/<?php echo $dm_image;?>" style="height: 7%;"></th>
     </tr>
     <tr>
     <th class="col-md-7">
               <div class="form-group">
               <label for="id-name">ชื่อ - นามสกุล</label>
               <input type="text" class="form-control"   readonly = true value="<?php echo   $dm_prefix." ".$name;?>">
               </div>
               
          </th>
     </tr>
     <tr>
     <th class="col-md-4">
          <div class="form-row">
               <div class="form-group col-md-6">
                    <label for="inputEmail4">เพศ</label>
                    <input type="text" class="form-control"   readonly = true value="<?php echo  $dm_gender;?>">
               </div>
               <div class="form-group col-md-6">
                    <label for="inputPassword4">อายุ</label>
                    <input type="text" class="form-control"  readonly = true value="<?php echo  $dm_age;?>">
               </div>
               </div>
          </th>
     </tr>
</table>
<br><hr>
<div class="table-responsive" id="showmessage">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
                  <tr>
                    <th  class="text-center">ลำดับ</th>
                    <th class="text-center">ประเภทผู้มีพฤติกรรมเสี่ยง</th>
                    <th class="text-center">สถานที่ </th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center">รายละเอียด</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $count=1;
                       
                      $sql = "
                      SELECT dt.*, dtd.*
                        FROM dt_management dt
                        INNER JOIN dt_detailmanagement dtd on dt.dm_id = dtd.dm_id  WHERE  dtd.dm_id='".$_REQUEST["id"]."' ORDER BY dtd.dtd_id DESC"; 
                      $result = $connect->query($sql);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <tr>
                    <td  class="text-center"><?php echo $count;?></td>
                    <td><?php echo $row['dtd_type']; ?></td>
                    <td><?php echo $row['dtd_location'] ; ?></td>
                    <td><?php echo $row['dtd_status'] ?></td>
                    <td class="text-center"><button  class="btn btn-success view_data col-md-10" id='<?php echo $row['dtd_id'];?>'><i  class="fas fa-eye acolor"> ดูรายละเอียด</i></button></a></td>
                          <?php   $count +=1;}
                        }?>
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

  <div class="modal fade bd-example-modal-lg" id="riskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content tablelayout" style="width: 800px;">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> รายละเอียดพฤติกรรมเสี่ยง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" id="insert_form">
                        <table style="width: 743px;"> 
          <tr>
          <th class="col-md-7">
               <div class="form-group">
               <label for="id-cards">วันที่ - เวลา</label>
               <input type="text" class="form-control" id="dtd_date" readonly = true>
               </div>
          </th>
          <br>
          <th class="col-md-4" rowspan="4"><div id="imagerisk"></div></th>
     </tr>
     <tr>
     <th class="col-md-7">
               <div class="form-group">
               <label for="id-name">ประเภทพฤติกรรมเสี่ยง</label>
               <input type="text" class="form-control" id="dtd_type"  readonly = true>
               </div>
               
          </th>
     </tr>
     <tr>
     <th class="col-md-4">
          <div class="form-row">
               <div class="form-group col-md-6">
                    <label for="inputEmail4">สถานที่</label>
                    <input type="text" class="form-control" id="dtd_location"  readonly = true>
               </div>
               <div class="form-group col-md-6">
                    <label for="inputPassword4">สถานะผู้มีพฤติกรรมเสี่ยง</label>
                    <input type="text" class="form-control" id="dtd_status" readonly = true>
               </div>
          </div>
          </th>
     </tr>
     <tr>
     <th class="col-md-7">
               <div class="form-group">
               <label for="id-name">ผู้บันทึกข้อมูล</label>
               <input type="text" class="form-control" id="at_name"  readonly = true>
               </div>
               
          </th>
     </tr>
     <tr>
     <th class="col-md-12">
               <div class="form-group">
               <label for="id-name">หมายเหตุ : กรณียกเลิกผู้มีพฤติกรรมเสี่ยง</label>
               <input type="text" class="form-control" id="dtd_comment"  readonly = true>
               </div>
               
          </th>
     </tr>
     </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
  <script type='text/javascript'>
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
$(document).on('click', '.view_data', function(){  
           var dtd_id = $(this).attr("id");  
           $.ajax({  
                url:"ajaxdetilerisk.php",  
                method:"POST",  
                data:{dtd_id:dtd_id},  
                dataType:"json",  
                success:function(data){  
                    let suby =parseInt((data.dtd_date.substring(0, 4)))
                       suby+=543
                      var date="วันที่  "+data.dtd_date.substring(8, 10)+"/"+data.dtd_date.substring(6, 7)+"/"+suby+"  เวลา "+data.dtd_date.substring(11,16)+" น."
                     $('#dm_name').val(data.dm_prefix+' '+data.dm_name);  
                     $('#dm_age').val(data.dm_age);  
                     $('#dtd_id').val(data.dtd_id);  
                     $('#dm_gender').val(data.dm_gender);
                      $('#dtd_date').val(date);  
                     $('#dtd_type').val(data.dtd_type);
                     $('#dtd_location').val(data.dtd_location);
                     $('#dtd_status').val(data.dtd_status);
                     $('#dtd_comment').val(data.dtd_comment);
                     $('#at_name').val(data.at_rank+' '+data.at_name);
                     $('#dtd_image').val('http://wangkhondaeng.prachinburi.police.go.th/img/risk-img/'+data.dtd_image);
                     $('#imagerisk').html('<img src=http://wangkhondaeng.prachinburi.police.go.th/img/risk-img/'+ data.dtd_image + ' style="width: 300px;height: 300px;"  />');
                     $('#riskModal').modal('show');  
                }  
           });  
      });  
    });  
            </script>
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
