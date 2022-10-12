<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="test11.js"></script>

      <p>welcome</p>
    
      <?php


 session_start();
 include("header.php");
 

$cartArr=getUserFullCart();

//prx($cartArr);

   //getting user details
   $userArr=getUserDetailByid();
   //prx($userArr);

   if(isset($_POST['place_order'])){
    $checkout_name=get_safe_value($_POST['checkout_name']);
    $checkout_email=get_safe_value($_POST['checkout_email']);
    $checkout_mobile=get_safe_value($_POST['checkout_mobile']);
    $checkout_zipcode=get_safe_value($_POST['checkout_zipcode']);
    $checkout_address=get_safe_value($_POST['checkout_address']);
    $added_on=date('Y-m-d h:i:s');
    
     $sql="insert into order_master(user_id,name,email,mobile,address,zipcode,total_price,order_status,payment_status,added_on) values('".$_SESSION['CustomerId']."','$checkout_name','$checkout_email','$checkout_mobile','$checkout_address','$checkout_zipcode','$totalPrice','1','pending','$added_on')";
     
     mysqli_query($db,$sql);
     echo "hello" ;

$last_id="";
if ($db->query($sql) === TRUE) {
  $last_id = $db->insert_id;
  //echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}

   //$insert_id=last_insert_id($db);

    foreach($cartArr as $key=>$val){
      $id1=$last_id;
      $pic_id1=$key;
      $price1=$val['price'];
      $qty1=$val['qty'];

     
echo $sql2="insert into order_detail(order_id,pic_detail_id,price,qty) values('$id1','$pic_id1','$price1','$qty1')";
     mysqli_query($db,$sql2);

    }
   
  }
  ?>
<form method="post" action="">
         <lable>First Name</lable>
     <input type="text" value="<?php echo $userArr['name'] ?>" name="checkout_name" required></input><br>

       <lable>Email</lable>
     <input type="text" value="<?php echo $userArr['email'] ?>" name="checkout_email" required></input><br>

       <lable>Mobile</lable>
     <input type="text" value="<?php echo $userArr['mobile'] ?>" name="checkout_mobile" required></input><br>

       <lable>Zip Code</lable>
     <input type="text" name="checkout_zipcode" required></input><br>

       <lable>Address</lable><br>
     <input type="textarea" name="checkout_address" required></input><br>

     <button class="fancy-btn" type="submit"  name="place_order" value="Place Order">Place Order</button>&nbsp;
     </form>
     <?php
/*
 
// take an array with some elements
$array = array(9,3,4,5,100,1);
// get the size of array
$count = count($array);
echo "<pre>";
// Print array elements before sorting
print_r($array);
for ($i = 0; $i < $count; $i++) {
    for ($j = $i + 1; $j < $count; $j++) {
        if ($array[$i] < $array[$j]) {
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
    }
}
echo "Sorted Array:" . "<br/>";
// Print array elements after sorting
print_r($array);


for ($i = 0; $i < $count; $i++) {
    if($i==$count-1){
        echo $array[$i];
    }
    else{
  echo $array[$i] .",";
    }
}



/*
function seqSummation($j,$k,$m){
$x=0;
$y=0;
for($j;$j<$k;$j++){
$x+=$j;

}

for($k;$k>=$m;$k--){

    $y+=$k;

}
 echo $y+$x;
}

seqSummation(5,9,6);
*/
?>