<?php
include 'Connect.php';

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($connect, "SELECT * FROM `cart` WHERE name = '$product_name'");
   if(mysqli_num_rows($select_cart) > 0){
      $message [] = "Product alread added to cart";
   }else{
      $insert_product = mysqli_query($connect, "INSERT INTO `cart` (name, price, image, quantity) VALUE ('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message [] = "Product added to cart succesfull !";
   }
}
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
   <link rel="stylesheet" href="CSS/Admin.css">
   <link rel="stylesheet" href="CSS/Heading.css">
   <link rel="stylesheet" href="CSS/Display.css">
   <link rel="stylesheet" href="CSS/Edit.css">
   <title>View Product</title>
   <style>
      .product .box-container{
         justify-content: center;
      }
   </style>
</head>
<body>
<?php 
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message"> <span>'. $message .'</span><i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
         };
      };
   ?>
   <?php include 'header.php';?>
   <div class="container">
      <section class="product">
      <h1 class="heading">Latest Product</h1>
      <div class="box-container">
         <?php
            $select_product = mysqli_query($connect, "SELECT * FROM `product_1`");
            // if(!$select_product){
            //    echo 'Connecting failled !';
            // }
            if(mysqli_num_rows($select_product) > 0){
               while($fetch_product = mysqli_fetch_assoc($select_product)){
         ?>
         <form action="" method="POST">
            <div class="box">
               <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
               <h3><?php echo $fetch_product['name']; ?></h3>
               <div class="price">$ <?php echo $fetch_product['price']; ?></div>
               <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
               <input type="submit" class="btn" value="Add to cart" name="add_to_cart">
            </div>
         </form>
         <?php      
               };
            };
         ?>
      </div>
      </section>
   </div>


   <!-- link javascript -->
   <script src="Script/Script.js"></script>
   <script src="Script/edit.js"></script>
</body>
</html>