<?php
// sesstion start
session_start();

// connection with database
require_once "../config/database.php";

// Getting Id from URL
$getId = $_GET['id'];

// Delete data from database
$sql = "DELETE  from `admin` where id='$getId'";
$result = mysqli_query($connect,$sql);

if($result==true){
  
    $_SESSION['delete'] = "Admin Data Delete";
    header("location: http://localhost/food/admin/manage-admin.php");
}
else{
echo "not";
}
?>