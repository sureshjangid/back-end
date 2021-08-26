
   
<?php
session_start();
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>
<section class="rowBg">
<?php
 if(isset($_SESSION['login'])){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successful ! </strong>'.$_SESSION['login'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>'; 
  unset($_SESSION['login']);
  }
  ?>
    <div class="container">
        <div class="row">
            <h1>Dashboard</h1>
            <div class="col-md-3 footCard">
                <!-- fetch data from categories table -->
                <?php 
                // connection with database
                require_once "../config/database.php";

                $sql = "SELECT * from `categories`";
                $result = mysqli_query($connect,$sql);
                $num = mysqli_num_rows($result);
                ?>
                <h3><?php echo $num ?></h3>
                <p>Categories</p>
            </div>
            <div class="col-md-3 footCard">
                    <!-- fetch data from categories table -->
                    <?php 
            
                
                $sql = "SELECT * from `food`";
                $result = mysqli_query($connect,$sql);
                $num = mysqli_num_rows($result);
                ?>
                <h3><?php  echo $num;?></h3>
                <p>food</p>
            </div>
            <div class="col-md-3 footCard">
                    <!-- fetch data from order_food table -->
                    <?php 
                
                $sql = "SELECT * from `order_food`";
                $result = mysqli_query($connect,$sql);
                $num = mysqli_num_rows($result);
                ?>
                <h3><?php echo $num; ?></h3>
                <p>Order</p>
            </div>
            <div class="col-md-3 footCard">
                    <?php
                        
                        $sql1 = "SELECT SUM(total) as total from order_food where status='DELIVERED'";
                        $result1 = mysqli_query($connect,$sql1);
                        $num = mysqli_fetch_assoc($result1);
                        $total_price = $num['total'];
                    ?>
                <h3>₹<?php echo $total_price; ?></h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>
</section>
<?php require_once "./files.php/footer.php" ?>

