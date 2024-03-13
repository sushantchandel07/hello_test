<?php
include "../common/header.php";
require "../common/database.php";
// Fetch albums from the database
$user_id = $_SESSION['userid'];
$query = "SELECT * FROM `album2` WHERE `user_id`='$user_id'";
$result = mysqli_query($conn, $query);
?>
<div class="album-section-image">
    <img src="../photos/Rectangle 619.png" alt="Image" width="100%" />
</div>
<div class="container profile-content-1 d-flex justify-content-between flex-wrap">
    <div class="profile-para">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quos
            maiores quia ullam<br />
            maxime eligendi ipsam aliquam totam at. Consequatur. Lorem ipsum dolor
            sit amet.
        </p>
    </div>
    <div class="prodfile-para">
        <a href="profile.php"><button class="profile-button m-2">Profile</button></a>
        <a href="gallerydisplay.php"><button class="profile-button m-2">Album</button></a>
    </div>
</div>
<hr />
<div class="container">
    <a href="addalbum.php"><button class="create-album">Create album</button></a>
</div>
<div class="container">
    <h1>Gallery</h1>
    <div class="row">
        <?php
        // Loop through each album and display its cover image and title
        while ($album = mysqli_fetch_assoc($result)) {
            $album_id = $album['id'];
        ?>
            <div class="col-md-4">
                <div class="">
                <a href="viewalbumimages.php?album_id=<?php echo $album_id; ?>"><img class="card-img-top fixed-image " src="<?php echo $album['cover_image']; ?>" alt="Album Cover"></a>
                    <div class="card-body d-flex justify-content-between mt-1">
                        <h5 class="card-title"><?php echo $album['album_title']; ?></h5>
                        <a href="delete_image.php?album_id=<?php echo $album_id; ?>" ><i class="fas fa-trash-alt delete-btn" data-album-id="<?php echo $album_id; ?>"></i></a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include "../common/footer.php"; ?>














