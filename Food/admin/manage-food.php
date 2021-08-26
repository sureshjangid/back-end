<?php       
     // connection with database
     session_start();
     require_once "../config/database.php";
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>
<section class="rowBg">

    <div class="container-fluid">
        <div class="row">
            <!-- Displaying the message -->
  <?php include "./files.php/message.php" ?>
        <h1 class="mt-2">Food Panal</h1>
            <a href="./add-food.php" class="btn btn-outline-primary col-2 mt-3 mb-3">Add New Food</a>
            <table class="table table-bordered   table-hover table-striped">
                <tbody>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Desrciption</th>
                        <th>Price</th>
                        <th>Food-Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                   
                    </tr>

                    <?php
                        // display the data from food table 
                        $sql1 = "SELECT * from `food`";
                        $result1 = mysqli_query($connect,$sql1);
                        $num = mysqli_num_rows($result1);
                        $id = 1;
                        if($num>0){
                            while($row = mysqli_fetch_assoc($result1)){

                        

                    ?>
                    <tr>
                        <td><?php echo $id++?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['desrciption']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php
                        if($row['image_name']!=""){

                        ?>
                       <img src="../images/food/<?php echo $row['image_name'] ?>" alt="" width="100px"> 
                        <?php
                        }
                        else{
                            echo "<div class=' text-danger'>No Image Found</div>";
                        }
                        ?>
                    </td>
                        <td><?php echo $row['featured']?></td>
                        <td><?php echo $row['active']?></td>
                        <td>
                            <a href="./update-food.php?id=<?php  echo $row['id']?> & image_name=<?php echo $row['image_name']?>" class="btn btn-outline-success">Update</a>
                            <a href="./delete-food.php?id=<?php  echo $row['id']?> & image_name=<?php echo $row['image_name']?>" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
               <?php
                   }
                }else{
                    echo ' <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-4">Not Found 😢</h1>
                      <p class="lead">Be the First to Add Food</p>
                  </div>';
                }
                ?>
                </tbody>
            </table>
            
        </div>
    </div>
</section>
<?php require_once "./files.php/footer.php" ?>