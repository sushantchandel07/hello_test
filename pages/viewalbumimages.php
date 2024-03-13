<?php
include "../common/header.php";
require "../common/database.php";
if(isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
    // Query the database to fetch images associated with the album ID
    $query = "SELECT * FROM `images` WHERE `album_id`='$album_id'";
    $result = mysqli_query($conn, $query);
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
<a href="addalbumimages.php?album_id=<?php echo $album_id; ?>" ><button class="create-album">Add Images</button></a>
</div>
<div class="container">
    <a href="gallerydisplay.php"><button class="btn btn-primary">Back</button></a>
</div>
<div class="container">
    <h1>View Album</h1>
    <div class="row">
        <?php
        // Loop through each image and display it
        while ($image = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top fixed-image" src="<?php echo $image['filepath']; ?>" alt="Album Image">
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
} else {
    // Redirect to gallery page if album ID is not provided
    header("Location: gallerydisplay.php");
    exit();
}
include "../common/footer.php";
?>