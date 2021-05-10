<?php
    require '../../database/mysql.php';
    session_start();
    $_SESSION['user_id'] = 11111;
    $section_name = strtoupper($_POST['section_name']);
    $semester = $_POST['semester'];
    $course_id = $_POST['course_id'];
    $faculty_id = $_SESSION['user_id'];

    $sql = "SELECT section_id FROM section WHERE semester = '$semester' AND section_name = '$section_name' AND course_id = '$course_id' AND faculty_id = '$faculty_id'";
    $result = $mysql->query($sql)->fetch_row();

    if($result){
        $section_id = $result[0];
    }else{
        $sql = "INSERT INTO section (section_name, semester, course_id, faculty_id)
            VALUES('$section_name', '$semester', '$course_id', '$faculty_id')";
        $mysql->query($sql);
        $section_id = $mysql->insert_id;
    }

    $file = fopen($_FILES['students']['tmp_name'], "r");

    fgetcsv($file);

    while($d = fgetcsv($file)){
        $year = substr($semester, -4);
        $student_id = $d[0];
        $sql = "INSERT INTO enrollment (year, semester, student_id, section_id)
                VALUES ($year, '$semester', $student_id, $section_id)";
        $mysql->query($sql);   
        echo $mysql->error;
    }

    header("Location: ../section-co-create.php?section_id=$section_id&course_id=$course_id");

?>