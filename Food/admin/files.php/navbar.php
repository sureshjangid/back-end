<!-- Navbar Section Starts Here -->
<?php
require_once "../admin/check-login.php";
        if(isset($_SESSION['login'])&& ($_SESSION['login']==true)){
         $login = true;      
        }else{
          $login = false;
        }
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light navBg">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./manage-admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./manage-food.php">Food</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./manage-category.php">Categroy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./order.php">Order</a>
        </li>
        
         <li class="nav-item">
          <a href="./admin-logout.php" class="btn btn-outline-light">Logout</a>
          </li>
        
       
    
      </ul>
      
    </div>
  </div>
</nav>