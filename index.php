<?php
include("header.php");
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <body>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="custom.js"></script> 
      <script src="lightbox-plus-jquery.js"></script>  
    <link href="lightbox.css" rel="stylesheet" />
      <script src="lightbox.js"></script>
 <link href="style.css" rel="stylesheet">
  </head>
    <div class="main">
        <div class="intro">
             <div class="searh-wrapper"> 
                 <div class="home-title">                 
                     <h1>Move the World!</h1>
                 </div>  
                <div class="form-cover">
                    <form action="" method="post">
                        <div class="select-cat">
                         <select class="noSelect" name="catergory">
                            <option value="">Select Filter</option>
                         <?php
                         $sqlcategory="select * from category";
                         $rescategory=mysqli_query($db,$sqlcategory);
                         //$rescategory=mysqli_num_rows($rescategory);
                         while($rowcat=mysqli_fetch_assoc($rescategory)){
                         ?>      
                            <option  value="<?php echo $rowcat['category'] ?>"><?php echo $rowcat['category'] ?> </option>
                        <?php
                         }
                         ?>
                        </select>
                        </div>
                         <div class="search-wrapper-inner">
                         <input type="text" name="searchTag" placeholder="| Search best pictures for your project needs">
                        </div>                
                         <div class="btn-wrapper-inner">
                         <button  class="btn" name="submit" type="submit"><i class="fas fa-search"></i></button>
                         </div>
                    </form>  
                </div>
             </div>
             <div class="nav-bar" style="margin-top:135px;"> 
                 <div class="nav-inner">
                    <form method="post"><a><input type="submit" name="Creative" class="nav-button"  value = "Creative"/></a>
                    <a><input type="submit" name="Editorial" class="nav-button"  value = "Editorial"/></a>
                    <a><input type="submit" name="Music" class="nav-button"  value = "Music"/></a>
                    <a><input type="submit" name="Vedios" class="nav-button"  value = "Vedios"/></a>
                    <a><input type="submit" name="Blog" class="nav-button"  value = "Blog"/></a>
                    <a><input type="submit" name="Collections" class="nav-button"  value = "Collections"/></a>
                     <!--<a href="#">Editorial</a>
                     <a href="#">Videos</a>
                     <a href="#">Music</a>
                     <a href="#">Blog</a>
                     <a href="#">Collections</a>--></form>
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
  getHomePageData($sql);
}
elseif($catergory=="Editorial"){
    $imgSrc=SITE_PIC_IMAGE;
    $sql = "select * from pictures where (category_id='4') AND (pic_tags LIKE '%$searchTag%')";
    getHomePageData($sql);
}
elseif($catergory=="Music")
{
$imgSrc=SITE_PIC_IMAGE;
  $sql = "select * from pictures where (category_id='9') AND (pic_tags LIKE '%$searchTag%')";
  getHomePageData($sql);
}
elseif($catergory=="Vedios"){
  $imgSrc=SITE_PIC_IMAGE;
  $sql = "select * from pictures where (category_id='10') AND (pic_tags LIKE '%$searchTag%')";
  getHomePageData($sql);
}
else{
    echo "No data found";
}
}
elseif(isset($_POST["Creative"]))
{
   $sql23 = "select * from pictures where (category_id='1')";
    getHomePageData($sql23);
}
elseif(isset($_POST["Editorial"]))
{
   $sql23 = "select * from pictures where (category_id='4')";
    getHomePageData($sql23);
}
elseif(isset($_POST["Music"]))
{
   $sql23 = "select * from pictures where (category_id='9')";
    getHomePageData($sql23);
    
}
elseif(isset($_POST["Vedios"]))
{
   $sql23 = "select * from pictures where (category_id='10')";
    getHomePageData($sql23);
}
elseif(isset($_POST["Blog"]))
{
    echo "Blog coming soon :)";
}
elseif(isset($_POST["Collections"]))
{
    echo "No collections yet.";
}
 else{
    $sqll = "select * From pictures";
    getHomePageData($sqll);
 }
    ?>   
</div>
<?php
include("footer.php");
?>
  </body>
  </html>