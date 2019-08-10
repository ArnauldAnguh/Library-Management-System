<?php  
	session_start();
 $db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

 if (isset($_POST['update'])) {
    $_SESSION['update'] = $_POST['update'];
   	$admin_id = mysqli_real_escape_string($db,$_SESSION['user_id']);
   	$author   = mysqli_real_escape_string($db,$_POST['author']);
   	$title    = mysqli_real_escape_string($db,$_POST['title']);
   	$isbn     = mysqli_real_escape_string($db,substr($_POST['isbn'],0, 11));
   	$time     = $_POST['time'];
   	$date     = $_POST['date'];
   	$content  = mysqli_real_escape_string($db,$_POST['content']);
    $book_id  = $_SESSION['edit_id'];

    if (!empty($_FILES['image']['name'])) {
      $image_name = $_FILES['image']['name'];
      $temp_name  = $_FILES['image']['tmp_name'];

      move_uploaded_file($temp_name, "../img/" . $image_name);

      $update_query  = "UPDATE books SET ";

      $update_query .= "admin_id = $admin_id, ";

      $update_query .= "image = '{$image_name}', ";

      $update_query .= "title = '{$title}', ";

      $update_query .= "content = '{$content}', ";

      $update_query .= "author = '{$author}', ";

      $update_query .= "isbn = '{$isbn}', ";

      $update_query .= "uploaded_on = '{$date}', ";

      $update_query .= "at_time = '{$time}' ";

      $update_query .= "WHERE id = $book_id ";
      
    } else {

      $update_query  = "UPDATE books SET ";

      $update_query .= "admin_id = $admin_id, ";

      $update_query .= "title = '{$title}', ";

      $update_query .= "content = '{$content}', ";

      $update_query .= "author = '{$author}', ";

      $update_query .= "isbn = '{$isbn}', ";

      $update_query .= "uploaded_on = '{$date}', ";

      $update_query .= "at_time = '{$time}' ";

      $update_query .= "WHERE id = $book_id ";
      
  }
  $run_query = mysqli_query($db,$update_query);
  if ($run_query) {
  	$_SESSION['success'] = "Book Successfully updated";
  	header('location: manage_books.php');
	  exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Library Management Center</title>
	<link rel="stylesheet" type="text/css" href="css/bkedit.css">
</head>
<body>
	
	<header>
		<ul>
			<li>
			 <?php if(!empty($_SESSION['username'])) : ?>
			    <?php if(isset($_SESSION['username'])) : ?>
                 <?php echo "<a href='library.php'>" . $_SESSION['firstname'] . "</a>"; ?>
               <?php endif; ?>
             <?php endif; ?>
			</li>
			<li><a href="index.php" style="color: red;display: block;">Home</a></li>
		</ul>

		<h1>Management Center</h1>
	</header>

 <div class="container">
	<form method="POST" action="edit.php" enctype="multipart/form-data">

		<?php if (isset($_GET['edit_id'])) {
      $_SESSION['edit_id'] = $_GET['edit_id'];

			 //DISPLAYING ALL BOOKS FROM LIBRARY
			  $edit_id = $_GET['edit_id'];

		  	$query = "SELECT * FROM books WHERE id = $edit_id ";
		  	$results = mysqli_query($db,$query);
		  
		  while ($book_edit = mysqli_fetch_assoc($results)) {

		  	$_SESSION['book_id'] = $book_edit['id'];
		  	
	    ?>

     <div class="form-group">
       <label for="author">Book Author</label><br>
       <input type="text" value="<?php echo $book_edit['author'];?>" class="form-control" name="author">
     </div>
      <div class="form-group">
       <label for="image">Book Image</label><br>
       <img src="../img/<?php echo $book_edit['image']; ?>" name="image" width="100" height="80">
        <br>
       <br>
       <input type="file" name="image">
     </div>
     <div class="form-group">
       <label for="title">Book Title</label><br>
       <input type="text" value="<?php echo $book_edit['title'];?>" class="form-control" name="title">
     </div>
     <div class="form-group">
       <label for="isbn">ISBN CODE</label><br>
       <input type="text" value="<?php echo $book_edit['isbn'];?>" class="form-control" name="isbn">
     </div>
     <div class="form-group">
       <label for="date">Date</label><br>
       <input type="date" value="<?php echo $book_edit['uploaded_on'];?>" class="form-control" name="date">
     </div>
     <div class="form-group">
       <label for="time">time</label><br>
       <input type="time" value="<?php echo $book_edit['at_time'];?>" class="form-control" name="time">
     </div>

     <div class="form-group">
       <label for="Post_Content">Book Content</label><br>
       <textarea name="content" cols="30">
       	<?php echo $book_edit['content'];?>
       	</textarea>
     </div>

     <div class="form-group">
       <input type="Submit" class="btn" name="update" value="Update Book">
     </div>

    <?php } } ?>
	   
	  </form>
		
	</div>

</body>
</html>