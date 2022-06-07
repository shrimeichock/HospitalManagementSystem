<!-- 
    Author: @shrimeichock
    Date created: April 2, 2022
    Version: 
    Description: View single patient or doctor's info
 -->

<?php
    include_once('index.php'); //to carry over formatting
    require('config.php');

    $id = $_GET['id']; //patient or doctor id
    $table = $_GET['table']; //patient or doctor table

    if($table == 'doctors'){

        //print out basic doctor data
        $sql = "SELECT * FROM {$table} WHERE ID = {$id}";
        $result = mysqli_query($connect, $sql);

        foreach($result as $row){
            echo "<h2>Dr. {$row['FirstName']} {$row['LastName']}</h2>";
            echo "<table border=1>";
            echo "<tr><th>Doctor ID</th><td>{$row['ID']}</td></tr>";
            echo "<tr><th>First Name</th><td>".$row['FirstName']."</td></tr>";
            echo "<tr><th>Last Name</th><td>".$row['LastName']."</td></tr>";
            echo "<tr><th>Phone Number</th><td>".$row['PhoneNumber']."</td></tr>";
            echo "<tr><th>Email</th><td>".$row['Email']."</td></tr>";
            echo "<tr><th>Address</th><td>".$row['Address']."</td></tr>";
            echo "<tr><th>Position</th><td>".$row['Position']."</td></tr>";
            echo "<tr><th>Date Joined</th><td>".$row['Date_joined']."</td></tr>";
            echo "<tr><th>Department</th><td>".$row['Department']."</td></tr>";
        }

        //patients that the doctor is assigned to
        $sql2 = "SELECT * FROM assigned_to NATURAL JOIN patients WHERE Doctor_id = {$id} AND Patient_id = ID";
        $result2 = mysqli_query($connect, $sql2);

        echo "<tr><th>Patients</th><td><ul>";
        foreach($result2 as $row){
            echo "<li>{$row['FirstName']} {$row['LastName']}</li>";
        }
        echo "</ul></td></tr>";
        echo "</table><br>";

        //remove button
        echo "<form action='./remove.php' method='get'>";
            echo "<button name='remove' type='submit' id='button' value='removeDoctor{$id}'>Remove Doctor</button>";
        echo "</form>";

        //print out sql queries
        echo "<p>".$sql."<br>";
        echo $sql2."<br></p>";

    }elseif($table == 'patients'){

        //print out basic patient data
        $sql = "SELECT * FROM {$table} WHERE ID = {$id}";
        $result = mysqli_query($connect, $sql);

        foreach($result as $row){
            echo "<h2>{$row['FirstName']} {$row['LastName']}</h2>";
            echo "<table border=1>";
            echo "<tr><th>Patient ID</th><td>{$row['ID']}</td></tr>";
            echo "<tr><th>First Name</th><td>".$row['FirstName']."</td></tr>";
            echo "<tr><th>Last Name</th><td>".$row['LastName']."</td></tr>";
            echo "<tr><th>Sex</th><td>".$row['Sex']."</td></tr>";
            echo "<tr><th>Phone Number</th><td>".$row['PhoneNumber']."</td></tr>";
            echo "<tr><th>Email</th><td>".$row['Email']."</td></tr>";
            echo "<tr><th>Address</th><td>".$row['Address']."</td></tr>";
            echo "<tr><th>Birthdate</th><td>".$row['Birthdate']."</td></tr>";
            echo "<tr><th>Insurance Number</th><td>".$row['Insurance']."</td></tr>";
            echo "<tr><th>Date Admitted</th><td>".$row['DateAdmitted']."</td></tr>";
        }
        
        //print out symptoms
        $sql2 = "SELECT * FROM is_experiencing NATURAL JOIN symptoms WHERE Patient_id = {$id} AND Symptom = ID";
        $result2 = mysqli_query($connect, $sql2);
    
        echo "<tr><th>Symptoms</th><td><ul>";
        foreach($result2 as $row){
            echo "<li>{$row['Symptom_name']} ({$row['Severity']})</li>";
        }
        echo "</ul></td></tr>";

        //print out doctors assigned to the patient
        $sql3 = "SELECT * FROM assigned_to NATURAL JOIN doctors WHERE Patient_id = {$id} AND Doctor_id = ID";
        $result3 = mysqli_query($connect, $sql3);

        echo "<tr><th>Doctor(s)</th><td><ul>";
        foreach($result3 as $row){
            echo "<li>Dr. {$row['FirstName']} {$row['LastName']}</li>";
        }
        echo "</ul></td></tr>";

        //illnesses that patient is sick from
        $sql4 = "SELECT * FROM sick_from WHERE Patient_id = {$id}";
        $result4 = mysqli_query($connect, $sql4);

        echo "<tr><th>Illnesses</th><td><ul>";
        foreach($result4 as $row){
            echo "<li>{$row['Illness']} ({$row['Status']})</li>";
        }
        echo "</ul></td></tr>";
        echo "</table><br>";

        //remove button
        echo "<form action='./remove.php' method='get'>";
            echo "<button name='remove' type='submit' id='button' value='removePatient{$id}'>Remove Patient</button>";
        echo "</form>";

        //print out sql queries
        echo "<p>".$sql."<br>";
        echo $sql2."<br>";
        echo $sql3."<br>";
        echo $sql4."<br><p>";
    }
    
    
?>
