<?php
//Add patient/doctor SQL logic
require('config.php');

if($_POST['submit']=="Add Doctor"){
    $sql = "INSERT INTO doctors (FirstName, LastName, PhoneNumber, Email, Address, Position, Date_joined, Department) VALUES('{$_POST['fname']}', '{$_POST['lname']}','{$_POST['phone']}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['position']}', '{$_POST['date']}', '{$_POST['department']}')";
    $result = $db->query($sql);
}elseif($_POST['submit']=="Add Patient"){
    $sql = "INSERT INTO patients (FirstName, LastName, Sex, PhoneNumber, Email, Address, Birthdate, Insurance, DateAdmitted) VALUES ('{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['sex']}', '{$_POST['phone']}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['birthdate']}', '{$_POST['insurance']}', '{$_POST['date']}')";
    $result = $db->query($sql);

    //get most recently added ID
    $sql2 = "SELECT ID FROM patients ORDER BY ID DESC LIMIT 1"; 
    $result2 = $db->query($sql2);
    foreach($result2 as $id){
        $patient_id = $id;
    }
    $patient = $patient_id[0];
    echo $patient;

    if (isset($_POST['symptoms'])){

        foreach($_POST['symptoms'] as $symptom){
            $sev = $_POST[$symptom."_sev"]; //get severity
            $sql3 = "INSERT INTO is_experiencing VALUES($patient, $symptom, $sev)";
            $result3 = $db->query($sql3);
        }
    }
}

header("Location: http://localhost/index.php"); 
?>
