
  <?php  
  include('db_connect.php');
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $dtd_status = mysqli_real_escape_string($connect, $_POST["dtd_status"]); 
      $dtd_comment = mysqli_real_escape_string($connect, $_POST["comment"]);  
      if($dtd_status=='ผู้มีพฤติกรรมเสี่ยง'){
        $dtd_comment='-';
      }
      if($_POST["dtd_id"] != '')  
      {  
           $query = "  
           UPDATE dt_detailmanagement   
           SET dtd_status='$dtd_status',dtd_comment='$dtd_comment'
           WHERE dtd_id='".$_POST["dtd_id"]."'";  
           $message = 'Data Updated';  
      }   
      if(mysqli_query($connect, $query))  
      {  
          $count=1;
           $output .= ' <div class="alert alert-success alert-dismissible fade show  success-alert" role="alert" id="success-alert">
           <strong>ข้อมูลถูกแก้ไขเรียบร้อย</strong> 
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>';  
           $select_query = "
           SELECT dt.*, dtd.*, at.*
           FROM dt_management dt
           INNER JOIN dt_detailmanagement dtd
               on dt.dm_id = dtd.dm_id
           INNER JOIN authorities at
           on dtd.at_id = at.at_id  WHERE  dt.dm_id='".$_REQUEST["dm_id"]."'"; 
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
           <table class="table table-bordered" id="dataTable"  cellspacing="0" >
           <thead>
             <tr>
             <th>ลำดับ</th>
             <th>ประเภทผู้มีพฤติกรรมเสี่ยง</th>
             <th>สถานที่ </th>
             <th>สถานะ</th>
             <th>รายละเอียด</th>
             </tr>
           </thead>
           <tbody>
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                              <td>'. $count.'</td>
                          <td>'.$row["dtd_type"].'</td>
                          <td>'.$row["dtd_location"].'</td>
                          <td>'.$row["dtd_status"].'</td>
                          <td><button  class="btn btn-danger view_data" id=' .$row['dtd_id'].'"><i  class="fas fa-eye acolor"> แก้ไขข้อมูล</i></button></a></td>
                          
                          </tr>  
                ';  
                $count +=1;
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