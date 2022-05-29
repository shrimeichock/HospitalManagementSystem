<?php
    $server = "localhost";
    $username = "hospitalAdmin";
    $password = "hospitalAdmin*123";
    $database = "hospital";
    
    $connect = mysqli_connect($server, $username, $password, $database);
    if(!$connect){
        die("Connection failed: " . mysqli_connect_error());
    }
?>
