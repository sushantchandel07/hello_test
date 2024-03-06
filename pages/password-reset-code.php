<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); 
require "../common/database.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function send_password_reset($get_name ,$get_email , $token){

    $mail = new PHPMailer(true);

    $mail->isSMTP();                                                               
    $mail->SMTPAuth   = true;
    
    $mail->Host       = 'ssl://smtp.gmail.com'; 
    $mail->Username   = 'developers.webethics@gmail.com';                     
    $mail->Password   = 'julfuupgunobirtu';                               
    $mail->SMTPSecure = 'tls';            
    $mail->Port       = 465;      

    $mail->setFrom('sushant.webethics@gmail.com', $get_name);
    $mail->addAddress($get_email);  

    $mail->isHTML(true);                                  
    $mail->Subject = 'Mail send from carsafe';

    $email_template ="
      <h2>hello</h2>
      <h5>your are resiving this email because $get_name we recevied a password request from you</h5>
      <a href='http://localhost/bootstrapproject2/hello_test/pages/resetpassword.php?token=$token&email=$get_email'>click me</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
}

// here it is checking that password_reset_link exit
if(isset($_POST['password_reset_link'])) {
    // here we are using mysqli_real_escape_string for mysqli injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // here i genrate a token
    $token = md5(rand());
    // here i select email and name from database     
    $check_email = "SELECT name, email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);
    // here i check if that user exist in database  or not
    if (mysqli_num_rows($check_email_run) > 0) 
    {

        $row = mysqli_fetch_assoc($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token ='$token' WHERE email= '$get_email' ";
        $update_token_run = mysqli_query($conn, $update_token);

        if ($update_token_run == true) 
        {
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['statussusccess'] = "We mailed you a password reset link";
            header('Location: forgetpassowrd.php');
            exit(0);
        } 
        else 
        {
            $_SESSION['status'] = "Something went wrong";
            header('Location: forgetpassowrd.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] ="No Email found";
        header('Location: forgetpassowrd.php');
        exit(0);
    }
}
// 
if (isset($_POST['password_update'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);

    if (!empty($email) && !empty($new_password) && !empty($confirm_password)) 
    {
       // Check if the token is valid and not expired
       $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' AND email='$email' LIMIT 1";
       $check_token_run = mysqli_query($conn, $check_token);

    if (mysqli_num_rows($check_token_run) > 0) 
    {
        if ($new_password === $confirm_password) 
        {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password = "UPDATE users SET password = '$hashed_password', verify_token = NULL WHERE email= '$email' LIMIT 1";
                $_update_password_run = mysqli_query($conn, $update_password);

            if ($_update_password_run) 
            {
                    $_SESSION['statussusccess'] = "New password successfully updated";
                    header("Location: Login.php");
                    exit(0);
            } 
            else 
            {
                    $_SESSION['status'] = "Something went wrong";
                    header("Location: resetpassword.php?token=$token&email=$email");
                    exit(0);
            }
            } 
            else 
            {
                $_SESSION['status'] = "Password and confirm password do not match";
                header("Location: resetpassword.php?token=$token&email=$email");
                exit(0);
            }
    } 
    else 
    {
            $_SESSION['status'] = "Invalid token or email";
            header("Location: resetpassword.php");
            exit(0);
    }
    } 
    else 
    {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: resetpassword.php");
        exit(0);
    }
}  
else 
{
    if (isset($_GET['token']) && isset($_GET['email'])) {
        $token = $_GET['token'];
        $email = $_GET['email'];

        // Check if the token is valid and not expired
        $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' AND email='$email' LIMIT 1";
        $check_token_run = mysqli_query($conn, $check_token);

        if (mysqli_num_rows($check_token_run) > 0) {
            include 'resetpassword.php';
            exit(0);
        } else {
            $_SESSION['status'] = "Invalid token or email";
            header("Location: resetpassword.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No token available";
        header("Location: resetpassword.php");
        exit(0);
    }
}
?>