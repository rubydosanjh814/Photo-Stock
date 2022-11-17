<?php
include('conn.php');
include('functions.inc.php');
if(isset($_POST["btn-chkout-login"]))
{
    $UserName = $_POST['UserName'];
    $PassWord = $_POST['PassWord'];
  
    if(empty($UserName) || empty($PassWord))
    {
    header("location: checkout.php?error=emptyInput");
   // $msg ="Please fill all fields.";
   // redirect('login.php');
    
    exit();
    }
    else
    {
     $sql="SELECT * FROM user WHERE UserName=?;";
     $stmt= mysqli_stmt_init($db);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
         header("location: checkout.php?error=sqlError");
         exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$UserName);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
              if($row = mysqli_fetch_assoc($result))
              {      
              $PasswordChk = password_verify($PassWord,$row['PassWord']);
                 if($PasswordChk == false){
                     header("location: checkout.php?error=wrongPassword");
                     exit();
                    }
                    elseif($PasswordChk == true)
                    {
                     session_start();
                     $_SESSION['CustomerId'] = $row['id'];
                     $_SESSION['userUsername'] =$row['UserName'];  
                     
                     if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
                         foreach($_SESSION['cart'] as $key=>$val){
                         manageUserCart($_SESSION['CustomerId'],$val['qty'],$key);
                         }
                     }
                      
                     header("location: checkout.php?error=loginSuccess");
                     exit();
                    }
                    else
                    {
                    header("location: checkout.php?error=noUser");
                    exit();
                    }
              }
        }
    }

}
else{
    header("location: checkout.php");
    exit();
}
?>