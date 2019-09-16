 <?php  
 include('db_connect.php');
 if(isset($_POST["at_id"]))  
 {  
      $query = "SELECT * FROM authorities WHERE at_id = '".$_POST["at_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
