<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Register New User</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col lg-12 col-xl-6"> <!-- display 12 column on large screen and 6 on extra large-->
<form action="" method="post" enctype="multipart/form-data">

    <!-- Username field-->
    <div class="form-outline mb-4"> <!-- bootstrap class-->
         <lable for="user_username" class="form-lable">Username</lable>
         <input type="text" id="user_username" class="form-control"
         placeholder="Enter your username" autocomplete="off" required ="required"
         name="user_username"/><!--autocomplete off mean no suggestions user_username because username was already used as a session value-->
    </div>

    <!-- Email field-->
    <div class="form-outline mb-4">
         <lable for="user_email" class="form-lable">Email</lable>
         <input type="email" id="user_email" class="form-control"
         placeholder="Enter your email" autocomplete="off" required ="required" name="user_email"/>
    </div>

    <!-- Image field-->
    <div class="form-outline mb-4">
         <lable for="user_image" class="form-lable">Image</lable>
         <input type="file" id="user_image" class="form-control"
          required ="required" name="user_image"/>
    </div>

    <!-- Password field-->
    <div class="form-outline mb-4">
         <lable for="user_password" class="form-lable">Password</lable>
         <input type="password" id="user_password" class="form-control"
         placeholder="Enter your password" autocomplete="off" required ="required" name="user_password"/>
    </div>

        <!--Confirm Password field-->
        <div class="form-outline mb-4">
         <lable for="conf_user_password" class="form-lable">Confirm Password</lable>
         <input type="password" id="conf_user_password" class="form-control"
         placeholder="Confirm your password" autocomplete="off" required ="required" name="conf_user_password"/>
    </div>

    <!-- Address field-->
    <div class="form-outline mb-4"> 
         <lable for="user_address" class="form-lable">Address</lable>
         <input type="text" id="user_address" class="form-control"
         placeholder="Enter your address" autocomplete="off" required ="required"
         name="user_address"/>
    </div>

        <!-- Contact Number field-->
        <div class="form-outline mb-4"> 
         <lable for="user_contact" class="form-lable">Contact</lable>
         <input type="text" id="user_contact" class="form-control"
         placeholder="Enter your mobile number" autocomplete="off" required ="required"
         name="user_contact"/>
    </div>
    <div class="mt-4 pt-2">
        <input type="submit" value="Register" class="bg-info py-2 px-3
        border-0" name="user_register">
        <p class="small fw-bold mt-2 pt-1 mb-0">Already registered ? <a href="user_login.php">Login</a></p>
    </div>
            </div>
        </div>
    </div>
    
</body>
</html>

<!-- php code -->
 <?php 
//only fetch data when user_register isset and store in db
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $conf_user_password=$_POST['conf_user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_temp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();

    //select query

    $select_query="Select * from `user_table` where username='$user_username' or 
    user_email='$user_email'";//fetch record in db
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);// count number of rows
    if($rows_count>0){ //if the row count is more than 0 so it is already present
        echo "<script>alert('Username and/or Email alredy exists')</script>";
     // if true get alert if false pass into db
    }
    else if($user_password!=$conf_user_password){
        echo "<script>alert('passwords do not match')</script>";

    }
    else{
     //insert_query 
    move_uploaded_file($user_image_temp,"./user_images/$user_image");
    $insert_query="insert into `user_table` (username,user_email,user_password,user_image,
    user_ip,user_address,user_mobile) values ('$user_username','$user_email','$hash_password',
    '$user_image','$user_ip','$user_address','$user_contact')";//stored hased password in db 
    $sql_execute=mysqli_query($con,$insert_query);

    }

    //selecting cart items
    $select_cart_item="Select * from `cart_details` where ip_address='$user_ip'";// select all fron cart detail where same user
    $result_cart=mysqli_query($con,$select_cart_item);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){// if row count is more than 0 it means user not logged in
    $_SESSION['username']=$user_username;//assigned username to session
    echo "<script>alert('you have items in your cart')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
    }
    else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
    }


?>