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
            your  order id  <?php echo $_SESSION['ORDER_ID']?>. You will receive an download link for purchased images in your email.</h2>
        </div>
     </div>

<?php
//$res=$_SESSION['ORDER_ID'];
$res=20;
$i=0;
$j=0;
$varArr=array();
$varPicARR=array();
$sql = "SELECT * from order_detail where order_id = '$res'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["pic_detail_id"]. "<br>";
$varArr[$i]= $row["pic_detail_id"];
$i++;
  }
} else {
  echo "0 results";
}

foreach ($varArr as $value) {
  echo "$value <br>";
  $sql1 = "SELECT * from pictures where id = '$value'";
$result1 = $db->query($sql1);
if ($result1->num_rows > 0) {
  // output data of each row
  while($row1 = $result1->fetch_assoc()) {
  echo SERVER_PIC_IMAGE . $row1["pic_name"]. "<br>";
$varPicARR[$j]= $row1["pic_name"];
$j++;
  }
} else {
  echo "0 results";
}

}


foreach ($varPicARR as $value) {
  echo "$value <br>";
  
}
$cus=$_SESSION['CustomerId'];
$sql3 = "SELECT * from order_master where user_id = '$cus'";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
  // output data of each row
  $row3 = $result3->fetch_assoc();
  echo  $row3["email"] ;
  }



$to = "kaur.dosanjh123@gmail.com";
$subject = "My subject";
$message = "Guests: ".implode("\n,     ", $varPicARR).". ";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$message,$headers);

echo $message;







//unset($_SESSION['ORDER_ID']);
?>
</body>
</html>