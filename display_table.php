<?php 
    include_once('home.php');

    require('config.php');

    echo "<table border=1 id='table'>";
    $key = ucwords($_POST['keyword']);
   
    if(isset($_POST['doctor'])){
        $table = 'doctor';
        $attribute = "FirstName = '{$key}' or LastName = '{$key}' or Position = '{$key}' or Department = '{$key}'";
        $sql = "SELECT * FROM {$table} WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['patient'])){
        $table = 'patient';
        $attribute = "FirstName = '{$key}' or LastName = '{$key}' or Sex = '{$key}'";
        $sql = "SELECT * FROM {$table} WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['illness'])){
        $table = 'illness';
        $attribute = "Name = Illness and Symptom = ID and (Name = '{$key}' or Symptom_name = '{$key}')";
        $sql = "SELECT * FROM {$table} NATURAL JOIN symptom_of NATURAL JOIN symptom WHERE {$attribute}";
        if($key == ''){
            $sql = "SELECT * FROM {$table}";
        }
    }elseif(isset($_POST['department'])){
        $table = 'department';
        $attribute = "Dept_name = '{$key}'";
        $sql = "SELECT * FROM {$table} NATURAL JOIN doctor WHERE {$attribute}"; 
        if($key == ''){
            $sql = "SELECT * FROM {$table} NATURAL JOIN doctor WHERE ID = Head";
        }
    }
    
    $result = $db->query($sql);
    $table_name = ucwords($table);
    echo "<h2>{$table_name}</h2>";

    if($table == 'doctor'){
        echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Position</th> <th>Department</th> </tr>";
        foreach($result as $row){
            echo "<tr><td><a href='expand.php?id={$row['ID']}&table={$table}'>{$row['ID']}</a></td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['Position']."</td>";
            echo "<td>".$row['Department']."</td></tr>";
        }
    }elseif($table == 'patient'){
        echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th>Date Admitted</th></tr>";
        foreach($result as $row){
            echo "<tr><td><a href='expand.php?id={$row['ID']}&table={$table}'>{$row['ID']}</a></td>";
            echo "<td>".$row['FirstName']."</td>";
            echo "<td>".$row['LastName']."</td>";
            echo "<td>".$row['DateAdmitted']."</td></tr>";
        }
    }elseif($table == 'illness'){
        echo "<tr> <th>Name</th> <th>Description</th> <th>Symptoms</th></tr>";
        foreach($result as $row){
            echo "<tr><td>".$row['Name']."</td>";
            echo "<td>".$row['Description']."</td>";

            $sql2 = "SELECT * FROM symptom_of NATURAL JOIN symptom WHERE Illness='{$row['Name']}' and Symptom = ID";
            $result2 = $db->query($sql2);
            echo "<td><ul>";
            foreach($result2 as $row){
                echo "<li>{$row['Symptom_name']}</li>";
            }
            echo "</ul></td></tr>";
        }

    }elseif($table == 'department'){
        echo "<tr> <th>Name</th> <th>Description</th> <th>Head</th></tr>";
        foreach($result as $row){
            echo "<tr><td>".$row['Dept_name']."</td>";
            echo "<td>".$row['Building']."</td>";
            echo "<td>{$row['FirstName']} {$row['LastName']}</td></tr>";
        }
    }

    echo "</table>";
    
    //print query
    echo "<p>{$sql}</p>";
?>