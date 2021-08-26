<?php 
session_start();
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Update Admin Data</h1>
            <div class="col-md-4 mx-auto">

                <?php
            
            // connection with database
            require_once "../config/database.php";

            // Getting Id from URL
             $get_id = $_GET['id'];

            //  Fetching data from database for update
             $sql = "SELECT * from `admin` where id='$get_id'";
             $result = mysqli_query($connect,$sql);
             $num = mysqli_num_rows($result);
             if($num==1){
                 while($row = mysqli_fetch_assoc($result)){

            ?>
                <form action="<?php $_SERVER['REQUEST_METHOD']?>" method="POST">
                        
                <!-- This is hidden input for id -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <label for="">Name</label>
                    <input type="text" name="name"  value="<?php echo $row['name']; ?>" class="form-control">

                    <label for="">Username</label>
                    <input type="text" name="username"  value="<?php echo $row['username']; ?>" class="form-control">

                    <!-- <label for="">Password</label> -->
                    <!-- <input type="password" name="password"  value="<?php echo $row['password']; ?>" class="form-control"> -->

                    <button type="submit" class="btn btn-success mt-3 mb-5">Confirm</button>
                    <a href="./manage-admin.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>
                <?php
                    }
                 }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Updating data in database -->
<?php
// connection with database
require_once "../config/database.php";

// Update query
if($_SERVER['REQUEST_METHOD']=="POST"){

    // getting base from form
    $name = mysqli_real_escape_string($connect,$_POST['name']);
    $username = mysqli_real_escape_string($connect,$_POST['username']);

    $sql1 = "UPDATE `admin` SET name='{$name}',username='{$username}' WHERE id='$get_id'";
    $result1 = mysqli_query($connect,$sql1);
    if($result==true){
        $_SESSION['update'] = "Your Admin Data is Updated Successfully";
        header("location: http://localhost/food/admin/manage-admin.php");
    }else{
echo "not";
    }

}
?>

<?php require_once "./files.php/footer.php" ?>