<?php
include '../database/config.php';
session_start();
$pageTitle = 'EDIT | SHOPEE';
if (empty($_SESSION['id']) || $_SESSION['id'] != 1) {
    header("Location: 500.php");
    exit;
}
$id = isset($_GET['upcoming_id']) ? $_GET['upcoming_id'] : null;
if (empty($id)) {
    header("Location: 404.php");
    exit;
}
$stmt = $con->prepare('SELECT * FROM upcoming_products WHERE upcoming_id=:id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $depth = $_POST['depth'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];

    // Check if a new image is uploaded
    if (!empty($_FILES['images_upcoming']['name'])) {
        // File upload handling
        $uploadDir = '../../public/img/upcoming/';
        $uploadedFile = $_FILES['images_upcoming']['tmp_name'];
        $images = $_FILES['images_upcoming']['name'];
        $targetFile = $uploadDir . basename($images);

        // Check if file is uploaded successfully
        if (move_uploaded_file($uploadedFile, $targetFile)) {
            // Update product details with the new image
            $sql = "UPDATE upcoming_products SET product_name=:a, category=:b, price=:c, description=:d, images=:e, width=:f, height=:g, depth=:h, weight=:i, quantity=:j WHERE upcoming_id=:id";
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
            $stmt->bindParam(':id', $id);

            // Execute the query
            if ($stmt->execute()) {
                echo '<script>alert("Product updated successfully.");</script>';
                echo '<script>setTimeout(function(){window.location.href = "";}, 30); </script>';
            } else {
                echo '<script>alert("Error updating product.");</script>';
            }
        } else {
            echo '<script>alert("Error uploading file.");</script>';
        }
    } else {
        // Update product details without changing the image
        $sql = "UPDATE upcoming_products SET product_name=:a, category=:b, price=:c, description=:d, width=:f, height=:g, depth=:h, weight=:i, quantity=:j WHERE upcoming_id=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':a', $product_name);
        $stmt->bindParam(':b', $category);
        $stmt->bindParam(':c', $price);
        $stmt->bindParam(':d', $description);
        $stmt->bindParam(':f', $width);
        $stmt->bindParam(':g', $height);
        $stmt->bindParam(':h', $depth);
        $stmt->bindParam(':i', $weight);
        $stmt->bindParam(':j', $quantity);
        $stmt->bindParam(':id', $id);

        // Execute the query
        if ($stmt->execute()) {
            echo '<script>alert("Upcoming Product updated successfully.");</script>';
            echo '<script>setTimeout(function(){window.location.href = "";}, 30); </script>';
        } else {
            echo '<script>alert("Error updating product.");</script>';
        }
    }
}
include_once '../templates/edit-upcoming-template.php';
?>


