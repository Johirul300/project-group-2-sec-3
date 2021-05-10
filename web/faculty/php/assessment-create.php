<?php
    require '../../database/mysql.php';
    
    $section_id = $_POST['section_id'];
    $assessment_type = strtolower($_POST['assessment_type']);
    $total_q = $_POST['total_q'];

    for($i=1; $i<=$total_q; $i++){
        $mark = $_POST['mark'.$i];

        $sql = "SELECT course_id FROM section WHERE section_id = $section_id";
        $course_id = $mysql->query($sql)->fetch_row()[0];

        $co = $_POST['co'.$i];

        $sql = "INSERT INTO assessment (assessment_type, question_number, co, mark, section_id)
                VALUES('$assessment_type', $i, $co, $mark, $section_id)";
        $mysql->query($sql);
    }

    header("Location: ../assessments.php?section_id=$section_id");

?>