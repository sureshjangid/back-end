<?php  include "./front-end/html-navbar.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<!-- display the message  -->
<?php

// order successful message
if(isset($_SESSION['order-success'])){
    echo $_SESSION['order-success'];
    unset($_SESSION['order-success']);
}
// order failed message
if(isset($_SESSION['order-failed'])){
    echo $_SESSION['order-failed'];
    unset($_SESSION['order-failed']);
}

?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>


        <?php

            // Selecting categories from database to display
            $sql = "SELECT * from `categories` where active='Yes' AND featured='Yes' limit 0,3";

            // execute the query
            $result = mysqli_query($connect,$sql);

            // count the number of rows
            $num = mysqli_num_rows($result);
            
            // check whether number of rows 
            if($num >0){
                while($row = mysqli_fetch_assoc($result)){
                   $id = $row['id'];
                   $title = $row['title'];
                   $image_name = $row['image_name'];
                    
            ?>

        <a href="category-foods.php?category_id=<?php echo $id ?>">
            <div class="box-3 float-container">
                <!-- check whether image is available or not  -->
                <?php
                if($image_name==""){
                    echo "<div class='text-danger'>Image not available</div>";
                }else{

                
                ?>
                <img src="http://localhost/food/images/category/<?php  echo $image_name?>" alt="Pizza"
                    class="img-responsive img-curve">

                <?php
                    }
                ?>
                <h3 class="float-text text-white"><?php  echo $title ?></h3>
            </div>
        </a>
        <?php
              }
            }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- Select data from database table t display the food -->
        <?php
            
            $sql2 = "SELECT * from `food` where active='Yes' and featured='Yes' limit 0,4";

            // execute the query
            $result2= mysqli_query($connect,$sql2);

            // count the number of rows
            $num2 = mysqli_num_rows($result2);

            // check whether with number of rows
            if($num2>0){
                while($row2 = mysqli_fetch_assoc($result2)){
                    
                    $id2 = $row2['id'];
                    $title2= $row2['title'];
                    $desctiption2= $row2['desrciption'];
                    $image_name2= $row2['image_name'];
                    $price2 = $row2['price'];
            
        ?>
         <div class="food-menu-box">
            <div class="food-menu-img">
                <!-- check whether image is available or not -->
                <?php
                if($image_name2==""){
                    // if No image available then display this message
                    echo '<div class="text-danger">No Image Available</div>';
                }else{

                
                ?>
                <img src="http://localhost/food/images/food/<?php echo $image_name2 ;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                <?php
                }
                ?>
            </div>
            <div class="food-menu-desc">
                <h4><?php echo $title2; ?></h4>
                <p class="food-price"><?php echo '₹'.$price2 ?></p>
                <p class="food-detail">
                    <?php echo substr($desctiption2,0,40)."..." ;?>
                </p>
                <br>

                <a href="order.php?Food-id=<?php echo $id2 ?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php
            }
        }else{
            echo "";
        }

        ?>
       



        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php  include "front-end/footer.php"?>