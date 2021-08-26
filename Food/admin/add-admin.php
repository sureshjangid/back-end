<?php
session_start();
// $errMsg = "Please Enter your Name";
// Connection with database
require_once "../config/database.php";

$username_exsits = false;



if($_SERVER['REQUEST_METHOD']=="POST"){
    $name =mysqli_real_escape_string($connect,$_POST['name']);
    $username = mysqli_real_escape_string($connect,$_POST['username']);
    $password =mysqli_real_escape_string($connect,md5($_POST['password']));

    $sql_exsits = "SELECT * from `admin` where username = '$username'";
    $result_exsits = mysqli_query($connect,$sql_exsits);
    $num = mysqli_num_rows($result_exsits);
    if($num > 0){
        $username_exsits = "Username Already Exsits ";
    }else{

        // Inserting data into database
        $sql = "INSERT Into `admin` (`name`,`username`,`password`) values ('$name','$username','$password')";
        $result = mysqli_query($connect,$sql);
         if($result==true){
             
            $_SESSION['add'] = "Welcome ".$_SESSION['username']=$username." now you are also Admin please do not do something wrong in Main Panal";
            header("location: http://localhost/food/admin/manage-admin.php");

         }
         else{
             header("localhost: http://localhost/food/admin/add-admin.php");
         }
    }
}

?>
<?php require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Add New Admin</h1>
            <?php
            
            if ($username_exsits==true){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>'.$username_exsits.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

            }
            ?>
            <div class="col-md-4 mx-auto">
  
            
                <form action="" method="POST">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">

                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control">

                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">

                    
                    <button type="submit" class="btn btn-success mt-3 mb-5">Confirm</button>
                    <a href="./manage-admin.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>
            </div>
        </div>
    </div>
</section>


<?php require_once "./files.php/footer.php" ?>