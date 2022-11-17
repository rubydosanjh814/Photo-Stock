<?php
include("top.php");
?>
<body>
<div style="margin-left:25%;padding:1px 16px;height:1000px;">
   <form action="img-upload-inc.php" method="post" enctype="mutipart/form-data">
    Image you want to upload:
    <br>
    <input type="file" name="FileToUpload" id="FileToUpload">
    <br>
    Picture Description:<input type="text" name="pic-description"><br>
    Picture Tags:<input type="text" name="pic-tags"><br>
    Price:<input type="text" name="pic-price">
    <input type="submit">
    </form>
</div>
<?php
include("footer.php");
?>
</body>