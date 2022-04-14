<?php
require('config.php');

$string = $_GET['remove'];
echo $string."<br>";

if(substr($string, 0,13)=='removePatient'){
    $id = substr($string, 13,2);
    $sql = "DELETE FROM patients WHERE ID={$id}";
    $sql2 = "DELETE FROM is_experiencing WHERE Patient_id = {$id}";
    $sql3 = "DELETE FROM sick_from WHERE Patient_id = {$id}";
    $sql4 = "DELETE FROM assigned_to WHERE Patient_id = {$id}";
    $result = $db->query($sql);
    $result2 = $db->query($sql2);
    $result3 = $db->query($sql3);
    $result4 = $db->query($sql4);
    echo $sql;
}elseif(substr($string, 0,12)=='removeDoctor'){
    $id = substr($string, 12,2);
    $sql = "DELETE FROM doctors WHERE ID={$id}";
    echo $sql;
    $result = $db->query($sql);
}
header("Location: http://localhost/home.php"); 
?>