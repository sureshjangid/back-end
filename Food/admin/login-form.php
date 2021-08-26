<?php
session_start();
require_once "./files.php/html.php" ?>

<section class="">
    <div class="container mt-5">
        <div class="row">



            <div class="col-md-4 mx-auto">


                <form action="" method="POST">

                    <div class="card">

                        <div class="card-header">
                            <h1 class="mt-2 mb-3 text-center"><strong>Admin House</strong></h1>
                        </div>
                        <div class="card-body">

                            <?php
                                if(isset($_SESSION['not'])){
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error ! </strong>'.$_SESSION['not'].'
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>'; 
                                unset($_SESSION['not']);
                                }
                            ?>
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" ">

                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Login" class="btn btn-success mt-2 "></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php

// connection with database
require_once "../config/database.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
// getting data from form
$username = mysqli_real_escape_string($connect,$_POST['username']);;
  $password = mysqli_real_escape_string($connect,md5($_POST['password']));
// $password = $_POST['password'];

$sql = "SELECT * from `admin` where username = '$username' and password ='$password'";
$result = mysqli_query($connect,$sql);
$num = mysqli_num_rows($result);

if($num ==1){
    $_SESSION['login'] = "You are login now " .$username;
    $_SESSION['user'] = $username;

    header("location: http://localhost/food/admin");
}else{
    $_SESSION['not'] = "Username or Password in invaild";
    header("location: http://localhost/food/admin/login-form.php");
}

}
?>

<!-- Bootstrap CDN for Navbar -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>