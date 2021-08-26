<?php  include "front-end/html-navbar.php"?>

<?php 
// checking whether id isset or not
if(isset($_GET['category_id'])){
    
    // get id from url
    $category_id = $_GET['category_id'];
    
    // creating sql query
    $sql = "SELECT title from `categories` where id='$category_id'";

    // execute query
    $result = mysqli_query($connect,$sql);

    // count the number of rows
    $num = mysqli_num_rows($result);

    // fetch data
    $row= mysqli_fetch_assoc($result);
    $title = $row['title'];
    

}else{
    // if id not isset then redirect to index.php
    header("location: http://localhost/food");
    
    // stop to process
    die();
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
<?php
// Create sql query
$sql2 = "SELECT * from `food` where category_id='$category_id'";

// Execute query
$result2= mysqli_query($connect,$sql2);

// count the number of row
$num = mysqli_num_rows($result2);

// check whether row is available or not
if($num>0){
    while($row2=mysqli_fetch_assoc($result2)){
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

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php  include "front-end/footer.php"?>


</body>
</html>