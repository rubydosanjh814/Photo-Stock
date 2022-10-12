<?php session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="style.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <div class="main">
        <div class="intro">
           <div class="wrapper"> 
               <h1>Register</h1>
               <form action="user-register-inc.php" method="post">
               <lable>Name</lable>
               <input type="text" name="Name"></input><br>
               <lable>Email</lable>               
               <input type="email" name="Email"></input><br>
               <lable>Username</lable>
               <input type="text" name="UserName"></input><br>
               <lable>Password</lable>
               <input type="passward" name="PassWord"></input><br>
               <lable>Confirm Password</lable>
               <input type="password" name="ConfirmPassWord"></input><br>
               <input type="submit" name="Sign-Up"value="Sign Up"></input>
               </form>
           </div>
        </div>        
    </div>
</body>
</html>
<?php
if(isset($_GET['error']))
{
   if($_GET['error']=="emptyInput"){
	   echo'<p class ="error-msg">*Please fill all fields.</p>';
   }
   elseif($_GET['error']=="invalidEmailAnduserName"){
	echo'<p class ="error-msg">*Please enter valid username  eg. abc123</p>';
   }
   elseif($_GET['error']=="invalidUserName"){
	echo'<p class ="error-msg">*Please enter valid username</p>';
   }
   elseif($_GET['error']=="passwordDoestMatch"){
	echo'<p class ="error-msg">*Password does not match.</p>';
   }
   elseif($_GET['error']=="success"){
	echo'<p class ="error-msg">*Sign up sucessfull.</p>';
   }
   elseif($_GET['error']=="sqlerror"){
	echo'<p class ="error-msg">*Something went wrong..</p>';
   }
   elseif($_GET['error']=="userTaken"){
	echo'<p class ="error-msg">*Username already taken.</p>';
   }  
}
?>