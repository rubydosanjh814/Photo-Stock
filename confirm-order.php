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
   //getting user details
   $userArr=getUserDetailByid();
   //prx($userArr);   
   // emptyCart();
// echo "<script>window.location.href='success.php';</script>";
   // exit;
  
     ?>
     <div  style="width:60%;float:left;">
     
    
     <div  class="form-wraper <?php echo $is_second_box ?>">
      <table>
         <tr><th>First Name : <?php echo $userArr['name'] ?></th>
     </tr>
        <tr><th>Email :  <?php echo $userArr['email'] ?></th>
     </tr>
        <tr><th>Address : <?php echo $userArr['address'] ?></th>
     </tr>
        <tr><th>Mobile : <?php echo $userArr['mobile'] ?></th>
     </tr>
      <tr><th>Total :  $ <?php echo $totalPrice?> /-</th>
     </tr>
 </table>
 <div>
  <a style="float:left;margin-top:10px;color:#20c997;" href="checkout.php">Go Back</a>
  <!-- stripe payment code -->
<form style="margin-top:10px;float:right;" action="submit.php" method="post">
  <input type="hidden" name="totalPrice" value="<?php echo $totalPrice?>" ></input>
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"

    data-key="<?php echo $publishableKey ?>"
    data-amount="<?php echo $totalPrice*100; ?>"
    data-name="Programming with"
    data-description="Programming"
    data-image=""
    data-currency="cad"
    data-email="rybt@gmail.com";
    >
        </script>
        </form>
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
  //emptyCart();
 }else{
   header("location: index.php");
 }
 ?>