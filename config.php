<?php
require('stripe-php/init.php');

$publishableKey="pk_test_51LvD4RB9e8xzalx9jxkYzyIthscp5QtbPD2Hkfva2AcglRPvoB3ffGLVLZkx1dBXGPbafROjFmVSvAHSUNQsHEBN00wxHEFaEQ";
$secretKey="sk_test_51LvD4RB9e8xzalx9mZxAAaMLKE0UzLtTi4p7fh8Wrrr23mEmzWpG7mwNEnOHRTWVFcjaCGAGF66GRxSh1Nh0qnLW00C8UgWhGI";

\Stripe\Stripe::setApiKey($secretKey);
?>