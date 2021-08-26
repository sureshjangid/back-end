<?php
// connection with database
session_start();
require_once "../config/database.php";


// check whether Id and Image_name are isset or not
if(isset($_GET['id']) AND isset($_GET['image-name'])){
    
    // Get Id and Image_name from URL
    $id = $_GET['id'];
    $image_name = $_GET['image-name'];

    // Removing image from file
    if($image_name != ""){

        // file path
        $path = "../images/category/".$image_name;

        // remove the Image
        $remove = unlink($path);

        
        // check whether Image remove or not if not
        if($remove==false){

            // if image not remove then show this failed message in manage-category.php page
            $_SESSION['img-remove'] ="Failed to Remove ".$image_name;

            // redirect when not remove
            header("location: /food/admin/manage-category.php?delete-image=false");

            // stop to process
            die();
        }
    }
// Delete user from database
$sql = "DELETE from `categories` where id='$id'";
$result = mysqli_query($connect,$sql);

// checking whether Delete or not
if($result==true){
    // if data delete then show this success message
    $_SESSION['cat-delete'] = "Category Deleted";
    header("location: /food/admin/manage-category.php?delete=true");
    // exit();
}

}


else{
             //   Redircet
    header("location: http://localhost/food/admin/manage-category.php");
}

?>