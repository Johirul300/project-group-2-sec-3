<?php
    require '../../database/mysql.php';
    $department_id = strtoupper($_POST['department_id']);
    $program_name = $_POST['program_name'];

    $sql = "INSERT INTO program (program_name, department_id) 
            VALUES('$program_name', '$department_id')"; 
    
    $mysql->query($sql);

    $program_id = $mysql->insert_id;
    $plo_count = $_POST['plo_count'];

    for($plo=1; $plo <= $plo_count; $plo++){
        $plo_name = $_POST["plo".$plo];
        $level = $_POST["map".$plo];
        $sql = "INSERT INTO plo (plo_number, plo_name, plo_level, program_id) 
            VALUES ($plo, '$plo_name',  '$level', $program_id)"; 
        $mysql->query($sql);
    }   

    header("Location: ../programs.php");
    
?>