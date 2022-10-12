<?php
if(isset($_POST["login-btn"]))
{
    include('conn.php');
    include('functions.inc.php');
    $UserName = $_POST['UserName'];
    $PassWord = $_POST['PassWord'];
  
    if(empty($UserName) || empty($PassWord))
    {
    header("location: login.php?error=emptyInput");
   // $msg ="Please fill all fields.";
   // redirect('login.php');
    
    exit();
    }
    else
    {
     $sql="SELECT * FROM user_data WHERE UserName=?;";
     $stmt= mysqli_stmt_init($db);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
         header("location: login.php?error=sqlError");
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
                     header("location: login.php?error=wrongPassword");
                     exit();
                    }
                    elseif($PasswordChk == true)
                    {
                     session_start();
                     $_SESSION['userid'] = $row['id'];
                     $_SESSION['userUsername'] =$row['UserName'];                   
                     header("location: dashboard.php?error=loginSuccess");
                     exit();
                    }
                    else
                    {
                    header("location: login.php?error=noUser");
                    exit();
                    }
              }
        }
    }

}
else{
    header("location: index.php");
    exit();
}
?>