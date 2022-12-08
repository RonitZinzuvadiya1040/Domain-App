<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include('connect.php');

// $result =mysqli_query($con, "SELECT `reg_year` FROM `domain` GROUP BY `reg_year`, `reg_month`");
// while($row = mysqli_fetch_assoc($result)){
// echo $row['reg_year'];
// echo $row['reg_month'];
// };

?>


<?php

ini_set('display_errors', 1);
include 'connect.php';

$sql = mysqli_query($con, "SELECT (year(`reg_date`)) AS 'year', GROUP_CONCAT(DISTINCT(month(`reg_date`))) AS 'month', GROUP_CONCAT(DISTINCT domain_name SEPARATOR ',') as domain  FROM domain GROUP BY reg_date");
$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$newData = [];
foreach ($result as $key => $data) {
	//print_r($data);
	$newData[$data['year']][$data['month']] = explode(',', $data['domain']);
	// echo "<pre>";
	// print_r($newData);
}
// exit();
?>


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

require_once "connect.php";

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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<ul>
<?php
foreach ($newData as $year => $domainData): ?>
	<li><?=$year?></li>


<ul><?php for ($i = 0; $i <= 12; $i++): ?>
	<li><?php $domainName = [];
if (isset($domainData[$i])) {
	$domainName = $domainData[$i];
}?>
	<?=sprintf("%s (%s)", date("F", mktime(0, 0, 0, $i, 10)), count($domainName));?>
<?php if (count($domainName)): ?>
	 <ul>
	<?php foreach ($domainName as $domain): ?>
		<li><?=$domain?></li>

	<?php endforeach;?>

</ul>
<?php endif;?>





</li>
<?php endfor;?>
</ul>



<?php endforeach;?>
</ul>


</body>
</html>