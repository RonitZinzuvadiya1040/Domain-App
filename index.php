<?php

$url = 'C:\Users\George\Documents\HTML\bg.jpg';

?>


<?php
// session_start();
$con = mysqli_connect("localhost", "admin", "Admin@123", "domaintask");

$email = "";
$emailErr = "";
$validEmail = "";
// $pass="";
$passErr = "";
$validPassword = "";

$msg = "";

//$pass=md5($pass);
//echo "passord is:".$pass;
//die;

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$pass = md5($_POST['pass']);
	// $password = md5($_POST['password']);
	// $pass = $_POST['pass'];

	if (empty($email)) {
		$emailErr = "* Email is required.";
	} else {
		$e = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
		if (!preg_match($e, $email)) {
			$emailErr = "* Invalid email address.";
		} else {
			$validEmail = "* Valid email..";
			$email = $_POST['email'];
		}
	}

	if (empty($password)) {
		// echo "fvdf";
		$passErr = "* Correct Password is required.";
	}

	$sql = mysqli_query($con, "SELECT * FROM registration WHERE email='$email' AND password='$pass'");
	$r = mysqli_num_rows($sql);
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

	if ($r == 1) {
		$_SESSION['email'] = $email;
		echo '<script type="text/javascript">alert("Data fetch successfully")</script>';

		header('location:recent-domain.php');

	} else {
		$msg = "Record not found..! or E-mail / Password is wrong!!";
	}

}

?>

<!-- HTML CODE -->

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="icon.jpg">
    <title>Login Page</title>
    <style type="text/css">
body {
 /* background-image: url("simon-berger-twukN12EN7c-unsplash.jpg"); */
 background-repeat: no-repeat;
 background-size:cover;

}
</style>

    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


</head>

<body>
<nav class="navbar navbar-expand-lg bg-light" style="margin-left: 15px;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="color: black;">Domain App</a>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <!-- <a class="nav-link" href="#">Registration</a> -->
          <a class="nav-link" href="registration.php" style="color: black;">Register</a>
          <a class="nav-link" href="add-domain.php" style="color: black;">Domain</a>
        </div>
      </div>
    </div>
  </nav>


<form style="border: none;" action="" method="post">
<h1 style="text-align: center;">Login Page</h1>
   <p style="color: red;"><?php echo $msg; ?></p>

   <label for="na">E-mail:</label><br>

   <input style="width: 100%; height:35px" class="form-control" type="text" name="email" id="na" value= "<?php echo $email; ?>" placeholder="Enter E-mail" >
   <span style="color: red;"><?php echo $emailErr; ?></span>
   <span style="color: green;"><?php echo $validEmail; ?></span><br>


   <label for="pass">Password:</label>

   <input type="password" style="width: 100%; height:35px" class="form-control" name="pass" id="myInput"  placeholder="Enter Password" >
   <span style="color: red;"><?php echo $passErr; ?></span>


    <span style="color: red;"><br><input type="button" value="👁" onclick="myFunction()" style="width: 50px; margin-top: 1px;">
          <script type="text/javascript">
            function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
            }
          </script></span><br><br>

   <center>
    <button style= "height: 40px;" type = "submit" name = "submit" value = "Submit" class="btn btn-primary">Login</button><br><br>
</center>

</form>
</body>
</html>