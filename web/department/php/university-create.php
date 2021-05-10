<?php
    require '../../database/mysql.php';
    $university_id = strtoupper($_POST['university_id']);
    $university_name = $_POST['university_name'];
    $vice = $_POST['vice'];
    $address = $_POST['address'];

    $sql = "INSERT INTO university (university_id, university_name, vice, address) 
            VALUES('$university_id', '$university_name', '$vice', '$address')"; 
    
    if($mysql->query($sql)){
        header("Location: ../universities.php");
    }else{
        header("Location: ../university-create.php");
    }
?>