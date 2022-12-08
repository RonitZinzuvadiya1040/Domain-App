<!-- PHP CODE -->

<?php

include 'connect.php';

$name = "";
$nameErr = "";
$validName = "";

$email = "";
$emailErr = "";
$validEmail = "";

$mobile = "";
$mobileErr = "";
$validMobile = "";

$gender = "";
$genderErr = "";
$validGender = "";

$password = "";
$passErr = "";
$validPassword = "";

// $image="";
// $imageErr ="";
// $validImage ="";

$msg = "";

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$gender = $_POST['gender'];
	$password = $_POST['password'];
	$pass = md5($_POST['password']);
//   $image = $_POST['image'];

	// $password=md5($password);

	if (empty($name)) {
		$nameErr = "* Name is required.";
	} else {
		$n = "/^[A-Za-z]+$/";
		if (!preg_match($n, $name)) {
			$nameErr = "* Only alphabets allowed..";
		} else {
			$validName = "* Valid name..";
			$name = $_POST['name'];
		}
	}

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

	if (empty($mobile)) {
		$mobileErr = "* Mobile number is required.";
	} else {
		$m = "/^\d{10}$/";
		if (!preg_match($m, $mobile)) {
			$mobileErr = "* Invalid mobile number.";
		} else {
			$validMobile = "* Valid mobile..";
			$mobile = $_POST['mobile'];
		}
	}

	if (empty($gender)) {
		$genderErr = "* Gender is required.";
	}

	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);

	if (empty($password)) {
		$passErr = "* Password is required.";
	}

	if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
		$passErr = "* Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
	} else {
		$validPassword = "* Password is Valid and Strong..!!";
	}

//   if(empty($image))
	//   {
	//     $imageErr ="* Image is required.";
	//   }else{
	//     $validImage ="* Valid image..";
	//   }

	if ($nameErr != "" OR $emailErr != "" OR $mobileErr != "" OR $genderErr != "" OR $passErr != "") {
		$msg = "something is wrong.....";
	} else {

		$sql = "insert into `registration` (name,email,mobile,gender,password) values('$name', '$email', '$mobile', '$gender', '$pass')";

		$result = mysqli_query($con, $sql);
		if ($result) {
			echo '<script type="text/javascript">alert("Data inserted successfully")</script>';
			header('location:index.php');

		} else {
			die(mysqli_error($con));
		}
	}
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!-- HTML CODE -->

<!doctype html>
  <html lang="en">
  <head>
  <link rel="icon" href="icon.jpg">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Registration Form</title>
    <style type="text/css">
body {
 /* background-image: url("simon-berger-twukN12EN7c-unsplash.jpg"); */
 background-repeat: no-repeat;
 background-size:cover;


 .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

}
</style>
  </head>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="color: black;">Domain App</a>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <!-- <a class="nav-link" href="#">Registration</a> -->
          <a class="nav-link" href="index.php" style="color: black;">Login</a>
          <a class="nav-link" href="add-domain.php" style="color: black;">Domain</a>
        </div>
      </div>
    </div>
  </nav>
  <body>

    <div class="container my-5">

      <form method="post">

        <h1 style="text-align: center;">Registration Form</h1>
        <div class="form-group">
          <label>Name:</label>
          <input type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name" name="name" autocomplete="off">
          <span style="color: red;"><?php echo $nameErr; ?></span>
          <span style="color: green;"><?php echo $validName; ?></span>
        </div>

        <div class="form-group">
          <label>Email:</label>
          <input type="text" class="form-control" value="<?php echo $email; ?>" placeholder="Enter your email" name="email" autocomplete="off">
          <span style="color: red;"><?php echo $emailErr; ?></span>
          <span style="color: green;"><?php echo $validEmail; ?></span>
        </div>

        <div class="form-group">
          <label>Mobile:</label>
          <input type="text" class="form-control" value="<?php echo $mobile; ?>" placeholder="Enter your mobile number" name="mobile" autocomplete="off">
          <span style="color: red;"><?php echo $mobileErr; ?></span>
          <span style="color: green;"><?php echo $validMobile; ?></span>
        </div>

        <div class="form-group">
          <label>Gender:</label><br>
          <div>
            <input type="radio" name="gender" value="male" checked> Male
            <input type="radio" name="gender" value="female" > Female
            <input type="radio" name="gender" value="other" > Other
            <span style="color: red;"><?php echo $genderErr; ?></span>
          </div>
        </div>

        <div class="form-group">
          <label>Password:</label>
          <input type="password" class="form-control" id="myInput" value="<?php echo $password; ?>"  placeholder="Enter your Password" name="password" autocomplete="off">
          <span style="color: red;"><?php echo $passErr; ?></span>
          <span style="color: green;"><?php echo $validPassword; ?></span><br>
          <input type="button" value="👁" onclick="myFunction()" style="width: 50px; margin-top: 10px;">
          <script type="text/javascript">
            function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
            }
          </script>
        </div>

        <center>
          <button type="submit" class="btn btn-primary" name="submit">Register
            <?php
// alert("Registration successfull..!!");
?>
          </button>
        </center>

      </form>
    </div>
  </body>
  </html>