<?php
include 'Connect.php';
if(isset($_POST['user_login']) == NULL){
   echo '<script>alert("Register your information !")</script>';
   }else{
      $name = $_POST['name'];
      $age = $_POST['age'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $insert_query = ("INSERT INTO `login`(name, age, email, password) VALUE ('$name', '$age', '$email', '$pass')") or die ('query failled !');
      if($connect -> query($insert_query) === true){
         header('location:admin.php');
      }else{
         echo '<script>alert("Register Succesfull !")</script>';
      }
   }
//$insert_query = mysqli_query($connect,"INSERT INTO `login`(name, age, email, paassword) VALUE '$name', '$email', '$age', '$pass'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <!-- <link rel="stylesheet" href="CSS/Admin.css"> -->
   <link rel="stylesheet" href="CSS/Log_re.css">
</head>
<body>
   <!-- message -->
   <?php 
      // $message = "Register succesfull.";
      // echo "<script>alert('$message');</script>";
   ?>
   <div class="container">
      <form action="" method="POST">
         <h1>Register</h1>
         <input type="text" name="name" placeholder="Your name">
         <input type="number" name="age" placeholder="Your age">
         <input type="text" name="email" placeholder="Your email">
         <input type="password" name="pass" placeholder="Password">
         <!-- <input type="text" name="con_pass" placeholder="Config password"> -->
         <input type="submit" name="user_login" value="Login">
         <div class="switch">
            <p>i have a accont' <a href="login.php"> Login.</a></p>
         </div>
      </form>
   </div>
   <!-- link javascript -->
   <script src="Script/edit.js"></script>
   <script src="Script/Script.js"></script>
</body>
</html>
