<?php  include "front-end/html-navbar.php"?>


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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

                    <!-- Select data from database table t display the food -->
                    <?php
                        $sql = "SELECT * from `food` where active='Yes' and featured='Yes'";

                        // execute query
                        $result= mysqli_query($connect,$sql);
                         // count the number of rows
            $num2 = mysqli_num_rows($result);

            // check whether with number of rows
            if($num2>0){
                while($row2 = mysqli_fetch_assoc($result)){
                    
                    $id2 = $row2['id'];
                    $title2= $row2['title'];
                    $desctiption2= $row2['desrciption'];
                    $image_name2= $row2['image_name'];
                    $price2 = $row2['price'];
            
        ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
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
                    <p class="food-price"><?php echo  '₹'.$price2 ;?></p>
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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php  include "front-end/footer.php"?>

</body>
</html>