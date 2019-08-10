<?php  
	session_start();
	// create database connection

	$db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

	if (!isset($_SESSION['username'])) {
		header('location: login.php');
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/about.css">
	<link rel="shortcut icon" href="img/6.jpeg" type="image/x-icon">
	<style>


	</style>
</head>
<body>
	<?php if(!empty($_SESSION['success4'])): ?>
	<?php echo $_SESSION['success4']; header('refresh: 3, library.php'); unset($_SESSION['success4']);?>
	<?php endif; ?>
	<header>
			 <?php if(!empty($_SESSION['username'])) : ?>
			    <?php if(isset($_SESSION['username'])) : ?>
            <?php echo "<a href='library.php'>" . $_SESSION['username'] . "</a>"; ?>
          <?php endif; ?>
        <?php endif; ?>
			<?php if (isset($_GET['contact']) || isset($_GET['about'])): ?>
			   <a href="library.php" style="color: red">Home</a>
			 <?php else: ?>
			    <a href="app/auth/authentication.php?logout=1" style="color: red">Logout</a>
			<?php endif ?>
	
		<h1>ULibrary.<small>org</small></h1>
	</header>

 <?php if(!empty($_SESSION['success3'])) : ?>
  <div class="intro">
   <div class='success' style="width:100%;height: 30px;padding:5px;">
     <span id="span">
		 <a href="library.php?about=<?php echo 'ulibrary'; ?>">About us</a> | </span><span id="span"><a href="library.php?contact">contact</a></span>
		<!-- SEARCH BOX -->
	   <form method="POST" action="search.php" style="float: right;margin: 0px;position: relative;">
            <div class="input-group">
               <input type="text" name="searchs" class="form-control" style="height: 20px;" placeholder="Search Library">
              <span class="input-btn">
                <button class="btn" type="submit"  name="search">
              		Search
                  </button>
                </span>
              </div> 
          </form>
	<?php if (isset($_GET['contact'])): ?>
		<?php echo "| <i>You can reach us through : <b>+237671869068 </b> or via Gmail at <b>arnauldanguh@gmail.com</b></i> |"; ?> 
		<?php else: ?>
 	 <?php echo  $_SESSION['success3']; ?>
     <a href="my_books.php" style="color: brown;font-family: serif,cursive,tahoma;margin-left: 5px;">My Books</a>
 	 <?php endif ?>
</div>
  <?php endif; ?>

  <div class="section">
	 <?php if (isset($_GET['about'])): ?>
		<div class="container" id="header">
			About Ulibrary
		</div>
	   <div class="container">
		 
		 <i>Ulibrary</i>
			<img src="img/mat.jpg">
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
		<p>
			We Offer Other Services on differernt platforms including <a href="">Facebook</a> | <a href=""> Youtube </a> | <a href=""> Coursera </a> | <a href=""> Udemy </a>   And More..
		</p>
	</div>

	<?php else : ?>
		<form method="POST" action="" enctype="multipart/form-data">
			<table>
				<thead>
					<tr>
						<th>N<sup>o</sup></th>
						<th>Book</th>
						<th>Name</th>
						<th>Author</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php 

				//APPLY FOR A BOOK WHILE IN ULIBRARY MAIN PAGE

				if (isset($_GET['applied_id'])) {
				 	$query = "SELECT * FROM books WHERE id = " . $_GET['applied_id'];
					$run_query = mysqli_query($db, $query);
					
					$applied    = mysqli_fetch_assoc($run_query); 
				    $book_id    = $applied['id'];
				    $author     = $applied['author'];
				    $applicant_id =  $_SESSION['user_id'];
				    $applicant   =  $_SESSION['firstname'];
				    $title       = $applied['title'];
				    $image       = $applied['image'];
				    $content     = $applied['content'];
					$date		 =    date('Y/m/d');

		    $query  = "INSERT INTO admin_approvals (applicant_id,applicant,image,title,author,applied_date) ";
		    $query .= " VALUES($applicant_id,'$applicant','$image', '$title', '$author', '$date') ";

			$results_1 = mysqli_query($db,$query);

			  if ($results_1) {
				$_SESSION['success4'] = "<div class='clover'><p>You've Applied For 
				    <i style='color: red;'>$title</i> By <b>$author</b><br></p></div>";
					  header('location: library.php');
					  exit();
					}
				 }
				 
//DISPLAYING ALL BOOKS TO LIBRARY
			$query = "SELECT * FROM books ";
			$results = mysqli_query($db,$query);
			$books = mysqli_fetch_all($results, MYSQLI_ASSOC);
			foreach ($books as $key => $book):
			?>
				<tr>
					<td><?php echo ++$key; ?></td>
					<td><img src="img/<?php echo $book['image'];?>"></td>
					<td><?php echo $book['title']; ?></td>
					<td><?php echo $book['author']; ?></td>
					<td><a href="page_info.php?read=<?php echo $book['id'] ?>">more info...</a></td>
					<td>
					 	<a href='library.php?applied_id=<?php echo $book['id'] ?>'> Apply For Book </a>
					</td>
				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
	</form>
<?php endif ?>
  </div>
<footer>
	<p>&copy; Created by:   <i style="padding-right: 18px;"> Lab of Kn<i style="color:red;">o</i>wledge group</i>

	<?php if (isset($_GET['contact'])): ?>

	<?php echo "| <i>You can reach us through : <b>+237671869068 </b> or via Gmail at <b>arnauldanguh@gmail.com</b></i> |"; ?> 
		
	<?php else: ?>
	
<marquee id="marquee">Arnauld Anguh is the CEO of the Uengine Company That runs the WEB today</marquee>

	<?php endif ?>


	<?php if ($_SESSION['role'] == 'admin'): ?>

	<?php $id = $_SESSION['user_id']; echo "<a href='admin/index.php?role=$id'>Manage Library</a>"; ?> 
		
	<?php else: ?>

		<?php echo $_SESSION['role']; ?>

	<?php endif ?>

</p> 
</footer>
</body>
</html>