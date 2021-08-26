<?php  include "front-end/html-navbar.php"?>

<?php
//  check whether id is isset or not 

if(isset($_GET['Food-id'])){

  // Get from URL
  $id= $_GET['Food-id'];

  // Get the details of selecting food
  $sql = "SELECT * FROM `food` WHERE id = $id";
  // Execute the query
  $result = mysqli_query($connect,$sql);
  // count the number of rows
  $num = mysqli_num_rows($result);
  
  // check whether rows are more then 0
  if($num == 1){
   $row = mysqli_fetch_assoc($result);
   
   $title = $row['title'];
   $price = $row['price'];
   $image_name = $row['image_name'];
  }

}   
 
       
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">
            Fill this form to confirm your order.
        </h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <!-- check whether image is available or not -->
                    <?php
              if(!$image_name==""){
               ?>
                    <img src="http://localhost/food/images/food/<?php echo $image_name ?>"
                        class="img-responsive img-curve" alt="">
                    <?php

              }else{ 
                  echo '<div class=""> Image not available</div>';
            } 
            ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <p class="food-price">₹<?php echo $price ?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required />
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>

                <!-- hidden inputs  -->
                <input type="hidden" name="food" value="<?php echo  $title?>">
                <input type="hidden" name="price" value="<?php echo $price  ?>">

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required />

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required />

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive"
                    required />

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />
            </fieldset>
        </form>

    </div>

</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php  include "front-end/footer.php"?>

<!-- footer Section Ends Here -->

<?php
// check whether submit button clicked or not
if(isset($_POST['submit'])){

  // Get data from form
  $title = $_POST['food'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $total = $price * $qty;
  $status = "ORDERED";
  $c_name = $_POST['full-name'];
  $c_contact = $_POST['contact'];
  $c_email = $_POST['email'];
  $c_address = $_POST['address'];

//   Insert data into database table order_food
$sql2 = "INSERT INTO `order_food` ( `food`, `price`, `qty`, `total`, `order_date`, `status`, `c_name`, `c_contact`, `c_email`, `c_address`) VALUES ('$title', $price, '$qty', $total , current_timestamp(), '$status','$c_name', '$c_contact', '$c_email', '$c_address')";
  
// Execute query
$result2 = mysqli_query($connect,$sql2);

// check whether order success or not
if($result2==true){
    // when order success then display this message on index.php
    $_SESSION['order-success'] = "<div class='text-center' id='success'>Order successfull</div>";
    // Redirect 
    echo '<script>
    window.location.href="http://localhost/food?order_success=true"
    </script>';
  
    // stop to proess
    die();
}else{
    // when order failed then display this message on index.php
    $_SESSION['order-failed'] = "<div class='text-center error'>Order Failed</div>";
    // Redirect
    echo '<script>
    window.location.href="http://localhost/food?order_success=false"
    </script>';

}
}else{
  echo '';
}

?>


<script>
//  let timedate = new Date();
//  let timeshow = timedate.toTimeString;


function timeshow() {
    time.innerHTML = new Date();
}
console.log(new Date());
setInterval(timeshow, 1000);
</script>
</body>

</html>