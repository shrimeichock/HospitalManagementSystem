<?php

try{
    $db = new PDO('sqlite:hospital_management.db');
    
}catch(PDOException $e){
    echo $e->getMessage();
}

?>