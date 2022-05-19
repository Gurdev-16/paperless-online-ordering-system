<!--connects to the database-connect.php-->
<?php
include('../includes/connect.php');
session_start();

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uni food ordering </title>
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
<body>
    <!-- navbar -->
    <div class="container-fluid p-0"> 
        <!-- first child  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="../img/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li><li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <form class="d-flex" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" 
        name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>



<!-- Second child --> 
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<<?php
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
          <a class='nav-link' href='./user_login.php'>Login</a>
          </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./logout.php'>Logout</a>
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

<!-- Fourth child  --> 
<div class="row px-1">
    <div class="col-md-12">
        <!-- Products --> 
          <div class="row">
              <?php
              //if the session varible (username) is not set include users_area/user_login.php else go to payment.php
              if(!isset($_SESSION['username'])){
        include('user_login.php');
              }
              else{
                include('payment.php');
              }
              ?>

<!-- div for row end -->
</div>
<!-- div for collumn end -->
</div>

    
</div>


<!-- final child  -Footer- --> 
<!-- include footer from footer.php-->
<?php
include("../includes/footer.php") ?>
</div>



    
<!--Link for Bootstrap js -from Bootstrap webiste-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>
</body>
</html>