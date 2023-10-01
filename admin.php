<?php 
// if(empty($p_name)){
      //    die('Input product name' . $p_name -> connect_error);
      // }
      // else if(empty($p_price)){
      //    die('Input product Price' . $p_price -> connect_error);
      // }
      // else if(empty($p_image)){
      //    die('Input product Image' . $p_image -> connect_error);
      // }
      // else{}
   include 'Connect.php';
   // Config mysql
   // add product
   if(isset($_POST['add_product'])){
      $p_name = $_POST['p_name'];
      $p_price = $_POST['p_price'];
      $p_image = $_FILES['p_image']['name'];
      $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
      $p_image_folder = 'uploaded_img/' . $p_image;
      
      $insert_query = mysqli_query($connect, "INSERT INTO `product_1`(name, price, image) VALUES ('$p_name', '$p_price', '$p_image')") or die ('query failled !');
         if($insert_query){
            move_uploaded_file($p_image_tmp_name, $p_image_folder);
            $message [] = 'Product add successfully !';
         }else{
            $message [] = 'Can not add Failled !';
         }
   };
   // Delete Product
   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      $delete_query = mysqli_query($connect, "DELETE FROM `product_1` WHERE id = $delete_id") or die('quer failed');
      if($delete_query){
         header('location:admin.php');
         $message [] = 'Product Has be Delete !';
      }else{
         header('location:admin.php');
         $message [] = 'Product Can Not Delete !';
      };
   };
   // Update product
   if(isset($_POST['update_product'])){
      $update_p_id = $_POST['update_p_id'];
      $update_p_name = $_POST['update_p_name'];
      $update_p_price = $_POST['update_p_price'];
      $update_p_image = $_FILES['update_p_image']['name'];
      $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
      $update_p_image_folder = 'uploaded_img/' . $update_p_image;
      $update_query = mysqli_query($connect, "UPDATE `product_1` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = $update_p_id");
      if($update_query){
         move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
         $message [] = 'Product Updated succesfully!';
         header('location:admin.php');
      }else{
         $message [] = 'Product Cannot be Updated !';
      }
   };
?>
<!-- displa HTML -->
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
   <title>Admin Page</title>
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
      <section>
         <form action="admin.php" method="POST" class="add-product-form" enctype="multipart/form-data">
            <h3>Add a new product</h3>
            <input type="text" name="p_name" placeholder="Enter name" class="box" require>
            <input type="text" name="p_price" min="0" placeholder="Enter the product price" class="box" require>
            <input type="file" name="p_image" accept="imamge/png, image/jpg, image/jpeg" min="0" placeholder="Enter the product name" class="box" require>
            <input type="submit" value="Add the Product" name="add_product" class="btn">
         </form>
      </section>
      <!-- Display Product -->
      <section class="display-product-table">
         <table>
            <thead>
               <th>Product image</th>
               <th>Product name</th>
               <th>Product price</th>
               <th>Action</th>
            </thead>
            <tbody>
               <?php
                  $select_products = mysqli_query($connect, "SELECT * FROM `product_1`");
                     if(mysqli_num_rows($select_products) > 0){
                        while($row = mysqli_fetch_assoc($select_products)){
               ?>
               <tr>
                  <td><img class="rem" src="uploaded_img/<?php echo $row['image'];?>" height="100"  alt="No Image"></td>
                  <td><?php echo $row['name'];?></td>
                  <td>$ <?php echo $row['price'];?></td>
                  <td>
                     <a href="admin.php?delete=<?php echo $row['id'];?>" class="delete-btn" onclick="return confirm('Are you sure You what to delete this?');"><i class="fas fa-trash"></i> Delete </a>
                     <a href="admin.php?edit=<?php echo $row['id'];?>" class="option-btn" onclick="return confirm('Are you sure You what to Update this?');"><i class="fas fa-edit"></i> Update </a>
                     
                  </td>
               </tr>
               <?php
                        };
                     }else{
                        echo "<span class='empty'>No product add</span>";
                     }
               ?>
            </tbody>
         </table>
      </section>
      <!-- Edit product -->
      <section class="edit-form-container">
         <?php
            if(isset($_GET['edit'])){
               $edit_id = $_GET['edit'];
               $edit_query = mysqli_query($connect, "SELECT * FROM  `product_1` WHERE id = $edit_id");
               if(mysqli_num_rows($edit_query) > 0){
                  while($fetch_edit = mysqli_fetch_assoc($edit_query)){
         ?>
      <!-- Display Edit Product -->
         <form action="" method="POST" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_edit['image'];?>" height="200" alt="No image">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id'];?>">
            <input type="text" class="box" realpath name="update_p_name" value="<?php echo $fetch_edit['name'];?>">
            <input type="number" min="0" class="box" realpath name="update_p_price" value="<?php echo $fetch_edit['price'];?>">
            <input type="file" class="box" realpath name="update_p_image" accept="imamge/png, image/jpg, image/jpeg">
            <input type="submit" value="Updated" name="update_product" class="btn">
            <input type="reset" value="Cencel" id="close-edit" class="option-btn">
         </form>
      <!-- Script  -->
         <?php  
               };
            };
            echo "<script>
                     document.querySelector('.edit-form-container').style.display = 'flex';
                  </script>";
         };
         ?>
      </section>
   </div>
   
   <!-- link javascript -->
   <script src="Script/edit.js"></script>
   <script src="Script/Script.js"></script>
   
</body>
</html>