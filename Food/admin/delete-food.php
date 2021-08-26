<?php
// connection with database
session_start();
require_once "../config/database.php";

// check whether ID and image_name passed or not in url
if(isset($_GET['id'])&& (isset($_GET['image_name']))){
    
    // Get Id and Image_name from URL
    $id= $_GET['id'];
    $image_name= $_GET['image_name'];

    // Remove image from file
    if($image_name!=""){
        
        // file path
        $path="../images/food/".$image_name;

        // Remove image
        $remove = unlink($path);

        // if image failed to remove then display this message
        if($remove==false){
            
            // image failed message
            $_SESSION['food-img-remove'] ="Failed to remove iamge";

            // redirecd when failed to remove
            header("location: http://localhost/food/admin/manage-food.php?Image_failed=false");

            //  stop to process
            die();
                
        }
    }
    // Delete insert data
    $sql = "DELETE FROM `food` WHERE id ='$id'";
    
    // exexute query
    $reuslt = mysqli_query($connect,$sql);

    // check whether data delete or not
    if($reuslt==true){
        
        // if data deleted then dispaly this message on manage-food.php page
        $_SESSION['food-delete'] ="Deleted";

        // redirecd
        header("location: http://localhost/food/admin/manage-food.php?Delete=true");

        // stop to process
        die();
    }else{
        // else display failed to delete on manage-food.php page
        $_SESSION['failed-food'] ="Failed to Delete";
        // redirecd
         header("location: http://localhost/food/admin/manage-food.php?Delete=false");

        // stop to process
        die();
    }

}else{
    header("location: http://localhost/food/admin/manage-food.php?id=null&image_name=null");
}
?>