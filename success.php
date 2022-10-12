<?php
session_start();
 include("header.php");
if(!$_SESSION['ORDER_ID']){
header("location: index.php");
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <div class="main">
        <div class="intro">
            
          <h2> Thank you your order has been placed.<br>
            your  order id  <?php echo $_SESSION['ORDER_ID']?></h2>
        </div>
     </div>
</body>
</html>
<?php
unset($_SESSION['ORDER_ID']);
?>