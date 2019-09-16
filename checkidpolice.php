<?php  
 include('db_connect.php');
 if(isset($_POST["at_id"]))  
 {  
      $query = "SELECT * FROM authorities WHERE at_code = '".$_POST["at_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      if($row!=null){
        echo json_encode("1"); 
      }
      else{  echo json_encode("0"); }
      
 }  
 ?>
