<?php require('config.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Database System</title>
    <link rel="stylesheet" href="styles.css">
<head>
<body>
    <h1>Hospital Management System</h1>
    <form action='/display_table.php' method='post'>
        <label for='Keyword'> Keyword: </label>
        <input type='text' id='keyword' name='keyword' placeholder='Enter a keyword'></input>
        <input type='submit' value='Patient' name='patient' id='button'>
        <input type='submit' value='Doctor' name='doctor' id='button'>
        <input type='submit' value='Illness' name='illness' id='button'>
        <input type='submit' value='Department' name='department' id='button'>
    </form>
    
</body>
</html>