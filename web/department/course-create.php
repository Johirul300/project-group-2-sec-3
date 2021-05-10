<?php
	require '../database/mysql.php';
	// $sql = "SELECT program.program_id, program.program_name, program.department_id, plo.plo_id, plo.plo_number, plo.plo_level
	// 		FROM program NATURAL LEFT JOIN plo
	// 		ORDER BY program.program_id, plo.plo_id";
	$sql = "SELECT * FROM program";	
	$datas = $mysql->query($sql);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Course Create - SPMS</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
					<span class="align-middle">SPM</span>
				</a>

				<ul class="sidebar-nav">
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="index.html">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
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

					<li class="sidebar-item active">
						<a class="sidebar-link" href="course-create.php">
							<i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Create Course</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">LogOut</span>
						</a>
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

					<h1 class="h3 mb-3">Course Create</h1>
					<form method="POST" action="php/course-create.php">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
											<div class="form-group">
												<label for="course_id">Course ID</label>
												<input type="text" class="form-control" id="course_id" name="course_id" placeholder="Course ID">
											</div>
											<div class="form-row">
												<div class="form-group col-md-8">
													<label for="course_name">Course Name</label>
													<input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name">
												</div>
												<div class="form-group col-md-4">
													<label for="course_level">Level</label>
													<input type="number" class="form-control" id="course_level" name="course_level" placeholder="Level">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="inputState">Program</label>
													<select id="inputState" class="form-control" name="program_id" id="program_id">
														<?php
															foreach($datas as $d){
																echo "<option value='".$d["program_id"]."'>".$d["program_name"]." in ".$d["department_id"]."</option>";
															}
														?>
													</select>
												</div>
												<div class="form-group col-md-4">
													<label for="credits">Credit</label>
													<input type="number" class="form-control" id="credits" name="credits" placeholder="Credit">
												</div>
												<div class="form-group col-md-4">
													<label for="co_count">Total CO</label>
													<input type="number" class="form-control" id="co_count" name="co_count" placeholder="Total CO">
												</div>
												<input type="number" id="total_plo" name="total_plo" hidden>
											</div>
											<button type="button" class="btn btn-primary" onclick="generateList();">Generate</button>
									</div>
								</div>
							</div>
							<div class="col-md-12 mapper" hidden>
								<div class="card">
									<div class="card-body">
											<table class="table">
												<thead>
													<tr id="table-header">
														<th>PLO</th>
													</tr>
												</thead>
												<tbody id="table-body">
													<tr>
													</tr>
												</tbody>
											</table>
											<div>
												<button type="submit" class="btn btn-primary submit-button">Submit</button>
											</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
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

	<script src="../js/jquery-3.6.0.min.js"></script>
	<script src="../js/app.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>

<?php
echo "<script>";
echo '$plo_level = new Array();';

$temp = 0;

$sql = "SELECT program.program_id, program.program_name, program.department_id, plo.plo_id, plo.plo_number, plo.plo_level
		FROM program NATURAL LEFT JOIN plo
		ORDER BY program.program_id, plo.plo_id";
$datas = $mysql->query($sql);

foreach($datas as $d){
	if($d['program_id'] != $temp){
		echo '$plo_level['.$d["program_id"].']=new Array();';
		$temp = $d["program_id"];
	}
	echo '$plo_level['.$temp.'].push('.$d["plo_level"].');';
}

echo "</script>";
?>
	
	<script>

		console.log($plo_level[1].length);

		function generateList(){
			$(".mapper").removeAttr('hidden');
			$program_id = $('select[name="program_id"] option:selected').val();
			$("#total_plo").val($plo_level[$program_id].length);
			for($plo=1; $plo<=$plo_level[$program_id].length; $plo++){
				$("#table-body").append(
					`<tr id="plo`+$plo+`-tab">
						<td>PLO`+$plo+`</td>
					</tr>`
				);
			}

			$cos = $("#co_count").val();
			for($co=1; $co<=$cos; $co++){
				$("#table-header").append(
					`<th style="text-align: center;">CO`+$co+`</th>`
				);
			}
			
			$course_level = $("#course_level").val();
			console.log($course_level);
			for($plo=1; $plo<=13; $plo++){
				console.log($plo_level[$program_id][$plo-1]); 
				for($co=1; $co<=$cos; $co++){
					if($plo_level[$program_id][$plo-1] == $course_level){
						$("#plo"+$plo+"-tab").append(
							`<td align="center"><input class="form-check-input" type="checkbox" value="`+$co+`" name="plo`+$plo+`[]" checked></td>`
						);
					}else{
						$("#plo"+$plo+"-tab").append(
							`<td align="center"><input class="form-check-input" type="checkbox" value="`+$co+`" name="plo`+$plo+`[]"></td>`
						);
					}
					
				}
			}
		}
	</script>

</body>

</html>