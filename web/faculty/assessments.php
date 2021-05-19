<?php
	require '../database/mysql.php';
	if(!isset($_GET['section_id'])){
		header("Location: sections.php");
	}
	$section_id = $_GET['section_id'];
	$sql = "SELECT *, COUNT(assessment_type) as 'total_q' FROM assessment NATURAL LEFT JOIN section WHERE section_id = 1 GROUP BY assessment_type";
	$datas = $mysql->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Assessments - SPMS</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="../css/jquery.dataTables.min.css" rel="stylesheet">
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

					<li class="sidebar-item active">
						<a class="sidebar-link" href="sections.php">
							<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Sections</span>
						</a>
					</li>

					<li class="sidebar-item">
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

					<div class="row">
						<div class="col-10">
							<h1 class="h3 mb-3">Assessments List</h1>
						</div>
						<div class="col-2 text-right">
							<?php
								echo '<a href="assessment-create.php?section_id='.$section_id.'" class="btn btn-primary">Add</a>';
							?>
						</div>
					</div>
					

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-body">
									<table class="table table-striped" id="users-data">
										<thead>
											<tr>
												<th>Semester</th>
												<th>Course Id</th>
												<th>Section</th>
												<th>Assessment Name</th>
												<th>Total Questions</th>
												<th>Evaluation</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($datas as $d){
													echo "<tr>
															<td>".$d['semester']."</td>
															<td>".$d['course_id']."</td>
															<td>".$d['section_name']."</td>
															<td id='type".$d['assessment_id']."'>".$d['assessment_type']."</td>
															<td>".$d['total_q']."</td>
															<td class='table-action text-center'>
																<a type='button class='btn' data-toggle='modal' data-target='#evaluation_input' onclick='evlnForm(".$d['assessment_id'].");'>
																	<svg width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 align-middle'>
																		<path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
																	</svg>
																</a>
															</td>
														</tr>";
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<!-- Modal -->
			<div class="modal fade" id="evaluation_input" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="evln-form" action="php/evaluation-create.php" enctype='multipart/form-data'>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="students">Upload Evaluated Mark</label>
    								<input type="file" class="form-control-file" id="students" data-allowed-file-extensions='["csv"]' name="evaluation">
								</div>
							</div>
							<?php
								echo '<input name="section_id" value="'.$section_id.'" hidden>';
							?>
							<input id="modal-type" name="type" hidden>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="evln-sbmt">Save changes</button>
					</div>
					</div>
				</div>
			</div>

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
	<script src="../js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#users-data').DataTable();
		} );

		function evlnForm($asmnt){
			$type = $("#type"+$asmnt).html();
			$("#modal-type").attr('value', $type);
		}

		$("#evln-sbmt").click(function(){
			$("#evln-form").submit();
		});
	</script>

</body>

</html>