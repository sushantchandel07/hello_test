<?php
session_start(); 
include "../common/header.php";  
require "../common/database.php";
$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    if (empty($_POST["email"])) {
        $emailErr ="Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST['password']);
    }
} 
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!$conn) {
        die('Connection Failed' . mysqli_error());
    }

    $sql = "SELECT * FROM userdata WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($user) {
    if(password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['userid'] = $user['id'];
        header("Location: profile.php");
        }elseif(!empty($_POST['password'])) {
        $wrongpassword = "Wrong password";
        }
    } else {
        $loginerror = "User not found"; 
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}
?>