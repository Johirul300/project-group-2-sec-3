<?php
    require '../../database/mysql.php';

    $course_id = $_POST['course_id'];   
    $section_id = $_POST['section_id']; 
    $total_plo = $_POST['total_plo']; 

    $sql = "SELECT program_id FROM course WHERE course_id = '$course_id'";
    $program_id = $mysql->query($sql)->fetch_row()[0];

    for($plo=1; $plo<=$total_plo; $plo++){
        if(isset($_POST['plo'.$plo])){
            for($j=0; $j<sizeof($_POST['plo'.$plo]); $j++){
                $co = $_POST['plo'.$plo][$j];
                $sql = "SELECT plo_id FROM plo WHERE program_id = $program_id AND plo_number = $plo";
                $plo_id = $mysql->query($sql)->fetch_row()[0];
                $sql = "INSERT INTO co (co_number, plo_id, course_id, section_id)
                        VALUES ($co, $plo_id, '$course_id', $section_id)";
                $mysql->query($sql);
            }
        }
    }


    header("Location: ../sections.php");

?>