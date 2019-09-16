<?php  
 include('db_connect.php');
 if(isset($_POST["acc_id"]))  
 {  
      $query = "SELECT * FROM account WHERE acc_name = '".$_POST["acc_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
if(isset($_POST["account_id"])){

     if($_POST["new_password"]!=NULL){
          $password =md5($_POST['new_password']);
       
               $query = "  
               UPDATE account   
               SET acc_password='$password',
               acc_rank='".$_POST["acc_rank"]."',
               acc_name='".$_POST["acc_name"]."'
               WHERE acc_id='".$_POST["account_id"]."'"; 
          
          if(mysqli_query($connect, $query))  
          { 
               session_start();
               session_destroy();
               header("location:index.php");
          }

     }
     else {
               $query = "  
               UPDATE account   
               SET acc_name='".$_POST["acc_name"]."',
               acc_rank='".$_POST["acc_rank"]."'
               WHERE acc_id='".$_POST["account_id"]."'"; 
               if(mysqli_query($connect, $query))  
               { 
                session_start();
                $sqlname = "SELECT * FROM authorities WHERE at_id = ".$_POST["acc_name"]."";
                $resultname = mysqli_query($connect,$sqlname);
                $rowname = mysqli_fetch_array($resultname,MYSQLI_ASSOC);
                $_SESSION['user_id']= $_POST["acc_name"];
                $_SESSION["login_user"] =  $_POST["acc_rank"]." ".$rowname["at_name"];
               } 
          
        
         }
    
 }


 ?>
