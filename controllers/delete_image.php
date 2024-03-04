<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $imageId = $_POST['image_id'];
    // Construct the DELETE query
    $sql = "DELETE FROM albums WHERE user_id = $userId AND album_id = $imageId";
    // Execute the DELETE query
    if (mysqli_query($conn, $sql)) {
        // Redirect to the gallery display page after successful deletion
        header("Location: ../pages/gallery_display.php");
        exit();
    } else {
        // Handle errors if the DELETE query fails
        echo "Error deleting image: " . mysqli_error($conn);
    }
} else {
    // Redirect to the login page if user is not logged in or if the request is not a POST request
    header("Location: ../pagesLogin.php");
    exit();
}
// Close the database connection
mysqli_close($conn);
?>
