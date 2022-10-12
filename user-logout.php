<?php
session_start();
unset($_SESSION['CustomerId']);
unset($_SESSION['userUsername']);
//session_destroy();
header("location: user-login.php");
?>