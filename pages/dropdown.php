<?php 
require '../common/database.php';
$sql ="SELECT  * FROM `country`";
$result=mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    echo '<select name="countryDropdown">'; 
    while($row = $result->fetch_assoc()) { 
        echo '<option value="' . $row['country_id'] . '">' . $row['name'] . '</option>';
    }
    echo '</select>';
} else {
    echo "No countries found";
}
$conn->close();
?>
<?php 
require '../common/database.php';
$sql = "SELECT * FROM `state`";
$result = mysqli_query($conn,$sql);
if($result->num_rows >0){
    echo '<select name="statedropdown">';
    while($row=$result->fetch_assoc()){
      echo  "<option value='".$row["state_id"]."'>" . $row["name"]. "</option>";  
    }
}


