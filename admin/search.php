<?php  
	session_start();
 $db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

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
	<link rel="stylesheet" type="text/css" href="css/bookmanage.css">
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
			<li><a href="manage_books.php" style="color: red;display: block;">Manage</a></li>
		</ul>
				<!-- SEARCH BOX -->

	<form method="POST" action="search.php" style="float: right;background: ;margin: 0px;position: relative;">
            <div class="input-group" id="" style="background: ">
               <input type="text" name="searchs" class="form-control" style="height: 20px;" placeholder="Search Library">
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
			<table border="true">
				<thead>
					<tr>
						<th>N<sup>o</sup></th>
						<th>Book</th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN CODE</th>
						<th>Upload Date</th>
						<th>Upload Time</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
			 <tbody>
				 <?php if (!empty($_SESSION['success'])) : ?>
				 	<?php echo $_SESSION['success']; unset($_SESSION['success']);?>
				 <?php endif ?>

				 <?php if (!empty($_SESSION['error'])) : ?>
				 	<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
				 <?php endif ?>
			<?php if(!empty($_SESSION['success1'])) : ?>
			<?php echo "<div class='success'>". $_SESSION['success1'] . "</div>";unset($_SESSION['success1']);?>
			<?php endif; ?>




				<!-- APPLY FOR A BOOK WHILE IN ULIBRARY MAIN PAGE -->

				 <?php 

	// <!-- SEARCH QUERY -->

	 if (isset($_POST['search'])) {
			
				$search = $_POST['searchs'];

				$query = "SELECT * FROM books WHERE title LIKE '%$search%' || author LIKE '%$search%'";
				$results = mysqli_query($db,$query);

				if (mysqli_num_rows($results) < 1) {
				    echo "<div class='well'>Sorry, The Book You searched for is Not In Library</div>";
				 }
				
				$bk_search = mysqli_fetch_all($results, MYSQLI_ASSOC);

				foreach ($bk_search as $key => $bk_search) {
				
				$_SESSION['book_id']      = $bk_search['id']; 
			    $_SESSION['book_title']   = $bk_search['title'];
			    $_SESSION['img']          = $bk_search['image'];
			    $_SESSION['book_author']  = $bk_search['author'];
			    $_SESSION['book_isbn']    = $bk_search['isbn'];
			    $_SESSION['book_date']    = $bk_search['uploaded_on'];
			    $_SESSION['book_time']    = $bk_search['at_time'];
			 
		 ?>
			  <tr>
			
				 <td><?php echo ++$key; ?></td>
				 <td><img src="../img/<?php echo $_SESSION['img']; ?>"></td>
				 <td><?php echo $_SESSION['book_title']; ?></td>
				 <td><?php echo $_SESSION['book_author']; ?></td>
				 <td><?php echo $_SESSION['book_isbn']; ?></td>
				 <td><?php echo $_SESSION['book_date']; ?></td>
				 <td><?php echo $_SESSION['book_time']; ?></td>
				 <td>
				 	<a href="my_books.php" id="r" >Edit</a>
				 </td>
				 <td>
				 	 <a href='manage_books.php?delete_bk=<?php echo $book['id'] ?>' id="a"> Delete </a>
				 </td>

			   </tr>

				<?php 
					} 
				 } 
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