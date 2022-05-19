<!--connects to the database-connect.php-->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uni food ordering- cart details</title>
    <!--Link for Bootstrap css -from Bootstrap webiste-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <!--Link for font awesome cnd-content delivey network -from font-awesome libraries-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file link -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img{
    width:80px;
    height:80px;
    object-fit: contain;
    }
    body{
            overflow-x:hidden;
        }
    </style>

</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0"> 
        <!-- first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./img/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li><li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li><li class="nav-item">
          <a class="nav-link" href="cart.php"> <i class="fas fa-shopping-cart"></i>Cart<sup>
              <?php
              cart_item();
              ?></sup></a><!--calling cart item function to display cart items-->
        </li>
    
    </div>
  </div>
</nav>

<!-- calling cart function -->
<?php
cart();
?>

<!-- Second child --> 
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<?php
        //if logged in display name if not show hello guest
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Hello Guest</a>
          </li>";
        }
        else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Hello ".$_SESSION['username']."</a>
          </li>";
        }
        //if logged in show logout button and vice versa
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
          </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/logout.php'>Logout</a>
          </li>";
        }

        ?>
  </ul>
</nav>
<!-- Third child  --> 
<div class="bg-light">
   <h3 class="text-center">Uni Food order</h3>
   <p class="text-center">Making ordering food and snacks at uni simpler with paperless ordering</p>
</div>

<!-- Fourth child - Table--> 
<div class="container">
    <div class="row">
        <form action="" method="post"> <!--enclose entire form in a form to store in database-->
        <table class="table table-bordered text-center">
            
                <!-- php code to display dynamic data for table -->
                <?php
 global $con;
 //fetch all the data from cart_details if the ip addess is a match
 $get_ip_address= getIPAddress();
 $total_price=0; //inital value
 $cart_query="Select * from cart_details where ip_address='$get_ip_address'";
 $result=mysqli_query($con,$cart_query);
$result_count=mysqli_num_rows($result);// counts number of rows in table
// only show the following table if the rows are great than 0
if($result_count>0){
    echo " <thead>
    <tr>
        <th>Product Title</th>
        <th>Product Image</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Remove</th>
        <th colspan='2'>Operations</th>
    </tr>
</thead>
<tbody>";
 while($row=mysqli_fetch_array($result)){
     // fetch product id from cart deatils toget to the products tableand match to get that item price
     $product_id=$row['product_id'];
     $select_products="Select * from `products` where product_id='$product_id'";
     $result_products=mysqli_query($con,$select_products);
     while($row_product_price=mysqli_fetch_array($result_products)){
         //wrap items in an array as user can have multiple items
         $product_price=array($row_product_price['product_price']);
         $price_table=$row_product_price['product_price'];//fetched product price
         $product_title=$row_product_price['product_title'];//fetched product title
         $product_image1=$row_product_price['product_image1'];//fetched product image
         $product_values=array_sum($product_price);// add the items in array to get total
         $total_price+=$product_values;

?>

                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin/product_images/<?php echo $product_image1?>" alt="" class= "cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
$get_ip_address= getIPAddress();
if(isset($_POST['update_cart'])){
     $quantities=$_POST['qty']; //store input value in $quantities
     $update_cart="update `cart_details` set quantity=$quantities where
    ip_address='$get_ip_address'";//set quantity in the cart table
    $result_products_quantity=mysqli_query($con,$update_cart);
    $total_price=$total_price*$quantities;
}

                
                    ?>
                    <td>£<?php echo $price_table?></td>
                    <td><input type="checkbox"name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!--<button class="bg-info px-3 py-2 border-0 mx-3">Update</button> -->
                        <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3"
                        name="update_cart">
                        <!--<button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                        <input type="submit" value="remove Cart" class="bg-info px-3 py-2 border-0 mx-3"
                        name="remove_cart">
                    </td>
                </tr>
                <?php
}}}

else{

    echo"<h2 class='text-center text-danger'> Cart is empty </h2>";
}

?>
            </tbody>
        </table>
        <!--subtotal  bottom of cart page-->
        <div class="d-flex mb-5">
            <?php

$get_ip_address= getIPAddress();

$cart_query="Select * from cart_details where ip_address='$get_ip_address'";
$result=mysqli_query($con,$cart_query);
$result_count=mysqli_num_rows( $result);// counts number of rows in table
// only show the following table if the rows are great than 0
if($result_count>0){

 echo "<h4 class='px-3'> subtotal:<strong class='text-info'> £ $total_price </strong></h4>

 <input type='submit' value='Continue to place order' class='bg-info px-3 py-2 border-0 mx-3'
 name='Continue_shopping'>

  <button class='bg-secondary px-3 py-2 border-0 text-light'><a href='./users_area/checkout.php'
  class='text-light text-decoration-none'>Checkout</button>";
}
else{
    echo"<input type='submit' value='Continue to place order' class='bg-info px-3 py-2 border-0 mx-3'
    name='Continue_shopping'>";
}
if(isset($_POST['Continue_shopping'])){
    echo "<script>window.open('index.php','_self')</script>";
}

            ?>
            
        </div>
    </div>
</div>
</form>

<!-- function to remove items from cart -->
<?php
function remove_cart_item(){
    global $con;
    //if button is clicked (isset) access product id and delete item from cart table with matching id 
    if(isset($_POST['remove_cart'])){  
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>wndows.open('cart.php','_self')</script>";
            }
        }

    }
}
echo $remove_item=remove_cart_item();
?>



<!-- final child  -Footer- --> 
<!-- include footer from footer.php-->
<?php
include("./includes/footer.php") ?>
    </div>
    
<!--Link for Bootstrap js -from Bootstrap webiste-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
</body>
</html>