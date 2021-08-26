<?php
 // connection with database
 session_start();
 require_once "../config/database.php";
require_once "./files.php/html.php" ?>
<?php require_once "./files.php/navbar.php" ?>

<!-- order update message -->
<?php

// when order failed to update 
if(isset( $_SESSION['order-update-failed'])){
   
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error ! </strong>'.$_SESSION['order-update-failed'].'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['order-update-failed']);
    }

    // when order update successful
if(isset( $_SESSION['order-update'])){
   
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successful ! </strong>'.$_SESSION['order-update'].'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['order-update']);
    }
?>
<section class="rowBg">
    <div class="container-fluid">
        <div class="row">
            <h1 class="mt-2">Order Panal</h1>
            <table class="table table-bordered   table-hover table-striped">
                <tbody>
                    <tr>
                        <th>Order No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total Price</th>
                        <th>Date-Time</th>
                        <th>Status</th>
                        <th>Custmer_name</th>
                        <th>Custmer_email</th>
                        <th>Custmer_cotact</th>
                        <th>Custmer_Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    
                    // fetch data from order_food table
                    $sql = "SELECT * from `order_food` ORDER BY id desc";
                    
                    // Execute query
                    $result = mysqli_query($connect,$sql);

                    // count the number of rows
                    $num = mysqli_num_rows($result);
                    
                    // id number
                    $id = 1;
                    // check whether rows are available or not
                    if($num >0){
                        while($row= mysqli_fetch_assoc($result)){
                        $ids = $id++;
                        $food =$row['food'];
                        $price =$row['price'];
                        $qty =$row['qty'];
                        $total =$row['total'];
                        $order =$row['order_date'];
                        $status =$row['status'];
                        $c_name =$row['c_name'];
                        $c_contact =$row['c_contact'];
                        $c_email =$row['c_email'];
                        $c_address =$row['c_address'];
                    
                    ?>
                    <tr>
                        <td><?php echo $ids; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo '₹'.$price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo '₹'.$total; ?></td>
                        <td><?php echo $order; ?></td>
                        <td>
                            
                        <?php
                        // order
                            if($status=="ORDERED"){
                                echo '<p class="text-color">ORDERED</p>';
                            }elseif($status=="ON DELIVERY"){
                                echo '<p class="text-primary">ON DELIVERY</p>';
                            }elseif($status=="DELIVERED"){
                                echo '<p class="text-success">DELIVERED</p>';

                            }else{
                                echo '<p class="text-danger" >CANCELLED</p>';
                            }
                        ?>
                                
                        </td>
                        <td><?php echo $c_name; ?></td>
                        <td><?php echo $c_contact; ?></td>
                        <td><?php echo $c_email; ?></td>
                        <td><?php echo $c_address; ?></td>
                        <td><a href="update-order.php?order-id=<?php echo $row['id']?>" class="btn btn-outline-success">Update</a></td>
                    </tr>
              <?php
                  }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require_once "./files.php/footer.php" ?>