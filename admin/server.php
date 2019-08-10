<?php 

// start sessions
	session_start();

// create database connection

$db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());



 //ADDING A BOOK TO BOOK LIBRARY

 if (isset($_POST['publish'])) {
 	$admin_id = $_SESSION['user_id'];
 	$author   = mysqli_real_escape_string($db,htmlspecialchars($_POST['author']));
 	$title    = mysqli_real_escape_string($db,htmlspecialchars($_POST['title']));
 	$image_name = $_FILES['image']['name'];
 	$temp_name  = $_FILES['image']['tmp_name'];
 	$isbn       = mysqli_real_escape_string($db,substr($_POST['isbn'],0, 11));
 	$content   = mysqli_real_escape_string($db,$_POST['discribe']);
 	$date	   =  date('Y/m/d');
 	$time	   =  date('h:i:s');
 	$target    = "../img/" . $image_name;

 	move_uploaded_file($temp_name, $target);

    $query    = "INSERT INTO books (admin_id,image,title,content,author,isbn,uploaded_on,at_time)"; 
 	$query   .= " VALUES($admin_id,'{$image_name}','{$title}','{$content}','{$author}','{$isbn}', '$date', '$time')";
 	$run_query = mysqli_query($db,$query);
 if ($run_query) {
		$_SESSION['book_id']  = mysqli_insert_id($db);
	 	$_SESSION['success'] = "Book Successfully Added To Library";
 	    header('location: manage_books.php');
        exit();
 	} else {
 		die("book upload failed" . mysqli_error($db));
 	}

 }
