<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
global $db;
$str= mysqli_real_escape_string($db,$str);
return $str;
}

function redirect($link){
?>
  	<script>
		window.location.href='<?php echo $link?>';
  	</script>
<?php
}
?>

<?php
function getUserCart(){
	global $db;
	$arr=array();
	$id=$_SESSION['CustomerId'];
	$res=mysqli_query($db,"select * from pic_cart where user_id='$id'");
	while($row=mysqli_fetch_assoc($res)){
     $arr[]=$row;
	}
	return $arr;
}

function manageUserCart($id,$qty,$attr){
  global $db;
 $res=mysqli_query($db,"select * from pic_cart where user_id='$id' and pic_detail_id='$attr'");
                     if(mysqli_num_rows($res)>0){
                             $row=mysqli_fetch_assoc($res);
                             $cid=$row['id'];
                             mysqli_query($db,"update  pic_cart set qty='$qty' where id='$cid'");                             
                     }
                     else{
                             $added_on=date('y-m-d h:i:s');
                             mysqli_query($db,"insert into pic_cart(user_id,pic_detail_id,qty,added_on) values('$id','$attr','$qty','$added_on')");
                     }
}

function getUserFullCart($attr_id=''){
  	$cartArr=array();
       if(isset($_SESSION['CustomerId'])){
         $getUserCart=getUserCart();
         $cartArr=array();
            foreach($getUserCart as $list){
            $cartArr[$list['pic_detail_id']]['qty']=$list['qty'];   
            $getPicDetail=getPicDetailById($list['pic_detail_id']);       
			      $cartArr[$list['pic_detail_id']]['price']=$getPicDetail['price'];
            $cartArr[$list['pic_detail_id']]['pic_name']=$getPicDetail['pic_name'];
            $cartArr[$list['pic_detail_id']]['image']=$getPicDetail['image'];
            }
      }else {
              if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
               foreach($_SESSION['cart'] as $key=>$val){
            $cartArr[$key]['qty']=$val['qty'];  
            $getPicDetail=getPicDetailById($key);
			      $cartArr[$key]['price']=$getPicDetail['price'];
            $cartArr[$key]['pic_name']=$getPicDetail['pic_name'];
            $cartArr[$key]['image']=$getPicDetail['image'];
            }
               }
               // prx($_SESSION['cart']);
             }
         if($attr_id!=''){
            return $cartArr[$attr_id]['qty'];
           }
           else{
	         return $cartArr;
           }
}


?>
<?php

function getPicDetailById($id){
 	 global $db;
$res=mysqli_query($db,"select pictures.pic_name,pictures.image,picture_size_detail.price from picture_size_detail,pictures where picture_size_detail.pic_id='$id' and pictures.id=picture_size_detail.pic_id");
$row=mysqli_fetch_assoc($res);
return $row;
}

function removeDishFromCartByid($id){
   if(isset($_SESSION['CustomerId'])){        
    global $db;
    $customerid = $_SESSION['CustomerId'];
    $res=mysqli_query($db,"delete from pic_cart where pic_detail_id='$id' and user_id='$customerid'");
 
    }
    else{   
    unset($_SESSION['cart'][$id]);
    }
}

function emptyCart(){
  if(isset($_SESSION['CustomerId'])){        
    global $db;
    $customerid = $_SESSION['CustomerId'];
    $res=mysqli_query($db,"delete from pic_cart where  user_id='$customerid'");
    }
    else{   
    unset($_SESSION['cart']);
    }
}

function getUserDetailByid(){
   global $db;
   $data['name']='';
   $data['email']='';
   $data['mobile']='';
   $data['address']='';
   if(isset($_SESSION['CustomerId'])){  
   $row=mysqli_fetch_assoc(mysqli_query($db,"select * from user where id=".$_SESSION['CustomerId']));
   $data['name']=$row['Name'];
   $data['email']=$row['Email'];
   $data['mobile']=$row['MobileNumber'];
   $data['address']=$row['Address'];
  }
  return $data;
}
?>

