<?php session_start();
 $db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

 //DISPLAYING ALL BOOKS FROM LIBRARY
  	$query = "SELECT * FROM books ORDER BY rand()";
  	$results = mysqli_query($db,$query);
  	$books = mysqli_fetch_all($results, MYSQLI_ASSOC);

//DELETING A BOOK FROM Management TABLE
    if (isset($_GET['delete_bk'])) {
       $delete_bk = $_GET['delete_bk'];
       $query   = "DELETE FROM books WHERE id = $delete_bk ";
       $results = mysqli_query($db,$query);

       if ($results) {
          $_SESSION['success'] = "<div class='success'>Book Deleted From Library!</div>";
          header('location: manage_books.php');
	      exit();
        } else {
          $_SESSION['error'] = "<div class='error'> Book Not Deleted!! Try again </div>";
        }
      }
	if (!isset($_SESSION['username'])) {
	  	header('location: ../admin/login.php');
	  	exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library Management Center</title>
	<link rel="stylesheet" type="text/css" href="css/managebk.css">
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
				<!-- SEARCH BOX -->

	<form method="POST" action="search.php" style="float: right;background: ;margin: 0px;position: relative;top: 10px;">
            <div class="input-group" id="" style="background: ">
               <input type="text" name="searchs" class="form-control" style="height: 20px;width:px;" placeholder="Search Library">
              <span class="input-btn">
                <button class="btn" type="submit" style="outline: 0;width:70px;padding: 2px;cursor: pointer;" name="search">
              		Search
                  </button>
                </span>
              </div> 
          </form>
		<h1>Management Center</h1>
	</header>

	<div class="container">
		<form method="POST" action="" enctype="multipart/form-data">
			<a href="add_book.php" id="r1">Add book</a>
			<a href="applied_books.php" id="r2">Applied books</a>
			<table border="true">
				<thead>
					<tr>
						<th>N<sup>o</sup></th>
						<th>Book</th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN CODE</th>
						<th>Uploaded Date</th>
						<th>Uploaded Time</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>

			 <tbody>
				 <?php if (!empty($_SESSION['success'])) : ?>
				 	<?php echo "<div class='clover'>".  $_SESSION['success'] . "</div>";header('refresh: 2, manage_books.php'); unset($_SESSION['success']);?>
				 <?php endif ?>

				 <?php if (!empty($_SESSION['error'])) : ?>
				 	<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
				 <?php endif ?>

				<!-- APPLY FOR A BOOK WHILE IN ULIBRARY MAIN PAGE -->

				 <?php foreach ($books as $key => $book) { ?>
			 <tr>
				 <td><?php echo ++$key; ?></td>
				 <td><img src="../img/<?php echo $book['image']; ?>"></td>
				 <td><?php echo $book['title']; ?></td>
				 <td><?php echo $book['author']; ?></td>
				 <td><?php echo $book['isbn']; ?></td>
				 <td><?php echo date('D, d M Y' , strtotime($book['uploaded_on'])); ?></td>
				 <td><?php echo $book['at_time']; ?></td>
				 <td><a href="edit.php?edit_id=<?php echo $book['id']; ?>" id="r" disabled>Edit</a></td>
				 <td><a href='manage_books.php?delete_bk=<?php echo $book['id'] ?>' id="a"> Delete </a></td>
			 </tr>

			<?php } 
			     if(mysqli_num_rows($results) < 1) {
		  			echo "<div class='empty'>LIBRARY IS EMPTY!! GO ADD SOME BOOKS</div>";
				   }
			 ?>
			</tbody>
		</table>
	</form>
	</div>

</body>
</html>