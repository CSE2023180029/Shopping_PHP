<?php
   (include 'Connect.php') or die ('Connected Failed !');
   if(isset($_POST['order_btn'])){
      $name = $_POST['name'];
      $number = $_POST['number'];
      $email = $_POST['email'];
      $method = $_POST['method'];
      $flat = $_POST['flat'];
      $street = $_POST['street'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $country = $_POST['cocuntry'];
      $pin_code = $_POST['pin_code'];
      $cart_query = mysqli_query($connect, "SELECT * FROM `cart`");
      $price_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
         while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['name'] . '( ' . $product_item['quantity'] . ' )';
            $producct_price = number_format($product_item['price'] * $product_item['quantity']);
            $price_total += $producct_price;
         }
      }
      $total_product = implode(',',$product_name);
      $delail_query = mysqli_query($connect, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code,	total_product,	total_price) 
      VALUE('$name', '$number', '$email', '$method', '$flat', '$street', '$city', '$state', '$country', '$pin_code', '$price_total', '$total_product')");
      if($cart_query && $delail_query){
         echo "
         <div class='order-message-container'>
            <div class='message-container'>
               <h3>Thank you for shopping!</h3>
               <div class='order-detail'>
                  <span>".$total_product."</span>
                  <span class='total'>Total : $ ".$price_total." </span>
               </div>
               <div class='customer-detail'>
                  <p>Your name : <span>".$name."</span></p>
                  <p>Your number : <span>".$number."</span></p>
                  <p>Your email : <span>".$email."</span></p>
                  <p>Your address : <span>".$flat.", ".$street." ".$city.", ".$state.", ".$country." - ".$pin_code."</span></p>
                  <p>Your payment  mode : <span>".$method."</span></p>
                  <p>(*Pay when product arrives*)</p>
               </div>
               <a href='product.php' class='btn'>Container shopping</a>
            </div>
         </div>
         ";
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
   <link rel="stylesheet" href="CSS/Display.css">
   <link rel="stylesheet" href="CSS/Edit.css">
   <link rel="stylesheet" href="CSS/Admin.css">
   <link rel="stylesheet" href="CSS/Heading.css">
   <link rel="stylesheet" href="CSS/Checkout.css">
   <title>Checkout</title>
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
   <div class="container">
      <section class="checkout-form">
         <h1 class="heading">Complete your order</h1>

      
         <form action="" method="post">

         <div class="display-order">
            <?php
               $select_cart = mysqli_query($connect, "SELECT * FROM `cart`");
               $total = 0;
               $grand_total = 0;
               if(mysqli_num_rows($select_cart) > 0){
                  while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                     $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                     $grand_total = $total += $total_price;
            ?>
            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
            <?php   
                  }
               }else{
                  echo "<div class='display-order'><span>Yoyr ccart is empty!</span></div>";
               }
            ?>
            <span class="grand-total"> Grand total : <?=  $grand_total; ?> </span>
         </div>

            <div class="flex">
               <div class="inputBox">
                  <span>your name</span>
                  <input type="text" name="name" placeholder="Enter your name" required>
               </div>
               <div class="inputBox">
                  <span>your number</span>
                  <input type="number" name="number" placeholder="Enter your number" required>
               </div>
               <div class="inputBox">
                  <span>your email</span>
                  <input type="text" name="email" placeholder="Enter your email" required>
               </div>
               <div class="inputBox">
                  <span>Patment method</span>
                  <select name="method" id="">
                     <option value="cash on delivery">Cash on deliver</option>
                     <option value="credit cart">Credit cart</option>
                     <option value="payment">payment</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>address line 1</span>
                  <input type="text" name="flat" placeholder="e.g. flat no." required>
               </div>
               <div class="inputBox">
                  <span>address line 2</span>
                  <input type="text" name="street" placeholder="e.g. street name" required>
               </div>
               <div class="inputBox">
                  <span>City</span>
                  <input type="text" name="city" placeholder="e.g. Phnom Penh" required>
               </div>
               <div class="inputBox">
                  <span>state</span>
                  <input type="text" name="state" placeholder="e.g. state" required>
               </div>
               <div class="inputBox">
                  <span>country</span>
                  <input type="text" name="cocuntry" placeholder="e.g. Cambodia" required>
               </div>
               <div class="inputBox">
                  <span>Pin code</span>
                  <input type="text" name="pin_code" placeholder="e.g. 1404" required>
               </div>
            </div>
            <input type="submit" name="order_btn" class="btn" value="order now">
         </form>
      </section>
   </div>
   <!-- link javascript -->
   <script src="Script/edit.js"></script>
   <script src="Script/Script.js"></script>
</body>
</html>