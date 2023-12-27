<?php
include '../database/config.php';
session_start();
$pageTitle = 'LOGIN | SHOPEE';
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $con->prepare("SELECT * FROM users Where email=:a and password=:b");
    $stmt->bindParam(':a', $email);
    $stmt->bindParam(':b', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && $result['email'] == 'admin@gmail.com'){
        $_SESSION['id'] = $result['user_id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        header('location:admin/tables.php');
        exit;
    } else{
    
    if($result) {
        $_SESSION['id'] = $result['user_id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        header('location:index.php');
        exit;
    } else{
        echo '<script>alert("Invalid Email or Password!"); </script>';
    }
}
} 
	include_once '../templates/login-template.php';
?>



