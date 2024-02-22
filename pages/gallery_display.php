<?php   
session_start();

require "../common/database.php";

if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("Location: Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bootstrapproject</title>
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
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px;
        }
        .gallery img {
            height: 400px;
            width: calc(400px); 
            margin: 5px;
        }
    </style>
</head>
<body>

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
    <div class="gallery">
        <?php
        require "../common/database.php";
        $query = "SELECT * FROM gallery";
        $data = mysqli_query($conn, $query);
        $total = mysqli_num_rows($data);

        if ($total != 0) {
            $count = 0; 
            while ($result = mysqli_fetch_assoc($data)) {
                echo "<form method='post' action='delete_image.php'>
                        <input type='hidden' name='id' value='" . $result['id'] . "'>
                        <input type='hidden' name='picsource' value='" . $result['picsource'] . "'>
                        <input type='hidden' name='picname' value='" . $result['picname'] . "'>
                        <img src='" . $result['picsource'] . "' alt='" . $result['picname'] . "'>
                        <h2>" . $result['picname'] . "</h2>
                        <button class='border border-rounded  btn-danger deletebtn' type='submit' name='submit'>Delete Image</button>
                      </form>";

              
                $count++;

                if ($count % 3 == 0) {
                    echo "</div><div class='gallery'>";
                }
            }
        }
        ?>
    </div>
</body>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
></script>
</html>
