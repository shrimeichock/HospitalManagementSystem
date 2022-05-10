<?php require('config.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
<head>
<body>
    <h1>Hospital MaMMMM</h1>
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
