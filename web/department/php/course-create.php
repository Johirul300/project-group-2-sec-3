<?php
    require '../../database/mysql.php';
    $course_id = strtoupper($_POST['course_id']);
    $course_name = $_POST['course_name'];
    $course_level = $_POST['course_level'];
    $credits = $_POST['credits'];
    $program_id = $_POST['program_id'];

    $sql = "INSERT INTO course (course_id, course_name, course_level, credits, program_id)
            VALUES ('$course_id', '$course_name', $course_level, $credits, $program_id)";
    $mysql->query($sql);
    echo $mysql->error;
    echo '<br/>';
    $total_plo = $_POST['total_plo'];
    for($i=1; $i<$total_plo; $i++){
        if(isset($_POST["plo".$i])){
            $sql = "SELECT plo_id FROM plo WHERE plo_number = $i AND program_id = $program_id";
            $plo_id = $mysql->query($sql)->fetch_row()[0];
            for($j=0; $j<sizeof(($_POST["plo".$i])); $j++){
                $co = $_POST["plo".$i][$j];
                $sql = "INSERT INTO co (co_number, plo_id, course_id) VALUES($co, $plo_id, '$course_id')";
                $mysql->query($sql);
                echo $mysql->error;
                echo '<br/>';
            }
            
        }
    }
    header("Location: ../courses.php");

?>