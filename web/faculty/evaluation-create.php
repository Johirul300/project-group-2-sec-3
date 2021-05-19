<?php
	require '../database/mysql.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Assessments Create - SPMS</title>

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
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="index.php">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="sections.php">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Sections</span>
						</a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="section-create.php">
							<i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Create Section</span>
						</a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="assessments.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Assessments</span>
						</a>
					</li> -->

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="assessment-create.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Create Assessments</span>
						</a>
					</li> -->

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="assessments-update.html">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Update Assessments</span>
						</a>
					</li> -->

					<li class="sidebar-item">
						<a class="sidebar-link" href="qbank.html">
							<i class="align-middle" data-feather="server"></i> <span class="align-middle">Question Bank</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="qbank-create.html">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Question Bank</span>
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

					<h1 class="h3 mb-3">Section Create</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="POST" action="php/evaluation-create.php" enctype='multipart/form-data'>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="students">Upload Evaluated Mark</label>
    											<input type="file" class="form-control-file" id="students" data-allowed-file-extensions='["csv"]' name="evaluation">
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

	<script src="../js/app.js"></script>

</body>

</html>