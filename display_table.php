<?php 
    include_once('home.php');

    require('config.php');

    
    $key = ucwords($_POST['keyword']);
   
    if(isset($_POST['doctors'])){
        $table = 'doctors';
        $attribute = "FirstName = '{$key}' or LastName = '{$key}' or Position = '{$key}' or Department = '{$key}'";
        $sql = "SELECT * FROM {$table} WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['patients'])){
        $table = 'patients';
        $attribute = "FirstName = '{$key}' or LastName = '{$key}' or Sex = '{$key}'";
        $sql = "SELECT * FROM {$table} WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['illnesses'])){
        $table = 'illnesses';
        $attribute = "Name = Illness and Symptom = ID and (Name = '{$key}' or Symptom_name = '{$key}')";
        $sql = "SELECT * FROM {$table} NATURAL JOIN symptom_of NATURAL JOIN symptoms WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['departments'])){
        $table = 'departments';
        $attribute = "Dept_name = '{$key}'";
        $sql = "SELECT * FROM {$table} NATURAL JOIN doctors WHERE {$attribute}"; 
        if($key == ''){
            $sql = "SELECT * FROM {$table} NATURAL JOIN doctors WHERE ID = Head";
        }
    }
    
    $result = $db->query($sql);
    $table_name = ucwords($table);
    echo "<h2>{$table_name}</h2>";

    if($table == 'doctors'){
        echo "<table border=1 id='table'>";
        echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Position</th> <th>Department</th> </tr>";
        foreach($result as $row){
            echo "<tr><td><a href='expand.php?id={$row['ID']}&table={$table}'>{$row['ID']}</a></td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['Position']."</td>";
            echo "<td>".$row['Department']."</td></tr>";
        }
        echo "</table>";
        echo "<form action='/doctor_form.html' method='get'>";
            echo "<br>";
            echo "<button name='addDoctor' type='submit' id='button' value='addDoctor'>Add Doctor</button>";
        echo "</form>";
    }elseif($table == 'patients'){
        echo "<table border=1 id='table'>";
        echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Date Admitted</th></tr>";
        foreach($result as $row){
            echo "<tr><td><a href='expand.php?id={$row['ID']}&table={$table}'>{$row['ID']}</a></td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['DateAdmitted']."</td></tr>";
        }
        echo "</table>";
        echo "<form action='/patient_form.html' method='get'>";
            echo "<br>";
            echo "<button name='addPatient' type='submit' id='button' value='addPatient'>Add Patient</button>";
        echo "</form>";
    }elseif($table == 'illnesses'){
        echo "<table border=1 id='table'>";
        echo "<tr> <th>Name</th> <th>Description</th> <th>Symptoms</th></tr>";
        foreach($result as $row){
            echo "<tr><td>".$row['Name']."</td>";
            echo "<td>".$row['Description']." <a href = {$row['Url']}> Read more...</a></td>";

            $sql2 = "SELECT * FROM symptom_of NATURAL JOIN symptoms WHERE Illness='{$row['Name']}' and Symptom = ID";
            $result2 = $db->query($sql2);
            echo "<td><ul>";
            foreach($result2 as $row){
                echo "<li>{$row['Symptom_name']}</li>";
            }
            echo "</ul></td></tr>";
        }
        echo "</table>";
    }elseif($table == 'departments'){
        echo "<table border=1 id='table'>";
        echo "<tr> <th>Name</th> <th>Description</th> <th>Head</th></tr>";
        foreach($result as $row){
            echo "<tr><td>".$row['Dept_name']."</td>";
            echo "<td>".$row['Building']."</td>";
            echo "<td>{$row['FirstName']} {$row['LastName']}</td></tr>";
        }
        echo "</table>";
    }
    
    //print query
    echo "<p>{$sql}</p>";
?>
