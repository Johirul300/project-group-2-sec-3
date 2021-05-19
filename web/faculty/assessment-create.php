<?php
	require '../database/mysql.php';
	if(!isset($_GET['section_id'])){
		header("Location: sections.php");
	}
	$section_id = $_GET['section_id'];
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

					<h1 class="h3 mb-3">Assessment Create</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="POST" id="assessment_form" action="php/assessment-create.php">
										<div class="form-row">
											<div class="form-group col-md-4">
												<label for="section-id">Section Id</label>
												<?php
													echo '<input type="text" class="form-control" id="section-id" name="section_id" value="'.$section_id.'" placeholder="Section Id" readonly>';
												?>
												
											</div>
											<div class="form-group col-md-4">
												<label for="assessment_type">Assessment Type</label>
												<input type="text" class="form-control" id="assessment_type" name="assessment_type" placeholder="Assessment Type">
											</div>
											<div class="form-group col-md-4">
												<label for="total_q">Total Question</label>
												<input type="number" class="form-control" id="total_q" name="total_q" placeholder="Total Question">
											</div>
										</div>
										<div id="q-list">
											
										</div>
										<button type="button" class="btn btn-primary" id="q-btn">Generate</button>
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
	<script src="../js/jquery-3.6.0.min.js"></script>

	<script>
		$f = 1;
		$("#q-btn").click(function(){
			if($f==1){
				$total_q = $("#total_q").val();

				for($i=1; $i<=$total_q; $i++){
					$("#q-list").append(`
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="mark`+$i+`">Question `+$i+` Mark</label>
								<input type="text" class="form-control" id="mark`+$i+`" name="mark`+$i+`" placeholder="Question `+$i+` Mark">
							</div>
							<div class="form-group col-md-6">
								<label for="co`+$i+`">Question `+$i+` CO</label>
								<input type="text" class="form-control" id="co`+$i+`" name="co`+$i+`" placeholder="Question `+$i+` CO">
							</div>
						</div>
					`);
				}

				$("#q-btn").html("Submit");
				$f = 0;
			}else{
				$("#assessment_form").submit();
			}
		});
	</script>

</body>

</html>