<?php
include "../common/header.php";
require "../common/database.php";
?>
    <div class="album-section-image">
        <img src="../photos/Rectangle 619.png " alt="Image" width="100%" />
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
        <a href="profile.php"><button class="profile-button m-2">
                Profile
        </button></a>
    <a href="gallery_display.php"><button class="profile-button m-2">
                Album
    </button></a>
        </div>
    </div>
    <hr />
    <div class="container">
        <a href="addalbum.php"><button class=" create-album">Create album</button></a>
    </div>
    <?php
$user_id = $_SESSION['userid']; 
$query = "SELECT * FROM `album2` WHERE `user_id`='$user_id'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    echo '<div class="container d-flex justify-content-evenly flex-wrap">';  // Start the container here
    while ($album = mysqli_fetch_assoc($result)){
    $album_id = $album['id'];
    $query_images = "SELECT * FROM `images` WHERE `album_id`='$album_id'";
    $result_images = mysqli_query($conn, $query_images);
    ?>
    <div class="album-cover" id="albumCover_<?php echo $album_id; ?>">
    <img src="<?php echo $album['cover_image']; ?>" alt="Album Cover" width="300">
    <h2><?php echo $album['album_title']; ?></h2>
    <button class="btn btn-danger" onclick="deleteAlbum(<?php echo $album_id; ?>)">Delete Album</button>
    </div>
        <!-- Modal for displaying other images -->
    <div class="modal" id="imageModal_<?php echo $album_id; ?>">
    <span class="close" onclick="closeModal(<?php echo $album_id; ?>)">&times;</span>
    <div class="modal-content-1">
    <?php while ($image = mysqli_fetch_assoc($result_images)) { ?>
    <div class="image">
    <img src="<?php echo $image['filepath']; ?>" alt="Album Image">
    </div>
    <?php } ?>
    </div>
    </div>
<?php
    }
    echo '</div>';  // End the container here
} else {
    echo "No albums found";
}
?>
<script>
    function deleteAlbum(album_id) {
    let confirmation = confirm("Are you sure you want to delete this album?");
    if(confirmation){
            // Redirect to the delete album page
        window.location.href = "delete_image.php?album_id=" + album_id;
    }
    }
    function openModal(album_id) {
        document.getElementById('imageModal_' + album_id).style.display = 'block';
    }
    // Function to close the modal
    function closeModal(album_id) {
        document.getElementById('imageModal_' + album_id).style.display = 'none';
    }
    // Event listeners for clicking on the cover images
    <?php
    // Add event listeners for each album cover
    $result = mysqli_query($conn, $query);
    while ($album = mysqli_fetch_assoc($result)) {
        $album_id = $album['id'];
    ?>
    document.getElementById('albumCover_<?php echo $album_id; ?>').addEventListener('click', function() {
        openModal(<?php echo $album_id; ?>);
    });
    <?php } ?>
</script>
<?php include "../common/footer.php"; ?>





















