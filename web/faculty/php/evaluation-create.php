<?php
    require '../../database/mysql.php';
    
    $section_id = $_POST['section_id'];
    $assessment_type = strtolower($_POST['type']);

    $file = fopen($_FILES['evaluation']['tmp_name'], "r");
    fgetcsv($file);

    while($d = fgetcsv($file)){
        $student_id = $d[0];
        $sql = "SELECT enrollment_id FROM enrollment WHERE student_id = $student_id AND section_id = $section_id";
        $enrollment_id = $mysql->query($sql)->fetch_assoc()['enrollment_id'];
        for($i=1; $i<sizeof($d); $i++){
            $mark_obtains = $d[$i];
            $sql = "SELECT assessment_id FROM assessment WHERE section_id = $section_id AND assessment_type = '$assessment_type' AND question_number = $i";
            $assessment_id = $mysql->query($sql)->fetch_assoc()['assessment_id'];
            $sql = "SELECT * FROM marksheet WHERE assessment_id = $assessment_id AND enrollment_id = $enrollment_id";
            if($mysql->query($sql)->num_rows == 0){
                $sql = "INSERT INTO marksheet (assessment_id, enrollment_id, mark_obtains)
                    VALUES ($assessment_id, $enrollment_id, $mark_obtains)";
                $mysql->query($sql);
            }else{
                $sql = "UPDATE marksheet SET mark_obtains = $mark_obtains WHERE assessment_id = $assessment_id AND enrollment_id = $enrollment_id";
                $mysql->query($sql);
            }
            
        }
    }
    
     header("Location: ../assessments.php?section_id=$section_id");

?>