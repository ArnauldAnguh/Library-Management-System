<?php  
  

  if (isset($_POST['submit'])) {
    $sum = 0;
    $inputNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
  for ($n = 0; $n < 10; $n++) { 
  	$sum = $sum + $inputNumbers[$n];
  }
    echo $submit;

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Whatsapp Question</title>
</head>
<body>
 <form method="POST">
 	<input type="submit" name="submit" value="Calculate">
 </form>
</body>
</html>