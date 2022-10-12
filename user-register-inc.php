<?php
session_start();
include('conn.php');

if(isset($_POST['Sign-Up']))
{  
$name= $_POST['Name'];
$email=$_POST['Email'];
$username=$_POST['UserName'];
$password=$_POST['PassWord'];
$confirmPass=$_POST['ConfirmPassWord'];

   if(empty($name) || empty($email) || empty($username) || empty($password) || empty($confirmPass))
   {
   header("location: user-register.php?error=emptyInput");
   exit();
   }
   elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9)*$/", $username))
   {
   header("location: register.php?error=invalidEmailAnduserName");
   exit();
   }
   elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username))
   {
   header("location: user-register.php?error=invalidUserName");
   exit();
   }
   elseif($password != $confirmPass)
   {
   header("location: user-register.php?error=passwordDoestMatch");
   exit();
   }
   else
   {
   $sql ="SELECT UserName FROM user WHERE UserName=?";
   $stmt = mysqli_stmt_init($db);
     if(!mysqli_stmt_prepare($stmt,$sql))
     {
      header("Location: user-register.php?error=sqlerror");
      exit();
      }
      else
      {
       mysqli_stmt_bind_param($stmt,"s",$username);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_store_result($stmt);
       $resultcheck= mysqli_stmt_num_rows($stmt);
        if($resultcheck>0)
          {
           header("Location: user-register.php?error=userTaken");
           exit();
          }
          else 
          {
          $sql="INSERT INTO user(Name,Email,UserName,PassWord) VALUES(?,?,?,?)";
          $stmt= mysqli_stmt_init($db);
            if(!mysqli_stmt_prepare($stmt,$sql))
            {
            header("Location: user-register.php?error=sqlerror");
            exit();
            }
           else{
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$username,$hashpassword);
            mysqli_stmt_execute($stmt);
            header("Location: user-register.php?error=success");
            exit();
           }
          }
      }
   }
mysqli_stmt_close($stmt);
mysqli_close();
}
?>