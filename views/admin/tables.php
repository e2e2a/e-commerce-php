<?php
include '../../database/config.php';
session_start();
    if (empty($_SESSION['id']) || $_SESSION['id'] != 1) {
        header("Location: login.php");
        exit();
    }
    if(isset($_POST['create-product'])){
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $depth = $_POST['depth'];
        $weight = $_POST['weight'];
        $quantity = $_POST['quantity'];



        // File upload handling
    $uploadDir = '../../public/img/product/'; // Change this to your desired upload directory
    $uploadedFile = $_FILES['images']['tmp_name'];
    $images = $_FILES['images']['name'];
    $targetFile = $uploadDir . basename($images);

    // Check if file is uploaded successfully
    if (move_uploaded_file($uploadedFile, $targetFile)) {
        // File was uploaded successfully, continue with database insert
        $sql = "INSERT INTO products(product_name, category, price, description, images, width, height, depth, weight, quantity) 
                VALUES (:a, :b,:c,:d,:e,:f,:g,:h,:i,:j)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':a', $product_name);
        $stmt->bindParam(':b', $category);
        $stmt->bindParam(':c', $price);
        $stmt->bindParam(':d', $description);
        $stmt->bindParam(':e', $images);
        $stmt->bindParam(':f', $width);
        $stmt->bindParam(':g', $height);
        $stmt->bindParam(':h', $depth);
        $stmt->bindParam(':i', $weight);
        $stmt->bindParam(':j', $quantity);

        if ($stmt->execute()) {
            echo '<script> alert("Product created successfully.") </script>';
        } else {
            echo '<script> alert("Error creating product.") </script>';
        }
    } else {
        echo 'Error uploading file.';
    }
}

include '../../database/config.php';
if(isset($_POST['create-user'])){
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $password = $_POST['password'];
    
    //verifying the unique email
    
    $stmt = $con->prepare("SELECT email From users WHERE email=:a");
    $stmt->bindParam(':a', $email);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num_rows = count($results);
    if($num_rows !=0) {
        echo "<script>alert('Email is already used!'); </script>";
        
    } else {
        $sql = "INSERT INTO users(username,fullname,email,birthdate,password) VALUES(:a,:b,:c,:d,:e)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':a', $username);
        $stmt->bindParam(':b', $fullname);
        $stmt->bindParam(':c', $email);
        $stmt->bindParam(':d', $birthdate);
        $stmt->bindParam(':e', $password);
        if($stmt->execute()) {
            echo "<script>alert('Registration Success!'); </script>";
        } else {
            echo "<script>alert('Registration Failed!'); </script>";
        }
    }
}

$sql = "SELECT * FROM products";
$stmt = $con->prepare($sql);
$stmt->execute();
$result_product = $stmt->fetchAll();

$sql = "SELECT * FROM users";
$stmt = $con->prepare($sql);
$stmt->execute();
$result_user = $stmt->fetchAll();
if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete'];  
    if (!isset($_POST['delete_type'])) {
        echo "Delete type not set";
        exit;
    }
    switch ($_POST['delete_type']) {
        case 'users':
            $stmt = $con->prepare("DELETE FROM users WHERE user_id=:deleteId");
            break;
        case 'products':
            $stmt = $con->prepare("DELETE FROM products WHERE product_id=:deleteId");
            break;
        default:
            echo "Invalid delete type";
            exit;
    }
    $stmt->bindParam(':deleteId', $deleteId);
    if ($stmt->execute()){
            echo '<script>alert("Record deleted successfully.");</script>';
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "tables.php";
                    }, 250); // Delay of 250 milliseconds (0.25 second)
                </script>';
            exit;
        } else {
            echo "Error deleting record: " . $con->error;
        } 
    
}
if (isset($_POST['edit'])) {
    $editId = $_POST['edit'];
    if (!isset($_POST['delete_type'])) {
        echo "Delete type not set";
        exit;
    }
    switch ($_POST['delete_type']) {
        case 'users':
            header("Location: ../edit.php?user_id=" . $editId);
            break;
        case 'products':
            header("Location: ../edit-product.php?products_id=" . $editId);
            break;
        
        default:
            echo "Invalid delete type";
            exit;
    }
    
}

?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Administrator</title>

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="../../public/css/linearicons.css">
    <link rel="stylesheet" href="../../public/css/owl.carousel.css">
    <link rel="stylesheet" href="../../public/css/themify-icons.css">
    <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/nice-select.css">
    <link rel="stylesheet" href="../../public/css/nouislider.min.css">
    <link rel="stylesheet" href="../../public/css/bootstrap.css">
    <link rel="stylesheet" href="../../public/css/main.css">
