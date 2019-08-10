<?php 
   session_start();
// create database connection
 $db = mysqli_connect('127.0.0.1', 'root', '', 'library') or die("connection failed" . mysqli_error());

//ARROVING A REQUESTED BOOK BY ANY STUDENT
if (isset($_GET['approve'])) {
	$_SESSION['approve_id']  = $_GET['approve'];
	$query  = "INSERT INTO borrowed_books(applicant_id,title,image,author,borrow_date)";
	$query .= " SELECT applicant_id,title,image,author,applied_date FROM admin_approvals WHERE id = " . $_SESSION['approve_id'];

    $results_approve = mysqli_query($db,$query);

if ($results_approve) {
	$query1 = "SELECT username FROM users WHERE id = " . $_SESSION['approve_id'];
	$run_query = mysqli_query($db, $query1);

	$borrower_name = mysqli_fetch_assoc($run_query);

	$_SESSION['success']  = "<div class='clover'><p>Approved</p></div>";


//DELETING AN APPROVED BOOK FROM APPROVE TABLE
if ($_SESSION['success']) {
	$query    = "DELETE FROM admin_approvals WHERE id = " . $_SESSION['approve_id'];
	$results  = mysqli_query($db,$query);

  if ($results) {
   header('location: applied_books.php');
   exit();
        }	        
	  }
    } 
   else {die(mysqli_error($db));}	
  header('location: applied_books.php');
   exit();			   
}


//DISAPPROVING REQUESTED BOOK
if (isset($_GET['unapprove'])) {
	$unapprove_id  = $_GET['unapprove'];
    $query    = "DELETE FROM admin_approvals WHERE id = $unapprove_id ";
    $results  = mysqli_query($db,$query);
    if ($results) {
		$query = mysqli_query($db, "SELECT * FROM books WHERE id = $unapprove_id ");
		$key = mysqli_fetch_assoc($query);
		$_SESSION['bk_unapproved'] = 
		" The requested book <b>" . $key['title'] . "</b> By <b>" . $key['author'] . "</b> was Disapproved!";
        header('location: applied_books.php');
	    exit();
        }
	 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Applied Books</title>
<link rel="stylesheet" type="text/css" href="css/applied.css">
</head>
<body>
 <h2>Applied Books</h2>
	<div class="container">

		<table>
		<?php if(!empty($_SESSION['success'])): ?>
		<?php echo $_SESSION['success']; unset($_SESSION['success']); header('refresh: 2, applied_books.php');?>
		    <?php endif; ?>
		    

		<a href="index.php" id="r1">Home</a>
		<a href="manage_books.php" id="r2">Manage Books</a>
			<thead>
				<tr>
					<th>N<sup>o</sup></th>
					<th>Book</th>
					<th>Title</th>
					<th>Author</th>
					<th>Applicant</th>
					<th>Applied Date</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>
			<tbody>
	
			<?php 
            //SELECT INFO FROM APPROVAL TABLE WHERE THE APPLICANT'S ID IS SAME AS VALIDATED ID
				$query = "SELECT * FROM admin_approvals";
				$execute = mysqli_query($db, $query);
				
				if(mysqli_num_rows($execute) < 1) {
					echo "<div class='well'>No Books Available For Approval</div>";
				}
				
				$applieds = mysqli_fetch_all($execute, MYSQLI_ASSOC);


				foreach ($applieds as $key => $apply) {
					    $date = strtotime($apply['applied_date']);
					    $date = date('d/m/Y', $date);
				 ?>
				<tr>
					<td><?php echo ++$key; ?></td>
					<td><img src="../img/<?php echo $apply['image']; ?>"></td>
					<td><?php echo $apply['title']; ?></td>
					<td><?php echo $apply['author']; ?></td>
					<td><?php echo $apply['applicant']; ?></td>
					<td><?php echo $date; ?></td>
					<td><a href="applied_books.php?approve=<?php echo $apply['id'] ?>">Approve</a></td>
					<td><a href="applied_books.php?unapprove=<?php echo $apply['id'] ?>">Unapprove</a></td>
				</tr>
		       <?php } ?>
		  </tbody>
		</table>
      </div>
   </body>
</html>