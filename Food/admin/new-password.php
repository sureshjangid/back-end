
<?php
session_start();
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<?php
    // connection with database
    require_once "../config/database.php";
    $pass_not_match = false;
    if($_SERVER['REQUEST_METHOD']=="POST"){

        // getting name from form
        $id = $_POST['id'];
        $old = mysqli_real_escape_string($connect,md5($_POST['old_password']));
        $new = mysqli_real_escape_string($connect,md5($_POST['new_password']));;
        $confirm = mysqli_real_escape_string($connect,md5($_POST['confirm_password']));

        // checking whether user exsit or not
        $sql = "SELECT * from `admin` where id=$id AND password = '$old'";
        
        // execute the quert
        $result = mysqli_query($connect,$sql);

        if($result==true){
        // checking the number of rows
        $num = mysqli_num_rows($result);
        
        if($num ==1){
        //  if user and password exsit message   
            
        if($new == $confirm){
            $sql2 = "UPDATE `admin` SET password = '$new' where id={$id}";
            $result2  = mysqli_query($connect,$sql);
            if($result==true){
                $_SESSION['pass-changed'] = "Your Password been Changed";
                header("location: http://localhost/food/admin/manage-admin.php");

            }else{
                echo "password not changed due to ->" .mysqli_error($connect);
            }
        }else{
            
            $_SESSION['not-match'] = "Confirm Password does not Match Please try again.";
        }


        }else{
            // if user not exsit message
            $_SESSION['user-not'] = "User not Exsit";
            header("location: http://localhost/food/admin/manage-admin.php");
        }
    }else{
        echo "due to ->" .mysqli_error($connect);
    }
}

?>

<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-3 text-center">Change Password</h1>
<?php
if(isset($_SESSION['not-match'])){
    
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error; ! </strong>'.$_SESSION['not-match'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    unset($_SESSION['not-match']);
}
?>
            <div class="col-md-4 mx-auto">
                <?php
                    // Getting ID from URL
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                    }
                    
                     ?>
            
                <form action="" method="POST">
                    <!-- Hidden input -->
                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <label for="">Current Password</label>
                    <input type="password" name="old_password" class="form-control">

                    <label for="">New Password</label>
                    <input type="password" name="new_password" class="form-control">

                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">

                    
                    <input type="submit" class="btn btn-success mt-3 mb-5"></input>
                    <a href="./manage-admin.php" type="submit" class="btn btn-warning  mt-3 mb-5">Back</a>
                </form>
            </div>
        </div>
    </div>
</section>



<?php require_once "./files.php/footer.php" ?>