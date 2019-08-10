<?php 
// start sessions
	session_start();
// initializing variables
	$firstname = "";
	$lastname = "";
	$username = "";
	$email    = "";
	$errors   = array(); 
// create database connection
	$db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());
// USER/STUDENT REGISTRATION QUERY
if (isset($_POST['register'])) {
	$firstname = mysqli_real_escape_string($db,$_POST['firstname']);
	$lastname = mysqli_real_escape_string($db,$_POST['lastname']);
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$email    = mysqli_real_escape_string($db,$_POST['email']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$passconf = mysqli_real_escape_string($db,$_POST['passwordconf']);
	$role = 'subscriber';
	$status = 'active';

// User Validity by adding (array_push()) corresponding error unto $errors array
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password)) { array_push($errors, "Password is required"); }
	if ($password != $passconf) {
		array_push($errors, "The two passwords do not match");
	}

//Check if User Already Exists
	$query = "SELECT email FROM users WHERE email = '$email' ";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) > 0) {
		$_SESSION['error'] = "Sorry, this Email Already Exists";
		header('location: register.php');
		exit();
	} else {
     if (count($errors) == 0) {
// if user does not exists then encrypt password and register user
	   $password = md5($password);
		$query  = "INSERT INTO users (firstname, lastname, username, email, password, status, role)";
		$query .= "VALUES('$firstname', '$lastname', '$username', '$email', '$password', '$status', '$role') ";
		$execute_results = mysqli_query($db,$query);

		if($execute_results) {
			$_SESSION['user_id']  = mysqli_insert_id($db);
// Once user is registered, redirect user to home page
	 		$_SESSION['role']      = $role;
	 		$_SESSION['username']  = $username;
	 		$_SESSION['firstname'] = $firstname;
	 		$_SESSION['email']     = $email;
	 		$_SESSION['status']     = $status;

	 		$_SESSION['success3'] = "<br>Note: Books Borrowed here MUST be returned within 7days!!";

	 		header('location: library.php');
	 		exit();
		} else {
			$_SESSION['error'] = "<div class='error'>Sorry, you have an error registering, try again</div>";
		}
      }		
    }
}
// USER LOGIN SYSTEM
 if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
	$password = md5($password);
	$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
 	$results = mysqli_query($db, $query);
 	if (mysqli_num_rows($results) >= 1) {
		$new_user = mysqli_fetch_assoc($results);
		$_SESSION['user_id']	   = $new_user['id'];
		$_SESSION['role']	       = $new_user['role'];
		$_SESSION['username']      = $new_user['username'];
		$_SESSION['firstname']     = $new_user['firstname'];
		$_SESSION['email']         = $new_user['email'];

		$query = "UPDATE users SET status = 'active' WHERE id = " . $_SESSION['user_id'];
		$return = mysqli_query($db,$query);

		$status = mysqli_fetch_assoc($return);

		$_SESSION['status'] = $status['status'];

		$_SESSION['success3'] = "<br>Note: Books Borrowed here MUST be returned within 7days!!";
		header("location: library.php");
		exit(0);
 	} else if(mysqli_num_rows($results) < 1) {
			$_SESSION['error'] = "Sorry,This user does not exist! Please Register";
			header('location: library.php');
			exit();
 		} else {
			$_SESSION['error'] = "Wrong username/password combination";
			header('location: library.php');
			exit();
 	    }
  }
}
//Logout System
if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
	unset($_SESSION['firstname']);
	unset($_SESSION['email']);
	unset($_SESSION['status']);

	$query = "UPDATE users SET status = 'inactive' WHERE id = " . $_SESSION['user_id'];
	$return = mysqli_query($db, $query);

	if ($return) {
	   $_SESSION['success'] = "<div class='success'>Click <a href=''>Save Password</a> For Future Visit</div>";
	   header('location: ../../login.php');
	   exit();
	}
}