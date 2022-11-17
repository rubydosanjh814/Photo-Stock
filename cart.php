<?php
include("header.php");
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
             <div class="table-wrapper">
            <form method="post">
            <?php
            $cartArr=getUserFullCart(); 
            if(count($cartArr)>0){?>          
            <table>
                <tr>
                <th>Image</th>
                <th>Product name</th>
                 <!--<th>Qty</th>-->
                <th>Unit Price</th>
                <th>Subtotal</th>
                <th>Action</th>
                </tr>
                <?php
                foreach($cartArr as $key=>$list){?>
           <tr>
               <td><a href="#"><span><?php  $imgSrc=SITE_PIC_IMAGE;
          $imgName1 = $list['pic_name']?>
         <img class="cart-img" src=<?php echo $imgSrc.$imgName1 ?>  alt=''></span></a></td>
         <td><?php echo $imgName1; ?></td>
         <!--hide the qty bcz we dont need qty for images -->
         <!--<td><input hidden type="text" name ="qty[<?php echo $key ?>][]" value="<?php echo $list['qty'];; ?>"></td>-->
         <td><?php echo $list['price']; ?></td>
         <td><?php echo $list['price']*$list['qty']; ?></td>
         <td><button onclick="delete_cart('<?php echo $key ?>')">X</button></td>
           </tr>
            <?php }}
            else{
                echo 'Cart empty';
            }?>
             </table>
        </div>
            <input style="float:right;" class="btn-fancy" type="submit" name="update_cart" value="Update cart">
            </form>    
         <div><a href="index.php"><button class="btn-fancy">Continue Shopping</button></a>
         <a href="checkout.php"><button class="btn-fancy">Checkout</button></a></div>
        </div>
     </div>
</body>
</html>