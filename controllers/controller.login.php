<?php
include "../common/header.php";
require "../common/database.php";
$email = $password = "";
$emailErr = $passwordErr = "";
$loginerror = $wrongpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
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

    if (empty($emailErr) && empty($passwordErr)) {
        // Check if email exists before attempting to log in
        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $checkEmailResult = mysqli_query($conn, $checkEmailQuery);
        $emailExists = mysqli_num_rows($checkEmailResult) > 0;

        if ($emailExists) {
            // Continue with login validation
            $user = mysqli_fetch_array($checkEmailResult, MYSQLI_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['userid'] = $user['id'];
                header("Location: profile.php");
            } else {
                $wrongpassword = "Wrong password";
            }
        } else {
            $loginerror = "User not found";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
