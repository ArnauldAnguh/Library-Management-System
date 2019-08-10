<?php include 'app/books/books.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>About Book</title>
	<link rel="stylesheet" type="text/css" href="css/moreinf.css">
</head>
<body>
	<div class="container">
		<a href="library.php" class="backbtn">Home</a>
		<?php if(!empty($_SESSION['success1'])): ?>
		<?php echo $_SESSION['success1']; header('refresh: 3, page_info.php'); unset($_SESSION['success1']);?>
		<?php endif; ?>
		<div class="case">
		 <form method="POST">
		 	<?php 
		 		$date = strtotime($_SESSION['book_date']);
		 		$date = date('D, d M Y', $date);
		 		$time  = strtotime($_SESSION['book_time']);
		 	 ?>
		  <h2><?php echo $_SESSION['book_title']; ?></h2>
			<small>By :</small> <?php echo $_SESSION['book_author']; ?><br><b><small>ISBN CODE: <?php echo $_SESSION['book_isbn']; ?></small></b><br><span style="">uploaded on : <small><?php echo $date; ?></small><samp>  at <?php echo date('h:i', $time); ?></samp></span><br><br>
			  <img src="img/<?php echo $_SESSION['img']; ?>" width="300px" height="230px" style="border-radius: 5px;border: 2px solid;">

			  <p style="padding: 5px;">
				<H5>About Book</H5>
				<samp>
					<i><?php echo $_SESSION['book_content']; ?></i>
				</samp><br>
				  To get more details of this book, Click the button below to Borrow.
			  </p>
			  <hr>
			
			    <input type="submit" name="borrow" value="Apply" title="Borrow Book" class="btn"><br>
			 </form>
		</div>
	</div>

</body>
</html>