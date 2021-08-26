<?php
session_start();
?>

<?php require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Add New Category</h1>
            <?php
            
            // New Category add message
            if(isset($_SESSION['cat-error'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed ! </strong>'.$_SESSION['cat-error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['cat-error']);
            }
            // file  failed to upload
            if(isset( $_SESSION['file-error'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed ! </strong>'.$_SESSION['file-error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['file-error']);
            }

        ?>
            <div class="col-md-4 mx-auto">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                     
                    <label for="">Select Image</label>
                    <input type="file" name="image" id="formFile">
                    
                    <label for="">featured : </label>
                    <input type="radio" name="featured" value ="Yes" class=""> Yes
                    <input type="radio" name="featured" value="No" class=""> No
<br>
                    <label for="">Active : </label>
                    
                    <input type="radio" name="active" value ="Yes" class=""> Yes
                    <input type="radio" name="active" value="No" class=""> No

                    <br>
                    
                    <button type="submit" class="btn btn-success mt-3 mb-5">Confirm</button>
                    <a href="./manage-category.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>
            </div>
        </div>
    </div>
</section>
        <?php
        // Connection with database
        require_once "../config/database.php";

        // checking the form
        if($_SERVER['REQUEST_METHOD']=="POST"){


            // getting data from form
            $title = mysqli_real_escape_string($connect,$_POST['title']);

            // checking the value of featured YES OR NO !!
            if(isset($_POST['featured'])){
                
                // if value is Yes
                $featured = mysqli_real_escape_string($connect,$_POST['featured']);

            }
            else{
                // if value is NO
                $featured = "No";
            }
            // checking the value of Active YES OR NO !!
            if(isset($_POST['active'])){
                
                // if value is Yes
                $active = mysqli_real_escape_string($connect,$_POST['active']);;

            }
            else{
                // if value is NO
                $active = "No";
            }
            
            
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
                $save_image = "../images/category/" .$image_name;

                // final code to upload file
                $upload_file = move_uploaded_file($source_path,$save_image);

                // check whether file is upload or not
                if($upload_file==false){
                    $_SESSION['file-error'] = "Failed to upload File";
                    header("location: http://localhost/food/admin/add-category.php");
                    die();
                }
            }
            }
            else{
                $image_name="";
            }
          
            // if they are all correct | inserting data into database
           $sql = "INSERT INTO `categories` (`title`,`image_name`,`featured`,`active`) values ('$title','$image_name','$featured','$active')";
            $result = mysqli_query($connect,$sql);

            // Message
            if($result==true){
                // show success message when data insert
                $_SESSION['cat-success'] = "New Category Added";
                 header("location: http://localhost/food/admin/manage-category.php");

            }else{
                // show failed message when data not insert
                $_SESSION['cat-error'] = " Category not Added";
                header("location: http://localhost/food/admin/add-category.php");
            }

        }


        ?>

<?php require_once "./files.php/footer.php" ?>