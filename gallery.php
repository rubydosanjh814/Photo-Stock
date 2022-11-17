<?php
include('conn.php');
$sql="select Pic_Id,pic_name,pic_price FROM pictures";
$result = mysqli_query($db,$sql);
$queryResult = mysqli_num_rows($result);
$dir ="pics/";
if($queryResult>0){
     while($row=mysqli_fetch_assoc($result)){
     $imgId= $row['Pic_Id'];
     $imgName= $row['pic_name'];
     $imgPrice =$row['pic_price'];
     echo "  id-". $imgId."--"."--".$imgName."<br><img src='".$dir.$imgName."'><br>";
     echo "price--".$imgPrice;
     }
 }
 else {
     echo"error occured";
 }

?>