<!-- PHP CODE -->

<?php

$con= new mysqli('localhost','admin','Admin@123', 'domaintask');

if(!$con){
	die(mysqli_error($con));
}

?>