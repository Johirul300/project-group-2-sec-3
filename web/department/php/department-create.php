<?php
    require '../../database/mysql.php';
    $school_id = strtoupper($_POST['school_id']);
    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name'];
    $head = $_POST['head'];

    $sql = "INSERT INTO department (department_id, department_name, head, school_id) 
            VALUES('$department_id', '$department_name', '$head', '$school_id')"; 
    
    if($mysql->query($sql)){
        header("Location: ../departments.php");
    }else{
        header("Location: ../department-create.php");
    }
?>