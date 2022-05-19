<?php
include('../includes/connect.php');
if(isset($_POST['insert_products'])){

    $product_title=$_POST['Product_title'];
    $description=$_POST['description'];
    $Product_keywords=$_POST['Product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $Product_price=$_POST['Product_price'];
    $product_status='true';

    // accessing images
    $product_image1=$_POST['product_image1']['name'];

    // accessing images temporary name
    $temp_image1=$_POST['product_image1']['tmp_name'];


    //checking if fields are empty 
    if($product_title=='' or $description=='' or $Product_keywords=='' or
    $product_category=='' or $product_brands=='' or $Product_price=='' or $product_image1=='' ){
        echo "<script>alert('Make sure that all field are filled in')</script>";
        exit();
    }
    else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");

        //insert product query
        $insert_products="insert into `products` (product_title,product_description,product_keywords,
        category_id,brand_id,product_image1,product_price,status) values ('$product_title',
        '$description','$Product_keywords','$product_category','$product_brands','$product_image1',
        '$Product_price','$product_status')";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<script>alert('product hasbeen successfully inserted into the Database')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
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
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3" header:[]>
        <h1 class="text-center">Insert Products</h1>
        <!-- Form -->
        <form action="" method="post" enctype="multipart/form.data">
            <!-- Product Title -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <label for="product_title" class="form-label">product title</label>
                <input type="text" name="Product_title" id="product_title" class="form-control" 
                placeholder= "Enter product title" autocomplete="off" required="required">
            </div>

             <!-- Product Description -->
             <div class="form-outline mb-4 w-50 m-auto"> 
                <label for="description" class="form-label">product description</label>
                <input type="text" name="description" id="description" class="form-control" 
                placeholder= "Enter product description" autocomplete="off" required="required">
            </div>

            <!-- Product Keyword -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <label for="product_keywords" class="form-label">product keywords</label>
                <input type="text" name="Product_keywords" id="product_keywords" class="form-control" 
                placeholder= "Enter any product keywords" autocomplete="off" required="required">
            </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                         $select_query="Select * from `categories`";
                         $result_query=mysqli_query($con,$select_query);
                         while($row=mysqli_fetch_assoc($result_query)){
                             $category_title=$row['category_title'];
                             $category_id=$row['category_id'];
                             echo "<option value='$category_id'>$category_title</option>";
                         }

                    ?>
                </select>
            </div>

            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <select name="product_brands" id="" class="form-select">
                <option value="">Select a Brands</option>
                <?php
                         $select_query="Select * from `brands`";
                         $result_query=mysqli_query($con,$select_query);
                         while($row=mysqli_fetch_assoc($result_query)){
                             $brand_title=$row['brand_title'];
                             $brand_id=$row['brand_id'];
                             echo "<option value='$brand_id'>$brand_title</option>";
                         }

                    ?>
                </select>
            </div>

              <!-- Image of Product  -->
              <div class="form-outline mb-4 w-50 m-auto"> 
                <label for="product_image1" class="form-label">Product image </label>
                <input type="file" name="product_image1" id="product_image1" class="form-control"
                 required="required">
            </div>

            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <label for="product_price" class="form-label">product price</label>
                <input type="text" name="Product_price" id="product_price" class="form-control" 
                placeholder= "Enter a price for the product" autocomplete="off" required="required">
            </div>

            <!-- sumbmit button -->
            <div class="form-outline mb-4 w-50 m-auto"> 
                <input type="submit" name="insert_products" class="btn btn-info mb-3 px-3"
                value="Insert products">
            </div>
        </form>
    </div>


</body>
</html>