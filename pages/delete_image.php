<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $imageId = $_POST['image_id'];
    $sql = "DELETE FROM albums WHERE user_id = $userId AND album_id = $imageId";
    if (mysqli_query($conn, $sql)) {
        header("Location: gallery_display.php");
        exit();
    } else {
        echo "Error deleting image: " . mysqli_error($conn);
    }
} else {
    header("Location: Login.php");
    exit();
}
mysqli_close($conn);
?>