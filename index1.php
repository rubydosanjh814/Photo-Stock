<?php
  include("conn.php");
    include("functions.inc.php");
    include("constant.inc.php");
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <script type="text/javascript" src="custom.js"></script>
 <link href="style.css" rel="stylesheet">
  </head>
  <body>
      <div class="top-bar"> 
           <div class="top-inner">
                <div class="logo"><h1>Photo Stock</h1></div>
                     <div class="top-inner-left"><a href="login_user.php">Login Or Register</a><a href="login_user.php">Cart</a></div>
            </div>
        </div>

    <div class="main">
        <div class="intro">
             <div class="searh-wrapper"> 
                   
                
                    
                         <div class="container-search">
                                   <h1 class="title">What are you searchonh for</h1>
                            <div class="form-group">
                         <div class="dropdown">
                <div class="default-option">Category</div>
                <div class="dropdown-list">
                <ul>
                    <li><i 	class="fas fa-camera"></i>&nbsp;image</li>
                    <li><i 	class="fas fa-align-center"></i>&nbsp;Vector</li>
                    <li><i class="fas fa-music"></i>&nbsp;Music</li>
                    <li><i 	class="fas fa-camera-retro"></i>&nbsp;Vedio</li>
                </ul>
                </div>
            </div>
                        <div class="search">
                <input type="text" class="search-input" placeholder="Search for best photos">
            </div>

            <button class="btn" type="submit"><i class="fas fa-search"></i></button>

        </div>

    </div>

             <div class="nav-bar" style="margin-top:20px;"> 
                 <div class="nav-inner">
                     <a href="#">Creative</a>
                     <a href="#">Editorial</a>
                     <a href="#">Videos</a>
                     <a href="#">Music</a>
                     <a href="#">Blog</a>
                     <a href="#">Collections</a>

                     
                 </div>
             </div>

    </div>
</div>

      <div class="container">
        <?php
      
 
 if(isset($_POST['submit'])){

$searchTag=mysqli_real_escape_string($db,$_POST['searchTag']);
$catergory=mysqli_real_escape_string($db,$_POST['catergory']);

if($catergory=="" ){
    echo "Please enter data";

}
elseif($catergory=="Creative"){
 $imgSrc=SITE_PIC_IMAGE;

  $sql = "select * from pictures where (category_id='1') AND (pic_tags LIKE '%$searchTag%')";
           $result = mysqli_query($db,$sql);
           
          
           if(mysqli_num_rows($result)==0)
           {
            echo "no data find";
               
            }
            else {
                while($row=mysqli_fetch_assoc($result)){
                     $imgName = $row['pic_name'];
                    echo  "<div class='gallery-container'>
                 <div class='image'>
                 <img src='".$imgSrc.$imgName."' style='width:100%;' alt=''>
                </div>
                <div class='text'>
                Add to cart
                </div></div>";

               }
            }
}
elseif($catergory=="Editorial"){
    $imgSrc=SITE_PIC_IMAGE;

  $sql = "select * from pictures where (category_id='4') AND (pic_tags LIKE '%$searchTag%')";
           $result = mysqli_query($db,$sql); 
           if(mysqli_num_rows($result)==0)
           {
            echo "no data find";              
           }
            else {
                while($row=mysqli_fetch_assoc($result)){
                     $imgName = $row['pic_name'];
                    echo  "<div class='gallery-container'>
                 <div class='image'>
                 <img src='".$imgSrc.$imgName."' style='width:100%;' alt=''>
                </div>
                <div class='text'>
                Add to cart
                </div></div>";

               }
            }
}
elseif($catergory=="Music")
{
$imgSrc=SITE_PIC_IMAGE;

  $sql = "select * from pictures where (category_id='9') AND (pic_tags LIKE '%$searchTag%')";
           $result = mysqli_query($db,$sql); 
           if(mysqli_num_rows($result)==0)
           {
            echo "no data find";              
           }
            else {
                while($row=mysqli_fetch_assoc($result)){
                     $imgName = $row['pic_name'];
                    echo  "<div class='gallery-container'>
                 <div class='image'>
                 <img src='".$imgSrc.$imgName."' style='width:100%;' alt=''>
                </div>
                <div class='text'>
                Add to cart
                </div></div>";

               }
            }
}
elseif($catergory=="Vedios"){
  $imgSrc=SITE_PIC_IMAGE;
  $sql = "select * from pictures where (category_id='10') AND (pic_tags LIKE '%$searchTag%')";
           $result = mysqli_query($db,$sql); 
           if(mysqli_num_rows($result)==0)
           {
            echo "no data find";              
           }
            else {
                while($row=mysqli_fetch_assoc($result)){
                     $imgName = $row['pic_name'];
                    echo  "<div class='gallery-container'>
                 <div class='image'>
                 <img src='".$imgSrc.$imgName."' style='width:100%;' alt=''>
                </div>
                <div class='text'>
                Add to cart
                </div></div>";

               }
            }
}
else{
    echo "No data found";
}
 }
 else{
      $sql = "select * From pictures";
           $result1 = mysqli_query($db,$sql);
           $queryResult1 = mysqli_num_rows($result1);
           $imgSrc=SITE_PIC_IMAGE;
           if($queryResult1>0)
           {
            
            while($row=mysqli_fetch_assoc($result1))
            {
                  $imgName1 = $row['pic_name'];
                    echo  "<div class='gallery-container'>
                 <div class='image'>
                 <img src='".$imgSrc.$imgName1."' style='width:100%;' alt=''>
                </div>
                <div class='text'>
                Add to cart
                </div></div>";
            }
        }
 }
        /*
         include("conn.php");
         include("functions.inc.php");
        include("constant.inc.php");
          
           $sql = "select * From pictures";
           $result = mysqli_query($db,$sql);
           $queryResult = mysqli_num_rows($result);
          
           if($queryResult>0)
           {
            
            while($row=mysqli_fetch_assoc($result))
            {
                $imgId = $row['id'];
                $imgName = $row['pic_name'];
                $imgPrice= $row['pic_price'];
                $imgDescription =$row['pic_description'];
                $imgTags =$row['pic_tags'];
                $imgSrc=SITE_PIC_IMAGE;
               // echo "<div class='pictureBox'><br>Pic #".$imgId."<br>Pic Name: ".$imgName."<br>Pic Description: ".$imgDescription.
               // "<br>Pic Tags: ".$imgTags."<br><img src='".$imgSrc.$imgName."'><br></div>";

            */
         


               // echo"<div class='product-price-wraper'>price".$imgPrice."</div>";
               
              /*  $pic_detail= "select * From picture_size_detail"; 
                $size_result = mysqli_query($db,$pic_detail);
                $query_result = mysqli_num_rows($size_result);
                      if($query_result>0)
                      {
                        while($row_result=mysqli_fetch_assoc($size_result))
                        {
                         echo "<input type='radio' class='pic_radio' name='radio_".$row['id']."' id='radio_".$row['id']."' value='".$row['id']."'/>";
                         echo $row_result['attribute']; 
                         echo "  ";
                         echo "<span class-'price'>".$row_result['price']."</span>";
                          }
                      }
                      
               ?>
               
                <select id="qty<?php echo $row['id'];?>">
                    <option value="0">Qty</option>
                    <?php
                    for($i=1;$i<=5;$i++)
                    echo "<option>$i</option>";
                    ?>
                </select>
                <button onclick="add_to_cart('<?php echo $row['id'];?>','Add')">Add to Cart</button>
                <?php
               
            }
           }

           else
           {
               echo "No results";
           } */
        ?>
   </div>
  </body>
  </html>
