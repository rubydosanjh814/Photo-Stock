<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width, initial-scale=1.0">
    <title>Photo 
        Stock</title>
</head>
<body>
    <div class="main">
        <div class="intro">
            <div class="wrapper"> 
                <div style=""> <h1>Photo Stock</h1><br>
            </div>
<div class="form-wraper">  
    <h4>Admin Login</h4>
            <form class="" action="login-inc.php" method="post">
            <div>
            <lable>Username</lable>
             <input type="text" Placeholder="Username" name="UserName"></input><br>
             </div>
             <div>
             <lable>Password</lable>
             <input type="passward" Placeholder="Password" name="PassWord"></input><br>
            </div>
             <input class="primary-btn" type="submit" value="Login" name="login-btn"></input>
            </form>
            
</div>
        </div>
        </div>
    </div>
</body>
</html>
<?php
//include('top.php');
if(isset($_GET['error']))
{
   if($_GET['error']=="emptyInput"){
	   echo'<p class ="error-msg">*Please fill all fields.</p>';
   }
   elseif($_GET['error']=="wrongPassword"){
	echo'<p class ="error-msg">*Please enter a valid password.</p>';
   }
   elseif($_GET['error']=="noUser"){
	echo'<p class ="error-msg">*User not found.</p>';
   }
   elseif($_GET['error']=="sqlError"){
	echo'<p class ="error-msg">*Something went wrong..</p>';
   }
}
?>