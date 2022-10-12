<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
include("top.php");
//include("constant.inc.php");

$msg="";
$category_id ="";
$pic_name="";
$image="";
$pic_price="";
$pic_description="";
$pic_tags="";
$id="";
$image_status='required';
$image_condition="";
$image_error="";
if(isset($_GET['id']) && $_GET['id']>0){

$id=get_safe_value($_GET['id']);
$row=mysqli_fetch_assoc(mysqli_query($db,"select * from pictures where id='$id'"));
//pr($row);
$category_id =$row['category_id'];
$pic_name=$row['pic_name'];
$image=$row['image'];
$pic_price=$row['pic_price'];
$pic_description=$row['pic_description'];
$pic_tags=$row['pic_tags'];
$image_status='';
}

if(isset($_GET['pic_detail_id']) && $_GET['pic_detail_id']>0){
  $pic_detail_id=get_safe_value($_GET['pic_detail_id']);
  $id=get_safe_value($_GET['id']);
  mysqli_query($db,"delete from picture_size_detail where id='$pic_detail_id'");
  redirect('manage-picture.php?id='.$id);
}


if(isset($_POST['add'])){
  
 //prx($_POST);
 $category_id=get_safe_value($_POST['category_id']);
 $pic_name=get_safe_value($_POST['pic_name']);
 //$image="";
 $pic_price=get_safe_value($_POST['pic_price']);
 $pic_description=get_safe_value($_POST['pic_description']);
 $pic_tags=get_safe_value($_POST['pic_tags']);
 //$status='1';
 $uploaded_on=date('y-m-d h:i:s');
 //$image=$_FILES['image']['name'];

  if($id=='')
  {
      $sql="select * from pictures where pic_name='$pic_name'";
  }
  else
  {
      $sql="select * from pictures where pic_name='$pic_name' and id!='$id'";
  }

  if(mysqli_num_rows(mysqli_query($db,$sql))>0)
  {
    $msg="Picture already added";
  }
  else{
    $type=$_FILES['image']['type'];
    if($id==''){
       if($type!='image/jpeg' && $type!='image/png')
       {
         $image_error="invalid image format";
       }else{

        $image=$_FILES['image']['name'];
        $img_temp=$_FILES['image']['tmp_name']; 
        $random_number = rand(111111111,999999999);
        $user_image = ($random_number).'_'.($image) ;
        move_uploaded_file($img_temp,SERVER_PIC_IMAGE.$user_image);
        mysqli_query($db,"insert into pictures(category_id,pic_name,image,pic_price,pic_description,pic_tags,status,uploaded_on) 
        values('$category_id','$user_image','$user_image','$pic_price','$pic_description','$pic_tags','1','$uploaded_on')");
       
       $pid=mysqli_insert_id($db);
       $attributeArr=$_POST['attribute'];
       $priceArr=$_POST['price'];
       foreach($attributeArr as $key=>$val){
       $attribute=$val;
       $price=$priceArr[$key];
       mysqli_query($db,"insert into picture_size_detail(id,pic_id,attribute,price,added_on) values('','$pid','$attribute','$price','$uploaded_on')");
  }
     redirect('picture.php'); 
      }
    }
    else{
     $image_condition='';
      if($_FILES['image']['name']!=''){
          if($type!='image/jpeg' && $type!='image/png')
        {
         $image_error="invalid image format";
        }else{
            $image=$_FILES['image']['name'];
            $random_number = rand(111111111,999999999);
            $user_image = ($random_number).'_'.($image) ;
            move_uploaded_file($_FILES['image']['tmp_name'],SERVER_PIC_IMAGE.$user_image);
            $image_condition=", image='$image'";
      //to delete previous image from folder
            $oldImageRow=mysqli_fetch_assoc(mysqli_query($db,"Select image from pictures where id='$id'"));
            $oldImg=$oldImageRow['image'];
            unlink(SERVER_PIC_IMAGE.$oldImg);
          }
      }
      if($image_error==''){
      $sql1 ="update pictures set category_id='$category_id',pic_name='$user_image', pic_price='$pic_price', pic_description='$pic_description',pic_tags='$pic_tags'  $image_condition where id ='$id'";
      mysqli_query($db,$sql1);



       $attributeArr=$_POST['attribute'];
       $priceArr=$_POST['price'];
       $dishDetailIdArr=$_POST['pic_detail_id'];

       foreach($attributeArr as $key=>$val){
       $attribute=$val;
       $price=$priceArr[$key];

          if(isset($dishDetailIdArr[$key])){
            $did=$dishDetailIdArr[$key];
          mysqli_query($db,"update picture_size_detail set attribute='$attribute',price='$price' where id='$did'");
          }
          else{
          mysqli_query($db,"insert into picture_size_detail(id,pic_id,attribute,price,added_on) values('','$id','$attribute','$price','$uploaded_on')");
          }


       
  }








      redirect('picture.php');
      }
    }
  }
}

$res_category=mysqli_query($db,"select * from category where status='1' order by category asc");

?>
<div style="margin-left:25%;padding:63px 16px;height:1000px;">
<div class="form-wraper">  
<form action="" method="POST" enctype="multipart/form-data"> 
       <h2>Add Picture</h2>
            <div>
              <lable> Category:</lable><br>
              <select name="category_id" required>
                  <option value="">Select Category</option>
              <?php
            while($row_category=mysqli_fetch_assoc($res_category)){
                if($row_category['id']==$category_id){
                echo "<option value='".$row_category['id']."' selected>".$row_category['category']."</option>";
                }
                else{
                     echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";
                }
            }
          ?>
          
              </select>
             </div>

             <div>
              <!--<lable> Pic name:</lable><br>-->
               <input type="hidden" name="pic_name" value="<?php echo $pic_name ?>" required>
               <?php  echo $msg;?>
             </div>

             <div>
              <lable> Pic Price:</lable><br>
               <input type="text" name="pic_price" value="<?php echo $pic_price ?>" required>
              
             </div>

             <div>
              <lable> Description:</lable><br>
               <textarea name="pic_description" required> <?php echo $pic_description ?> </textarea>
              
             </div>
             <div>
              <lable> Pic Tags:</lable><br>
               <input type="text" name="pic_tags" value="<?php echo $pic_tags ?>" required >
            </div> 
            
            <div>
              <lable> Image:</lable><br>
               <input type="file" name="image" placeholder="Image" <?php echo $image_status ?>required>
              <div class=""><?php echo $image_error ?></div>
            </div> 
            <div class="attr-wrapper" id="pic_box1" style="width:100%;float:left;">
             <lable> Pic Details:</lable><br>
            
            
              <?php if($id==''){?>
               <div class="attr_text">
              <input type="text" name="attribute[]" placeholder="Attribute" required >
              </div> 
             <div class="attr_text" >
              
               <input type="text" name="price[]" placeholder="Price" required >
               <br>
            
              </div>
             <?php } else{
               $pic_detail_res=mysqli_query($db,"select * from picture_size_detail where pic_id='$id'");
               $ii=1;
               while($pic_detail_row=mysqli_fetch_assoc($pic_detail_res)){
               
               ?>
             <div class="attr_text">
             <input type="hidden" name="pic_detail_id[]" value="<?php echo $pic_detail_row['id']?>">
              <input type="text" name="attribute[]" placeholder="Attribute" value="<?php echo $pic_detail_row['attribute']?>" required >
              </div> 
             <div class="attr_text">
              
               <input type="text" name="price[]" placeholder="Price" required value="<?php echo $pic_detail_row['price']?>">
               <br>
             
              </div>
              <?php if($ii!=1){?>
             <div class="attr_text" ><button  class="primary-btn" type ="button" onclick="remove_more_new('<?php echo $pic_detail_row['id']?>')"> Remove</button></div>
           <?php 
              }
            $ii++;
            } }?>
             </div>
           

               
    <div style="width:100%;float:left;"><button  class="primary-btn" type ="submit" value="Add" name ="add">Submit</button>
    <button  class="primary-btn" type ="button" onclick="add_more();">Add More</button>
  
  </div>
               </form>
</div>
<input type="hidden" id="add_more" value="1"/>
</div>

  <script>
    function add_more(){
      var add_more=jQuery('#add_more').val();
      add_more++;
      jQuery('#add_more').val(add_more);

      var html='<div id="box'+add_more+'"><div class="attr_text"> <input type="text" name="attribute[]" placeholder="Attribute" required >   </div> <div class="attr_text" ><input type="text" name="price[]" placeholder="Price" required ></div><div class="attr_text_remove" ><button  class="btn-small" type ="button" onclick=remove_more("'+add_more+'") <br>Remove</button></div></div>';
      jQuery('#pic_box1').append(html);
    }

    function remove_more(id){
      jQuery('#box'+id).remove();
    }

    function remove_more_new(id){
    var result=confirm('Are you sure');
    if(result==true){
      var cur_path=window.location.href;
      window.location.href=cur_path+"&pic_detail_id="+id;
    }
    }
  </script>
<?php
include("footer.php");
?>
</body>