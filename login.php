<?php include "app/auth/authentication.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login With Remember me button</title>
    <link rel="stylesheet" type="text/css" href="css/auth.css" />
    <link rel="shortcut icon" href="img/6.jpeg" type="image/x-icon" />
  </head>
  <body>
    <div class="container">
      <h1>User's Login Credentials <a href="index.php">Head Home</a></h1>
      <div class="formbox">
        <div class="img">
          <img src="admin/img/avatar.png" width="60px" height="60px" />
        </div>
        <form action="login.php" method="POST" autocomplete="off">
      <?php 
        include 'errors.php';
				if (!empty($_SESSION['success'])) {
					echo "<div class='success'>" . $_SESSION['success'] . "</div>";
						unset($_SESSION['success']); session_destroy();
					} 
        ?>
				 <?php if (!empty($_SESSION['error'])) : ?>
				 	<?php echo "<div class='error'>" . $_SESSION['error'] . "</div>"; unset($_SESSION['error']);?>
				 <?php endif ?>
          <div class="form-group">
            <input
              type="text"
              id="login"
              name="username"
              placeholder="Student Name"
              value = "<?php echo $username ?>"
            />
          </div>
          <div class="form-group">
            <input
              type="password"
              id="login"
              name="password"
              id="pass"
              placeholder="Student Password"
            />
          </div>
          <div class="button">
            <input type="submit" name="login" value="Login" class="btn" />
          </div>
          <p>
            Register for School Id?
            <a href="register.php" style="color: #EE00FF;">SignUp</a>
            <a href="#" style="color: #EE00FF;float: right;"
              >Forgot Password?</a
            >
          </p>
        </form>
      </div>
    </div>
  </body>
</html>
