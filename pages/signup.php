<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$fullNameErr = $dobErr = $numberErr =$genderErr= $emailErr = $passwordErr = $confirmPasswordErr =$stateErr=$countryErr = "";
$fullName = $dob = $gender = $number = $email = $password = $confirmPassword = "";
$errormessage=$successmessage="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $fullNameErr = "Full Name is required";
    }
 else  {
    $fullName = test_input($_POST["name"]);
    }

    if (empty($_POST["dob"])) {
      $dobErr = "Date of Birth is required";
  } else {
      $dob = test_input($_POST["dob"]);
      $currentYear = date("Y");
      $dobYear = date("Y", strtotime($dob));
      if ($dobYear > 2005 || $dobYear > $currentYear) {
         $dobErr = "Date of Birth must be from the year 2005 or earlier";
      }
  }

    if (empty($_POST["number"])) {
      $numberErr = "Contact number is required";
    } elseif (!is_numeric($_POST["number"])) {
      $numberErr = "Phone number must be numeric";
    } elseif (strlen($_POST["number"]) != 10) {
      $numberErr = "Phone number must have 10 digits";
    } else {
      $number = test_input($_POST["number"]);
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
  } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
  } else {
      $email = test_input($_POST["email"]);
  }

    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
    } elseif (strlen($_POST["password"])!=8 ) {
      $passwordErr = "Password must of 8 characters";
    } else {
      $password = test_input($_POST["password"]);
    }

  if (empty($_POST["confirmPassword"])) {
    $confirmPasswordErr = "Confirm Password is required";
    } elseif (strlen($_POST["confirmPassword"]) < 8) {
    $confirmPasswordErr = "Password must be of 8 characters";
    } else {
    $confirmPassword = test_input($_POST["confirmPassword"]);
    }

   if ($passwordErr == "" && $confirmPasswordErr == "") {
   if ($password != $confirmPassword) {
      $confirmPasswordErr = "Passwords do not match";
   }
  }else{
    $confirmPassword=test_input($_POST["confirmPassword"]);
  }


  $password = test_input($_POST["password"]);
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $confirmPassword = test_input($_POST["confirmPassword"]);
  
}
if (empty($fullNameErr) && empty($dobErr) && empty($numberErr) && empty($genderErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) &&
        !empty($fullName) && !empty($dob) && !empty($number) && !empty($gender) && !empty($email) && !empty($password) && !empty($confirmPassword) && !empty($_POST['country']) && !empty($_POST['state'])) {
        }
if(isset($_POST[ 'submit'])){
  $name= $_POST['name'];
  $dob= $_POST['dob'];
  $gender=$_POST['gender'];
  $number=$_POST['number'];
  $email=$_POST['email'];
  $country = $_POST['country'];
    $state = $_POST['state'];
    $verify_token = md5(rand());

  require '../common/database.php';
  $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
 $hobbies = isset($_POST['hobbies']) && is_array($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';


  $sql = "INSERT INTO userdata(name,date_of_birth,gender,phone,email,password,country_id, state_id, hobbies,verify_token) VALUES('$name', '$dob', '$gender','$number','$email', '$hashedpassword','$country', '$state', '$hobbies','$verify_token')";
$checkUserQuery =  "SELECT * FROM userdata WHERE email = '$email'";
$result = $conn->query($checkUserQuery);
if($result->num_rows>0){
  $errormessage="";
}
elseif($conn->query($sql) === TRUE){
  $successmessage="your Account has been created successfully!<br> Please login to continue.";
}
$fullName = $dob = $gender = $number = $email = $password = $confirmPassword = "";
}
        
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

    
    <style>
      .error {
        color: red;
      }
.important{
  color: red;
}
    </style>
  <!--header-->
  <?php include "../common/header.php" ?>
  <!--main section-->
    <div class="section d-flex">
      <div class="section-image">
        <img class="section-image-2" src="../photos/Illustration.png"/>
      </div>
      <form method="post" action="code.php">
        <div class="form-container">
          <div class="form heading">
            <div class="form-heading">
              <span class="text-success"><?php echo  $successmessage ? " <p>$successmessage</p>" : "" ?></span>
              <h3>Signup to your Account</h3>
            </div>
          </div>
          <br />
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
              <label for="gender">Gender<span class="important">*</span></label>
              <select class="form-control" id="gender" name="gender">
                <option class="gender">Male</option>
                <option class="gender" >Female</option>
                <option class="gender">Other</option>
              </select>
            </div>
            <br />
            <div class="form-group">
              <label for="gender">country<span class="important">*</span></label>
              <select class="form-control" id="country" name="country"> 
              <option>select country</option>
                <?php
                 require "../common/database.php";
                 $sql = "SELECT * FROM country";
                 $result = mysqli_query($conn,$sql);
                if($result->num_rows >  0){
                  while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['cid'] . '">' . $row['cname'] . '</option>';
                }
                }
                ?>
              </select>
            </div>
            <br />
            <div class="form-group">
              <label for="gender">state<span class="important">*</span></label>
              <select class="form-control" id="state" name="state"> 
                <option>select state</option>
              </select>
            </div>
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
              <span class="text-danger"><?php echo $errormessage ? "<p>$errormessage.</p>" :"" ?></span>
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
             <input class="form-check-input" type="checkbox" name="hobbies" value="reading">
             <label class="form-check-label">Reading</label>
           </div>&nbsp;&nbsp;
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies" value="traveling">
             <label class="form-check-label">Traveling</label>
           </div>&nbsp;&nbsp;
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies" value="gaming">
             <label class="form-check-label">Gaming</label>
           </div>&nbsp;&nbsp;
           
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies" value="gaming">
             <label class="form-check-label">eating</label>
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

  

        