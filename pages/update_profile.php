<?php
require "../controllers/controller.updateprofile.php";

?>
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
<div class="container p-4 bg-secondary-subtle rounded mt-4 mb-4">
  <div>
    <h1>Update Profile</h1>
  </div>
<form method='post' action = "#" class='row g-3'>
  <div class='col-md-6'>
    <span>Username</span>
    <input class="form-control" type="text" id="name" name="name" value="<?php echo $user['name']; ?>">
  </div>
  <div class="col-md-6">
    <span>Date-of-Birth</span>
    <input class="form-control" type="date" id="dob" name="dob" value="<?php echo $user['date_of_birth']; ?>">
  </div>
  <div class='col-md-6'>
    <span>Gender</span>
    <select class="form-select" id="gender" name="gender">
            <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
        </select>
  </div>
  <div class='col-lg-6'>
    <span>Number</span>
    <input class='form-control' type = "text" id="" name="number" value="<?php echo $user['phone']; ?>" >
  </div>
  <div class="col-lg-6">
    <span>Country</span>
    <select id="country" class="form-select" name="country">
        <option>choose..</option>
        <?php
        while ($country = mysqli_fetch_assoc($countryListResult)) {
        echo "<option value=\"{$country['cid']}\" " . ($country['cid'] == $user['country_id'] ? 'selected' : '') . ">{$country['cname']}</option>";
        }
        ?>
        </select>
  </div>
  <div class='col-md-6'>
    <span>State</span>
    <select class="form-select" id="state" name="state">
        <option>choose..</option>
        <?php
        // Loop through the states fetched from the database
        while ($stateData = mysqli_fetch_assoc($stateListResult)) {
            // Check if the current state ID matches the user's state ID
            if ($stateData['sid'] == $user['state_id']) {
                // If it matches, set the selected attribute
                echo "<option value=\"{$stateData['sid']}\" selected>{$stateData['sname']}</option>";
            } else {
                echo "<option value=\"{$stateData['sid']}\">{$stateData['sname']}</option>";
            }
        }
        ?>
    </select>
</div>
<div class="form-group d-flex flex-wrap">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="reading" <?php echo (in_array('reading', explode(',', $user['hobbies']))) ? 'checked' : ''; ?>>
        <label class="form-check-label">Reading</label>
    </div>&nbsp;&nbsp;
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="traveling" <?php echo (in_array('traveling', explode(',', $user['hobbies']))) ? 'checked' : ''; ?>>
        <label class="form-check-label">Traveling</label>
    </div>&nbsp;&nbsp;
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="gaming" <?php echo (in_array('gaming', explode(',', $user['hobbies']))) ? 'checked' : ''; ?>>
        <label class="form-check-label">Gaming</label>
    </div>&nbsp;&nbsp;
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="eating" <?php echo (in_array('eating', explode(',', $user['hobbies']))) ? 'checked' : ''; ?>>
        <label class="form-check-label">Eating</label>
    </div>
</div>
        <div class='col-md-6'>
        <button class="btn btn-success" type="submit" name="update_profile">Update Profile</button>
      </div>
  </div>
</form>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function(){
        function loaddata(type,category_id){
          $.ajax({
            url:"load-cs.php",
            type:"POST",
            data:{type:type, id: category_id},
            success:function(data){
             if(type=="statedata"){
              $( "#state" ).html(data);
             }else{
              $("#country").append(data);
             }
            }
          })
        }
        loaddata();
        $("#country").on("change",function(){
          var country = $("#country").val();
          loaddata("statedata",country);
        })
      })
      </script>
<?php require "../common/footer.php" ?>