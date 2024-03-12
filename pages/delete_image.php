<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
require "../common/database.php";

if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];

    // Retrieve image filenames associated with the album
    $getImagesQuery = "SELECT `filepath` FROM `images` WHERE `album_id`='$album_id'";
    $getImagesResult = mysqli_query($conn, $getImagesQuery);

    if ($getImagesResult) {
        while ($row = mysqli_fetch_assoc($getImagesResult)) {
            $filename = $row['filepath'];
            $filePath = "../uploads/" . $filename;
            // Delete the image file from the folder 
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                echo "Warning: Image file not found: $filename\n";
            }
        }
        
        // Delete images associated with the album from the 'images' table
        $deleteImagesQuery = "DELETE FROM `images` WHERE `album_id`='$album_id'";
        $deleteImagesResult = mysqli_query($conn, $deleteImagesQuery);

        // Delete the album from the 'album2' table
        $deleteAlbumQuery = "DELETE FROM `album2` WHERE `id`='$album_id'";
        $deleteAlbumResult = mysqli_query($conn, $deleteAlbumQuery);

        if ($deleteImagesResult && $deleteAlbumResult){
            // Deletion successful, redirect the user to a relevant page
            header("Location: gallery_display.php");
            exit();
        } else {
            // Handle deletion failure
            echo "Error deleting album. Please try again.";
        }
    } else {
        // Handle error retrieving image filenames
        echo "Error retrieving image filenames. Please try again.";
    }
} else {
    // Handle case when 'album_id' parameter is not set
    echo "Album ID is not set!";
}

// Close the database connection
mysqli_close($conn);
?>
