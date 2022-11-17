<?php
include("top.php");
?>
<body>
<div style="margin-left:25%;padding:63px 16px;height:1000px;">
<div class="form-wraper">  
<form action="img-upload-inc.php" method="POST"  enctype = "multipart/form-data">
       <h2>Upload Picture</h2>
            <div>
              <lable> Picture Description:</lable><br>
               <input type="text" name="pic-description">
             </div>
             <div>
              <lable> Picture Tags:</lable><br>
               <input type="text" name="pic-tags">
            </div> 
            <div>
               <input type="file" name ="file">
</div>
               
    <div><input  class="primary-btn" type ="submit" value="upload" name ="upload"></button> </div>
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