<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uni food ordering-payment page</title>
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
<style>
    img{
        width:75%;
        margin:auto;
        display:block;
    }
    </style>
<body>
    <!--php code to access user id-->
    <?php
    $user_ip=getIPAddress();
    $get_user="Select * from `user_table` where user_ip='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_array($result);
    $user_id=$run_query['user_id'];

    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-md-6">
            <a href="https://www.paypal.com/uk/home" target="_blank" class="">
                <img src="../img/cardpay.jpg" alt=""></a>
            </div>
            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>">
            <h2 class="text-center">Pay Offline</h2></a>
            </div>
            
        </div>
    </div>
    
</body>
</html>    