<?php  include "front-end/html-navbar.php"?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        // search name
            // $search = mysqli_real_escape_string($_POST['search']);
            $search = mysqli_real_escape_string($connect,$_POST['search']);
           
        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">

        <h2 class="text-center">Food Menu</h2>

        <!-- select seacrh food -->

        <?php
            
            // POST Request from index.php page for search foor
            // select query
            $sql = "SELECT * from `food` WHERE title LIKE '%$search%' OR desrciption LIKE '%$search%' ";

            // exexute query
            $result = mysqli_query($connect,$sql);
if(!$result){
    echo "not -> ".mysqli_error($connect);
}
            // count the number of rows
            $num = mysqli_num_rows($result);

            if($num>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id=$row['id'];
                    $title=$row['title'];
                    $desrciption=$row['desrciption'];
                    $image_name=$row['image_name'];
                    $price=$row['price'];

             
            ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <!-- check whether image availalble or not -->
                <?php
                    if($image_name==""){
                        echo "<div class='text-danger'>Image not available</div>";
                    }else{

                    
                ?>
                <img src="http://localhost/food/images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza"
                    class="img-responsive img-curve">
                <?php
                }
                ?>
            </div>

            <div class="food-menu-desc">
                <h4><?php $title ?></h4>
                <p class="food-price">₹<?php echo $price?></p>
                <p class="food-detail">
                    <?php echo $desrciption ?>
                </p>
                <br>

                <a href="#" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php
            }
            }
            else{
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h3 class="display-4 text-danger">Not Available</h3>
                  <p class="lead">
                  <ul>
                  <li>Make sure that all words are spelled correctly.</li>
                  <li>Try different keywords. </li>
                  <li>Try more general keywords.</li>
                  </ul>
                  </p>    
                </div>
              </div>';
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php  include "front-end/footer.php"?>


</body>

</html>