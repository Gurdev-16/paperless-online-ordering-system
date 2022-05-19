<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav"> 
                        <li class="nav-item">
                            <a href="" class="nav.link">Hello guest</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </nav>

        <!-- Second child  -->
        <div class="bg-light">
            <h3 class="text-center p-2"> Admin panel</h3>
        </div>

        <!-- Third child  -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-2 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../img/apple.jpg" alt="" class="admin_img"></a>
                    <p class="text-light text-center">Admin Name</p>
                </div>
                <div class="button text-center">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Products</a>
                    </button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Categories</a>
                    </button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View Brands</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View All Orders</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View All Payments</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">List Users</a>
                    </button>
                    <button><a href="" class="nav-link text-light bg-info my-1">Log Out</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- Fourth child --> 
<div class="container my-3">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
    }
    ?>
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