<?php   session_start();
date_default_timezone_set('UTC');
if($_SESSION['login_user'] == null || $_SESSION['user_status'] =="")
{
    header("location:index.php");
exit();
}
else{
  include('db_connect.php');
?>
<nav class="navbar navbar-expand navcolor static-top">
    <a class="navbar-brand mr-1 acolor" href=""><h3>แถบเมนู</h3></a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0 acolor" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0 ">
    <a class="nav-link dropdown-toggle acolor" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw acolor"></i> <?php echo  $_SESSION["login_user"];?> 
        </a>
        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="userDropdown">
        <button class="dropdown-item edit_accdata" id='<?php echo $_SESSION["user_id"];?>'>ตั้งค่าบัญชี</button>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">ออกจากระบบ</a>
        </div>
    </form>
  </nav>


  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อความแจ้งเตือน</h5>
          </button>
        </div>
        <div class="modal-body">คุณต้องการออกจากระบบ ใช่หรือไม่</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
          <a class="btn btn-danger" href="logout.php">ออกจากระบบ</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="successupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อความแจ้งเตือน</h5>
          </button>
        </div>
        <div class="modal-body"> ได้ทำการอัพเดตข้อมูลเรียบร้อยแล้ว</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade margin-top" id="editaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">รายละเอียดผู้ใช้งาน</h5>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" id="insert_formdata">  
                         <div class="input-group footers" id="rank">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ยศ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <select class="custom-select" id="acc_rank"  name="acc_rank">
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
                        <div class="input-group footers" id="authorities">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อ-นามสกุล &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <select class="custom-select" id="acc_name"  name="acc_name">
                            <?php 
                                  $sql = "SELECT * FROM authorities";
                                  $result = $connect->query($sql);
                                  if (mysqli_num_rows($result) > 0) {
                                      while($row = mysqli_fetch_assoc($result)) {
                            ?>
                                       <option  value="<?php echo $row['at_id'];?>"><?php echo $row['at_name'];?></option>
                                      <?php }}?>
                            </select>
                        </div>
                        <div class="input-group footers" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ชื่อผู้ใช้งาน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control" id="acc_username"  name="acc_username" readonly= true>
                        </div>
                        <div class="input-group footers">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">สถานะผู้ใช้งาน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="text" class="form-control" id="acc_status" name="acc_status" readonly = true>
                        </div>
                        <div class="input-group footers">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">ตั้งรหัสผู้ใช้งานใหม่ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
                            </div>
                            <input type="password" class="form-control" name="new_password" value="">
                        </div>
        </div>
        <div class="modal-footer">
        <div class="text-center">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">ปิด</button>  
                        <button type="submit" name="insert" class="btn btn-success"  onclick="return confirm('คุณต้องการบันทึกข้อมูล หรือไม่');">บันทึกข้อมูล</button>  
                        </div>
                        <input type="hidden" name="account_id" id="acc_id" />  
        </div>
        </form>
      </div>
    </div>
  </div>
  <script type='text/javascript'>
 $(document).ready(function(){  
$(document).on('click', '.edit_accdata', function(){  
            event.preventDefault();  
           var acc_id = $(this).attr("id"); 
           $.ajax({  
            url:"editaccount.php",  
                method:"POST",  
                data:{acc_id:acc_id},  
                dataType:"json",  
                success:function(data){  
                     $('#acc_id').val(data.acc_id);  
                     $('#acc_name').val(data.acc_name);  
                     $('#acc_name1').val(data.acc_name);  
                     $('#acc_username').val(data.acc_username);  
                     $('#acc_password').val(data.acc_password);  
                     $('#acc_status').val(data.acc_status);  
                     $('#acc_status1').val(data.acc_status);  
                     $('#acc_rank').val(data.acc_rank);  
                     $('#editaccount').modal('show');   
                }  
           });  
      });  
      $('#insert_formdata').on("submit", function(event){  
        event.preventDefault();  
                $.ajax({  
                     url:"editaccount.php",  
                     method:"POST",  
                     data:$('#insert_formdata').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("กำลังอัพเดตข้อมูล");  
                     },  
                     success:function(data){  
                          $('#insert_formdata')[0].reset();  
                          $('#editaccount').modal('hide');  
                          $('#successupdate').modal('show');    
                     }  
                });  
      }); 
    });  

            </script>
<?php }?>