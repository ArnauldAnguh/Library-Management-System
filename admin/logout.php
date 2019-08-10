<?php  
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['firstname']);
	unset($_SESSION['email']);

	$query = "UPDATE users SET status = 'inactive' ";
	$return = mysqli_query($db,$query);

	$_SESSION['success'] = "<div class='success'>Click <a href=''>Save Password</a> For Future Visit</div>";
	header('location: ../admin/login.php');
	exit();
?>