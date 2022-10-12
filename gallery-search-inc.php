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
             <div class="wrapper"> 
                <form action="gallery-search-inc.php" method="post">
                    Search Tags <input type="text" name="searchTag">
                    <input type="submit">
                </form>  
             </div>
        </div>    
        <?php
        error_reporting(0);
         include("conn.php");
           $SearchTags = mysqli_real_escape_string($db,$_POST['searchTag']);
           $sql="select Pic_Id,pic_name,pic_description,pic_tags FROM pictures Where pic_tags Like'%$SearchTags%'";
           $result = mysqli_query($db,$sql);
           $queryResult = mysqli_num_rows($result);
          
           if($queryResult>0)
           {
            while($row=mysqli_fetch_assoc($result))
            {
                $imgId = $row['Pic_Id'];
                $imgName = $row['pic_name'];
                $imgDescription =$row['pic_description'];
                $imgTags =$row['pic_tags'];
                $imgSrc="pics/";
                echo "<div class='pictureBox'><br>Pic #".$imgId."<br>Pic Name: ".$imgName."<br>Pic Description: ".$imgDescription.
                "<br>Pic Tags: ".$imgTags."<br><img src='".$imgSrc.$imgName."'><br></div>";
            }
           }
           else
           {
               echo "No results";
           }
    
        ?>

</body>
</html>