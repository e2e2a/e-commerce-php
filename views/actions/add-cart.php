<?php
include '../../database/config.php';
session_start();
//ID's declare
$id = $_SESSION['id'];
$user_id = $id ?? null;
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
    if (empty($product_id)) {
        header("Location: ../404.php");
        exit;
    }

// Check if the main cart array exists in the session
if (!isset($_SESSION['carts'])) {
    $_SESSION['carts'] = [];
}

// Check if a specific cart for a user exists
 // Use null coalescing operator
if (!isset($_SESSION['carts'][$user_id])) {
    $_SESSION['carts'][$user_id] = [];
}

// Add the product to the user's cart
$_SESSION['carts'][$user_id][] = $product_id;

// Insert into the cart table
$qty = 1;

    $stmt = $con->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);
	$stmt->bindParam(':quantity', $qty);
    if($stmt->execute()){
		echo '<script> window.location.href = "../index.php"; </script>';
        exit;
	}else{
		echo '<script> window.location.href = "../500.php"; </script>';
        exit;
	}



?>