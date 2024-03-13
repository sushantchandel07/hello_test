<?php
include "../common/database.php";
// Check if album ID is provided in the URL
if(isset($_GET['album_id'])) {
    // Retrieve album ID from the URL parameter
    $album_id = $_GET['album_id'];
    // Check if the user confirmed deletion
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Delete the album from the database
        $query_delete_album = "DELETE FROM `album2` WHERE `id`='$album_id'";
        $query_delete_images = "DELETE FROM `images` WHERE `album_id`='$album_id'";
        mysqli_query($conn, $query_delete_album);
        mysqli_query($conn, $query_delete_images);
        // Redirect back to gallery display page
        header("Location: gallerydisplay.php");
        exit();
    } else {
        // Ask for confirmation before deletion
        echo "<script>
        var result = confirm('Are you sure you want to delete this album?');
        if(result) {
            window.location.href = 'delete_image.php?album_id=$album_id&confirm=yes';
        } else {
            window.location.href = 'gallerydisplay.php';
        }
      </script>";
        exit();
    }
} else {
    // Redirect to gallery page if album ID is not provided
    header("Location: gallerydisplay.php");
    exit();
}
?>