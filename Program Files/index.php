<!-- 
    Author: @shrimeichock
    Date created: April 2, 2022
    Version: 1.2
    Description: Home page of website with search bar and table options
 -->
 
<?php 
require('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="../Styles/styles.css">
<head>
<body>
    <h1>Hospital Management System</h1>
    <form action='./display_table.php' method='post'>
        <label for='Keyword'> Keyword: </label>
        <input type='text' id='inputField' name='keyword' placeholder='Enter a keyword'></input>
        <input type='submit' value='Patients' name='patients' id='button'>
        <input type='submit' value='Doctors' name='doctors' id='button'>
        <input type='submit' value='Illnesses' name='illnesses' id='button'>
        <input type='submit' value='Departments' name='departments' id='button'>
    </form>
    
</body>
</html>
