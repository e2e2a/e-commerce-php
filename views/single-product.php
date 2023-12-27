<?php
include '../database/config.php';
$pageTitle = 'PRODUCT DETAILS | SHOPEE';
$id = isset($_GET['productId']) ? $_GET['productId'] : null;
$up_id = isset($_GET['upcoming_id']) ? $_GET['upcoming_id'] : null;
// Redirect to home.php if the user ID is not provided
if (empty($id) && empty($up_id)) {
    header("Location: 404.php");
    exit;
}
if (!empty($id)) {
    $sql = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Process result for regular product
    if ($result) {
        include_once '../templates/partials/single-product-template.php';
    }else {
		header('location: 404.php');
		exit;
	}
}

if (!empty($up_id)) {
    $sql = "SELECT * FROM upcoming_products WHERE upcoming_id = :up_id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':up_id', $up_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Process result for upcoming product
    if ($result) {
        include_once '../templates/partials/single-upcoming-product-template.php';
    }else {
		header('location: 404.php');
		exit;
	}
}
?>



