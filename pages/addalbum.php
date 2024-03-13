<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../common/header.php";
require "../common/database.php";
if(isset($_POST["submit"])) {
    $album_name = $_POST["album_name"];
    $user_id = $_SESSION['userid'];
    // Handle image uploads
    if(isset($_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'][0])) {
        $file_name = $_FILES['uploadfile']['name'][0];
        $file_tmp = $_FILES['uploadfile']['tmp_name'][0];
        $file_type = $_FILES['uploadfile']['type'][0];
        // Specify the directory to which the file will be uploaded
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($file_name);
        // Move the uploaded file to the specified directory
        if(move_uploaded_file($file_tmp, $target_file)) {
            // Insert album information into the database
            $query = "INSERT INTO `album2`(`user_id`, `album_title`, `cover_image`) VALUES ('$user_id', '$album_name', '$target_file')";
            mysqli_query($conn, $query);
            echo "Album created successfully.";
            header("Location: gallerydisplay.php"); // Redirect to gallery display page
            exit();
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Please upload at least one image.";
    }
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
        <a href="gallerydisplay.php"><button class="profile-button">Album</button></a>
    </div>
</div>
<hr />
<div class="container">
    <a href="addalbum.php"><button class="create-album">Create album</button></a>
</div>
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