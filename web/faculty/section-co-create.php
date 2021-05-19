<?php
	require '../database/mysql.php';
	$section_id = $_GET['section_id'];
	$course_id = $_GET['course_id'];
	
	$sql = "SELECT DISTINCT co_number from co WHERE course_id = '$course_id' AND section_id IS NULL";
	$total_co = $mysql->query($sql)->num_rows;
	$sql = "SELECT COUNT(plo_id) as 'total_plo' FROM plo WHERE program_id = ALL (SELECT program_id FROM course WHERE course_id = '$course_id')";
	$total_plo = $mysql->query($sql)->fetch_row()[0];
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

					<li class="sidebar-item">
						<a class="sidebar-link" href="section-create.php">
							<i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Create Section</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="assessments.php">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Assessments</span>
						</a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="assessment-create.php">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Create Assessments</span>
						</a>
					</li>

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

					<h1 class="h3 mb-3">Remap PLO-CO</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<form method="POST" action="php/section-co-create.php">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>PLO</th>
													<?php
														for($i=1; $i<=$total_co; $i++){
															echo "<th>CO$i</th>";
														}
													?>
												</tr>
											</thead>
											<tbody>
												<?php
													for($plo=1; $plo<=$total_plo; $plo++){
														echo "<tr>
																<td>PLO$plo</td>";
														for($co=1; $co<=$total_co; $co++){
															echo '<td><input class="form-check-input" type="checkbox" id="plo'.$plo.'co'.$co.'" value="'.$co.'" name="plo'.$plo.'[]"></td>';
														}
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
										<?php
											echo "<input type='text' value='$course_id' name='course_id' hidden>";
											echo "<input type='text' value='$section_id' name='section_id' hidden>";
											echo "<input type='text' value='$total_plo' name='total_plo' hidden>";
										?>
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
	<script src="../js/jquery-3.6.0.min.js"></script>
	<?php
		$sql = "SELECT *FROM co WHERE course_id = '$course_id' AND section_id IS NULL";
		$datas = $mysql->query($sql);
		echo "<script>";
		foreach($datas as $d){
			$plo_id = $d['plo_id'];
			$sql = "SELECT plo_number from plo WHERE plo_id = $plo_id";
			$plo = $mysql->query($sql)->fetch_row()[0];
			echo "$('#plo".$plo."co".$d['co_number']."').attr('checked', 'true');";
		}
		echo "</script>";
	?>

</body>

</html>