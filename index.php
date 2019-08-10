<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="css/welcome.css">
	<link rel="shortcut icon" href="img/6.jpeg" type="image/x-icon">
</head>
<body style="overflow: hidden;">
	<header style=>
		<ul style="margin: 0px;width: 100px;padding: 6px;margin-right: 30px;">
		 <?php if (isset($_GET['francais'])): ?>
		 	<li style="background:rgba(25, 24, 12, .3);margin: 0px;"><a href="register.php" style="padding:9px;color: white;display: block;">inscrivez</a></li>
		 	<?php else: ?>
			<li style="background:rgba(25, 24, 12, .3);margin: 0px;"><a href="register.php" style="padding:9px;color: white;display: block;">SIGN UP</a></li>
			<?php endif ?>
		</ul>
		<h1>ULibrary.<small>org</small></h1>
	</header>

	<div id="introd" style="margin: 80px auto;width: 500px;color: white;;text-align: center;padding: 10px;border-radius: 3px;font-size: 20px;">
		
		<?php if (isset($_GET['francais'])): ?>
		
		<?php echo '<p>Bienvenue sur notre plateforme de bibliothèque. 
		   Pour pouvoir emprunter un livre de la table des livres, vous devez avoir une carte de membre.</p> <a href="login.php"> CLIQUEZ ICI POUR ACCEDER</a><br><br>
		<a href="index.php"> continuez in English</a>' ?>
		<?php else: ?>
		<p>
			Welcome To Our Library platform.  To Borrow a Book from the table of books, you need to have a Membership Card.
		</p> <a href="login.php"> CLICK HERE FOR ACCESS</a><br><br>
		<a href="index.php?francais=french"> continue en français</a>

		<?php endif ?>
	</div>

	<!-- FOUNDERS OF ULIBRARY.ORG -->

	<h3 id="owners">DEVELOPERS  | DÉVELOPPEURS</h3>
<div class="row">
	<div class="founder">
		<div class="page-header">
			The Co-founder 
		</div>
		<img src="img/8.jpeg" id="fimg" title="hello am Arnauld Anguh, the Co-founder of Ulibrary.org">
		<p class="footer">
		   Arnauld Anguh
		</p>
	</div>
	<div class="founder">
		<div class="page-header">
			Developer 
		</div>
		<img src="img/dev.jpg" id="fimg" title="Am Donny Yen, the Developer of Ulibrary.org">
		<p class="footer">
		   Donny Yen
		</p>
	</div>
	<div class="founder">
		<div class="page-header">
			Designer
		</div>
		<img src="img/believe.jpg" id="fimg" title="Hi, am  Sarah J. Juggler, Designer of Ulibrary.org">
		<p class="footer">
		   Sarah J. Juggler
		</p>
	</div>
	<div class="founder">
		<div class="page-header">
			Liberian
		</div>
		<img src="img/book.jpg" id="fimg" title="Am Derulo Mager,Liberian of Ulibrary.org">
		<p class="footer">
		   Derulo Mager
		</p>
	</div>
</div>
<footer style="">
	<?php if (isset($_GET['francais'])): ?>
<p>&copy; Créé par:   <i style="padding-right: 20px;"> groupe Lab of Kn<i style="color:red;">o</i>wledge</i>
<marquee id="marquee">Arnauld Anguh est le PDG de la société Uengine qui gère le Web aujourd'hui</marquee>
	<?php else: ?>
<p>&copy; Created by:   <i style="padding-right: 20px;"> Lab of Kn<i style="color:red;">o</i>wledge group</i>
<marquee id="marquee">Arnauld Anguh is the CEO of the Uengine Company That runs the WEB today</marquee>
    <?php endif ?>
</footer>
</body>
</html>