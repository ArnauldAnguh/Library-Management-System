<?php  
	session_start();
 $db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

 if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  	exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Books</title>
	<link rel="stylesheet" type="text/css" href="css/mybks.css">
	<style>
.notification {
		color: white;
		padding: 5px 10px;
		text-align: center;
		font-family: Verdana, Geneva, Tahoma, sans-serif;
		}
.notification span {
		font-weight: bold;
		color: red;
		}
.notification b {
		font-weight: bold;
		color: orangered;
		background: transparent;
		}

</style>
</head>
<body>
		<header>
			 <?php if(!empty($_SESSION['username'])) : ?>
			    <?php if(isset($_SESSION['username'])) : ?>
            <?php echo '<a href="library.php" style="color: red">Home</a>'; ?>
          <?php endif; ?>
        <?php endif; ?>
			<?php if (isset($_GET['contact']) || isset($_GET['about'])): ?>
			   <a href="library.php" style="color: red">Home</a>
			 <?php else: ?>
			    <a href="app/auth/authentication.php?logout=1" style="color: red">Logout</a>
			<?php endif ?>
	
		<h1>ULibrary.<small>org</small></h1>
	</header>

	<div class="container">
		<h2>MY PACKAGES FROM ULIBRARY</h2>
		<form method="POST" action="" enctype="multipart/form-data">
			<table >
				<thead >
					<tr>
						<th>N<sup>o</sup></th>
						<th>Book</th>
						<th>Title</th>
						<th>Author</th>
						<th>Refund Date</th>
						<th>Action</th>
					</tr>
				</thead>
			 <tbody>
				 <?php if (!empty($_SESSION['success'])) : ?>
				 	<?php echo $_SESSION['success']; unset($_SESSION['success']);?>
				 <?php endif ?>
				<?php 
					$user_id = $_SESSION['user_id'];
				  	$query = "SELECT * FROM borrowed_books WHERE applicant_id = $user_id ";
				  	$run_query = mysqli_query($db,$query);

			  	if ($run_query) {
					if(!empty($_SESSION['bk_unapproved'])) {
						  echo "<div class='notification'><span>Notification:</span> " . $_SESSION['bk_unapproved'] . " </div>";unset($_SESSION['bk_unapproved']);
					  }
			  	   if (mysqli_num_rows($run_query) >= 1) { 
			  	   $rows = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
			  	   
				  	foreach ($rows as $key => $row) {
			  		
					 $_SESSION['refund_date'] = date('d/m/Y', strtotime('+7 DAYS'));
					 $_SESSION['book_id']     = $row['id'];
				 ?>
				<tr>
				 <td><?php echo ++$key; ?></td>
				 <td><img src="img/<?php echo $row['image']; ?>"></td>
				 <td><?php echo $row['title']; ?></td>
				 <td><?php echo $row['author']; ?></td>
				 <td><?php echo $_SESSION['refund_date']; ?></td>
				 <td><a href='my_books.php?delete=<?php echo $_SESSION['book_id'] ?>' id="a">Remove</a></td>
			    </tr>
			<?php } } else {
		  			echo "<div class='empty'>BAG IS EMPTY!! GO BORROW SOME BOOKS OR WAIT FOR APPROVAL OF APPLLIED BOOKS!!</div>";
				    }
			     } 
				 if(isset($_GET['delete'])) {
					 $del = $_GET['delete'];
					 $query = "DELETE FROM borrowed_books WHERE id = $del ";
					 $results = mysqli_query($db, $query);
					header('location: my_books.php');
					exit(0);
				 }
               ?>
			</tbody>
		</table>
	</form>
	</div>
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