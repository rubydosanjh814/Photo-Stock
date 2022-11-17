<?php
include("top.php");
//include("constant.inc.php");
//(SERVER_PIC_IMAGE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title>
        
    </title>-->
</head>
<body>
<?php
if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['id']) && $_GET['id']>0){

  $type = $_GET['type'];
  $id =$_GET['id'];
  if($type =='delete'){
      $sql1 = "delete from pictures where id ='$id'";
      $result1 = mysqli_query($db,$sql1);
      redirect('picture.php');
  }
if($type=='active' || $type=='deactive'){
$status = 1;
if($type=='deactive'){
    $status =0;
}
mysqli_query($db,"update pictures set status='$status' where id ='$id'");
redirect('picture.php');

}
}

$sql = "Select pictures.*,category.category from pictures,category 
where pictures.category_id=category.id order by pictures.id desc";
$result =mysqli_query($db,$sql);
?>
<div class="admin_table_wrapper">
<div><a href="manage-picture.php"><button class="fancy-btn">Add Pictures</button></a></div>
<div class="table-wrapper">
<table>
    <thead>
    <tr>
        <th>S No. </th>
        <th>Category</th>
        <th>Picture Name</th>
        <th>Image</th>
        <th>Added On</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        <?php if(mysqli_num_rows($result)>0){
            $i=1;
            while($row=mysqli_fetch_assoc($result)){ 
               
                ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['category'] ?></td>
        <td><?php echo $row['pic_name'] ?></td>
        <td><a target="_blank" href="<?php  echo SITE_PIC_IMAGE.$row['pic_name'] ?>"><img class="pic-icon" src="<?php echo SITE_PIC_IMAGE.$row['pic_name'] ?>"/></td>
        <td>
            <?php 
            $dateStr=strtotime($row['uploaded_on']);
            echo date('d-m-y',$dateStr);
            ?>
        </td>
        <td><a class="edit" href="manage-picture.php?id=<?php echo $row['id'] ?>">Edit</a>&nbsp;
        <?php
        if($row['status']==1){
        ?>
        <a class="activate" href="?id=<?php echo $row['id']?>&type=deactive">Deactive</a>&nbsp;
        <?php
        }else{
            ?>
           <a class="deactivate" href="?id=<?php echo $row['id']?>&type=active">Active</a>&nbsp;
            <?php
        }
        
        
        ?>
            
            <a class="delete" href="?id=<?php echo $row['id']?>&type=delete">Delete</a>&nbsp;

        </td>
    </tr>
    <?php
    $i++;
       } } else{  ?>
        <tr>
        <td colspan="5">no data found</td>
        </tr>
    <?php } ?>
</tbody>
</table>
       </div>
</div>

</div>
<?php
include("footer.php");
?>
</body>