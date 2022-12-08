<!-- PHP CODE -->

<?php

// session_start();
// if(!isset($_SESSION['email'])){
// header("location:/index.php");
// }
include 'connect.php';
$sql = "SELECT * FROM `registration` WHERE email='$_SESSION[email]'";
$r = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($r);

?>

<?php

include 'connect.php';

$dname = "";
$dnameErr = "";
$validName = "";

$regdate = "";
$regdateErr = "";
$validRegDate = "";

$expdate = "";
$expdateErr = "";
$validExpDate = "";

$downer = "";
$downerErr = "";
$validDowner = "";

$msg = "";

if (isset($_POST['submit'])) {
	$dname = $_POST['dname'];
	$regdate = $_POST['regdate'];
	$expdate = $_POST['expdate'];
	$downer = $_POST['downer'];

	if (empty($dname)) {
		$dnameErr = "* Domain Name is required.";
	}
//   else{
	//     $n="/^[A-Za-z]+$/";
	//     if(!preg_match($n, $dname))
	//     {
	//       $dnameErr ="* Please insert valid Domain..";
	//     }
	else {
		$validName = "* Valid Domain name..";
		$dname = $_POST['dname'];
	}

	if (empty($regdate)) {
		$regdateErr = "* Registration Date is required.";
	}
//   else{
	//     $m="^(0[1-9]|[12][0-9]|3[01])[- /.] (0[1-9]|1[012])[- /.] (19|20)\d\d$";
	//     if(!preg_match($m, $regdate))
	//     {
	//       $regdateErr ="* Invalid Registration Date..";
	//     }
	//     else{
	//       $validRegDate ="* Valid Registration Date..";
	//       $regdate = $_POST['regdate'];
	//     }
	//   }

	if (empty($expdate)) {
		$expdateErr = "* Expiration Date is required..";
	}
//   else{
	//     $n="^(0[1-9]|[12][0-9]|3[01])[- /.] (0[1-9]|1[012])[- /.] (19|20)\d\d$";
	//     if(!preg_match($n, $expdate))
	//     {
	//       $expdateErr ="* Invalid Expiration Date..";
	//     }
	//     else{
	//       $validExpDate ="* Valid Expiration Date..";
	//       $expdate = $_POST['expdate'];
	//     }
	//   }

	if ($regdate == $expdate) {
		$expdateErr = "Both date are same, please try to choose different dates :(";
	}

	if (empty($downer)) {
		$downerErr = "* Domain Owner Name is required..";
	} else {
		$n = "/^[A-Za-z]+$/";
		if (!preg_match($n, $downer)) {
			$downerErr = "* Please insert valid Domain Owner name..";
		} else {
			$validDowner = "* Valid Domain Owner..";
			$downer = $_POST['downer'];
		}
	}

	if ($dnameErr != "" OR $regdateErr != "" OR $expdateErr != "" OR $downerErr != "") {
		$msg = "something is wrong.....";
	} else {
		$sql = "INSERT into domain(domain_name,reg_date,exp_date,domain_owner) values('$dname', '$regdate', '$expdate', '$downer')";

		$result = mysqli_query($con, $sql);
		if ($result) {
			echo 'done';
			header('location:category.php');
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

    <title>Add Domain</title>
    <style type="text/css">
body {
 /* background-image: url("simon-berger-twukN12EN7c-unsplash.jpg"); */
 background-repeat: no-repeat;
 background-size:cover;

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
          <a class="nav-link" href="registration.php" style="color: black;">Register</a>
          <a class="nav-link" href="recent-domain.php" style="color: black;">Recent Domain</a>
          <a class="nav-link" href="category.php" style="color: black;">All Domain</a>
        </div>
      </div>
    </div>
  </nav>
  <body>

    <div class="container my-5">

      <form method="post">

        <h1 style="text-align: center;">Add Domain</h1>
        <div class="form-group">
          <label>Domain Name:</label>
          <input type="text" class="form-control" value="<?php echo $dname; ?>" placeholder="Enter your domain name" name="dname" autocomplete="off">
          <span style="color: red;"><?php echo $dnameErr; ?></span>
          <span style="color: green;"><?php echo $validName; ?></span>
        </div>

        <div class="form-group">
          <label>Registration Date:</label>
          <input type="date" class="form-control" value="<?php echo $regdate; ?>" name="regdate" autocomplete="off">
          <span style="color: red;"><?php echo $regdateErr; ?></span>
          <span style="color: green;"><?php echo $validRegDate; ?></span>
        </div>

        <div class="form-group">
          <label>Expiration Date:</label>
          <input type="date" class="form-control" value="<?php echo $expdate; ?>" name="expdate" autocomplete="off">
          <span style="color: red;"><?php echo $expdateErr; ?></span>
          <span style="color: green;"><?php echo $validExpDate; ?></span>
        </div>

        <div class="form-group">
          <label>Domain Owner:</label>
          <input type="text" class="form-control" value="<?php echo $downer; ?>" placeholder="Enter domain owner name" name="downer" autocomplete="off">
          <span style="color: red;"><?php echo $downerErr; ?></span>
          <span style="color: green;"><?php echo $validDowner; ?></span>
        </div>

        <center>
          <button type="submit" class="btn btn-primary" name="submit">Add
            <?php
// alert("Registration successfull..!!");
?>
          </button>
        </center>

      </form>
    </div>
  </body>
  </html>