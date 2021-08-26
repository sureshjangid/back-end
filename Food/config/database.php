<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "food-order";

    $connect = mysqli_connect($server,$user,$password,$database);

    if(!$connect){
        echo "Not Connect due to -> " . mysqli_connect_error($connect);
    }
?>