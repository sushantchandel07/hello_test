<?php
$host ='localhost';
$dbUsername ='root'; 
$pass = 'yourpassword';
$dbname='userdb';

// Create connection
$conn = new mysqli($host, $dbUsername , $pass ,$dbname );
if($conn){
    echo "";
}
?>
