<body>
<?php
include("top.php");

if(isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['id']) && $_GET['id']>0){

  $type = $_GET['type'];
  $id =$_GET['id'];
  if($type =='delete'){
      $sql1 = "delete from category where id ='$id'";
      $result1 = mysqli_query($db,$sql1);
      redirect('category.php');
  }
if($type=='active' || $type=='deactive'){
$status = 1;
if($type=='deactive'){
    $status =0;
}
mysqli_query($db,"update category set status='$status' where id ='$id'");
redirect('category.php');

}
}

$sql = "Select * from category order by id";
$result =mysqli_query($db,$sql);
?>
<div class="admin_table_wrapper">
<div><a href="manage_category.php"><button>Add Category</button></a></div>
<table>
    <thead>
    <tr>
        <th>S No. </th>
        <th>Category</th>
        <th>Order No.</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        <?php if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){ 
               $i=1; ?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['category'] ?></td>
        <td><?php echo $row['order_no'] ?></td>
        <td><?php echo $row['status'] ?></td>
        <td><a href="manage_category.php?id=<?php echo $row['id'] ?>">Edit</a>&nbsp;
        <?php
        if($row['status']==1){
        ?>
        <a href="?id=<?php echo $row['id']?>&type=deactive">Deactive</a>&nbsp;
        <?php
        }else{
            ?>
           <a href="?id=<?php echo $row['id']?>&type=active">Active</a>&nbsp;
            <?php
        }
        
        
        ?>
            
            <a href="?id=<?php echo $row['id']?>&type=delete">Delete</a>&nbsp;

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
<?php
include("footer.php");
?>
</body>