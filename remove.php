<?php
require('config.php');

$string = $_GET['remove'];
//echo $string."<br>";

if(substr($string, 0,13)=='removePatient'){
    $id = substr($string, 13,2);
    $sql = "DELETE FROM patients WHERE ID={$id}";
    $sql2 = "DELETE FROM is_experiencing WHERE Patient_id = {$id}";
    $sql3 = "DELETE FROM sick_from WHERE Patient_id = {$id}";
    $sql4 = "DELETE FROM assigned_to WHERE Patient_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $result2 = mysqli_query($connect, $sql2);
    $result3 = mysqli_query($connect, $sql3);
    $result4 = mysqli_query($connect, $sql4);
    //echo $sql;
}elseif(substr($string, 0,12)=='removeDoctor'){
    $id = substr($string, 12,2);
    $sql = "DELETE FROM doctors WHERE ID={$id}";
    //echo $sql;
    $result = mysqli_query($connect, $sql);
}
header("Location: ./index.php"); 
?>