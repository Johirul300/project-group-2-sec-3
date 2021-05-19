<?php
	require 'database/mysql.php';
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$email = $_POST['email'];
		$password = $_POST['password'];
		session_start();

		$sql = "SELECT * FROM faculty WHERE email = '$email' AND password = '$password'";
		$user = $mysql->query($sql)->fetch_assoc();
		if(sizeof($user)>0){
			$_SESSION['user_id'] = $user['faculty_id'];
			$name = strtolower($user['first_name']." ".$user['last_name']);
			$_SESSION['name'] = $name;
			$_SESSION['role'] = 'faculty';
			$sql = "SELECT * FROM school WHERE LOWER(dean) = '$name'";
			if($mysql->query($sql)->num_rows != 0){
				$_SESSION['role'] = 'dean';
				header("Location: /department/");
				return;
			}
			$sql = "SELECT * FROM department WHERE LOWER(head) = '$name'";
			if($mysql->query($sql)->num_rows != 0){
				$_SESSION['role'] = 'head';
				header("Location: /department/");
				return;
			}
			header("Location: /faculty/");
		}


		$sql = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
		$user = $mysql->query($sql)->fetch_assoc();
		if(sizeof($user)>0){
			$_SESSION['user_id'] = $user['student_id'];
			$name = strtolower($user['first_name']." ".$user['last_name']);
			$_SESSION['name'] = $name;
			$_SESSION['role'] = 'student';
			header("Location: /student/");
			return;
		}

		

		header("Location: login.php");
	
	}else if(isset($_GET['logout'])){
		session_destroy();
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>AdminKit Demo - Web UI Kit &amp; Dashboard Template</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		<div class="main">
			<main class="content">
				<div class="container-fluid p-0">

					<div class="row d-flex justify-content-center mt-5">
						<div class="col-xl-5 mt-5">
							<div class="card flex-fill w-100 mt-5 py-5">
								<div class="card-body">
								<form method="POST">
										<div class="form-row d-flex justify-content-center">
											<div class="form-group col-md-8">
												<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
											</div>
										</div>
										<div class="form-row d-flex justify-content-center">
											<div class="form-group col-md-8">
												<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
											</div>
										</div>
										<div class="d-flex justify-content-center">
											<button type="submit" class="btn btn-primary">Login</button>
										</div>										
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			
		</div>
	</div>

	<script src="js/vendor.js"></script>
	<script src="js/app.js"></script>

</body>

</html>