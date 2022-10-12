<?php
session_start();
unset($_SESSION['userUsername']);
header("location: login.php");
?>