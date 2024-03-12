<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
include "../common/header.php";
require "../common/database.php";
if(isset($_POST["submit"])) {
    $album_name = $_POST["album_name"];
    $user_id = $_SESSION['userid'];
    $query = "INSERT INTO `album2`(`user_id`, `album_title`) VALUES ('$user_id','$album_name')";
    mysqli_query($conn, $query);
    $album_id = mysqli_insert_id($conn); // Get the last inserted ID
    $firstImage = true; 
    $targetdir = "../uploads/";
    foreach ($_FILES['uploadfile']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['uploadfile']['name'][$key];
        $file_tmp = $_FILES['uploadfile']['tmp_name'][$key];
        $targetfile = $targetdir . $file_name;
        move_uploaded_file($file_tmp, $targetfile);
        $filepath = $targetfile;
        // Insert image into images table
        $query = "INSERT INTO `images`(`album_id`, `filepath`) VALUES ('$album_id','$filepath')";
        mysqli_query($conn, $query);
        // If it's the first image, set it as the album cover image
        if ($firstImage) {
        $query = "UPDATE `album2` SET `cover_image`='$filepath' WHERE `id`='$album_id'";
        mysqli_query($conn, $query);
        $firstImage = false;
        }
    }
    // Redirect to gallery_display.php after the upload process is complete
    header("Location: gallery_display.php?album_id=$album_id");
    exit(); // Ensure code is not executed after redirection
}
?>
<div class="profile-main-section-image">
    <img src="../photos/Rectangle 619.png " alt="Image" width="100%"/>
</div>
<div class=" container profile-content-1 d-flex justify-content-between flex-wrap">
    <div class="profile-para">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quos
            maiores quia ullam<br/>
            maxime eligendi ipsam aliquam totam at. Consequatur. Lorem ipsum dolor
            sit amet.
        </p>
    </div>
    <div class="prodfile-para flex-wrap">
    <a href="profile.php"> <button class="profile-button">
            Profile
        </button>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="gallery_display.php"><button class="profile-button">Album</button></a>
    </div>
</div>
<hr />
<div class=" container add-album border">
    <!-- Album creation form -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="add-album-input-2">
            <label for="album_name">Album Name:</label>
            <input class=" border border-light" type="text" placeholder="Album Name" name="album_name" id="album_name" required>
        </div>
        <br />
        <div class="add-album-input-2">
            <label>Upload Images:</label>
            <input type="file" name="uploadfile[]" accept="image/*" multiple required />
        </div>
        <br />
        <div class="add-album-button">
            <button type="submit" name="submit">Create Album</button>
        </div>
    </form>
</div>
<!--footer-->
<?php include "../common/footer.php" ?>