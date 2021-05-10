<?php
    require '../../database/mysql.php';
    $university_id = strtoupper($_POST['university_id']);
    $school_name = $_POST['school_name'];
    $dean = $_POST['dean'];

    $sql = "INSERT INTO school (school_name, dean, university_id) 
            VALUES('$school_name', '$dean', '$university_id')"; 
    
    if($mysql->query($sql)){
        header("Location: ../schools.php");
    }else{
        header("Location: ../school-create.php");
    }
?>