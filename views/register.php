<?php
include '../database/config.php';
$pageTitle = 'REGISTER | SHOPEE';

if(isset($_POST['create'])){
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
            echo "<script> window.location.href = 'login.php'; </script>";
        } else {
            echo "<script>alert('Registration Failed!'); </script>";
        }
    }
}
include_once '../templates/register-template.php';
?>





