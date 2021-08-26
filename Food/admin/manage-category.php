<?php
 // connection with database
 session_start();
 require_once "../config/database.php";
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>
<section class="rowBg">

    <div class="container-fluid">
        <div class="row">
            <h1 class="mt-2">Category Panal</h1>
            <?php
            
            // New Category add message
            if(isset($_SESSION['cat-success'])){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['cat-success'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['cat-success']);
            }
            //  Category Delete message
            if(isset( $_SESSION['cat-delete'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.$_SESSION['cat-delete'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['cat-delete']);
            }

            //  Remove Image message
            if(isset($_SESSION['img-remove'] )){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error ! </strong>'.$_SESSION['img-remove'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['img-remove']);
            }
            //  update Category message
            if(isset(  $_SESSION['cat-update'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful ! </strong>'.  $_SESSION['cat-update'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['cat-update']);
            }
            // When category failed to update then show this message 
            if(isset(  $_SESSION['cat-not-update'])){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error ! </strong>'.  $_SESSION['cat-not-update'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              unset($_SESSION['cat-not-update']);
            }

        ?>
            <a href="add-category.php" class="btn btn-outline-primary col-2 mt-3 mb-3">Add New Category</a>
            <table class="table table-bordered   table-hover table-striped">
                <tbody>
                    <tr>
                        <th>Id</th>
                        <th>Tilte</th>
                        <th>Image_name</th>
                        <th>featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                      $limit = 3;
                      if(isset($_GET['page_number'])){
                        $page_number = $_GET['page_number'];
                      }else{
                          $page_number = 1;
                      }
                      $offset = ceil($page_number - 1) * $limit;
                    // fetching data from database
                    $sql = "SELECT * FROM `categories` order by id desc LIMIT $offset , $limit";

                    $result = mysqli_query($connect,$sql);
                    $num = mysqli_num_rows($result);
                     $id = 1;
                    if($num >0){
                        while($row = mysqli_fetch_assoc($result)){
                           $get_id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active= $row['active'];
                     
                           

                 ?>
                    <tr>
                        <?php
                        $siteURL ="http://localhost/food/";
                        ?>
                        <td><?php echo $id++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php 
                        if($image_name!=""){
                            
                            ?>
                            <img src="<?php echo $siteURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                            <?php
                        }else{
                            echo "<div class=' text-danger'>No Image Found</div>";

                        }
                        ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="./update-category.php?id=<?php echo $get_id?>"
                                class="btn btn-outline-success">Update</a>
                            <a href="./delete-category.php?id=<?php echo $get_id?>&image-name=<?php echo $image_name;?>"
                                class="btn btn-outline-danger">Delete</a>
                        </td>
                        <?php

}
}
else{
    echo '
    
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Not Found 😢</h1>
      <p class="lead">Be the First to Add Category</p>
  </div>
  ';
}
   ?>
                </tbody>
            </table>




<!-- pagination -->
<?php
$sql2= "SELECT * from `categories`";
$result3 = mysqli_query($connect,$sql2);
$num3 = mysqli_num_rows($result3);

if($num3 > 0){
    
    $total_row = $num3;
  
    $page = $total_row / $limit;
        echo '  <ul class="pagination ">';
    for($a=1; $a<=$page;$a++){
        echo '<li class="page-item"><a class="page-link" href="manage-category.php?page_number='.$a.'">'.$a.'</a></li>';
    }
}
?>
            <!-- <nav aria-label="Page navigation example ">
              
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                
          </ul> 
        </div>
    </div>
</section>
<?php require_once "./files.php/footer.php" ?>