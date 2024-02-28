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
    $mail->Subject = 'mail send from carsafe';

    $email_template ="
      <h2>hello</h2>
      <h5>your are resiving this email because $get_name we recevied a password request from you</h5>
      <a href='http://localhost/bootstrapproject/hello_test/pages/resetpassword.php?token=$token&email=$get_email'>click me</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
}



if(isset($_POST['password_reset_link'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT name, email FROM userdata WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query( $conn, $check_email );
    
    if(mysqli_num_rows($check_email_run)>0){
        $row =mysqli_fetch_assoc($check_email_run);
        $get_name =$row['name'];
        $get_email=$row['email'];

        $update_token = "UPDATE userdata SET verify_token ='$token'WHERE email= '$get_email' ";
        $update_token_run= mysqli_query($conn , $update_token);

        if( $update_token_run == true) {
            send_password_reset($get_name ,$get_email , $token);
            $_SESSION['status']="we email you password reset link";
            header('Location: forgetpassowrd.php');
            exit(0);
        }
        else{
            $_SESSION['status']="something went wrong";
            header('Location: forgetpassowrd.php');
            exit(0);
        }
    }else{
        $_SESSION['status']="no email found";
        header('Location: forgetpassowrd.php');
        exit(0);
    }
}


if(isset($_POST['password_update'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
    $token = mysqli_real_escape_string($conn,$_POST['password_token']);

    if(!empty($email)&&!empty($new_password) && !empty($confirm_password)) {
        $check_token= "SELECT verify_token FROM userdata  WHERE verify_token='$token' LIMIT 1";
        $check_token_run = mysqli_query($conn, $check_token);

        if (mysqli_num_rows($check_token_run)>0){
            if($new_password===$confirm_password){
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password=  "UPDATE userdata SET password = '$hashed_password' WHERE email= '$email' LIMIT 1";
                $_update_password_run=mysqli_query($conn, $update_password);

                if($_update_password_run){
                    $_SESSION['status']="new password successfully updated";
                    header("Location:Login.php");
                    exit(0);
                }else{
                    $_SESSION['status']="something went wrong";
                    header("Location: resetpassword.php?token=$token&email=$email");
                    exit(0);
                }
            }else{
                $_SESSION['status']="password and confirm password does not match";
                header("Location: resetpassword.php?token=$token&email=$email");
                exit(0);
            }
        }else{
            $_SESSION['status']="invalid token";
            header("Location: resetpassword.php");
            exit(0);
        }
    }else{
        $_SESSION['status']="all field are mendetory";
        header("Location: resetpassword.php");
        exit(0);
    }
}else{
    if(isset($_GET['token']) && isset($_GET['email'])){
        $token = $_GET['token'];
        $email = $_GET['email'];

        $check_token= "SELECT verify_token FROM userdata  WHERE verify_token='$token' LIMIT 1";
        $check_token_run = mysqli_query($conn, $check_token);

        if (mysqli_num_rows($check_token_run)>0){
           
        }else{
            $_SESSION['status']="invalid token";
            header("Location: resetpassword.php");
            exit(0);
        }
    }else{
        $_SESSION['status']="no token avaliable";
        header("Location: resetpassword.php");
        exit(0);
    }
}
?>



