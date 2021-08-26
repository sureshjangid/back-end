<?php
session_start();

 require_once "./files.php/html.php" 
?>
<?php require_once "./files.php/navbar.php" ?>
<section class="rowBg">
    <div class="container">
        <div class="row">
            <h1 class="mt-2">Admin Panal</h1>
            <?php 
              if(isset($_SESSION['add'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['add'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
                  unset($_SESSION['add']);
              }

              if(isset($_SESSION['update'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['update'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>'; 
              unset($_SESSION['update']);
              }

              if(isset($_SESSION['delete'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['delete'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>'; 
              unset($_SESSION['delete']);
              }

              if(isset($_SESSION['user-not'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error ! </strong>'.$_SESSION['user-not'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>'; 
              unset($_SESSION['user-not']);
              }
              if(isset($_SESSION['pass-changed'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['pass-changed'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>'; 
              unset($_SESSION['pass-changed']);
              }
             
              
            ?>
            <br><br>
            <a href="./add-admin.php" class="btn btn-outline-primary col-2 mt-3 mb-3">Add New Admin</a>
            <table class="table table-bordered   table-hover table-striped">
                <tbody>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                    


                    // Connection with database
                    require_once "../config/database.php";

                    //  Variable from ID number 
                    $id = 1;
                    // Fetch data from database


                    $sql = "SELECT * from `admin`";
                    $result = mysqli_query($connect,$sql);

                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        while($row = mysqli_fetch_assoc($result)){

                            
                             $name = $row['name'];
                             $username = $row['username'];
                            
                            echo '<tr>
                            <td>'.$id++.'</td>
                            <td>'.$name.'</td>
                            <td>'.$username.'</td>
                            <td>
                                 <a href="new-password.php?id='.$row['id'].'" class="btn btn-outline-secondary">Change Password</a>
                                 <a href="admin-update.php?id='.$row['id'].'" class="btn btn-outline-success">Update</a>
                                <a href="admin-delete.php?id='.$row['id'].'" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>';

                        }
                    }
                    else{
                        echo '
                        
                        <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                          <h1 class="display-4">Not Found 😢</h1>
                          <p class="lead">Be the First Admin to control the Admin Panal</p>
                      </div>
                      ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require_once "./files.php/footer.php" ?>