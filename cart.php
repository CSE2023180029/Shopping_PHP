<?php 
   (include 'Connect.php') or die ('Connected Failed !');
   if(isset($_POST['update_update_btn'])){
      $update_value = $_POST['update_quantity'];
      $update_id = $_POST['update_quantity_id'];
      $update_quantity_query = mysqli_query($connect, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'"); 
      if($update_quantity_query){
         header('location:cart.php');
      };
   };
   if(isset($_GET['remove'])){
      $remove_id = $_GET['remove'];
      mysqli_query($connect, "DELETE FROM `cart` WHERE id = '$remove_id'");
      header('location:cart.php');
   }
   if(isset($_GET['delete_all'])){
      mysqli_query($connect, "DELETE  FROM `cart`");
      header('location:cart.php');
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
   <style>
      .shopping-cart .checkout-btn a.disabled{
         pointer-events: none;
         opacity: .5rem;
         user-select: none;
         background-color: var(--red);
      }
   </style>
   <link rel="stylesheet" href="CSS/Display.css">
   <link rel="stylesheet" href="CSS/Edit.css">
   <link rel="stylesheet" href="CSS/Admin.css">
   <link rel="stylesheet" href="CSS/Heading.css">
   <link rel="stylesheet" href="CSS/Cart.css">
   <title>Cart</title>
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
      <section class="shopping-cart">
         <h1 class="heading">Shopping Cart</h1>
         <table>
            <thead>
               <th>Image</th>
               <th>Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Total Product</th>
               <th>Action</th>
            </thead>
            <tbody>
               <?php 
                  $select_cart = mysqli_query($connect, "SELECT * FROM `cart`") or die ('Select Failed !');
                  $grand_total = 0;
                  if(mysqli_num_rows($select_cart) > 0){
                     while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               ?>
               <tr>
                  <td><img src="uploaded_img/<?php echo $fetch_cart['image'];?>" height="100" alt=""></td>
                  <td><?php echo $fetch_cart['name'];?></td>
                  <td>$ <?php echo number_format($fetch_cart['price']); ?></td>
                  <td>
                     <form action="" method="POST">
                     <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" value="Update" name="update_update_btn">
                     </form>
                  </td>
                  <td>$ <?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                  <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?')"><i class="fas fa-trash"></i>Remove</a></td>

               </tr>
               <?php 
                     $grand_total +=  $sub_total;
                  };
               };
               
               ?>
               <tr class="table-bottom">
                  <td><a href="product.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                  <td colspan="3">Grand Total</td>
                  <td>$ <?php echo $grand_total?></td>
                  <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure ou want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i>Delete All</a></td>
               </tr>
            </tbody>
         </table>
         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Procced to Checkout</a>
         </div>
      </section>
   </div>
   <!-- link javascript -->
   <script src="Script/edit.js"></script>
   <script src="Script/Script.js"></script>
</body>
</html>