<!-- 
    Author: @shrimeichock
    Date created: April 2, 2022
    Description: Remove doctor or patient from database
 -->

<?php
require('config.php');

$string = $_GET['remove'];

if(substr($string, 0,13)=='removePatient'){
    $id = substr($string, 13);
    $sql = "DELETE FROM patients WHERE ID={$id}";

    //Completely remove patient from connected tables

    /*
    $sql2 = "DELETE FROM is_experiencing WHERE Patient_id = {$id}";
    $sql3 = "DELETE FROM sick_from WHERE Patient_id = {$id}";
    $sql4 = "DELETE FROM assigned_to WHERE Patient_id = {$id}";
    $result2 = mysqli_query($connect, $sql2);
    $result3 = mysqli_query($connect, $sql3);
    $result4 = mysqli_query($connect, $sql4);
    */

    $result = mysqli_query($connect, $sql);
    //echo $sql;

}elseif(substr($string, 0,12)=='removeDoctor'){
    $id = substr($string, 12);
    $sql = "DELETE FROM doctors WHERE ID={$id}";

    //Completely remove doctor from connected tables
    
    /*
    $sql2 = "DELETE FROM assgned_to WHERE Doctor_id = {$id}";
    $result2 = mysqli_query($connect, $sql2);
    */
    
    $result = mysqli_query($connect, $sql);
    //echo $sql;
}
header("Location: ./index.php"); 
?>
