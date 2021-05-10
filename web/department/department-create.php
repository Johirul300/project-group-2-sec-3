<?php
	require '../database/mysql.php';
	$sql = "SELECT * FROM school";
	$datas = $mysql->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Schools Create - SPMS</title>

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
						<a class="sidebar-link" href="users.html">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="users-create.html">
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

					<li class="sidebar-item active">
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

					<h1 class="h3 mb-3">Department Create</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="POST" action="php/department-create.php">
										<div class="form-group">
											<label for="inputState">School name</label>
											<select id="inputState" class="form-control" name="school_id">
												<?php
													foreach($datas as $d){
														echo '<option value="'.$d["school_id"].'">'.$d["school_name"].'</option>';
													}
												?>
											</select>
										</div>
										<div class="form-row">
											<div class="form-group col-md-3">
												<label for="department_id">Department ID</label>
												<input type="text" class="form-control" id="department_id" name="department_id" placeholder="Department Id">
											</div>
											<div class="form-group col-md-6">
												<label for="department_name">Department Name</label>
												<input type="text" class="form-control" id="department_name" name="department_name" placeholder="Department Name">
											</div>
											<div class="form-group col-md-3">
												<label for="head">Head</label>
												<input type="text" class="form-control" id="head" name="head" placeholder="Head">
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
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
	<script src="../js/vendor.js"></script>
	<script src="../js/app.js"></script>
	<script src="../js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#users-data').DataTable();
		} );
	</script>

</body>

</html>