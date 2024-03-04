<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // here it check  if the user is logged in or not
    if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
        header("Location: Login.php");
        exit();
    }
    // here i add user id through session which start from login.php
    $userid = $_SESSION['userid'];
    $sql = "SELECT profile_image_path FROM userdata WHERE id=$userid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $existingImagePath = $row['profile_image_path'];
    if (!empty($existingImagePath) && file_exists($existingImagePath)) {
        if (unlink($existingImagePath)){ 
            $sql = "UPDATE userdata SET profile_image_path=NULL WHERE id=$userid";
            if (mysqli_query($conn, $sql)) {
                header("Location: profile.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting profile image.";
        }
    } else {
        echo "Profile image not found.";
    }
} else {
    header("Location: profile.php");
    exit();
}
mysqli_close($conn);
?>
