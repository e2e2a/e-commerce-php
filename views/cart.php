<?php
include '../database/config.php';
session_start();
$pageTitle = 'CART | SHOPEE';
$user_id = $_SESSION['id'];
$sql = "SELECT
            cart.cart_id,
            cart.user_id,
            cart.product_id,
            cart.quantity,
            products.product_name,
            products.price,
            products.images,
            products.description
        FROM
            cart
        JOIN
            users ON cart.user_id = users.user_id
        JOIN
            products ON cart.product_id = products.product_id
        WHERE
            cart.user_id = :user_id";

$stmt = $con->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$result_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
	include_once '../templates/partials/header.php';
	include_once '../templates/partials/nav-bar.php';
?>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shopping Cart</h1>
                <nav class="d-flex align-items-center">
                    <a href="indexphp">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="categoryphp">Cart</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalAmount = 0;
                    if($result_cart > 0) {
						foreach ($result_cart as $row){
                            $total = $row['price'] * $row['quantity'];
                            
                        echo '<tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img class="img-fluid img-thumbnail" style="width: 100px; height: 100px;" src="../public/img/product/'.$row['images'].'" alt="">
                                        </div>
                                        <div class="media-body">
                                            <p>'.$row['product_name'] . '</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>Php '.$row['price'] . '</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="number" name="qty" maxlength="12" value="'.$row['quantity'] . '" class="input-text qty">
                                        
                                    </div>
                                </td>
                                <td>
                                    <h5>Php '.$total.'</h5>
                                </td>
                                <td>
                                    <form method="post">
                                        <div class="btn-group" role="group" >
                                        <button type="submit" name="edit" class="btn btn-primary" value="' . $row['product_id'] . '">UPDATE</button>
                                        <input type="hidden" name="delete_type" value="products">
                                        <button type="submit" name="delete" class="btn btn-danger" value="' . $row['product_id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>';
                            $totalAmount += $total;
                            }
                            
                        }
                        
                        ?>

                        <tr class="bottom_button">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="cupon_text d-flex align-items-center">
                                    <input type="text" placeholder="Coupon Code">
                                    <a class="primary-btn" href="#">Apply</a>
                                    <a class="gray_btn" href="#">Close Coupon</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>Php <?php echo $totalAmount ?></h5>
                            </td>
                        </tr>

                        <tr class="out_button_area">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="#">Continue Shopping</a>
                                    <a class="primary-btn" href="#">Proceed to checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<?php
	include_once '../templates/partials/footer.php';
?>