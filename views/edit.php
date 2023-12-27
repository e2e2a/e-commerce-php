<?php
include '../database/config.php';
session_start();
$pageTitle = 'EDIT | SHOPEE';
if (empty($_SESSION['id']) || $_SESSION['id'] == 1) {
    $id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
    if (empty($id)) {
        header("Location: 404.php");
        exit;
    }
} elseif (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    header("Location: 404.php");
    exit;
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
   
        $updateStmt = $con->prepare("UPDATE users SET username=:username, fullname=:fullname, email=:email, birthdate=:birthdate WHERE user_id=:id");
        $updateStmt->bindParam(':username', $username);
        $updateStmt->bindParam(':fullname', $fullname);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->bindParam(':birthdate', $birthdate);
        $updateStmt->bindParam(':id', $id);
        if ($updateStmt->execute()) {
            echo '<script>alert("Profile has been updated!");</script>';
        } else {
            echo '<script>alert("Update Failed!");</script>';
        }
}


            
$stmt = $con->prepare('SELECT * FROM users WHERE user_id=:id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

include_once '../templates/edit-template.php';
?>

