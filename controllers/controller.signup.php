<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $fullNameErr = $dobErr = $numberErr =$genderError= $emailErr = $passwordErr = $confirmPasswordErr=$countryErr=$stateErr=$hobbiesErr="";
  $fullName = $dob = $gender = $number = $email = $password = $confirmPassword = $country = $state=$hobbies="";
  $errormessage=$successmessage="";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name validation
  if (empty($_POST["name"])) {
     $fullNameErr = "Full Name is required";
    }
     else  {
     $fullName = test_input($_POST["name"]);
    }
    // Date of Birth validation
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
     // Phone number validation
  if (empty($_POST["number"])) {
      $numberErr = "Contact number is required";
    } elseif (!is_numeric($_POST["number"])) {
      $numberErr = "Phone number must be numeric";
    } elseif (strlen($_POST["number"]) != 10) {
      $numberErr = "Phone number must have 10 digits";
    } else {
      $number = test_input($_POST["number"]);
  }
    // gender validation
   if (empty($_POST["gender"]) || $_POST["gender"] == "Choose...") {
      $genderError = "Please select a gender.";
     } else {
      $gender = test_input($_POST["gender"]);
    }

   // country validation
   if (empty($_POST["country"]) || $_POST["country"] == "Choose...") {
   $countryErr = "Please select a country.";
   } else {
    $country = test_input($_POST["country"]);
   }

   // state validation
   if (empty($_POST["state"]) || $_POST["state"] == "Choose...") {
      $stateErr = "Please select a state.";
     } else {
      $state = test_input($_POST["state"]);
    }

  // Email Validation
  if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    } else {
      $email = test_input($_POST["email"]);
    }

    // password Validation
    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
  } elseif (strlen($_POST["password"]) < 8) {
      $passwordErr = "Password must be at least 8 characters long";
  } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $_POST["password"])) {
      $passwordErr = "Password must contain at least one special character";
  } elseif (strlen($_POST["password"]) > 15) {
      $passwordErr = "Password can be maximum of 15 characters";
  } else {
      $password = test_input($_POST["password"]);
  }
  //  Confirm Password Validation
  if (empty($_POST["confirmPassword"])) {
     $confirmPasswordErr = "Confirm Password is required";
    } elseif (strlen($_POST["confirmPassword"]) < 8) {
      $passwordErr = "Password must be at least 8 characters long";
  } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $_POST["confirmPassword"])) {
      $passwordErr = "Password must contain at least one special character";
  } elseif (strlen($_POST["confirmPassword"]) > 15) {
      $passwordErr = "Password can be maximum of 15 characters";
  } else {
      $password = test_input($_POST["password"]);
  }
  // Country Validation
  if (empty($_POST["country"])) {
     $fullNameErr = "country is required";
  }
  // Here we check that password and confirmpassword is equel
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

// here i bind everything that without filling all the fields and without clearing the all error form can not be submitted
if (empty($fullNameErr) && empty($dobErr) && empty($numberErr) && empty($emailErr) && empty($passwordErr)&& empty($confirmPasswordErr)&& empty($genderError) && empty($countryErr)&&
    !empty($fullName) && !empty($dob) && !empty($number) && !empty($email) && !empty($password) && !empty($confirmPassword)
    && !empty($gender)&& !empty($country)&& !empty($state) ) {
        
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
          
          $hobbies = isset($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';
        
          $sql = "INSERT INTO userdata(name,date_of_birth,gender,phone,email,password,country_id, state_id, hobbies,verify_token) 
                  VALUES('$name', '$dob', '$gender','$number','$email', '$hashedpassword','$country', '$state', '$hobbies','$verify_token')";
        
          $checkUserQuery =  "SELECT * FROM userdata WHERE email = '$email'";
          $result = $conn->query($checkUserQuery);
          if($result->num_rows>0){
            $errormessage="Email already exist";
          }
          elseif($conn->query($sql) === TRUE){
            $successmessage="your Account has been created successfully!<br> Please login to continue.";
          }
          $fullName = $dob = $gender = $number = $email = $password = $confirmPassword = $country=$state="";
        }
      }     
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>