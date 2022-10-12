<!DOCTYPE html>
<html lang="en">
<body>
  <?php
  error_reporting(0);
  session_start();
  include("conn.php");
  include("functions.inc.php");
  include("constant.inc.php");
  ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="custom.js"></script>
     <link href="style.css" rel="stylesheet">
    <title>Photo Stock</title>
</head>
<?php
  $totalPrice=0;


  if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $key=>$val){        
         if(isset($_SESSION['CustomerId'])){
          if($val[0]==0){
          mysqli_query($db,"delete from pic_cart  where pic_detail_id='$key' and user_id=".$_SESSION['CustomerId']);
          }
          else{
           mysqli_query($db,"update pic_cart set qty='".$val[0]."' where pic_detail_id='$key' and user_id=".$_SESSION['CustomerId']);  
          }
         }else{
           if($val[0]==0){
           unset($_SESSION['cart'][$key]['qty']);//does not work
           }
           else{
                $_SESSION['cart'][$key]['qty']=$val[0];
           } 
        }
    }
  }

  $cartArr=getUserFullCart();
//prx($cartArr);
   foreach($cartArr as $list){
          $totalPrice=$totalPrice+($list['qty']*$list['price']);
          }
 $totalCartPic = count($cartArr);
?>

    <div class="desk-nav">
    <div class="top-bar"> 
           <div class="top-inner">
                <div class="logo"><h1><a href="index.php">Photo Stock</h1></a></div>
                     <div class="top-inner-left">
                      <?php
                      if(isset($_SESSION['userUsername'])){
                       echo '<a href="user-logout.php">logout</a>';
                      }
                      else{
                         echo '<a href="user-login.php">Login Or Register</a>';
                      }
                      ?>
                        
                        
                        <div class="dropdown">
                   
                    </div>
                       <span id="totalPrice"><?php 
                       if($totalPrice!=0){
                       echo $totalPrice.'/- INR';} ?> </span><button onclick="myFunction()" class="dropbtn"> Cart </button><span id="totalCartPic"><?php echo $totalCartPic ?></span>
                    <?php
                    if($totalPrice!=0){
                      ?>
  <div id="myDropdown" class="dropdown-content">
    <ol>
       <?php foreach($cartArr as $key=>$list){?>
         <li>
         <a href="#"><span class="cart-text-span"><?php  $imgSrc=SITE_PIC_IMAGE;
          $imgName1 = $list['pic_name']?>
         <img class="image-cart" src=<?php echo $imgSrc.$imgName1 ?>  alt=''>
          &nbsp $<?php echo $list['price']?>&nbsp(<?php echo $list['qty']?>)
        <span style="color:black;" class="shopping-cart-delete">&nbsp<button class="button-toggle-delete-cart" onclick="delete_cart('<?php echo $key ?>')">X</button></span> </span>
      </a></li>
         <?php
         }
         ?>
         <a><span >Total:&nbsp$<?php echo $totalPrice?></span></a>
         <a class="cart-text-span" href="cart.php">View Cart</a>
         <a  class="cart-text-span" href="checkout.php">Checkout</a>
  </ol>
  </div>
  <?php
                    }
  ?>
</div> <!--end container -->


           </div>
    </div>
                  </div>
    <?php
              
    ?>
    <script>
  </script>


  <!--Mobile Nav -->


<body>
<?php
 
?>

<div class="mobile-nav">
    <div class="top-bar"> 
           <div class="top-inner">
                 <!-- Top Navigation Menu -->
<div class="topnav">
  <a href="index.php"  class="active"><h1>Photo Stock</h1></a>
  <!-- Navigation links (hidden by default) -->
  <div id="myLinks">
    <a href="creative">News</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
  <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
  <a href="javascript:void(0);" class="icon" onclick="myFunctionTopNav()">
    <i class="fa fa-bars"></i>
  </a>
</div><!-- mobile toggle nav-->
                     <div class="top-inner-left">
                      <?php
                      if(isset($_SESSION['userUsername'])){
                       echo '<a href="user-logout.php">logout</a>';
                      }
                      else{
                         echo '<a href="user-login.php">Login/Register</a>';
                      }
                      ?>
                        
                        
                        <div class="dropdown">
                   
                    </div>
                       <span id="totalPrice"><?php 
                       if($totalPrice!=0){
                       /*echo $totalPrice.'/- INR';*/} ?> </span><span id="totalCartPic"><a class="cart-text-span" href="cart.php">Cart(<?php echo $totalCartPic ?>)</a></span>
                  
                 

  <?php
                    
  ?>
</div> 
           </div>
    </div></div>
    <?php
              
    ?>
    <script>
  

  </script>
</body>
</html>







</body>
</html>