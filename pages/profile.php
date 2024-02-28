<?php
session_start();
include "../common/header.php" ; 
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

// here i add country  list from database and display it in select option using joins
$sqlcountry = "SELECT userdata.*, country.cname 
               FROM userdata
               JOIN country ON userdata.country_id = country.cid
               WHERE userdata.id = $userid";

$countryresult = mysqli_query($conn, $sqlcountry);

if ($countryuser = mysqli_fetch_assoc($countryresult)) {
    $country = $countryuser['cname']; 
}


// here i add state  list from database and display it in select option using joins
$sqlstate = "SELECT userdata.*, state.sname 
               FROM userdata
               JOIN state ON userdata.state_id = state.sid
               WHERE userdata.id = $userid";

$stateresult = mysqli_query($conn, $sqlstate);

if ($stateuser = mysqli_fetch_assoc($stateresult)) {
    $state = $stateuser['sname'];
}

if ($user) {
    $profile_image = $user['profile_image_path'];
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $gender = $user['gender'];
    $dob = $user['date_of_birth'];
    $hobbies = $user['hobbies'];
   
} else {
    header("Location: login.php");
}
mysqli_close($conn);
?>
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
          <a href="update_profile.php"><button class="btn btn-primary">edit profile</button></a>
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
            <li>Hobbies</li>
            <li>Country</li>
            <li>State</li>
          </ul>
        </div>
        <div class="profile-list">
          <ul>
            <li><?php echo ucfirst($name)?></li>
            <li><?php echo $gender ?></li>
            <li><?php echo $phone ?></li>
            <li><?php echo ucfirst($email) ?></li>
            <li><?php echo $dob ?></li>
            <li><?php  echo $hobbies ?></li>
            <li><?php  echo $country ?></li>
            <li><?php  echo $state ?></li>
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




