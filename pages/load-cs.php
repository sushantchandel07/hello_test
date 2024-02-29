<?php
require '../common/database.php';

if(isset($_POST['type']) && $_POST['type'] == "countrydata"){
    $sql = "SELECT * FROM country";
    $query = mysqli_query($conn, $sql) or die("query unsuccessful.");
    $str = "";
    while($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='" . $row['cid'] . "'>" . $row['cname'] . "</option>";
    }
    }elseif(isset($_POST['type']) && $_POST['type'] == "statedata"){
    $country_id = $_POST['id'];
    $sql = "SELECT * FROM state WHERE country_id = $country_id";
    $query = mysqli_query($conn, $sql) or die("query unsuccessful.");
    $str = "";
    while($row = mysqli_fetch_assoc($query)) {
        $str .= "<option value='" . $row['sid'] . "'>" . $row['sname'] . "</option>";
    }
}
echo $str;
?>