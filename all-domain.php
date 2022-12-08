<!-- PHP CODE -->

<?php

// session_start();
// if(!isset($_SESSION['email'])){
//   echo '<script>alert("Please Login Again!!")</script>';
// header("location:index.php"); 
// }

include 'connect.php';
$sql = "SELECT * FROM `domain` ORDER BY id DESC limit 5 ";
$r=mysqli_query($con,$sql);
$data=mysqli_fetch_assoc($r);

?>

<!-- HTML CODE -->

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="icon.jpg">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <title>All Domains</title>
</head>

<body>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once("connect.php");
  
  $findresult = mysqli_query($con, "SELECT * FROM domain");
  ?>

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="color: black;">Domain App</a>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" href="index.php" style="color: black;">Login</a>
          <a class="nav-link" href="registration.php" style="color: black;">Register</a>
          <a class="nav-link" href="recent-domain.php" style="color: black;">Recent Domain</a>
          <a class="nav-link" href="add-domain.php" style="color: black;">Add Domain</a>
          <!-- <a class="nav-link" href="dashboard.php">Dashboard</a> -->
        </div>
      </div>
    </div>
  </nav>
  <div>
    <div class="row-sm-4">
      <div class="container">
        <div class=row-sm-4 >
          &nbsp;
          <h2 style="text-align: center; "> All Domains </h2>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Domain Name</th>
                <th scope="col">Registration Date</th>
                <th scope="col">Expiration Date</th>
                <th scope="col">Domain Owner</th>
              </tr>
            </thead>
            <?php
            while ($res = mysqli_fetch_array($findresult)) {
              ?>
              <tr>
                <td><?php echo $res['id']; ?></td>
                <td><?php echo $res['domain_name']; ?></td>
                <td><?php echo $res['reg_date']; ?></td>
                <td><?php echo $res['exp_date']; ?></td>
                <td><?php echo $res['domain_owner']; ?></td>
              </tr>

              <?php
            }
            ?>
          </table>

          <?php

          $m= "SELECT domain_name FROM `domain` where id DESC limit 5 ";
          ?>



        </div>
      </div>
    </div>
  </body>

  </html>