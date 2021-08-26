<?php
session_start();
 require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<div class="container">
    <div class="row">
        <h1 class="text-center mt-5">Update Food</h1>
        <div class="col-4 m-auto">
            <!-- fetch the data from data base -->
            <?php
// // check whether ID and image_name set or not
// if(isset($_GET['id']) && (isset[$_GET['image_name']])){

     // connection with database
     require_once "../config/database.php";

     // Get the Id from URL
     $id = $_GET['id'];

    // select data from food table
    $sql = "SELECT * from `food` where id='$id'";

    $result = mysqli_query($connect,$sql);

    // count the rows whether ID is vaild or not
    $num = mysqli_num_rows($result);

    // num  is equal or not
    if($num == 1){
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$title=$row['title'];
$desrciption=$row['desrciption'];
$price=$row['price'];
$image_name = $row['image_name'];
$category_id=$row['category_id'];
$featured = $row['featured'];
$active = $row['active'];
    }else{
        // if not equal then Redircet to mangae-category.php page
        header("location: http://localhost/food/admin/add-food.php?id=false");
        exit();
    }

?>

            <form action="" method="POST" enctype="multipart/form-data">
                <label for="">Title</label>
                <input type="text" name="title" value="<?php echo $title ?>" class="form-control">

                <label for="">Description</label>
                <input type="text" name="description" value="<?php echo $desrciption ?>" class="form-control">

                <label for="">Prices</label>
                <input type="number" name="price" value="<?php echo $price?>" class="form-control">

                <label for="">Current Image</label>
                <br>
                <?php
                    if($row['image_name']!=""){

                    
                ?>
                <img src="../images/food/<?php echo $image_name ?>" alt="" width="100px">
                <?php
                }else{
                    echo "<div class='text-danger'>Image not found</div>";
                }
                ?>
                <label for="">Select New Image</label>
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
                                  $cat_id = $row['id'];
                                  $cat_title = $row['title']  
                            
                        ?>
                    <option value="<?php echo $cat_id?>"><?php echo $cat_title ?></option>
                    <?php
                                }
                            }else{
                                echo '<option value="No category found">No category Found</option>';
                            }
                        ?>
                </select>
                <br>

                <label for="">featured : </label>
                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" class="">
                Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" class="">
                No

                <br>
                <label for="">Active : </label>

                <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" value="Yes" name="active" class=""> Yes
                <input <?php if($active=="No"){echo "checked";} ?> type="radio" value="No" name="active" class=""> No
                <br>
                <!-- This is hidden input for id and current_image -->
                <input type="hidden" name="id" value="<?php echo $id ?>" class="">
                <input type="hidden" name="image_name" value="<?php echo $image_name ?>" class="">

                <input type="submit" name="submit" class="btn btn-success mt-3 mb-5">
                <a href="./manage-food.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
            </form>
        </div>
    </div>
</div>
<?php
// connection with database
require_once "../config/database.php";

// <!-- check whether form have Post or not -->
if(isset($_POST['submit'])){

    // getting data from form
    $Get_id1 = mysqli_real_escape_string($connect,$_POST['id']);
    $title = mysqli_real_escape_string($connect,$_POST['title']);
    $description =mysqli_real_escape_string($connect,$_POST['description']);
    $current_image = mysqli_real_escape_string($connect,$_POST['image_name']);
    $category_id = mysqli_real_escape_string($connect,$_POST['category_id']);
    $featured =mysqli_real_escape_string($connect,$_POST['featured']);
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
    $save_image = "../images/food/".$image_name;

    // final code to upload file
    $upload_food = move_uploaded_file($source_path,$save_image);

    // check whether file is upload or not
    if($upload_food==false){
        $_SESSION['file-img-error'] = "Failed to upload File";
        header("location: http://localhost/food/admin/add-food.php");
        // die();
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
    $sql2 = "UPDATE `food` SET
                    title= '$title',
                    desrciption='$description',
                    price=$price,
                    image_name= '$image_name',
                    category_id= $category_id,
                    featured= '$featured',
                    active= '$active'
                    WHERE id= $Get_id1";

    // execute the update query
    $result2 = mysqli_query($connect,$sql2);
   

    // checking whether update is success or not
    if($result2 == true){
        // whether update is Successfully then show message 
        $_SESSION['food-update'] = "Food Updated";

        // Redirecd to manage-food.php page
            echo '<script>window.location.href="http://localhost/food/admin/manage-food.php?updateSuccess=true"</script>';
        
        // // end the process
        exit();
    }else{
        // whether update is Successfully then show message 
        $_SESSION['cat-not-update'] = "Food Failed to Update";

        // Redirecd to manage-category.php page
        echo '<script>window.location.href="http://localhost/food/admin/manage-food.php?updateSuccess=false"</script>';
        
        // // end the process
        exit(); 
    }

    // Redericed after
}

?>
<?php require_once "./files.php/footer.php" ?>