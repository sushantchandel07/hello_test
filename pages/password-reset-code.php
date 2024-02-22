<?php   
session_start();
require "../common/database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();  
    $mail->SMTPAuth   = true;   
    $mail->Host       = 'smtp.example.com';   
    $mail->Username   = 'sushant.webethics@gmail.com';                             
    $mail->Password   = 'Webethics@2024';      
    $mail->SMTPSecure = "tls";           
    $mail->Port       = 465;   
    
    $mail->setFrom('sushant.webethics@gmail.com', $get_name);
    $mail->addAddress($get_email);   
    $mail->isHTML(true);               
    $mail->Subject = 'reset my password';

    $email_template = "
    <h2>hello</h2>
    <h3>You requested to reset your password for the account associated with this email address.</h3><br/>
    <p>You are receiving this email because you (or someone else) have requested the reset of the password for your account</p>
    <a href='http://localhost/bootstrap-project/pages/resetpassword.php/password-changed.php?token=$token&email=$get_email'>Click here to reset your Password </a><br/><br/>
    ";

    $mail->Body = $email_template;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());
    $check_email = "SELECT email FROM  userdata WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);
    
    if(mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row["name"];
        $get_email = $row["enmail"];

        $update_token = "UPDATE userdata SET password='$token' WHERE email='$email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run){
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "Password reset email sent";
            header("location: signup.php");
            exit(0);
        } else { 
            $_SESSION['status'] = "Something went wrong with updating the token";
            header("location: signup.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No email found";
        header("location: signup.php");
        exit(0);
    }
}
?>
