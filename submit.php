<?php
session_start();
require('config.php');
include("header.php");

\Stripe\Stripe::setVerifySslCerts(false);
$token=$_POST['stripeToken'];
$totalPrice=$_POST['totalPrice'];
$totalPrice*=100;
$data=\Stripe\Charge::create(array(
    "amount" => $totalPrice,
    "currency"=>"cad",
    "description"=>"Programming",
    "source"=> $token,
));
emptyCart();
 echo "<script>window.location.href='success.php';</script>";
//echo "<pre>";
//print_r($data);
?>