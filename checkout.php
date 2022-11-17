<?php
session_start();
include("header.php");
require('config.php');
 
$cartArr=getUserFullCart();

//prx($cartArr);
$dd= count($cartArr);
//echo $dd;
//echo $_SESSION['CustomerId'];
 if($dd>0){

  //opening and displaying the login box depending on if user is loggedin or not
   if(isset($_SESSION['CustomerId'])){
    $is_show='';
    $is_display='checkshow';
    $is_second_box='';
    $is_final_show='myDIV1';
   }
   //opening, closing and displaying the login box depending on if user is loggedin or not
   else{
    $is_show='myDIV';
    $is_display='';
    $is_second_box='checkshow';
    $is_final_show='';
   }
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
     
    //mysqli_query($db,$sql);
    //$insert_id=mysql_insert_id($db);
    $last_id="";
   if ($db->query($sql) === TRUE) {
   $last_id = $db->insert_id;
   $_SESSION['ORDER_ID']=$last_id;
  //echo "New record created successfully. Last inserted ID is: " . $last_id;
  } else {
  echo "Error: " . $sql . "<br>" . $db->error;
  }
    foreach($cartArr as $key=>$list){
      $id1=$last_id;
      $pic_id1=$key;
      $price1=$list['price'];
      $qty1=$list['qty'];
    mysqli_query($db,"insert into order_detail(order_id,pic_detail_id,price,qty) values('$id1','$pic_id1','$price1','$qty1')");
    } 
  //  emptyCart();
 echo "<script>window.location.href='confirm-order.php';</script>";
    exit;
  }
     ?>
     <div  style="width:60%;float:left;">
     <button class="checkout-btn" onclick="checkFunction()">Checkout Method</button>
     <div  id ="<?php echo $is_show ?>" class="form-wraper <?php echo $is_display ?>">Login:
     
     <form method="post" action="chkout-login-inc.php">
      <br>
         <lable>UserName</lable>
     <input type="text" name="UserName"></input><br>
      <lable>Password</lable>
     <input style="width: 100% !important;" type="Password" name="PassWord"></input><br>
     <input class="fancy-btn" name="btn-chkout-login" type="submit" value="Login"></input>&nbsp;
     <a href="Register.php"><button class="fancy-btn">Register</button></a>
     </form>
      </div>
      <div><button class="checkout-btn" onclick="checkFunction1()">Other Information</button>
    
      <div id ="<?php echo $is_final_show ?>" class="form-wraper <?php echo $is_second_box ?>">
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
     
     <input class="fancy-btn" type="submit"  name="place_order" value="Continue Checkout"></input>&nbsp;
     </form>
      </div>
    </div>
    </div> 
    </div>

  <div style="width: 20%;float: right;"id="myDropdown1" class="dropdown-content1">
    <ol>
       <?php foreach($cartArr as $key=>$list){?>
         <li>
         <a href="#"><span class="cart-text-span"><?php  $imgSrc=SITE_PIC_IMAGE;
          $imgName1 = $list['pic_name']?>
         <img class="image-chkout" src=<?php echo $imgSrc.$imgName1 ?> alt=''>
         Image &nbsp<span>Price<?php echo $list['price']?>&nbsp qty<?php echo $list['qty']?>
        <span style="color:black;" class="shopping-cart-delete">&nbsp<button onclick="delete_cart('<?php echo $key ?>')">X</button></span></span>
        </a></li>
         <?php
         }
         ?>
         <a><span>Total<?php echo $totalPrice?></span></a>
         
  </ol>
  </div>
  <div>
        
  <?php
 }else{
   header("location: index.php");
 }
 ?>