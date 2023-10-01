<header class="header">
   <div class="flex">
      <a href="#" class="logo">Eyxa Mart</a>
      <nav class="navbar">
         <a href="admin.php">Add Product</a>
         <a href="product.php">View Product</a>
         <a href="setting.php">Setting</a>
      </nav>
      <?php 
         $select_rows = mysqli_query($connect,  "SELECT * FROM `cart`") or die ('Query faolled !');
         $rows_count = mysqli_num_rows($select_rows);
      ?>
      <a href="cart.php" class="cart">Cart <span> <?php echo $rows_count ?> </span></a>
      <div id="menu-btn" class="fas fa-bars">
      </div>
   </div>
</header>