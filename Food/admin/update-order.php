<?php 
session_start();
 require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<?php
//<!-- check whether id is isset or not in url -->
if(isset($_GET['order-id'])){
//   connection with data base
require_once "../config/database.php";
    // get the id from URL
    $id = $_GET['order-id'];
    
    // select data from table 
    $sql = "SELECT * from `order_food` where id='$id'";
    
    // Exexcute the query
    $result = mysqli_query($connect,$sql);

    // count the number of rows
    $num = mysqli_num_rows($result);

    // check whether data available or not
    if($num==1){
        
        // when data available then fetch the data
        $row= mysqli_fetch_assoc($result);
        
    }else{
        // when data not available then display this message
        echo "Data not available";
    }

}else{
    // when id not set
    // redirect order.php page
    header("location: http://localhost/food/admin/order.php");
}
    
?>

<div class="container">
    <div class="row">
        <h1 class="text-center mt-5 mb-3">Order Update</h1>
        <div class="col-4 m-auto">
            <form action="" method="POST">
                <label for="">Food </label>
                <h3 class="text-danger"><?php echo $row['food']?></h3>

                <label for="">Qty</label>
                <input type="number" name="qty" value="<?php echo $row['qty'] ?>" class="form-control">

                <label for="">Order Status</label>
                <br>
                <select name="status" id="">
                    <option <?php if($row['status']=="ON DELIVERY"){ echo "selected";} ?>value="ON DELIVERY">ON DELIVERY
                    </option>
                    <option <?php if($row['status']=="ORDERED")  {echo "selected";} ?>value="Ordered">ORDERED</option>
                    <option <?php if($row['status']=="DELIVERED"){echo "selected";} ?>value="DELIVERED"> DELIVERED
                    </option>
                    <option <?php if($row['status']=="CANCELLED") {echo "selected";} ?>value="CANCELLED">CANCELLED
                    </option>
                </select>
                <br>
                <br>
                <!-- Hidden inputs -->
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                <button class="btn btn-success" name="submit">Confirm</button>
                <a href="order.php" class="btn btn-warning">Back</a>
            </form>
        </div>
    </div>
</div>

<?php

// check whether button click or  not
if(isset($_POST['submit'])){

    // get the data from form
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = mysqli_real_escape_string($connect,$_POST['qty']);

    // total price
    $total = $price * $qty;
    
    $status = mysqli_real_escape_string($connect,$_POST['status']);

    // update the data 
    $sql2 = "UPDATE `order_food` SET
    price= '$price',
    qty= '$qty',
    total= '$total',
    status= '$status'
    WHERE id= $id";

    // Execute the query
    $result2 = mysqli_query($connect,$sql2);

    // when data update Successfully then display the message
    if($result2==true){
        
        // success
        $_SESSION['order-update'] = "Order Update ";

        // when order update successful then redirect to order.php page
        echo '<script>
         window.location.href= "http://localhost/food/admin/order.php?order_update=true"
        </script>';
        // stop to process
        die();
    }else{
        // when failed to update order then display this message
        $_SESSION['order-update-failed'] = "Failed to update order";
          // when order update successful then redirect to order.php page
          echo '<script>
          window.location.href= "http://localhost/food/admin/order.php?order_update=false"
          </script>';
          
    }
}else{
    
}
?>