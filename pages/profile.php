<?php
session_start();
require "../common/database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_image'])) {
    $userid = $_SESSION['userid'];
    $sql = "SELECT profile_image_path FROM userdata WHERE id=$userid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $existingImagePath = $row['profile_image_path'];
    if (!empty($existingImagePath) && file_exists($existingImagePath)) {
        unlink($existingImagePath);
        $sql = "UPDATE userdata SET profile_image_path=NULL WHERE id=$userid";
        if (mysqli_query($conn, $sql)) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }else {
      echo "Profile image not found.";
  }
    $uploadDir = "../uploads/";
    $profileImage = $_FILES['profile_image']['name'];
    $tempName = $_FILES['profile_image']['tmp_name'];
    $imagePath = $uploadDir . $profileImage;
    if (move_uploaded_file($tempName, $imagePath)) {
        $sql = "UPDATE userdata SET profile_image_path='$imagePath' WHERE id=$userid";
        if (mysqli_query($conn, $sql)) {
            header("Refresh:0");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}
if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("Location: Login.php");
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM userdata WHERE id=$userid";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
if ($user) {
    $profile_image = $user['profile_image_path'];
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $gender = $user['gender'];
    $dob = $user['date_of_birth'];
} else {
    header("Location: login.php");
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="../css/style.css"/>
  </head>
  <body class="d-flex flex-column min-vh-100">
  <!--header-->
  <?php include "../common/header.php" ?>
  <!--main section-->
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
      <div class="prodfile-para profile-btn">
      <a href="profile.php"><button class="profile-button m-2">
          Profile</button></a>
          <!-- <a href="album.php"><button class="profile-button m-2">Images</button></a> -->
          <a href="addalbum.php"><button class="profile-button m-2">Album</button></a>
      </div>
    </div>
    <hr />
    <div class="main-profile d-flex justify-content-center  ">
      <div class="profile-card text-center ">
      <div class="profile-card text-center">
    <?php
    if (!empty($profile_image)) {
        echo '<img src="' . $profile_image . '" alt="Profile Image" class="profile-image card-img-profile border rounded-circle" style="width: 150px; height: 150px;" />';
    } else {
        echo '<img src="https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.webp" alt="Default Profile Image" class="profile-image card-img-profile border rounded-circle" style="width: 150px; height: 150px;" />';
    }
    ?>
</div>
      <form method="post" enctype="multipart/form-data">
      <input type="file" name="profile_image" accept="image/*" />
      <br><br>
      <button class="btn btn-primary" type="submit" name="upload_image">Upload Image</button>
      <button class="btn btn-danger" type="button" id="deleteImageBtn">Delete Image</button>
  </form>
      <div class="profile-card-body">
          <h3 class="profile-name"><?php echo $name?></h3>
          <p class="profile-email"><?php echo $email ?></p>
          <p class="profile-number"><?php echo $phone ?></p>
      </div>
    </div> 
      <div class="d-flex">
        <div class="profile-list">
          <ul>
            <li>Name</li>
            <li>Gender</li>
            <li>Phone</li>
            <li>Email</li>
            <li>DOB</li>
          </ul>
        </div>
        <div class="profile-list">
          <ul>
            <li><?php echo $name?></li>
            <li><?php echo $gender ?></li>
            <li><?php echo $phone ?></li>
            <li><?php echo $email ?></li>
            <li><?php echo $dob ?></li>
          </ul>
        </div>
      </div>
    </div>
    <?php include "../common/footer.php" ?>
  </body>
  <script>
    document.getElementById("deleteImageBtn").addEventListener("click", function() {
        
        if (confirm("Are you sure you want to delete your profile image?")) {
          
            window.location.href = "delete_profile.php";
        }
    });
</script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>



