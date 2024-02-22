<?php
require "../common/database.php";

$id = $_POST['id'];
$picsource = $_POST['picsource'];


$uploadsFolder = "../uploads/";


if (file_exists($uploadsFolder . $picsource)) {
    unlink($uploadsFolder . $picsource);
}


$query = "DELETE FROM gallery WHERE id = $id";
mysqli_query($conn, $query);


header("Location: gallery_display.php");
exit();
?>
