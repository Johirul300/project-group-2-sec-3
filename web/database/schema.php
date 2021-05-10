<?php
    require 'mysql.php';

    $uni = "CREATE TABLE university ( 
        university_id VARCHAR(5) NOT NULL PRIMARY KEY, 
        university_name VARCHAR(200) NOT NULL , 
        vice VARCHAR(150) NOT NULL , 
        address TEXT NULL 
    )";

    $school = "CREATE TABLE school ( 
        school_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        school_name VARCHAR(200) NOT NULL , 
        dean VARCHAR(150) NULL , 
        university_id VARCHAR(5) NOT NULL , 
        FOREIGN KEY (university_id) REFERENCES university (university_id) 
    )";

    $department = "CREATE TABLE department ( 
        department_id VARCHAR(5) NOT NULL PRIMARY KEY, 
        department_name VARCHAR(200) NOT NULL , 
        head VARCHAR(150) NULL , 
        school_id INT NOT NULL , 
        FOREIGN KEY (school_id) REFERENCES school (school_id) 
    )";

    $program = "CREATE TABLE program ( 
        program_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        program_name VARCHAR(20) NOT NULL , 
        department_id VARCHAR(5) NOT NULL , 
        FOREIGN KEY (department_id) REFERENCES department (department_id) 
    )";

    $plo = "CREATE TABLE plo ( 
        plo_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        plo_number INT NOT NULL , 
        plo_name VARCHAR(100) NOT NULL , 
        plo_detail TEXT NULL , 
        plo_level INT NOT NULL,
        program_id INT NOT NULL ,
        FOREIGN KEY (program_id) REFERENCES program(program_id)
    )";

    $course = "CREATE TABLE course ( 
        course_id VARCHAR(10) NOT NULL PRIMARY KEY, 
        course_name VARCHAR(200) NOT NULL , 
        credits DOUBLE NOT NULL , 
        course_level INT NOT NULL , 
        program_id INT NOT NULL , 
        FOREIGN KEY (program_id) REFERENCES program(program_id)
    )";

    $faculty = "CREATE TABLE faculty ( 
        faculty_id INT NOT NULL PRIMARY KEY, 
        first_name VARCHAR(100) NOT NULL , 
        last_name VARCHAR(100) NOT NULL , 
        email VARCHAR(200) NOT NULL , 
        password VARCHAR(255) NOT NULL , 
        gender VARCHAR(10) NULL , 
        dob DATE NULL , 
        phone_number VARCHAR(20) NULL , 
        address TEXT NULL , 
        department_id VARCHAR(10) NOT NULL , 
        FOREIGN KEY (department_id) REFERENCES department (department_id) 
    )";

    $section = "CREATE TABLE section ( 
        section_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        section_name VARCHAR(10) NOT NULL , 
        semester VARCHAR(50) NOT NULL , 
        course_id VARCHAR(10) NOT NULL , 
        faculty_id INT NULL , 
        FOREIGN KEY (course_id) REFERENCES course(course_id),
        FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id)
    )";

    $co = "CREATE TABLE co ( 
        co_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        co_number INT NOT NULL , 
        co_name VARCHAR(100) NULL , 
        plo_id INT NOT NULL , 
        course_id VARCHAR(10) NOT NULL , 
        section_id INT NULL , 
        co_detail TEXT NULL , 
        FOREIGN KEY (plo_id) REFERENCES plo (plo_id),
        FOREIGN KEY (course_id) REFERENCES course (course_id),
        FOREIGN KEY (section_id) REFERENCES section (section_id)
    )";

    $student = "CREATE TABLE student ( 
        student_id INT NOT NULL PRIMARY KEY, 
        first_name VARCHAR(100) NOT NULL , 
        last_name VARCHAR(100) NOT NULL , 
        email VARCHAR(200) NOT NULL , 
        password VARCHAR(250) NOT NULL , 
        gender VARCHAR(10)  NULL , 
        dob DATE NULL , 
        phone_number VARCHAR(20) NULL , 
        address TEXT  NULL , 
        program_id INT NOT NULL , 
        FOREIGN KEY (program_id) REFERENCES program (program_id) 
    )";

    $enrollment = "CREATE TABLE enrollment ( 
        enrollment_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        year INT NOT NULL , 
        semester VARCHAR(30) NOT NULL , 
        student_id INT NOT NULL , 
        section_id INT NOT NULL , 
        FOREIGN KEY (student_id) REFERENCES student (student_id),
        FOREIGN KEY (section_id) REFERENCES section (section_id)
    )";

    $assessment = "CREATE TABLE assessment ( 
        assessment_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        assessment_type VARCHAR(20) NOT NULL , 
        question_number INT NOT NULL , 
        co INT NOT NULL , 
        mark INT NOT NULL , 
        section_id INT NOT NULL , 
        FOREIGN KEY (section_id) REFERENCES section (section_id)
    )";

    $marksheet = "CREATE TABLE marksheet ( 
        marksheet_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        assessment_id INT NOT NULL , 
        enrollment_id INT NOT NULL , 
        mark_obtains INT NOT NULL , 
        attendence INT NOT NULL , 
        FOREIGN KEY(enrollment_id) REFERENCES enrollment (enrollment_id),
        FOREIGN KEY(assessment_id) REFERENCES assessment (assessment_id)
    )";

    if($mysql->query($uni)){
        echo "university table created";
    }else{
        echo "university table failed";
    }
    echo '<br>';
    if($mysql->query($school)){
        echo "school table created";
    }else{
        echo "school table failed";
    }
    echo '<br>';
    if($mysql->query($department)){
        echo "department table created";
    }else{
        echo "department table failed";
    }
    echo '<br>';
    if($mysql->query($program)){
        echo "program table created";
    }else{
        echo "program table failed";
    }
    echo '<br>';
    if($mysql->query($plo)){
        echo "plo table created";
    }else{
        echo "plo table failed";
    }
    echo '<br>';
    if($mysql->query($course)){
        echo "course table created";
    }else{
        echo "course table failed";
    }
    echo '<br>';
    if($mysql->query($faculty)){
        echo "faculty table created";
    }else{
        echo "faculty table failed";
    }
    echo '<br>';
    if($mysql->query($section)){
        echo "section table created";
    }else{
        echo "section table failed";
    }
    echo '<br>';
    if($mysql->query($co)){
        echo "co table created";
    }else{
        echo "co table failed";
    }
    echo '<br>';
    if($mysql->query($student)){
        echo "student table created";
    }else{
        echo "student table failed";
    }
    echo '<br>';
    if($mysql->query($enrollment)){
        echo "enrollment table created";
    }else{
        echo "enrollment table failed";
    }
    echo '<br>';
    if($mysql->query($assessment)){
        echo "assessment table created";
    }else{
        echo "assessment table failed";
    }
    echo '<br>';
    if($mysql->query($marksheet)){
        echo "marksheet table created";
    }else{
        echo "marksheet table failed";
    }

?>