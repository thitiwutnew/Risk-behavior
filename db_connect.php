<?php
$Host ="localhost";
$my_user="root";
$my_password="123456789";
$my_db="pp-rbh";
$connect = mysqli_connect($Host, $my_user, $my_password, $my_db);
mysqli_set_charset($connect,"utf8");

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL."<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL."<br>";
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL."<br>";
  
}
?>