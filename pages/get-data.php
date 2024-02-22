<?php 
require '../common/database.php';


if(isset($_POST['id'])){
    $id - $_POST['id'];

    $query = mysqli_query($conn ,"SELECT * FROM `state` where country_id= $id ");
    while($row=mysqli_fetch_array($query)){
        $id= $row['id'];
        $state= $row['name'];
        echo "<option value '$id'>$state</option>";
    }

}

?>