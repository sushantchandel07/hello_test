<?php
include "../common/header.php";
require "../common/database.php";
// adding album  to database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_SESSION['userid'];
    //  get the data from form
    $albumName = mysqli_real_escape_string($conn, $_POST['album_name']);
    // upload directory
    $uploadDir = "../uploads/";
    $images = $_FILES['uploadfile'];
    foreach ($images['name'] as $key => $image) {
        $tempName = $images['tmp_name'][$key];
        $imagePath = $uploadDir . $image;
        move_uploaded_file($tempName, $imagePath);
        $sql = "INSERT INTO albums (user_id, album_name, image_path) VALUES ('$userid', '$albumName', '$imagePath')";
        mysqli_query($conn, $sql);
    }
    header("Location: gallery_display.php");
    exit();
}
?>
<div class="profile-main-section-image">
    <img src="../photos/Rectangle 619.png " alt="Image" width="100%"/>
</div>
<div class="profile-content-1 d-flex justify-content-evenly flex-wrap">
    <div class="profile-para">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quos
            maiores quia ullam<br/>
            maxime eligendi ipsam aliquam totam at. Consequatur. Lorem ipsum dolor
            sit amet.
        </p>
    </div>
    <div class="prodfile-para">
        <button class="profile-button">
            <a href="profile.php">Profile</a>
        </button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="profile-button"><a href="gallery_display.php">Images</a></button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="profile-button"><a href="addalbum.php">Album</a></button>
    </div>
</div>
<hr />
<div class="add-album border">
    <!-- Album creation form -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="add-album-input-2">
            <label for="album_name">Album Name:</label>
            <input class="border border-light" type="text" placeholder="Album Name" name="album_name" id="album_name" required>
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








