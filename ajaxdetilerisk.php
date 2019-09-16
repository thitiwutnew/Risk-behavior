<?php  
 include('db_connect.php');
 if(isset($_POST["dtd_id"]))  
 {  
      $query = "
      SELECT dt.*, dtd.*, at.*
        FROM dt_management dt
        INNER JOIN dt_detailmanagement dtd
            on dt.dm_id = dtd.dm_id
        INNER JOIN authorities at
        on dtd.at_id = at.at_id  WHERE  dtd.dtd_id='".$_POST["dtd_id"]."'";   
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
