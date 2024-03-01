<?php
session_start();
 include "../common/header.php";
?>
    <div class="album-section-image">
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
      <a href="profile.php"><button class="profile-button m-2">
          Profile
        </button></a>
        <a href="addalbum.php"><button class="profile-button m-2">
         Album
        </button></a>
      </div>
    </div>  
<hr/>
<?php
require "../common/database.php";
if (!isset($_SESSION['userid']) || empty($_SESSION['userid'])){
    header("Location: Login.php");
    exit();
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM albums WHERE user_id = $userid";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $albumId = $row['album_id'];
        $albumName = $row['album_name'];
        $sqlImages = "SELECT * FROM albums WHERE album_id = $albumId";
        $resultImages = mysqli_query($conn, $sqlImages);
        
        echo "<div class='album-images  '>";
        while ($imageRow = mysqli_fetch_assoc($resultImages)) {
            $imageId = $imageRow['album_id'];
            $imagePath = $imageRow['image_path'];
            echo "<div class='d-flex '>
            <div>
            <img src='$imagePath' class='imagestyle' style='width: 350px; height: 350px;'  alt='Album Image' />
            <h4>$albumName</h4>
            <form method='post' action='delete_image.php'>
            <input type='hidden' name='image_id' value='$imageId' />
            <button type='submit' id='deletealbum' class='btn btn-danger'>Delete</button>
            </form>
            </div>
            </div>";
          }
       
        echo "</div>";
    }
} else {
    echo "<p>No albums found.</p>";
}
mysqli_close($conn);
?>
<div>
</div>
<?php include "../common/footer.php" ?>

