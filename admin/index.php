<?php session_start(); ?>
<?php 
if (empty($_SESSION['username'])) {
	header('location: ../login.php');
	exit();
} ?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="css/dashb.css">
</head>
<body>
	<div class="header">LIBRARY ADMINISTRATION</div>
	<div class="container">
		<?php if(!empty($_SESSION['username'])) : ?>
		<?php echo "<h3>Welcome " . $_SESSION['email'] . "</h3>"; ?>
	   <img src="img/avatar.png" width="70" height="70" style="border-radius: 20px;"><br>
	   <samp>all admin users should make sure not to upload files without copy rights.<br>
	   	<a href="../library.php">Library Home</a></samp>
	   <?php endif; ?>
	   <div class="page">
	   	  Click To
	   		<a href="manage_books.php">
	   			Manage Library Books
	   		</a>
	   </div>

	   <div class="page1">
	   	  Click To View All
	   		<a href="applied_books.php">
	   			Applied Books
	   		</a>
	   </div>
	   <div class="page2">
	   	  Click To
	   		<a href="add_book.php">
	   			Add Book
	   		</a>
	   </div>
	</div>
</body>
</html>