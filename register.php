<?php include "app/auth/authentication.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <title>registration</title>
    <link rel="stylesheet" type="text/css" href="css/auth.css" />
    <style></style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1 class="info1">REGISTRATION</h1>
      </div>
      <form method="post" action="" name="frmRegistration" autocomplete="off">
        <?php include "errors.php";?>
        <div class="form-group">
          <input
            type="text"
            name="firstname"
            value="<?php echo $firstname; ?>"
            placeholder="Firstname"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <input
            type="text"
            name="lastname"
            value="<?php echo $lastname; ?>"
            placeholder="Lastname"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <input
            type="text"
            name="username"
            value="<?php echo $username; ?>"
            placeholder="Full Name"
            class="form-control"
          />
        </div>

        <div class="form-group">
          <input
            type="email"
            name="email"
            value="<?php echo $email; ?>"
            placeholder="Email: example@gmail.com"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            name="password"
            placeholder="Password"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            name="passwordconf"
            placeholder="Confirm Password"
            class="form-control"
          />
        </div>

        <p style="margin:10px;">
          <input
            type="submit"
            name="register"
            value="Register"
            class="btn"
          /><br />
        </p>
        <p
          style="font-size:15px;margin: 20px; padding: 10px; box-sizing: border-box;"
        >
          Already a member?
          <a href="login.php" style="text-decoration:none;color: #EE00FF;"
            >Sign in</a
          >
        </p>
      </form>
    </div>
  </body>
</html>
