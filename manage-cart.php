  <!DOCTYPE html>
 <html lang="en">
 <head>
          <body> 
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         
         <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script type="text/javascript" src="custom.js"></script>
         <title>Document</title>
 </head>
  <?php
  session_start();
         include("conn.php");
         include("functions.inc.php");
        include("constant.inc.php");
        ?>
 </body>
 </html>
        <?php
         $attr =get_safe_value($_POST['attr']);
         
         $typee =get_safe_value($_POST['typee']);
         if($typee =='add'){         
                 $qty =get_safe_value($_POST['qty']);
                 if(isset($_SESSION['CustomerId'])){        
                 $uid=$_SESSION['CustomerId'];
                 manageUserCart($uid,$qty,$attr);
                 }
                 else{   
                 $_SESSION['cart'][$attr]['qty']=$qty;                         
                 }
                 $getUserFullcart=getUserFullCart();
                 $totalPrice=0;
                 foreach($getUserFullcart as $list){
                 $totalPrice=$totalPrice+($list['qty']*$list['price']);
                // $quantity=$list['qty'];

                 }
                 $totalCartPic=count(getUserFullCart());
                // $arr=array('totalCartPic'=>$totalCartPic,'totalPrice'=>$totalPrice);
                 
                // echo json_encode($arr);
                echo json_encode(array(
   "totalCartPic"=>$totalCartPic,"totalPrice"=>$totalPrice
), JSON_FORCE_OBJECT);
                
         }     

          if($typee=='delete'){         
                 removeDishFromCartByid($attr);  
         }     
?>