<?php
function getHomePageData($sqll){
   global $db;
 $cartArr=getUserFullCart();
  
           $result1 = mysqli_query($db,$sqll);
           $queryResult1 = mysqli_num_rows($result1);
           $imgSrc=SITE_PIC_IMAGE;
       
           if($queryResult1>0)
           {
            $cuybt=1;
            while($row=mysqli_fetch_assoc($result1))
            {
              $cuybt+=1;
                  $imgName1 = $row['pic_name'];
                  $pictureId=$row['id'];
                  echo  "<div class='gallery-container'>
                  <div class='image'>
                <a data-lightbox='image".$cuybt."' href='".$imgSrc.$imgName1."' ><img src='".$imgSrc.$imgName1."' style='width:100%;' alt=''></a>
                  </div>
                  <div class='text'>";
                  $pic_detail= "select * From picture_size_detail where pic_id= '$pictureId'"; 
                  $size_result = mysqli_query($db,$pic_detail);
                  $query_result = mysqli_num_rows($size_result);
                      if($query_result>0)
                      {
                        while($row_result=mysqli_fetch_assoc($size_result))
                        {
                         //$pictureID=$row_result['id'];
                         echo "<input type='radio' class='pic_radio' name='radio_".$row['id']."' id='radio_".$row['id']."' value='".$row['id']."'/>";
                         echo $row_result['attribute']; 
                         echo "  ";
                         echo "<span class-'price'>$".$row_result['price']."/-</span>";
                         $added_mag="";
                         //$cartArr=getUserCart();//i added
                           if(array_key_exists($row_result['pic_id'],$cartArr)){
                            $added_qty=getUserFullCart($row_result['pic_id']) ;
                            $added_mag="(Added - $added_qty)";
                            }
                             echo "<span  id='shop_added_msg_".$row_result['pic_id']."'>".$added_mag."</span>";
                        }
                      }                     
                      ?>
              <!--hide the select bcz i dont need qty more than 1 -->
              <select hidden id="qty<?php echo $row['id'];?>">
              <option value="1"></option>
              <?php
              for($i=1;$i<=5;$i++)
              echo "<option>$i</option>";
              // $add='add';
              ?>
              </select>
               <i class="fas fa-cart-plus" onclick="add_to_cart('<?php echo $row['id'];?>','add');"></i>
               </div></div>
               <?php
               
            }
        }else {
          echo"No data Found";
        }
}
?>


<script>
function add_to_cart(id, typee) {
  var qty = jQuery("#qty" + id).val();
  var attr = jQuery("#radio_" + id).val();
  //var typee = jQuery(typee).val();
  //undefined = "add";
  //alert(typee);
  var is_attr_checked = "";
  if (typeof attr === "undefined") {
    is_attr_checked = "no";
  }
  if (qty > 0 && is_attr_checked != "no") {
    jQuery.ajax({
      url: "manage-cart.php",
      type: "post",
      data: {
        qty: qty,
        attr: attr,
        typee: typee,
      },
      success: function (result) {
      
       var data = jQuery.parseJSON(JSON.stringify(result));
       //var Display = json[0].Display;
        alert("Product added");
        jQuery("#shop_added_msg_" + attr).html("(Added-" + qty + ")");
        jQuery("#totalCartPic").html(data.totalCartPic+"No Pic ");
        jQuery("#totalPrice").html(data.totalPrice +"No Price");
        // alert(data.totalCartPic);

        //this is not working
         location.reload();
        ///i added
     
      },
    });
  } else {
    alert("Please select qty");
  }
}
</script>

<script>
  function delete_cart(id) {
   jQuery.ajax({
      url:"manage-cart.php",
      type: "post",
      data:'attr='+id+'&typee=delete',
      success: function (result) {
        alert(id);
        location.reload();
      },
});
}
  </script>

