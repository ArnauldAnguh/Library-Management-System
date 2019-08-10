<?php 
	include "server.php";
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Library Books</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
	<div class="header">
		ADD LIBRARY BOOK
	<a href="index.php" class="a">Go Home</a>
	</div>
	<form method="post" enctype="multipart/form-data">

		<div class="add">
			<label>Author</label><br>
			<input type="text" name="author" required="">
		</div>
		<div class="add">
			<label>Title</label><br>
			<input type="text" name="title" required="">
		</div>
		<div class="add">
			<label>Image</label><br>
			<input type="file" class="img" name="image" required="">
		</div>
		<div class="add">
			<label>ISBN</label><br>
			<input type="text" min="1" max="16"  name="isbn" required="">
		</div>
		<div class="add">
			<label>Discription</label><br>
			<textarea cols="30" rows="*" type="text" name="discribe" required=""> </textarea>
		</div>
		<div class="add">
			<input type="submit" name="publish" class="btn" value="Publish">
		</div>
	</form>
</body>
</html>