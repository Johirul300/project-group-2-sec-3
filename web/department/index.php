<?php
	require '../database/mysql.php';
	$sql = "SELECT * FROM student";
	$students = $mysql->query($sql)->num_rows;
	$sql = "SELECT * FROM school";
	$schools = $mysql->query($sql)->num_rows;
	$sql = "SELECT * FROM department";
	$departments = $mysql->query($sql)->num_rows;
	$sql = "SELECT * FROM program";
	$programs = $mysql->query($sql)->num_rows;

	if(isset($_GET['semester'])){
		$semester = $_GET['semester'];

		$sql = "SELECT school.school_name, COUNT(DISTINCT(enrollment.student_id)) as 'students' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment 
		WHERE section.semester = '$semester' GROUP BY school.school_name";
		$school = $mysql->query($sql);

		$sql = "SELECT department.department_id, COUNT(DISTINCT(enrollment.student_id)) as 'students' FROM department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment 
		WHERE section.semester = '$semester' GROUP BY department.department_id";
		$department = $mysql->query($sql);

		$sql = "SELECT program.program_name, program.department_id, COUNT(DISTINCT(enrollment.student_id)) as 'students' FROM program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment 
		WHERE section.semester = '$semester' GROUP BY program.program_id";
		$program = $mysql->query($sql);

		$sql = "SELECT school, department, program, semester, faculty, course, student, credits, assessment, SUM(obmrk) as 'obmark' FROM (SELECT school.school_name as 'school', UPPER(department.department_id) as 'department',  program.program_name as 'program', section.semester as 'semester', CONCAT(faculty.first_name, ' ', faculty.last_name) as 'faculty', course.course_id as 'course', enrollment.student_id as 'student', course.credits, assessment.assessment_type as 'assessment', IF(assessment.assessment_type = 'final', (SUM(marksheet.mark_obtains) / SUM(assessment.mark)) * 40, (SUM(marksheet.mark_obtains) / SUM(assessment.mark)) * 30) as 'obmrk' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN faculty NATURAL LEFT JOIN assessment NATURAL LEFT JOIN marksheet NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co = co.co_number AND section.section_id = co.section_id LEFT JOIN plo on co.plo_id = plo.plo_id WHERE section.semester = LOWER('$semester') GROUP BY course.course_id, enrollment.enrollment_id, assessment.assessment_type, course.course_id) as mySql GROUP BY semester, student, course";
		$marksheet = $mysql->query($sql);
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Dashboard - SPMS</title>

	<link href="../css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle">SPM</span>
				</a>

				<ul class="sidebar-nav">
					
					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a href="#ui" data-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase align-middle"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> <span class="align-middle">Reports</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
							<li class="sidebar-item"><a href="plo-comparison.php" class="sidebar-link" href="ui-alerts.html">PLO Comparison</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Data Entry
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="universities.php">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Universities</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="university-create.php">
							<i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">University Create</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="users.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="user-create.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Create User</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="schools.php">
							<i class="align-middle" data-feather="server"></i> <span class="align-middle">Schools</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="school-create.php">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create School</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="departments.php">
							<i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Departments</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="department-create.php">
							<i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Create Department</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="programs.php">
							<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Programs</span>
						</a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="program-create.php">
							<i class="align-middle" data-feather="folder-plus"></i> <span class="align-middle">Create Programs</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="courses.php">
							<i class="align-middle" data-feather="file"></i> <span class="align-middle">Courses</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="course-create.php">
							<i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Create Courses</span>
						</a>
					</li>

					<li class="sidebar-item">
						<li class="sidebar-item">
						<a class="sidebar-link" href="../login.php?logout=1">
							<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">LogOut</span>
						</a>
					</li>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
					<i class="hamburger align-self-center"></i>
				</a>

			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Dashboard</h1>

					<div class="row">
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title mb-4">Total Students</h5>
									<h1 class="display-5 mt-1 mb-3"><?php echo $students; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title mb-4">Total Schools</h5>

									<h1 class="display-5 mt-1 mb-3"><?php echo $schools; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title mb-4">Total Departments</h5>
									<h1 class="display-5 mt-1 mb-3"><?php echo $departments; ?></h1>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title mb-4">Total Programs</h5>
									<h1 class="display-5 mt-1 mb-3"><?php echo $programs; ?></h1>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-8">
							<h1 class="h3 mb-3">Enrollment Comparison</h1>
						</div>
						<div class="col-4 d-flex justify-content-end">
							<form class="form-inline" method="GET">
									<input type="text" class="form-control" id="semester" name="semester" placeholder="Summer-2021" <?php if(isset($_GET['semester'])){ echo "value='".$_GET['semester']."'"; } ?>>
									<button type="submit" class="btn btn-primary ml-2"><i class="align-middle" data-feather="arrow-right"></i></button>
							</form>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">School Wise Enrollment Comparision</h5>
									<!-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> -->
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-school"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Department Wise Enrollment Comparision</h5>
									<!-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> -->
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-department" height="200" width="400"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
									
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Program Wise Enrollment Comparision</h5>
									<!-- <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6> -->
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-program" height="200" width="400"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
									
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-8">
							<h1 class="h3 mb-3">Student Performance</h1>
						</div>
						
					</div>

					<div class="row mt-2">
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">School Wise Student Performacne</h5>
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-school-trend"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Department Wise Stuednt Performace</h5>
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-department-trend" height="200" width="400"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
									
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Program Wise Student Performance</h5>
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-program-trend" height="200" width="400"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
									
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Course Wise Student Performacne</h5>
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-course-trend"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Instructor Wise Student Performance</h5>
								</div>
								<div class="card-body text-center">
									<?php
										if(isset($semester)){
											echo '
											<div class="chart">
												<canvas id="bar-faculty-trend" height="200" width="400"></canvas>
											</div>';
										}else{
											echo '<small class="text-secondary mt-5">Semester not selected or not found!</small>';
										}
									?>
									
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.php" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="../js/vendor.js"></script>
	<script src="../js/app.js"></script>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-school"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(isset($semester)){
								foreach($school as $scl){
									echo "'".$scl['school_name']."', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
							if(isset($semester)){
								foreach($school as $scl){
									echo "".$scl['students'].", ";
								}
							}
						?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 10
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-department"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(isset($semester)){
								foreach($department as $dpt){
									echo "'".$dpt['department_id']."', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
							if(isset($semester)){
								foreach($department as $dpt){
									echo "".$dpt['students'].", ";
								}
							}
						?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 10
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-program"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(isset($semester)){
								foreach($program as $prog){
									echo "'".$prog['program_name']." in ".$prog['department_id']."', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(isset($semester)){
									foreach($program as $prog){
										echo "".$prog['students'].", ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 10
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<?php
		if(isset($marksheet) && mysqli_num_rows($marksheet)!=0){
			$temp = array();
			foreach($marksheet as $m){
				$scl = $m['school'];
				if(array_key_exists($scl, $temp)==false){
					$temp[$scl] = array();
				}
				$std = $m['student'];
				if(array_key_exists($std, $temp[$scl]) == false){
					$temp[$scl][$std] = array();
					$temp[$scl][$std]['scr'] = 0;
					$temp[$scl][$std]['crd'] = 0;
				}
				$crd = $m['credits'];
				$temp[$scl][$std]['crd']+=$crd;
				$mrk = $m['obmark'];
				$fnl = 0;
				if($mrk>=85){
					$fnl =($crd * 4.0);
				}else if($mrk>=80){
					$fnl =($crd * 3.7);
				}else if($mrk>=75){
					$fnl =($crd * 3.3);
				}else if($mrk>=70){
					$fnl =($crd * 3.0);
				}else if($mrk>=65){
					$fnl =($crd * 2.7);
				}else if($mrk>=60){
					$fnl =($crd * 2.3);
				}else if($mrk>=55){
					$fnl =($crd * 2.0);
				}else if($mrk>=50){
					$fnl =($crd * 1.7);
				}else if($mrk>=45){
					$fnl =($crd * 1.3);
				}else if($mrk>=40){
					$fnl =($crd * 1.0);
				}
				$temp[$scl][$std]['scr']+=$fnl;
			}

			$scls = array();
			foreach($temp as $x => $y){
				$total = sizeof($y);
				$sum = 0;
				foreach($y as $m){
					$sum+=($m['scr'] / $m['crd']);
				}
				$scls[$x] = round(($sum / $total), 2);
			}
		}
	?>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-school-trend"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(mysqli_num_rows($marksheet)!=0){
								foreach($scls as $x => $y){
									echo "'$x', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(mysqli_num_rows($marksheet)!=0){
									foreach($scls as $x => $y){
										echo "'$y', ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 5
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<?php
		if(mysqli_num_rows($marksheet)!=0){
			$temp = array();
			foreach($marksheet as $m){
				$dep = $m['department'];
				if(array_key_exists($dep, $temp)==false){
					$temp[$dep] = array();
				}
				$std = $m['student'];
				if(array_key_exists($std, $temp[$dep]) == false){
					$temp[$dep][$std] = array();
					$temp[$dep][$std]['scr'] = 0;
					$temp[$dep][$std]['crd'] = 0;
				}
				$crd = $m['credits'];
				$temp[$dep][$std]['crd']+=$crd;
				$mrk = $m['obmark'];
				$fnl = 0;
				if($mrk>=85){
					$fnl =($crd * 4.0);
				}else if($mrk>=80){
					$fnl =($crd * 3.7);
				}else if($mrk>=75){
					$fnl =($crd * 3.3);
				}else if($mrk>=70){
					$fnl =($crd * 3.0);
				}else if($mrk>=65){
					$fnl =($crd * 2.7);
				}else if($mrk>=60){
					$fnl =($crd * 2.3);
				}else if($mrk>=55){
					$fnl =($crd * 2.0);
				}else if($mrk>=50){
					$fnl =($crd * 1.7);
				}else if($mrk>=45){
					$fnl =($crd * 1.3);
				}else if($mrk>=40){
					$fnl =($crd * 1.0);
				}
				$temp[$dep][$std]['scr']+=$fnl;
			}

			$deps = array();
			foreach($temp as $x => $y){
				$total = sizeof($y);
				$sum = 0;
				foreach($y as $m){
					$sum+=($m['scr'] / $m['crd']);
				}
				$deps[$x] = round(($sum / $total), 2);
			}
		}
	?>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-department-trend"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(mysqli_num_rows($marksheet)!=0){
								foreach($deps as $x => $y){
									echo "'$x', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(mysqli_num_rows($marksheet)!=0){
									foreach($deps as $x => $y){
										echo "'$y', ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 5
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<?php
		if(mysqli_num_rows($marksheet)!=0){
			$temp = array();
			foreach($marksheet as $m){
				$prog = $m['program'];
				if(array_key_exists($prog, $temp)==false){
					$temp[$prog] = array();
				}
				$std = $m['student'];
				if(array_key_exists($std, $temp[$prog]) == false){
					$temp[$prog][$std] = array();
					$temp[$prog][$std]['scr'] = 0;
					$temp[$prog][$std]['crd'] = 0;
				}
				$crd = $m['credits'];
				$temp[$prog][$std]['crd']+=$crd;
				$mrk = $m['obmark'];
				$fnl = 0;
				if($mrk>=85){
					$fnl =($crd * 4.0);
				}else if($mrk>=80){
					$fnl =($crd * 3.7);
				}else if($mrk>=75){
					$fnl =($crd * 3.3);
				}else if($mrk>=70){
					$fnl =($crd * 3.0);
				}else if($mrk>=65){
					$fnl =($crd * 2.7);
				}else if($mrk>=60){
					$fnl =($crd * 2.3);
				}else if($mrk>=55){
					$fnl =($crd * 2.0);
				}else if($mrk>=50){
					$fnl =($crd * 1.7);
				}else if($mrk>=45){
					$fnl =($crd * 1.3);
				}else if($mrk>=40){
					$fnl =($crd * 1.0);
				}
				$temp[$prog][$std]['scr']+=$fnl;
			}

			$progs = array();
			foreach($temp as $x => $y){
				$total = sizeof($y);
				$sum = 0;
				foreach($y as $m){
					$sum+=($m['scr'] / $m['crd']);
				}
				$progs[$x] = round(($sum / $total), 2);
			}
		}
	?>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-program-trend"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(mysqli_num_rows($marksheet)!=0){
								foreach($progs as $x => $y){
									echo "'$x', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(mysqli_num_rows($marksheet)!=0){
									foreach($progs as $x => $y){
										echo "'$y', ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 5
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<?php
		if(mysqli_num_rows($marksheet)!=0){
			$temp = array();
			foreach($marksheet as $m){
				$crs = $m['course'];
				if(array_key_exists($crs, $temp)==false){
					$temp[$crs] = array();
				}
				$std = $m['student'];
				if(array_key_exists($std, $temp[$crs]) == false){
					$temp[$crs] = array();
					$temp[$crs]['scr'] = 0;
					$temp[$crs]['ttl'] = 0;
				}
				$crd = $m['credits'];
				$temp[$crs]['ttl']++;
				$mrk = $m['obmark'];
				$fnl = 0;
				if($mrk>=85){
					$fnl = 4.0;
				}else if($mrk>=80){
					$fnl =3.7;
				}else if($mrk>=75){
					$fnl =3.3;
				}else if($mrk>=70){
					$fnl =3.0;
				}else if($mrk>=65){
					$fnl =2.7;
				}else if($mrk>=60){
					$fnl =2.3;
				}else if($mrk>=55){
					$fnl =2.0;
				}else if($mrk>=50){
					$fnl =1.7;
				}else if($mrk>=45){
					$fnl =1.3;
				}else if($mrk>=40){
					$fnl =1.0;
				}
				$temp[$crs]['scr']+=$fnl;
			}

			$crss = array();
			foreach($temp as $x => $y){
				$crss[$x] = round(($y['scr'] / $y['ttl']), 2);
			}
		}
	?>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-course-trend"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(mysqli_num_rows($marksheet)!=0){
								foreach($crss as $x => $y){
									echo "'$x', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(mysqli_num_rows($marksheet)!=0){
									foreach($crss as $x => $y){
										echo "'$y', ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 5
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>

	<?php
		if(mysqli_num_rows($marksheet)!=0){
			$temp = array();
			foreach($marksheet as $m){
				$fac = $m['faculty'];
				if(array_key_exists($fac, $temp)==false){
					$temp[$fac] = array();
				}
				$std = $m['student'];
				if(array_key_exists($std, $temp[$fac]) == false){
					$temp[$fac] = array();
					$temp[$fac]['scr'] = 0;
					$temp[$fac]['ttl'] = 0;
				}
				$crd = $m['credits'];
				$temp[$fac]['ttl']++;
				$mrk = $m['obmark'];
				$fnl = 0;
				if($mrk>=85){
					$fnl = 4.0;
				}else if($mrk>=80){
					$fnl =3.7;
				}else if($mrk>=75){
					$fnl =3.3;
				}else if($mrk>=70){
					$fnl =3.0;
				}else if($mrk>=65){
					$fnl =2.7;
				}else if($mrk>=60){
					$fnl =2.3;
				}else if($mrk>=55){
					$fnl =2.0;
				}else if($mrk>=50){
					$fnl =1.7;
				}else if($mrk>=45){
					$fnl =1.3;
				}else if($mrk>=40){
					$fnl =1.0;
				}
				$temp[$fac]['scr']+=$fnl;
			}

			$facs = array();
			foreach($temp as $x => $y){
				$facs[$x] = round(($y['scr'] / $y['ttl']), 2);
			}
		}
	?>

	<script>
		$(function() {
			// Bar chart
			new Chart(document.getElementById("bar-faculty-trend"), {
				type: "bar",
				data: {
					labels: [
						<?php
							if(mysqli_num_rows($marksheet)!=0){
								foreach($facs as $f => $z){
									echo "'$f', ";
								}
							}
						?>
					],
					datasets: [{
						label: "Enrolled",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [
							<?php
								if(mysqli_num_rows($marksheet)!=0){
									foreach($facs as $f => $z){
										echo "'$z', ";
									}
								}
							?>
						],
						barPercentage: .80,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 5
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>


</body>

</html>