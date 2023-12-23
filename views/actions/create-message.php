<?php
include '../../database/config.php';
session_start();
if(isset($_POST['submit'])){
    $user_id = $_SESSION['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    if(empty($_SESSION['id'])){
        echo "<script>alert('Please login'); </script>";
        echo "<script> window.location.href: '../login.php'; </script>";
        exit;
    }
    if($username != $_SESSION['username']){
        echo "<script>alert('Wrong username!'); </script>";
        echo "<script> window.location.href = '../contact.php'; </script>";
        exit;
    }
    if($email != $_SESSION['email']){
        echo "<script>alert('Wrong email!'); </script>";
        echo "<script> window.location.href = '../contact.php'; </script>";
        exit;
    }
    
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
        
        $sql = "INSERT INTO message(user_id,subject,message) VALUES(:a,:b,:c)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':a', $user_id);
        $stmt->bindParam(':b', $subject);
        $stmt->bindParam(':c', $message);
        if($stmt->execute()) {
            echo "<script>alert('Thank you for sending us a message!'); </script>";
            echo "<script> window.location.href = '../contact.php'; </script>";
        } else {
            echo "<script>alert('Message Failed!'); </script>";
        }
    
}

?>