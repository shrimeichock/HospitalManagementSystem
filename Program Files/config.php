<!-- 
    Author: @shrimeichock
    Date created: April 2, 2022
    Version: 1.1
    Description: Connect to hospital database
 -->

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
