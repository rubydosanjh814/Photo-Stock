<?php
$user = 'root';
$pass = '';
$db ='photo_stock';

$db = new mysqli('localhost',$user,$pass,$db) or die();
mysqli_select_db($db,'photo_stock');
?>