
  <?php  
  include('db_connect.php');

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  

      if($_POST["at_id"] != '')  
      {  
           $query = "  DELETE FROM authorities WHERE at_id='".$_POST["at_id"]."'";  
          
      }  
      if(mysqli_query($connect, $query))  
      {  
           $deluser=$_POST["at_id"];
          $querydel = " DELETE FROM account WHERE acc_name='".$deluser."'";  
          if(mysqli_query($connect, $querydel))  
               {       
                    $output .=' <div class="alert alert-success alert-dismissible fade show  success-alert" role="alert" id="success-alert">
                    <strong>ข้อมูลถูกลบเรียบร้อย</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';  
                    $select_query = "SELECT * FROM authorities ";  
                    $result = mysqli_query($connect, $select_query);  
                    $output .= '  
                    <table class="table table-bordered" id="dataTable"  cellspacing="0" >
                    <thead>
                      <tr>
                      <th class="text-center" style=" width: 119px;">รหัสพนักงาน</th>
                      <th class="text-center" style=" width: 119px;">ยศ</th>
                      <th class="text-center" style=" width: 320px;">ชื่อ - นามสกุล</th>
                      <th class="text-center" style=" width: 320px;">ตำแหน่งงานรับผิดชอบ</th>
                      <th class="text-center">จัดการข้อมูล</th>
                      </tr>
                    </thead>
                    <tbody>
                    ';  
                    while($row = mysqli_fetch_array($result))  
                    {  
                         $output .= '  
                              <tr>  
                                   <td class="text-center">'.$row["at_code"].'</td>
                                   <td class="text-center">'.$row["at_rank"].'</td>
                                   <td>'.$row["at_name"].'</td>
                                   <td>'.$row["at_position"].'</td>
                                   <td class="text-center"><button  class="btn btn-info edit_data col-md-5" id=' .$row['at_id'].'"><i  class="fas fa-edit acolor">แก้ไข</i></button>&nbsp;&nbsp;<button  class="btn btn-danger delete col-md-5"  name="delete"  id="' .$row['at_code'].'"><i  class="fas fa-trash-alt acolor"> ลบข้อมูล</i></button></td>
                              </tr>  
                         ';  
                    }  
                    $output .= '  </tbody></table>'; 
                }
      }  
      else{
        $output .= '   <div class="alert alert-danger alert-dismissible fade show success-alert" role="alert" id="success-alert">
                            <strong>เกิดข้อผิดพลาดไม่สามารถลบข้อมูลได้</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
      }
      $output .='   <script>
      window.setTimeout(function() {
                         $(".alert").fadeTo(500, 0).slideUp(500, function(){
                             $(this).remove(); 
                         });
                     }, 2000);
   </script> <script src="js/demo/datatables-demo.js"></script>';
  echo json_encode($output);  
 }  
 ?>