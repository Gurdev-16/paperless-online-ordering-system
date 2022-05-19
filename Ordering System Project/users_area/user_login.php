<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
        body{
            overflow-x:hidden;
        }
    </style>

</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col lg-12 col-xl-6"> <!-- display 12 column on large screen and 6 on extra large-->
<form action="" method="post"> 

    <!-- Username field-->
    <div class="form-outline mb-4"> <!-- bootstrap class-->
         <lable for="user_username" class="form-lable">Username</lable>
         <input type="text" id="user_username" class="form-control"
         placeholder="Enter your username" autocomplete="off" required ="required"
         name="user_username"/><!--autocomplete off mean no suggestions user_username because username was already used as a session value-->
    </div>

    <!-- Password field-->
    <div class="form-outline mb-4">
         <lable for="user_password" class="form-lable">Password</lable>
         <input type="password" id="user_password" class="form-control"
         placeholder="Enter your password" autocomplete="off" required ="required" name="user_password"/>
    </div>


    <div class="mt-4 pt-2">
        <input type="submit" value="Login" class="bg-info py-2 px-3
        border-0" name="user_login">
        <p class="small fw-bold mt-2 pt-1 mb-0">Dont have an account ?
        <a href="user_registration.php">Register</a></p>
    </div>
            </div>
        </div>
    </div>
    
</body>
</html>


<?php
if(isset($_POST['user_login'])){
    //access typed varibles and store them
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="Select * from `user_table` where username='$user_username' ";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);//fetch result from db
    $user_ip=getIPAddress();

    // cart item
    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip' ";//if ip addres match fetch records
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);

    if($row_count>0){//if row count is more than 0 user is inthe db
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){//password matches
            if($row_count==1 and $row_count_cart==0){//user is present but no item in cart
            $_SESSION['username']=$user_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('../index.php','_self')</script>";//login in nothing in cart
            } 
            else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";//login in items in cart
            }
        }
        else{
            echo "<script>alert('incorrect username or password')</script>";
        }

    }
    else{
        echo "<script>alert('incorrect username or password')</script>";
    }

}

?>