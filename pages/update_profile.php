<?php
session_start();
include "../common/header.php";
require "../common/database.php";

if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("Location: Login.php");
}

$userid = $_SESSION['userid'];

// Fetch existing user data
$sql = "SELECT * FROM userdata WHERE id=$userid";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Fetch country and state data for dropdowns
$sqlCountryList = "SELECT * FROM country";
$countryListResult = mysqli_query($conn, $sqlCountryList);

$sqlStateList = "SELECT * FROM state";
$stateListResult = mysqli_query($conn, $sqlStateList);

if (!$user) {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $countryId = mysqli_real_escape_string($conn, $_POST['country']);
    $stateId = mysqli_real_escape_string($conn, $_POST['state']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Update user data
    $updateSql = "UPDATE userdata SET name='$name', email='$email', country_id=$countryId, state_id=$stateId, date_of_birth='$dob', gender='$gender' WHERE id=$userid";

    if (mysqli_query($conn, $updateSql)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


  
<form action="update_profile.php" method="post" class="form-control  text-center  ">
    <div class=" container d-flex  justify-content-between  flex-wrap">
    <div class="">
        <div>
        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        </div><br><br><br>

        <div>
        <label class="form_label" for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div><br><br><br>

        

        <div>
        <label for="country">Country:</label>
        <select id="country" class="form-select" name="country">
        <?php
        while ($country = mysqli_fetch_assoc($countryListResult)) {
        echo "<option value=\"{$country['cid']}\" " . ($country['cid'] == $user['country_id'] ? 'selected' : '') . ">{$country['cname']}</option>";
        }
        ?>
        </select>
        </div>
       
        
    </div>

    <div>
        <div>
        <label for="state">State:</label>
        <select class="form-select" id="state" name="state"> 
              
              </select>
        </div>
        <br><br><br>
        <div>
        <label for="dob">Date of Birth:</label>
        <input class="form-control" type="date" id="dob" name="dob" value="<?php echo $user['date_of_birth']; ?>">
        </div>
        <br><br><br>
        <div>
        <label for="gender">Gender:</label>
        <select class="form-select" id="gender" name="gender">
            <option value="Male" <?php echo ($user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Female</option>
            
        </select>
        </div>
       
    </div>
    </div>
    <button class="btn btn-success" type="submit" name="update_profile">Update Profile</button>
</form>
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
</body>
</html>
