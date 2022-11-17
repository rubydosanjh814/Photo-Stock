<?php
$user = 'root';
$pass = '';
$dbname ='photo_stock';
$db = new mysqli('localhost',$user,$pass,$dbname) or die();
mysqli_select_db($db, $dbname);
?>