<?php 
   (include 'Connect.php') or die ('Connected Failed !');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/pngtree-grocery-store-logo-png-png-image_7223803.png" type="image/gif" sizes="30x30">
   <!-- font awessome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- link Css -->
   
   <link rel="stylesheet" href="CSS/Display.css">
   <link rel="stylesheet" href="CSS/Edit.css">
   <link rel="stylesheet" href="CSS/Admin.css">
   <link rel="stylesheet" href="CSS/Heading.css">
   <title>Setting</title>
</head>
<body>
   <!-- message -->
   <?php 
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message"> <span>'. $message .'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
         };
      };
   ?>
   <!-- Called Header file -->
   <?php include 'header.php';?>
   <!-- Add product -->
   <div class="container">
      
   </div>
</body>
</html>