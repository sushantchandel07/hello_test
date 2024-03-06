<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../controllers/controller.signup.php";
require "../common/database.php";
include "../common/header.php" ;
?>
  <!--main section-->
    <div class="section d-flex">
      <div class="section-image">
        <img class="section-image-2" src="../photos/signup.jpg"/>
      </div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-container">
          <div class="form heading">
            <div class="form-heading">
              <span class="text-success"><?php echo  $successmessage ? " <p>$successmessage</p>" : "" ?></span>
              <h3>Signup to your Account</h3>
            </div>
          </div>
          <br/>
          <div class="form">
            <div class="form-group">
              <label for="fullName">Full Name<span class="important">*</span></label>
              <input
                type="text"
                class="form-control"
                id="fullName"
                placeholder="Your full name"
                name="name"
                value="<?php echo htmlspecialchars($fullName); ?>"
              />
              <span class="error"><?php echo $fullNameErr; ?></span>
            </div>
            <br/>
            <div class="form-group">
              <label for="dob">Date of Birth<span class="important">*</span></label>
              <input type="date" class="form-control" id="dob" name="dob"  value="<?php echo htmlspecialchars($dob); ?>"/>
              <span class="error"><?php echo $dobErr;?></span>
            </div>
            <br />
            <div class="form-group">
              
            <label for="gender">Gender:</label>
            <select class="form-select" id="gender" name="gender">
              <option value="Choose..." <?php echo ($gender == 'Choose...') ? 'selected' : ''; ?>>Choose...</option>
              <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
              <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
              <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
            <span class="error"><?php echo $genderError; ?></span><br>
            </div>
            <div class="form-group">
             <label for="country">Country<span class="important">*</span></label>
             <select class="form-select" id="country" name="country"> 
             <option>choose..</option>
             <?php
             $sql = "SELECT * FROM country";
             $result = mysqli_query($conn, $sql);
             $selectedCountry = isset($_POST['country']) ? $_POST['country'] : ''; 
             echo "Selected Country: " . $selectedCountry;// Check if country is selected in the form submission

             if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
             $selected = ($row['cid'] == $selectedCountry) ? 'selected' : ''; // Set 'selected' attribute if this option matches the selected country
             echo '<option value="' . $row['cid'] . '" ' . $selected . '>' . $row['cname'] . '</option>';
            }
           }
        ?>
        </select>
        </div>
        <span class="error"><?php echo $countryErr;?></span>
        <br/>
        <div class="form-group">
        <label for="state">State<span class="important">*</span></label>
        <select class="form-select" id="state" name="state"> 
        <?php
        $selectedState = isset($_POST['state']) ? $_POST['state'] : ''; // Check if state is selected in the form submission

        // Fetch states based on the selected country
        if (!empty($selectedCountry)) {
            $stateSql = "SELECT * FROM state WHERE country_id = $selectedCountry";
            $stateResult = mysqli_query($conn, $stateSql);

            if ($stateResult->num_rows > 0) {
                while ($stateRow = $stateResult->fetch_assoc()) {
                    $selectedStateOption = ($stateRow['sid'] == $selectedState) ? 'selected' : ''; // Set 'selected' attribute if this option matches the selected state
                    echo '<option value="' . $stateRow['sid'] . '" ' . $selectedStateOption . '>' . $stateRow['sname'] . '</option>';
                }
            }
        }
        ?>
    </select>
</div>
<span class="error"><?php echo $stateErr;?></span>

            <br />



            <div class="form-group">
              <label for="country"> Phone number<span class="important">*</span></label>
              <input
                name="number"
                type="text"
                class="form-control"
                id="country"
                placeholder="Your number"
                value="<?php echo htmlspecialchars($number); ?>"
              />
              <span class="error"><?php echo $numberErr;?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="email">E-mail<span class="important">*</span></label>
              <input
                type="text"
                class="form-control"
                id="email"
                placeholder="Your e-mail"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
              />
              <span class="error"><?php echo $emailErr;?></span>
              <span class="text-danger"><?php echo $errormessage  ?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="password">Password<span class="important">*</span></label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Your password"
                name="password"
                value="<?php echo htmlspecialchars($password); ?>"
              />
              <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="password">Confirm Password<span class="important">*</span></label>
              <input type="password"
                class="form-control"
                id="password"
                placeholder="confirm password"
                name="confirmPassword"
                value="<?php echo htmlspecialchars($confirmPassword); ?>"
                />
              <span class="error"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <br />
            <label>Hobbies</label>
            <hr style="width:70px">    
            <div class="form-group d-flex flex-wrap">
    <div class="form-check ">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="reading" <?php echo (isset($_POST['hobbies']) && in_array('reading', $_POST['hobbies'])) ? 'checked' : ''; ?>>
        <label class="form-check-label">Reading</label>
    </div>&nbsp;&nbsp;
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="traveling" <?php echo (isset($_POST['hobbies']) && in_array('traveling', $_POST['hobbies'])) ? 'checked' : ''; ?>>
        <label class="form-check-label">Traveling</label>
    </div>&nbsp;&nbsp;
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="gaming" <?php echo (isset($_POST['hobbies']) && in_array('gaming', $_POST['hobbies'])) ? 'checked' : ''; ?>>
        <label class="form-check-label">Gaming</label>
    </div>&nbsp;&nbsp;

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobbies[]" value="eating" <?php echo (isset($_POST['hobbies']) && in_array('eating', $_POST['hobbies'])) ? 'checked' : ''; ?>>
        <label class="form-check-label">Eating</label>
    </div> 
</div>

       
        <br />
            <div class="form-group">
              <input class="button-1 btn-primary" type="submit" name="submit"/>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- footer -->
    <?php include "../common/footer.php"?>
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

  

        