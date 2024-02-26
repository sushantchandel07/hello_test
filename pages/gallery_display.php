<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrapproject</title>
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
    <!--header-->
    <?php include "../common/header.php" ?>
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
if (!isset($_SESSION['userid']) || empty($_SESSION['userid'])) {
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
        echo "<h2>$albumName</h2>";
        echo "<div class='album-images'>";
        while ($imageRow = mysqli_fetch_assoc($resultImages)) {
            $imageId = $imageRow['album_id'];
            $imagePath = $imageRow['image_path'];
            echo "<img src='$imagePath' class='imagestyle' style='width: 400px; height: 400px; display:flex; flex:column;'  alt='Album Image' />";
            echo "<form method='post' action='delete_image.php'>";
            echo "<input type='hidden' name='image_id' value='$imageId' />";
            echo "<button type='submit' class='btn btn-danger'>Delete</button>";
            echo "</form>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No albums found.</p>";
}
mysqli_close($conn);
?>
<?php include "../common/footer.php" ?>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>











