<?php
    require '../../database/mysql.php';
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $program_id = $_POST['program_id'];
    $department_id = $_POST['department_id'];

    $user_type = $_POST['user_type'];

    if($user_type == "student"){
        $sql = "INSERT INTO student (student_id, first_name, last_name, email, password, program_id)
                VALUES($user_id, '$first_name', '$last_name', '$email', '$password', '$program_id')";
        $mysql->query($sql);
    }else{
        $sql = "INSERT INTO faculty (faculty_id, first_name, last_name, email, password, department_id)
                VALUES($user_id, '$first_name', '$last_name', '$email', '$password', '$department_id')";
        $mysql->query($sql);
    }

    header("Location: ../users.php");

?>