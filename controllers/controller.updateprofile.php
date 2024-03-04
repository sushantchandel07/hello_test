<?php
session_start();
require "../common/database.php";
include "../common/header.php";
// here i check if the user is logged in or not 
if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("Location: Login.php");
}
// this session user id coming  from login page 
$userid = $_SESSION['userid'];
// here i am select user data from database using user id
$sql = "SELECT * FROM userdata WHERE id=$userid";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
// here i am select data from country
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
    $hobbies = isset($_POST['hobbies']) ? implode(',', $_POST['hobbies']) : '';
    $updateSql = "UPDATE userdata SET name='$name', country_id=$countryId, state_id=$stateId, date_of_birth='$dob', gender='$gender' , hobbies='$hobbies' WHERE id=$userid";

    if (mysqli_query($conn, $updateSql)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// here we upload profile image unlink them from folder 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_image'])){
      $userid = $_SESSION['userid'];
      $sql = "SELECT profile_image_path FROM userdata WHERE id=$userid";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $existingImagePath = $row['profile_image_path'];
    if (!empty($existingImagePath) && file_exists($existingImagePath)) {
      unlink($existingImagePath);
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
    $sql = "UPDATE userdata SET profile_image_path=NULL WHERE id=$userid";
    if (mysqli_query($conn, $sql)){
    header("Location: profile.php");
    exit();
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }
}

if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '') {
    header("Location: Login.php");
}
$userid = $_SESSION['userid'];
$sql = "SELECT * FROM userdata WHERE id=$userid";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
// Adding country and state with the help of joins
$sqlcountry = "SELECT userdata.*, country.cname ,state.sname
               FROM userdata
               JOIN country ON userdata.country_id = country.cid
               JOIN state ON userdata.state_id = state.sid
               WHERE userdata.id = $userid";
$countryresult = mysqli_query($conn, $sqlcountry);
if ($countryuser = mysqli_fetch_assoc($countryresult)) {
    $country = $countryuser['cname']; 
    $state = $countryuser['sname'];
}
// adding then in variable for further display
if ($user) {
    $profile_image = $user['profile_image_path'];
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
    $gender = $user['gender'];
    $dob = $user['date_of_birth'];
    $hobbies = $user['hobbies'];
}   else {
    header("Location: login.php");
}
    mysqli_close($conn);
?>
  