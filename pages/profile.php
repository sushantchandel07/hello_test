<?php
require "../controllers/controller.updateprofile.php";
?>
<div class="profile-main-section-image">
      <img src="../photos/Rectangle 619.png " alt="Image" width="100%" />
    </div>
    <div class=" container profile-content-1 d-flex justify-content-between flex-wrap">
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
         
          <a href="gallery_display.php"><button class="profile-button m-2">Album</button></a>
      </div>
    </div>
    <hr />
    <div class="main-profile d-flex justify-content-center  ">
      <div class="profile-card text-center">
      <div class="profile-card text-center">
     <?php 
    if (!empty($profile_image)){
        echo '<img src="' . $profile_image . '" alt="Profile Image" class="profile-image card-img-profile border rounded-circle"
         style="width: 150px; height: 150px;" />';
    } else {
        echo '<img src="https://as2.ftcdn.net/v2/jpg/05/89/93/27/1000_F_589932782_vQAEAZhHnq1QCGu5ikwrYaQD0Mmurm0N.webp" 
        alt="Default Profile Image" class="profile-image card-img-profile border rounded-circle" style="width: 150px; height: 150px;" />';
    }
    ?> 
</div>
    <form method="post" enctype="multipart/form-data">
      <input type="file" name="profile_image" accept="image/*" required/>
      <br><br>
      <button class="btn btn-primary" type="submit" name="upload_image">Upload Image</button>
      <button class="btn btn-danger" type="button" id="deleteImageBtn">Delete Image</button>
    </form>
      <div class="profile-card-body">
          <h3 class="profile-name"><?php echo ucfirst($name)?></h3>
          <p class="profile-email"><?php echo ucfirst($email)?></p>
          <p class="profile-number"><?php echo $phone ?></p>
          <a href="update_profile.php"><button class="btn btn-primary">Edit profile</button></a>
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
            <li><?php echo  $email ?></li>
            <li><?php echo $dob ?></li>
            <li><?php  echo ucfirst($hobbies) ?></li>
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




