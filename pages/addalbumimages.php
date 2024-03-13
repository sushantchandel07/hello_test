<?php
include "../common/header.php";
require "../common/database.php";
// Initialize a variable to hold the album ID
$album_id = null;
// Check if form is submitted
if(isset($_POST["submit"])) {
    // Retrieve album ID from the URL parameter
    $album_id = $_GET['album_id'];
    // Handle image uploads
    if(isset($_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'][0])) {
        $file_count = count($_FILES['uploadfile']['name']);
        for($i = 0; $i < $file_count; $i++) {
            $file_name = $_FILES['uploadfile']['name'][$i];
            $file_tmp = $_FILES['uploadfile']['tmp_name'][$i];
            $file_type = $_FILES['uploadfile']['type'][$i];
            // Specify the directory to which the file will be uploaded
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($file_name);
            // Move the uploaded file to the specified directory
            if(move_uploaded_file($file_tmp, $target_file)) {
                // Insert the file path into the database
                $query_insert_image = "INSERT INTO `images` (`album_id`, `filepath`) VALUES ('$album_id', '$target_file')";
                mysqli_query($conn, $query_insert_image);
            } else {
                echo "Failed to upload file.";
            }
        }
        // Redirect to view_album.php after successful upload
        header("Location: viewalbumimages.php?album_id=$album_id");
        exit(); // Ensure that no further code is executed after redirection
    }
}
?>
<div class="container mt-5">
<div class="container d-flex justify-content-between">
    <h1>Add Images</h1>
    <a href="gallerydisplay.php"><button class="btn btn-primary">Back</button></a>
</div>
    <div class=" border p-5 m-5">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="uploadfile">Select Images:</label>
            <input type="file" class="form-control-file" name="uploadfile[]" accept="image/*" multiple required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-5">Upload Images</button>
</div>
    </form>
</div>
<?php include "../common/footer.php"; ?>