<?php
session_start();
 require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>



<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Add New Food</h1>
            <div class="col-md-4 mx-auto">
                <?php 
 // failed to add data
 if(isset($_SESSION['food-not-insert'] )){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['food-not-insert'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['food-not-insert']);
}
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">

                    <label for="">Description</label>
                    <input type="text" name="description" class="form-control">

                    <label for="">Prices</label>
                    <input type="number" name="price" class="form-control">

                    <label for="">Select Image</label>
                    <input type="file" name="image" id="formFile">

                    <label for="">Category</label>
                    <select name="category_id" id="">
                        <!-- select category form database -->
                        <?php
                            // connection with database
                            require_once "../config/database.php";

                            $sql="SELECT * from `categories` where active='Yes'";
                            $result = mysqli_query($connect,$sql);
                            
                            $num  = mysqli_num_rows($result);
                            if($num>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    
                            
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
                        <?php
                                }
                            }else{
                                echo '<option value="No category found">No category Found</option>';
                            }
                        ?>
                    </select>
                    <br>
                    <label for="">featured : </label>
                    <input type="radio" name="featured" value="Yes" class=""> Yes
                    <input type="radio" name="featured" value="No" class=""> No
                    <br>
                    <label for="">Active : </label>

                    <input type="radio" name="active" value="Yes" class=""> Yes
                    <input type="radio" name="active" value="No" class=""> No

                    <br>

                    <input type="submit" name="submit" class="btn btn-success mt-3 mb-5">
                    <a href="./manage-food.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>
                
            </div>
        </div>
    </div>
</section>
<!-- Inserting data into database table -->
<?php
// connection with database
require_once "../config/database.php";

// check whether method is Post or not

    if(isset($_POST['submit']))
    {
    // Getting data from form
    $title = mysqli_real_escape_string($connect,$_POST['title']);
    $description = mysqli_real_escape_string($connect,$_POST['description']);
    $price =  mysqli_real_escape_string($connect,$_POST['price']);
    // $image_name = $_POST['image'];
    $category_id =  mysqli_real_escape_string($connect,$_POST['category_id']);
   
    
    // // check wheter featured value Yes or no
    if(isset($_POST['featured'])){
        // if yes
      $featured = mysqli_real_escape_string($connect,$_POST['featured']);
    }
    else{
        // if No
        $featured = "No";
    }
    // check whether active value Yes or No
    if(isset($_POST['active'])){
        // if Yes
        $active = mysqli_real_escape_string($connect,$_POST['active']);
    }
    else{
        $active = "No";
    }

    // //1.checking whether Image in available or not
   
    // if Image Select
    if(isset($_FILES['image']['name'])){
              
        // image name
        $image_name = $_FILES['image']['name'];

        if($image_name !=""){

       
        // rename the image
        $rename = end(explode('.',$image_name));
       
            // Image name will bee like "food-category-123.png"
            $image_name = "food-category-".rand(0000,9999).'.'.$rename;

            // source path of image
            $src = $_FILES['image']['tmp_name'];
            
            // when we need to save the image
            $save_path = "../images/food/".$image_name;

            // finaly code to upload Image
            $upload = move_uploaded_file($src,$save_path);

            // check whether iamge upload failed
            if($upload==false){
                // if image failed to upload then show this message
                $_SESSION['food-img'] = "failed to upload Image";
                
                // redirecd to manage-food.php page
                 header("location: http://localhost/food/admin/manage-food.php?uploadFailed=false");
                    die();
              
            }
           
        }
    }else{
        $image_name = "";
    }
    


    //2.inserting data into database
    //    created sql quert to add data
    $sql2 = "INSERT INTO `food` ( `title`, `desrciption`, `price`, `image_name`, `category_id`, `featured`, `active`, `date-time`) VALUES ('$title', '$description', '$price', '$image_name', '$category_id', '$featured', '$active', current_timestamp());";
   
    //3.Execue inserting query
    $result2 = mysqli_query($connect,$sql2);  

    //4.checking whether data insert or not
    if($result2==true){
        // show success message when data insert
        $_SESSION['insert-food'] = "New Food Added";
        echo '<script>
        window.location.href="http://localhost/food/admin/manage-food.php"
        </script>';
        //  header("location: http://localhost/food/admin/manage-food.php");

    }else{
        // show failed message when data not insert
        $_SESSION['failed-food'] = " Food not Added";
        echo '<script>
        window.location.href="http://localhost/food/admin/manage-food.php"
        </script>';
        // header("location: http://localhost/food/admin/mangae-food.php");
    }
}
        ?>
<?php require_once "./files.php/footer.php"?>