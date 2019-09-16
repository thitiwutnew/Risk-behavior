
  <?php  
  include('db_connect.php');
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $at_id = mysqli_real_escape_string($connect, $_POST["at_id"]);  
      $at_code = mysqli_real_escape_string($connect, $_POST["at_code"]);  
      $at_rank = mysqli_real_escape_string($connect, $_POST["at_rank"]);  
      $at_name = mysqli_real_escape_string($connect, $_POST["at_name"]);  
      $at_position = mysqli_real_escape_string($connect, $_POST["at_position"]);  
      if($_POST["at_id"] != '')  
      {  
           $query = "  
           UPDATE authorities   
           SET at_code='$at_code',   
           at_rank='$at_rank',   
           at_name='$at_name',   
           at_position = '$at_position'
           WHERE at_id='".$_POST["at_id"]."'";  
           $message = 'Data Updated';  
      }   
      if(mysqli_query($connect, $query))  
      {  
           $output .= ' <div class="alert alert-success alert-dismissible fade show  success-alert" role="alert" id="success-alert">
           <strong>ข้อมูลถูกแก้ไขเรียบร้อย</strong> 
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
                          <td>'.$row["at_code"].'</td>
                          <td>'.$row["at_rank"].'</td>
                          <td>'.$row["at_name"].'</td>
                          <td>'.$row["at_position"].'</td>
                          <td class="text-center"><button  class="btn btn-info edit_data col-md-5" id=' .$row['at_id'].'"><i  class="fas fa-edit acolor">แก้ไข</i></button>&nbsp;&nbsp;<button  class="btn btn-danger delete col-md-5"  name="delete"  id="' .$row['at_code'].'"><i  class="fas fa-trash-alt acolor"> ลบข้อมูล</i></button></td>
                     </tr>  
                ';  
           }  
           $output .= '  </tbody></table>';  
      }  
      else{
        $output .= '  <div class="alert alert-danger alert-dismissible fade show success-alert" role="alert" id="success-alert">
                            <strong>เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้</strong> 
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
      echo $output;  
 }  
 ?>