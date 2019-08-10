<?php 
// start sessions
session_start();

// create database connection
$db = mysqli_connect('127.0.0.1', 'root', '', 'library') 
			or die("connection failed" . mysqli_error());

 //READ MORE ABOUT A BOOK
if (isset($_GET['read'])) {
	$read = $_GET['read'];
	$query = "SELECT * FROM books WHERE id = $read ";
	$run_query = mysqli_query($db, $query);

	if ($run_query) {
		if (mysqli_num_rows($run_query) > 0) {
			$about = mysqli_fetch_assoc($run_query);
			$_SESSION['book_id']      = $about['id']; 
		    $_SESSION['book_title']   = $about['title'];
		    $_SESSION['img']          = $about['image'];
		    $_SESSION['book_content'] = $about['content'];
		    $_SESSION['book_author']  = $about['author'];
		    $_SESSION['book_isbn']    = $about['isbn'];
		    $_SESSION['book_date']    = $about['uploaded_on'];
		    $_SESSION['book_time']    = $about['at_time'];
		}
	}
 }

 //APPLYING FOR A BOOK WHILE IN READ MORE PAGE

 if (isset($_POST['borrow'])) {
 	$query = "SELECT * FROM books WHERE id = " . $_SESSION['book_id'];
	$result_query = mysqli_query($db, $query);
	if ($result_query) {
			$applied = mysqli_fetch_assoc($result_query); 
		    $_SESSION['applied_title']   = $applied['title'];
		    $_SESSION['applied_img']     = $applied['image'];
		    $_SESSION['applied_content'] = $applied['content'];
		    $_SESSION['applied_author']  = $applied['author'];
		    $_SESSION['applied_isbn']    = $applied['isbn'];
		    $_SESSION['applied_date']    = $applied['uploaded_on'];

		    $applicant_id = $_SESSION['user_id'];
		    $applicant   = $_SESSION['firstname'];
			$title		 =    mysqli_real_escape_string($db,$_SESSION['applied_title']); 
			$image	     =    $_SESSION['applied_img'];     
			$content	 =    mysqli_real_escape_string($db,$_SESSION['applied_content']);
			$author  	 =    $_SESSION['applied_author']; 
			$date		 =    date('Y/m/d');

	$query  = "INSERT INTO admin_approvals (applicant_id,applicant,image,title,author,applied_date)";
	$query .= " VALUES($applicant_id,'$applicant','$image', '$title', '$author', '$date')";
	$result = mysqli_query($db,$query);
	var_dump($query); die(mysqli_error($db));
	if ($result) {
       $_SESSION['success1'] = "<div class='clover'><p>Book Successfully Applied For.<br></p></div>";
		header('location: page_info.php');
		exit();
	 } else {
		die(mysqli_error($db));
	}
  }
}


	
	
