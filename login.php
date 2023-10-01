<?php
include 'Connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <style>.container{
   width: 100%;
   /* max-width: 1200px; */
   height: 100vh;
   margin: 0 auto;
   display: flex;
   justify-content: center;
   align-items: center;
   background-color: #2980b9;
}</style>
   
   <!-- <link rel="stylesheet" href="CSS/Admin.css"> -->
   <link rel="stylesheet" href="CSS/Log_re.css">
</head>
<body>
   <div class="container">
      <form action="" method="POST">
         <h1>Login</h1>
         <input type="text" name="name" placeholder="Your name/email">
         <input type="text" name="password" placeholder="Password">
         <input type="submit" name="user_login" value="Login" href="admin.php">
         <div class="switch">
            <p>I want to <a href="register.php"> Register.</a></p>
         </div>
      </form>
   </div>
</body>
</html>