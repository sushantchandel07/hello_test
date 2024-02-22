<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../common/database.php';

if(isset($_POST['submit'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../uploads/" . $filename;

    // Move the uploaded file to the destination folder
    move_uploaded_file($tempname, $folder);

    if($filename != "") {
        // Corrected SQL query to insert the file path into the 'picsource' column
        $query = "INSERT INTO gallery (picsource) VALUES ('$folder')";
        $data = mysqli_query($conn, $query);

        if($data) {
            echo "inserted";
        } else {
            echo "not inserted";
        }
    } else {
        echo "Please choose a file to upload.";
    }
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
    <!-- Add this form element inside your existing HTML structure -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="add-album-input-2">
            <label>Upload Images</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="file" name="uploadfile" accept="image/*" multiple required />
        </div>
        <br />
        <div class="add-album-button"><button name="submit" type="submit">Create Album</button></div>
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