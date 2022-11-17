<?php
include("top.php");
$msg="";
$category ="";
$order_number="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){

$id=get_safe_value($_GET['id']);
$row=mysqli_fetch_assoc(mysqli_query($db,"select * from category where id='$id'"));
//pr($row);
$category =$row['category'];
$order_number=$row['order_no'];

}

if(isset($_POST['add'])){

 $category=get_safe_value($_POST['category']);
 $order_number=get_safe_value($_POST['order-no']);
 $added_on=date('y-m-d h:i:s');

 if($id==''){
 $sql="select * from category where category='$category'";
 }else{
      $sql="select * from category where category='$category' and id='$id'";
 }

if(mysqli_num_rows(mysqli_query($db,$sql))>0)
{
    $msg="Category already added";
}
else{
 if($id==''){
 mysqli_query($db,"insert into category(category,order_no,status,added_on) values('$category','$order_number','1','added_on')");
 }
 else{
     mysqli_query($db,"update category set category='$category',order_no='$order_number' where id ='$id'");
 }
redirect('category.php');
}
}
?>
<body>
<div class="admin-main-div">
<div class="form-wraper">  
<form action="" method="POST">
       <h2>Add Category</h2>
            <div>
              <lable> Category:</lable><br>
               <input type="text" name="category" value="<?php echo $category ?>" >
               <?php  echo $msg;?>
             </div>
             <div>
              <lable> Order Number:</lable><br>
               <input type="text" name="order-no" value="<?php echo $order_number ?>">
            </div>               
    <div><input  class="primary-btn" type ="submit" value="Add" name ="add"></button> </div>
</form>
</div>
<?php
if(isset($_GET['error']))
{
    if($_GET['error']=="uploadfailed")
    {
	echo'<p class ="error-msg">*Please try again.</p>';
    }
   elseif($_GET['error']=="Success")
    {
	echo'<p class ="error-msg">*Upload Successfull</p>';
    exit();  
    }
}
?>
</div>
<?php
include("footer.php");
?>
</body>