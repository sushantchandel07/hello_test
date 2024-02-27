<?php
session_start(); 
require "../common/database.php";

function send_password_reset($get_name ,$get_email , $token){
    
}



if(isset($_POST['password_reset_link'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM userdata WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query( $conn, $check_email );
    
    if(mysqli_num_rows($check_email_run)>0){
        $row =mysqli_fetch_array($check_email_run);
        $get_name =$row['name'];
        $get_email=$row['email'];

        $update_token = "UPDATE userdata SET verify_token ='$token'WHERE email= '$get_email' ";
        $update_token_run= mysqli_query($conn , $update_token);

        if( $update_token_run == true) {
            send_password_reset($get_name ,$get_email , $token);
            $_SESSION['status']="we email you password reset link";
            header('Location: password-reset-link.php');
            exit(0);
        }
        else{
            $_SESSION['status']="something went wrong";
            header('Location: password-reset-link.php');
            exit(0);
        }
    }else{
        $_SESSION['status']="no email found";
        header('Location: password-reset-link.php');
        exit(0);
    }




}
?>