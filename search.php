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
<section class="intro">
  <div class='success' style="background: ;width:100%;height: 30px;padding:5px;">
    <span id="span"><a href="">About us</a> | <a href="">contact</a></span>
		<!-- SEARCH BOX -->
    <form method="POST" action="search.php" style="float: right;background: ;margin: 0px;position: relative;">
            <div class="input-group" id="" style="background: ">
               <input type="text" name="searchs" class="form-control" style="height: 20px;width:px;" placeholder="Search Library">
              <span class="input-btn">
                <button class="btn" type="submit" style="outline: 0;width:70px;padding-top: 1.5px;cursor: pointer;" name="search">
              		Search
                  </button>
                </span>
              </div> 
          </form>

<?php echo  $_SESSION['success3']; ?>
<a href="my_books.php">My Books</a>
	     </div>
	</section>
<?php endif; ?>

	<section class="section">
			<li><a href="library.php" style="color: red">Home</a></li>
		<form method="POST" action="" enctype="multipart/form-data">
			<table border="true">
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

			if (isset($_SESSION['username'])) {

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

					$results_1  = mysqli_query($db,$query);

				if ($results_1) {
					$_SESSION['success4'] = "<div class='clover'><p>Book Successfully Applied For.<br></p></div>";
						header('location: library.php');
						exit();
					}
				  }

	// <!-- SEARCH QUERY -->

	 if (isset($_POST['search'])) {
			
				$search = $_POST['searchs'];

				$query = "SELECT * FROM books WHERE title LIKE '%$search%'  || author LIKE '%$search%'";
				$results = mysqli_query($db,$query);

				if (mysqli_num_rows($results) < 1) {
				    echo "<div class='well'>Sorry, The Book You searched for is Unavailable</div>";
				 }
				
				$bk_search = mysqli_fetch_all($results, MYSQLI_ASSOC);

				foreach ($bk_search as $key => $bk_search) {
				
				$_SESSION['book_id']      = $bk_search['id']; 
			    $_SESSION['book_title']   = $bk_search['title'];
			    $_SESSION['img']          = $bk_search['image'];
			    $_SESSION['book_author']  = $bk_search['author'];
			    $_SESSION['book_isbn']    = $bk_search['isbn'];
			 
		 ?>

			  <tr>
				 <td><?php echo ++$key; ?></td>
				 <td><img src="img/<?php echo $_SESSION['img'];?>"></td>
				 <td><?php echo $_SESSION['book_title']; ?></td>
				 <td><?php echo $_SESSION['book_author']; ?></td>
				 <td><a href="page_info.php?read=<?php echo $_SESSION['book_id'] ?>">more info...</a></td>
				  <td>
				 	 <a href='library.php?applied_id=<?php echo $_SESSION['book_id'] ?>'> Apply For Book </a>
				  </td>
			   </tr>
			<?php 
		         }
		       } 
		     }
			?>
			</tbody>
		</table>
	</form>
</section>

<footer>
	<p>&copy; Created by:   <i style="padding-right: 20px;"> Lab of Kn<i style="color:red;">o</i>wledge group</i>
<marquee id="marquee">Arnauld Anguh is the CEO of the Uengine Company That runs the WEB today</marquee>

<?php if (isset($_SESSION['username'])): ?>
	<?php if ($_SESSION['role'] == 'admin'): ?>

	<?php $id = $_SESSION['user_id']; echo "<a href='admin/index.php?role=$id'>Manage Library</a>"; ?> 
		
	<?php else: ?>
		<?php echo $_SESSION['role']; ?>

	<?php endif ?>


    <?php endif ?>

</p> 
</footer>
</body>
</html>