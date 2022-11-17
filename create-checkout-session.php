<?php
include './stripe-php/init.php';
//require 'vendor/autoload.php';
$total=$_POST['total'];
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LvD4RB9e8xzalx9mZxAAaMLKE0UzLtTi4p7fh8Wrrr23mEmzWpG7mwNEnOHRTWVFcjaCGAGF66GRxSh1Nh0qnLW00C8UgWhGI');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/stripe';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => $total,
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>