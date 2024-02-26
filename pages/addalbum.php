<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userid = $_SESSION['userid'];
    $albumName = mysqli_real_escape_string($conn, $_POST['album_name']);
    $uploadDir = "../uploads/";
    $images = $_FILES['uploadfile'];
    $albumDir = $uploadDir . $userid . "_" . time() . "/";
    mkdir($albumDir, 0777, true); // Create the directory if it doesn't exist
    // Loop through each uploaded image
    foreach ($images['name'] as $key => $image) {
        $tempName = $images['tmp_name'][$key];
        $imagePath = $albumDir . $image;
        // Move the image to the album directory
        move_uploaded_file($tempName, $imagePath);
        // Insert image information into the database
        $sql = "INSERT INTO albums (user_id, album_name, image_path) VALUES ('$userid', '$albumName', '$imagePath')";
        mysqli_query($conn, $sql);
    }
    // Redirect the user after creating the album
    header("Location: gallery_display.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bootstrap-project</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="d-flex flex-column min-vh-100">
<?php include "../common/header.php";?>
<div class="profile-main-section-image">
    <img src="../photos/Rectangle 619.png " alt="Image" width="100%" />
</div>
<div class="profile-content-1 d-flex justify-content-evenly flex-wrap">
    <div class="profile-para">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quos
            maiores quia ullam<br />
            maxime eligendi ipsam aliquam totam at. Consequatur. Lorem ipsum dolor
            sit amet.
        </p>
    </div>
    <div class="prodfile-para">
        <button class="profile-button">
            <a href="profile.php">Profile</a>
        </button>
        <button class="profile-button"><a href="gallery_display.php">Images</a></button>
        <button class="profile-button"><a href="addalbum.php">Album</a></button>
    </div>
</div>
<hr />
<div class="add-album border">
    <!-- Album creation form -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="add-album-input-2">
            <label for="album_name">Album Name:</label>
            <input type="text" name="album_name" id="album_name" required>
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
</body>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
></script>
</html>