</head>

<body>
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="../../public/img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-product.html">Product
                                            Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
                                    <li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown active">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="tracking.html">Tracking</a></li>
                                    <li class="nav-item active"><a class="nav-link" href="elements.html">Elements</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Element Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Element</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->


    <!-- Start Align Area -->
    <div class="whole-wrap pb-100">
        <div class="container">
            <div class="section-top-border mt-5">
                <h3 class="mb-30">Block Quotes</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <blockquote class="generic-blockquote">
                            “Recently, the US Federal government banned online casinos from operating in America by
                            making it illegal to
                            transfer money to them through any US bank or payment system. As a result of this law, most
                            of the popular
                            online casino networks such as Party Gaming and PlayTech left the United States. Overnight,
                            online casino
                            players found themselves being chased by the Federal government. But, after a fortnight, the
                            online casino
                            industry came up with a solution and new online casinos started taking root. These began to
                            operate under a
                            different business umbrella, and by doing that, rendered the transfer of money to and from
                            them legal. A major
                            part of this was enlisting electronic banking systems that would accept this new
                            clarification and start doing
                            business with me. Listed in this article are the electronic banking”
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--USERS TABLES-->
            <div class="section-top-border mb-5">
                <h3 class="mb-30">Users Table</h3>
                <div class="progress-table-wrap">
                    <?php
                        if($result_user > 0) {
                            echo '<div class="progress-table">';
                            echo '<div class="table-head">
                            <div class="serial">Id</div>
                            <div class="visit">username</div>
                            <div class="visit">fullname</div>
                            <div class="visit">email</div>
                            <div class="visit">birthdate</div>
                            <div class="visit ">Actions</div>
                        </div>';
                        foreach ($result_user as $row){
                            echo '<div class="table-row ">';
                            echo '<div class="serial">'. $row["user_id"] . '</div>';
                            echo '<div class="visit">'. $row["username"] . '</div>';
                            echo '<div class="visit">'. $row["fullname"] . '</div>';
                            echo '<div class="visit">'. $row["email"] . '</div>';
                            echo '<div class="visit">'. $row["birthdate"] . '</div>';
                            echo "<div class='visit'>
                                    <form method='post'>
                                        <div class='btn-group' role='group' >
                                        <button type='submit' name='edit' class='btn btn-primary' value='" . $row["user_id"] . "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
                                        <input type='hidden' name='delete_type' value='users'>
                                        <button type='submit' name='delete' class='btn btn-danger' value='" . $row["user_id"] . "'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                        </div>
                                    </form>
                                </div>";
                            echo '</div>';
                        }
                        echo '</div>';
                        }
                    ?>                 
                </div>
            </div>
            <!--PRODUCT TABLES-->
            <div class="section-top-border mb-5">
                <h3 class="mb-30">Products Table</h3>
                <div class="progress-table-wrap">
                    <?php
                        if($result_product > 0) {
                            echo '<div class="progress-table">';
                            echo '<div class="table-head">
                            <div class="serial">Id</div>
                            <div class="country">images</div>
                            <div class="visit">product_name</div>
                            <div class="visit">category</div>
                            <div class="visit">price</div>
                            <div class="visit">quantity</div>
                            <div class="visit ">Actions</div>
                        </div>';
                        foreach ($result_product as $row){
                            echo '<div class="table-row ">';
                            echo '<div class="serial">'. $row["product_id"] . '</div>';
                            echo '<div class="country"> <img class="img-fluid img-thumbnail" style="width: 100px; height: 100px;" src="../../public/img/product/' . $row['images'] .'" alt=""></div>';
                            echo '<div class="visit">'. $row["product_name"] . '</div>';
                            echo '<div class="visit">'. $row["category"] . '</div>';
                            echo '<div class="visit">'. $row["price"] . '</div>';
                            echo '<div class="visit">'. $row["quantity"] . '</div>';
                            echo "<div class='visit'>
                                    <form method='post'>
                                        <div class='btn-group' role='group' >
                                        <button type='submit' name='edit' class='btn btn-primary' value='" . $row["product_id"] . "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
                                        <input type='hidden' name='delete_type' value='products'>
                                        <button type='submit' name='delete' class='btn btn-danger' value='" . $row["product_id"] . "'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                        </div>
                                    </form>
                                </div>";
                            echo '</div>';
                        }
                        echo '</div>';
                        }
                    ?>                 
                </div>
            </div>


            <div class="section-top-border mb-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-5">
                        <h3 class="mb-30">Create Users</h3>
                        <form action="#" class="contact_form" action="" method="post">
                            <div class="mt-10">
                                <input type="text" name="username" placeholder="Username" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="fullname" placeholder="Full Name" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="email" name="email" placeholder="Email Address" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="date" name="birthdate" placeholder="Birthdate" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" placeholder="Password" required class="single-input">
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" value="submit" name="create-user" class="primary-btn e-large mt-3">Submit Now</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 col-md-12 mb-5">
                        <h3 class="mb-30">Create Product</h3>
                        <form class="contact_form" action="" method="post" enctype="multipart/form-data">
                            <div class="mt-10">
                                <input type="text" name="product_name" placeholder="Product Name" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="number" name="price" placeholder="Price" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="int" name="quantity" placeholder="Quantity"  required class="single-input-primary">
                            </div>
                            <div class="input-group-icon mt-10">
                            <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                <div class="form-select" id="default-select">
                                    <select name="category">
                                        <option value="" disabled selected>Category</option>
                                        <option value="Sneakers">Sneakers</option>
                                        <option value="Ballet flats">Ballet flats</option>
                                        <option value="Kitten heels">Kitten heels</option>
                                        <option value="Sandals">Sandals</option>
                                        <option value="Beach Shoes">Beach Shoes</option>
                                        <option value="Flip flops">Flip flops</option>
                                        <option value="Hiking boots">Hiking boots</option>
                                        <option value="Moccasin">Moccasin</option>
                                        <option value="Platform shoe">Platform shoe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-10">
                                <textarea class="single-textarea single-input-primary" name="description" placeholder="Description" required></textarea>
                            </div>
                            <div class="mt-10">
                                <input type="text" name="width" placeholder="Width" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="height" placeholder="Height" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="depth" placeholder="Depth" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="weight" placeholder="Weight" required class="single-input-primary">
                            </div>
                            <div class="mt-10">
                                <input type="file" name="images"  required class="single-input-primary">
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" value="submit" name="create-product" class="primary-btn e-large mt-3">Submit Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Align Area -->


        <!-- start footer Area -->
        <footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>About Us</h6>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore dolore
                                magna aliqua.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>Newsletter</h6>
                            <p>Stay update with our latest</p>
                            <div class="" id="mc_embed_signup">

                                <form target="_blank" novalidate="true"
                                    action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                    method="get" class="form-inline">

                                    <div class="d-flex flex-row">

                                        <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                            required="" type="email">


                                        <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
                                                aria-hidden="true"></i></button>
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                                type="text">
                                        </div>

                                        <!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
                                    </div>
                                    <div class="info"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-6 col-sm-6">
                        <div class="single-footer-widget mail-chimp">
                            <h6 class="mb-20">Instragram Feed</h6>
                            <ul class="instafeed d-flex flex-wrap">
                                <li><img src="../../public/img/i1.jpg" alt=""></li>
                                <li><img src="../../public/img/i2.jpg" alt=""></li>
                                <li><img src="../../public/img/i3.jpg" alt=""></li>
                                <li><img src="../../public/img/i4.jpg" alt=""></li>
                                <li><img src="../../public/img/i5.jpg" alt=""></li>
                                <li><img src="../../public/img/i6.jpg" alt=""></li>
                                <li><img src="../../public/img/i7.jpg" alt=""></li>
                                <li><img src="../../public/img/i8.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>Follow Us</h6>
                            <p>Let us be social</p>
                            <div class="footer-social d-flex align-items-center">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                    <p class="footer-text m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved | This template
                        is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </footer>
        <!-- End footer Area -->


        <script src="../../public/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="../../public/js/vendor/popper.min.js"></script>
        <script src="../../public/js/vendor/bootstrap.min.js"></script>
        <script src="../../public/js/jquery.ajaxchimp.min.js"></script>
        <script src="../../public/js/jquery.nice-select.min.js"></script>
        <script src="../../public/js/jquery.sticky.js"></script>
        <script src="../../public/js/nouislider.min.js"></script>
        <script src="../../public/js/jquery.magnific-popup.min.js"></script>
        <script src="../../public/js/owl.carousel.min.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="../../public/js/gmaps.min.js"></script>
        <script src="../../public/js/main.js"></script>
</body>

</html>