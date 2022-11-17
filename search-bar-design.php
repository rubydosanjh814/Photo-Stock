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
   
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src='custom.js'></script>
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
    <script>
       
    </script>
</head>
<body class="body-search" id="">
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
</body>
</html>