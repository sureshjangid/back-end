<?php 
session_start();
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Update Category Data</h1>
            <div class="col-md-4 mx-auto">
                <?php
// check whether Id is set or not
if(isset($_GET['id'])){

    // connection with database
    require_once "../config/database.php";

    // Get the Id from URL
    $id = $_GET['id'];
    
    // Select data from database where id was select
    $sql = "SELECT * from `categories` where id='$id'";

    // execute query
    $result = mysqli_query($connect,$sql);

    // count the rows whether ID is vaild or not
    $num = mysqli_num_rows($result);

    // num  is equal or not
    if($num == 1){
$row = mysqli_fetch_assoc($result);
    }else{
        // if not equal then Redircet to mangae-category.php page
        header("location: http://localhost/food/admin/manage-category.php?id=false");
        exit();
    }

}
// else Id is not set
else{

    header("location: http://localhost/food/admin/manage-category.php?id=false");
    exit();
}

?>

                <form action="<?php $_SERVER['REQUEST_METHOD']?>" method="POST" enctype="multipart/form-data"enctype="multipart/form-data">



                    <label for="">Title</label>
                    <input type="text" name="title" value="<?php echo $row['title']?>" class="form-control">

                    <label for="">Current Image</label>
                    <br>
                    <?php
                   if($row['image_name']!=""){

                   ?>
                    <img src="../images/category/<?php echo $row['image_name'] ?>" alt="" width="100px">
                    <br>
                    <?php
                    }else{
                        echo "<div class='text-danger'>Image not found</div>";
                    }
                   ?>
                    <label for="">New Image</label>
                    <input type="file" name="image" id="">


                    <label for="">featured : </label>
                    <input <?php if($row['featured']=="Yes"){echo "checked";} ?> type="radio" name="featured"
                        value="Yes" class=""> Yes
                    <input <?php if($row['featured']=="No"){echo "checked";} ?> type="radio" name="featured" value="No"
                        class=""> No

                    <br>
                    <label for="">Active : </label>

                    <input <?php if($row['active']=="Yes"){echo "checked";} ?> type="radio" value="Yes" name="active"
                        class=""> Yes
                    <input <?php if($row['active']=="No"){echo "checked";} ?> type="radio" value="No" name="active"
                        class=""> No

                    <br>
                    <!-- This is hidden input for id and current_image -->
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" class="">
                    <input type="hidden" name="image_name" value="<?php echo $row['image_name'] ?>" class="">

                    <button type="submit" class="btn btn-success mt-3 mb-5">Confirm</button>
                    <a href="./manage-category.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>

            </div>
        </div>

    </div>
</section>

<?php
// connection with database
require_once "../config/database.php";

// <!-- check whether form have Post or not -->
if($_SERVER['REQUEST_METHOD']=="POST"){

    // getting data from form
    $Get_id1 = mysqli_real_escape_string($connect,$_POST['id']);
    $title = mysqli_real_escape_string($connect,$_POST['title']);
    $current_image = mysqli_real_escape_string($connect,$_POST['image_name']);
    $featured = mysqli_real_escape_string($connect,$_POST['featured']);
    $active = mysqli_real_escape_string($connect,$_POST['active']);

   // if Image Select
if(isset($_FILES['image']['name'])){
              
    // image name
    $image_name = $_FILES['image']['name'];

    if($image_name !=""){

   
    // rename the image
    $rename = end(explode('.',$image_name));

    // name of image will
   
    $image_name="Food_category".rand(000,999).'.'.$rename; // name of image
    // source_path
    $source_path = $_FILES['image']['tmp_name'];

    // where we need to save img
    $save_image = "../images/category/".$image_name;

    // final code to upload file
    $upload_file = move_uploaded_file($source_path,$save_image);
    // check whether file is upload or not
    if($upload_file==false){
        $_SESSION['file-error'] = "Failed to upload File";
        header("location: http://localhost/food/admin/add-category.php");
        die();
    }
   

// To remove image from image/category folder
// $remove = '../images/category/'.$image_name;
// $remove_img = unlink($remove);

// // when failed to remove image
// if($remove_img==false){
//     echo "not";
// }
}

else{
    $image_name= $current_image;
}
}
else{
    $image_name= $current_image;
}



    // Update new data in database
    $sql2 = "UPDATE `categories` SET
                    title= '$title',
                    image_name= '$image_name',
                    featured= '$featured',
                    active= '$active'
                    WHERE id= $Get_id1";

    // execute the update query
    $result2 = mysqli_query($connect,$sql2);

    // checking whether update is success or not
    if($result2 == true){
        // whether update is Successfully then show message 
        $_SESSION['cat-update'] = "Category Updated";

        // Redirecd to manage-category.php page
        header("location: http://localhost/food/admin/manage-category.php?updateSuccess=true");
        
        // // end the process
        exit();
    }else{
        // whether update is Successfully then show message 
        $_SESSION['cat-not-update'] = "Category Failed to Update";

        // Redirecd to manage-category.php page
        header("location: http://localhost/food/admin/manage-category.php?updateSuccess=false");
        
        // // end the process
        exit(); 
    }

    // Redericed after
}

?>

<?php require_once "./files.php/footer.php" ?>