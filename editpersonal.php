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
            <a href="#">พนักงาน</a>
          </li>
          <li class="breadcrumb-item active">แก้ไขข้อมูลพนักงาน</li>
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
            <div class="table-responsive" id="showmessage">
              <table class="table table-bordered" id="dataTable"  cellspacing="0" >
                <thead>
                  <tr>
                    <th class="text-center" style=" width: 119px;">รหัสพนักงาน</th>
                    <th class="text-center" style=" width: 119px;">ยศ</th>
                    <th  class="text-center"style=" width: 320px;">ชื่อ - นามสกุล</th>
                    <th class="text-center"style=" width: 320px;">ตำแหน่งงานรับผิดชอบ</th>
                    <th class="text-center">จัดการข้อมูล</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        include('db_connect.php');
                      $sql = "SELECT * FROM authorities Order by at_id ASC";
                      $result = $connect->query($sql);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            
                    ?>
                      <tr>
                    <td class="text-center"><?php echo $row['at_code']; ?></td>
                    <td class="text-center"><?php echo $row['at_rank'] ; ?></td>
                    <td ><?php echo $row['at_name'] ?></td>
                    <td><?php echo $row['at_position'] ?></td>
                    <td class="text-center"><button  class="btn btn-info edit_data col-md-5" id='<?php echo $row['at_id'];?>'><i  class="fas fa-edit acolor">แก้ไข</i></button>&nbsp;&nbsp;<button  class="btn btn-danger delete col-md-5"  name="delete"  id='<?php echo $row['at_id'];?>'><i  class="fas fa-trash-alt acolor "> ลบข้อมูล</i></button></td>
                
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
  <div class="modal fade margin-top" id="empModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i  class="fas fa-user acolor-back"> แก้ไขรายละเอียดเจ้าหน้าที่พนักงาน</i></h5>
                </div>
                <div class="modal-body">
                <form method="post" id="insert_form">  
                        <div class="input-group footers" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">รหัสเจ้าหน้าที่พนักงาน&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control"  name="at_code" id="at_code" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group footers" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ยศเจ้าหน้าที่พนักงาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <select name="at_rank" id="at_rank" class="form-control">  
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
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ - นามสกุล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control"  name="at_name" id="at_name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group footers" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ตำแหน่งงานรับผิดชอบ&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control"  name="at_position" id="at_position" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                          <br />  
                          <input type="hidden" name="at_id" id="at_id" />  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่าง</button>
                    <input type="submit" name="insert" id="insert" value="แก้ไขข้อมูล" class="btn btn-success" />  
                </div>
                </form>  
                </div>
            </div>
            </div>

            <div class="modal fade margin-top" id="deletemodal" tabindex="-1" role="dialog">
            <form method="post" id="deletedata">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title">การแจ้งเตือนการลบข้อมูล</p>
      </div>
      <div class="modal-body">
              <center><h5> <p>คุณแน่ใจใช่ไหมว่าจะลบข้อมูลพนักงาน <input type="hidden" name="id" value=""><p id="id" ></p></input></p></h5></center>
           
        
      </div>
      <div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
     <input type="submit" name="submit" id="submit" value="ยืนยันการลบข้อมูล" class="btn btn-success submit" />  
     </form>
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

      $(document).on('click', '.delete', function(){   
        var at_id = $(this).attr("id");  
        $('#deletemodal').modal('show');
        $(document).on('click', '.submit', function(event){  
         
           event.preventDefault();  
           $.ajax({  
                url:"deletepersonal.php",  
                method:"POST",  
                data:{at_id:at_id},  
                dataType:"json",  
                success:function(data){ 
                     $('#deletemodal').modal('hide');  
                     $('#showmessage').html(data);    
                     at_id='';
                }  
           });   
      });  
      });  

$(document).on('click', '.edit_data', function(){  
           var at_id = $(this).attr("id");  
           $.ajax({  
                url:"ajaxedit.php",  
                method:"POST",  
                data:{at_id:at_id},  
                dataType:"json",  
                success:function(data){  
                     $('#at_id').val(data.at_id);  
                     $('#at_code').val(data.at_code);  
                     $('#at_rank').val(data.at_rank);  
                     $('#at_name').val(data.at_name);  
                     $('#at_position').val(data.at_position);  
                     $('#empModal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
        event.preventDefault();  
                $.ajax({  
                     url:"insertpersonal.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("กำลังอัพเดตข้อมูล");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#empModal').modal('hide');  
                          $('#showmessage').html(data);    
                     }  
                });  
      }); 
      // $(document).on('click', '.submit', function(){  
      //   var id = $(this).attr("id");  
      //           $.ajax({  
      //                url:"deletepersonal.php",  
      //                method:"POST",  
      //           data:{id:id},  
      //           dataType:"json",  
      //                beforeSend:function(){  
      //                     $('#submit').val("กำลังลบข้อมูล");  
      //                },  
      //                success:function(data){  
      //                     $('#deletedata')[0].reset();  
      //                     $('#deletemodal').modal('hide');  
      //                     $('#showmessage').html(data);    
      //                }  
      //           });  
           
      // }); 
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
