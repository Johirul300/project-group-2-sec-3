<?php
	session_start();
	if(isset($_SESSION['role'])){
		$role = $_SESSION['role'];
		if($role == 'dean' || $role=='head'){
			header("Location: /department/");
		}else if($role=='faculty'){
			header("Location: /faculty/");
		}else{
			header("Location: /student/");
		}
	}else{
		header("Location: login.php");
	}

?>