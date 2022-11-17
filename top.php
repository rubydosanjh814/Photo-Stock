<?php
session_start();
include("conn.php");
include("functions.inc.php");
include("constant.inc.php");

$curStr=$_SERVER['REQUEST_URI'];
$curArr=explode('/',$curStr);
$cur_path=$curArr[count($curArr)-1];


 if(!isset($_SESSION['userUsername'])){
         header("location: user-login.php");
         }
        





         $page_title='';
         if($cur_path=='dashboard.php' || $cur_path=='index.php'){
                 $page_title='Dashboard';
         }
         elseif($cur_path=='picture.php' ||$cur_path=='manage-picture.php')
         {
           $page_title='Manage Category';
         }
         elseif($cur_path=='category.php' ||$cur_path=='manage_category.php')
         {
           $page_title='Manage Category';
         }
 ?>
 <head>
          <!DOCTYPE html>
          <html>
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
  <link href="style.css" rel="stylesheet">
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>-->
 
 <title><?php echo $page_title.'_'.SITE_NAME?></title>

<div class="top-bar"> 
        <div class="top-inner"><div class="logo"><h1>Photo Stock</h1> </div>
        <div class="admin-logout-btn">
<a href="logout.php"><button class="fancy-btn">logout</button></a></div></div></div>
<?php
include("nav.php");
?>
</head>
</html>


