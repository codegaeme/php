<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= BASE_URL?>app/public/client/assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= BASE_URL?>app/public/client/assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= BASE_URL?>app/public/client/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= BASE_URL?>app/public/client/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <?php  if (isset( $_SESSION['user_name'])) :
                       ?>
                   
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['user_name']?></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= BASE_URL?>profile"class="dropdown-item" >My profile</a>
                            
                            <form action="<?= BASE_URL?>logout" method="post">
                                <button class="dropdown-item">Logout</button>
                            </form>
                           
                        </div>
                    </div>
                    <?php  else : ?>
                        <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"> My Account</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= BASE_URL?>register"class="dropdown-item" >Sign up</a>
                            <a href="<?= BASE_URL?>login"class="dropdown-item" >Sign In</a>
                           
                        </div>
                    </div>

                        <?php endif ?>
                    
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="<?=BASE_URL?>seach" method="POST"></form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" name="q" >
                        <div class="input-group-append">
                            <button type ="submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <?php foreach ($listCate as $key => $value) :?>
                        <a href="<?=BASE_URL.$value->id?>/probytype" class="nav-item nav-link"><?=$value->category_name?></a>
                        <?php endforeach?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?=BASE_URL?>" class="nav-item nav-link active">Home</a>
                            <a href="<?=BASE_URL?>shop" class="nav-item nav-link">Shop</a>
                          
                            
                            <a href="<?=BASE_URL?>/order/list" class="nav-item nav-link">Đơn hàng của tôi</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="<?= BASE_URL?>cart" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">

                                
                                <?php 
                              if (isset($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                               
                                $count = count($cart);
                                echo  $count;
                            }else echo 0;
                                ?>
                                
                                </span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['message_success'])): ?>
    <div id="alert-box" class="alert alert-success" style="
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 50%;
        z-index: 1000;
        text-align: center;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;">
        <?php echo $_SESSION['message_success']; ?>
        <div id="progress-bar" style="
            height: 5px;
            background: green;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;">
        </div>
    </div>
    <script>
        let alertBox = document.getElementById("alert-box");
        let progressBar = document.getElementById("progress-bar");

        setTimeout(() => {
            alertBox.style.opacity = "0";
            setTimeout(() => {
                alertBox.style.display = "none";
            }, 500);
        }, 3000);

        let width = 100;
        let interval = setInterval(() => {
            if (width <= 0) {
                clearInterval(interval);
            } else {
                width -= 1;
                progressBar.style.width = width + "%";
            }
        }, 30);
    </script>
    <?php unset($_SESSION['message_success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['message_error'])): ?>
    <div id="alert-box" class="alert alert-danger" style="
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 50%;
        z-index: 1000;
        text-align: center;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        border-radius: 5px;">
        <?php echo $_SESSION['message_error']; ?>
        <div id="progress-bar" style="
            height: 5px;
            background: red;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;">
        </div>
    </div>
    <script>
        let alertBox = document.getElementById("alert-box");
        let progressBar = document.getElementById("progress-bar");

        setTimeout(() => {
            alertBox.style.opacity = "0";
            setTimeout(() => {
                alertBox.style.display = "none";
            }, 500);
        }, 3000);

        let width = 100;
        let interval = setInterval(() => {
            if (width <= 0) {
                clearInterval(interval);
            } else {
                width -= 1;
                progressBar.style.width = width + "%";
            }
        }, 30);
    </script>
    <?php unset($_SESSION['message_error']); ?>
<?php endif; ?>


    <!-- Navbar End -->
