<?php
include('conn.php');
if(isset($_POST['upload']))
{
    $file =$_FILES['file'];
    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt= explode('.', $filename);
    $fileActualExt  = strtolower(end($fileExt));
    $allowed= array('jpg','jpeg','png','pdf');

    $tags = $_POST['pic-tags'];
     $description = $_POST['pic-description'];
     $price = $_POST['pic-price'];

     if (in_array($fileActualExt, $allowed)){
        if($fileError == 0){
            if($fileSize < 1000000){
             $fileNameNew  = uniqid('', true).".".$fileActualExt;
             $fileDestination = 'pics/'.$fileNameNew;
             move_uploaded_file($fileTmpName, $fileDestination);    
             header("Location: ./img-upload.php?error=Success");
             $sql ="Insert into pictures(pic_name,pic_price,pic_description,pic_tags) values('$fileNameNew','price','$description','$tags')";
             $result= mysqli_query($db,$sql);
                if($result)
                 {
                 echo "database worked";
                 } 
                 else{
                 echo "error occured";
                 }
                 exit();
                }
             else{
             header("Location: ./img-upload.php?error=uploadfailed");
             }
        }
        else{
        header("Location: ./img-upload.php?error=uploadfailed");    
        }
    }
  else{
     header("Location: ./img-upload.php?error=uploadfailed");
    }
/*echo "<h1>Diagnostic Info: </h1>";
echo "<br>Temp File Name: ".$fileTmpName."<br>";
echo "savefile variable valuable:".$saveFile;*/
}
?>
<!--<h1><a href="gallery.php">back to gallery</a>-->
</body>
</html>

