<?php

// include the connect.php file to connect to Db
//include('./includes/connect.php');

// getting products
function getproducts(){
    global $con;
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            //only display the following data if category and band is not set
    $select_query="select * from `products` order by rand() limit 0,3";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card' >
                     <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                     <div class='card-body'>
                     <h5 class='card-title'>$product_title</h5>
                     <p class='card-text'>$product_description</p>
                     <p class='card-text'> price: £$product_price</p>
                     <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                     </div>
        </div>
      </div> ";
    }
}
}
}

// getting all product product page
function get_all_products(){
    global $con;
    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){
            //only display the following data if category and band is not set
    $select_query="select * from `products` order by rand() ";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card' >
                     <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                     <div class='card-body'>
                     <h5 class='card-title'>$product_title</h5>
                     <p class='card-text'>$product_description</p>
                     <p class='card-text'> price: £$product_price</p>
                     <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                     </div>
        </div>
      </div> ";
    }
}
}
}
//getting unique categories to display whn clicked on side nav 
function get_unique_categories(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
            //only display the following data if category and band is not set
    $select_query="select * from `products` where category_id=$category_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>This category is out of stock or unavailable </h2>";
    }


    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card' >
                     <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                     <div class='card-body'>
                     <h5 class='card-title'>$product_title</h5>
                     <p class='card-text'>$product_description</p>
                     <p class='card-text'> price: £$product_price</p>
                     <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                     </div>
        </div>
      </div> ";
    }
}
}

//getting unique brands to display whn clicked on side nav 
function get_unique_brands(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
            //only display the following data if category and band is not set
    $select_query="select * from `products` where brand_id=$brand_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>This brand is out of stock or uniavailable </h2>";
    }

    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card' >
                     <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                     <div class='card-body'>
                     <h5 class='card-title'>$product_title</h5>
                     <p class='card-text'>$product_description</p>
                     <p class='card-text'> price: £$product_price</p>
                     <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                     </div>
        </div>
      </div> ";
    }
}
}


// displaying brands in sidnav
function getbrands(){
    global $con;
    $select_brands="select* from `brands`";
$result_brands=mysqli_query($con,$select_brands);
while($row_data=mysqli_fetch_assoc($result_brands)){
    $brand_title=$row_data['brand_title'];
    $brand_id=$row_data['brand_id'];
    echo "<li class='nav-item'>
    <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
</li>";
}
}

// displaying categories in sidnav
function getcategories(){
    global $con;
    $select_categories="select* from `categories`";
$result_categories=mysqli_query($con,$select_categories);
while($row_data=mysqli_fetch_assoc($result_categories)){
    $category_title=$row_data['category_title'];
    $category_id=$row_data['category_id'];
    echo "<li class='nav-item'>
    <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
</li>";
}
}


//Search for product function searchbar

function search_product(){
        global $con;
        //only search for the data once button is clicked 'isset'
        if(isset($_GET['search_data_product'])){
            $search_data_value=$_GET['search_data'];
        $search_query="Select * from `products` where product_keywords like '%$search_data_value%'";
        $result_query=mysqli_query($con,$search_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>The item you have searched is not uniavailable </h2>";
        }

        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo "<div class='col-md-4 mb-2'>
            <div class='card' >
                         <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                         <div class='card-body'>
                         <h5 class='card-title'>$product_title</h5>
                         <p class='card-text'>$product_description</p>
                         <p class='card-text'> price: £$product_price</p>
                         <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                         </div>
            </div>
          </div> ";
        }
    }
    }
    
// get ip address function for cart  used to get data from the cart

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

// using ip address to differentiate ,as mutuple people can order same product with same product_id

// cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_ip_address= getIPAddress();
        $get_product_id=$_GET['add_to_cart'];

        //condition stops multiple entry in db
        $select_query="Select *  from `cart_details` where ip_address ='$get_ip_address'
        and product_id=$get_product_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows>0){
        echo "<script>alert('You have alredy added this item to your cart')</script>";
        echo "<script>window.open('index.php','_self')</script>"; //_self means it will open in the same tab not open a new tab
        }
        else{

            $insert_query="insert into `cart_details` (product_id,ip_address,quantity)
             values($get_product_id,'$get_ip_address',0)";
             $result_query=mysqli_query($con,$insert_query);
             echo "<script>alert('Item has been sucessfully added to cart')</script>";
             echo "<script>window.open('index.php','_self')</script>";
             
      }
    }

}

//function to get cart item numbers (for the cart icon at the top of page)
function cart_item(){
    //if isset count number of rows else still count number of rows to display as cart number
        if(isset($_GET['add_to_cart'])){
            global $con;
            $get_ip_address= getIPAddress();
    
            //condition stops multiple entry in db
            $select_query="Select *  from `cart_details` where ip_address ='$get_ip_address'";
            $result_query=mysqli_query($con,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
            }
            else{
                global $con;
                $get_ip_address= getIPAddress();
                $select_query="Select *  from `cart_details` where ip_address ='$get_ip_address'";
                $result_query=mysqli_query($con,$select_query);
                $count_cart_items=mysqli_num_rows($result_query);
          }
          echo $count_cart_items;
        }
    
//function to get total price of items in the cart 
function total_cart_price(){
    global $con;
    //fetch all the data from cart_detailsif the ip addess is a match
    $get_ip_address= getIPAddress();
    $total_price=0; //inital value
    $cart_query="Select * from cart_details where ip_address='$get_ip_address'";
    $result=mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result)){
        // fetch product id from cart deatils toget to the products tableand match to gwt that item price
        $product_id=$row['product_id'];
        $select_products="Select * from `products` where product_id='$product_id'";
        $result_products=mysqli_query($con,$select_products);
        while($row_product_price=mysqli_fetch_array($result_products)){
            //wrap items in an array as user can have multiple items
            $product_price=array($row_product_price['product_price']);
            $product_values=array_sum($product_price);// add the items in array to get total
            $total_price+=$product_values;
    }
 }
 echo $total_price; //return the total
}
?>