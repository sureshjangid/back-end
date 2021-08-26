<?php  include "front-end/html-navbar.php"?>


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
    <?php  include "front-end/footer.php"?>

   