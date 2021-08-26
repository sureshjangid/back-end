<?php
                
// if Food added
if(isset($_SESSION['insert-food'])){

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successful ! </strong>'.$_SESSION['insert-food'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['insert-food'] );
}

// if failed to upload image
if(isset($_SESSION['food-img'])){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['food-img'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['food-img']);
}
 // if failed to upload Delete
 if(isset($_SESSION['food-delete'])){

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success ! </strong>'.$_SESSION['food-delete'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['food-delete']);
}
 // if failed to insert data
 if(isset($_SESSION['failed-food'])){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['failed-food'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['failed-food']);
}
 // if failed to remove image
 if(isset($_SESSION['food-img-remove'])){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['food-img-remove'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['food-img-remove']);
}
 // if food update 
 if(isset($_SESSION['food-update'])){

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Successful ! </strong>'.$_SESSION['food-update'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['food-update']);
}
 // if food update failed
 if(isset($_SESSION['cat-not-update'])){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['cat-not-update'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['cat-not-update']);
}
 // if food image update failed
 if(isset($_SESSION['file-img-error'])){

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error ! </strong>'.$_SESSION['file-img-error'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    unset($_SESSION['file-img-error']);
}


?>
