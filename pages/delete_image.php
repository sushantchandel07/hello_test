<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $userId = $_SESSION['userid'];
    $imageId = $_POST['image_id'];

    // Retrieve image path before deleting from the database
    $getImagePathQuery = "SELECT image_path FROM albums WHERE user_id = $userId AND album_id = $imageId";
    $imagePathResult = mysqli_query($conn, $getImagePathQuery);

    if ($imagePathResult && mysqli_num_rows($imagePathResult) > 0) {
        $imagePathRow = mysqli_fetch_assoc($imagePathResult);
        $imagePath = $imagePathRow['image_path'];

        // Delete the image file from the upload folder
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Construct the DELETE query
    $sql = "DELETE FROM albums WHERE user_id = $userId AND album_id = $imageId";

    // Execute the DELETE query
    if (mysqli_query($conn, $sql)) {
        // Redirect to the gallery display page after successful deletion
        header("Location: gallery_display.php");
        exit();
    } else {
        //we Handle errors if the DELETE query fails
        echo "Error deleting image: " . mysqli_error($conn);
    }
} else {
    // Redirect to the login page if the user is not logged in or if the request is not a POST request
    header("Location: Login.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>