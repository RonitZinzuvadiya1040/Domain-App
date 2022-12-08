<?php
session_start();
session_destroy();
echo '<script>alert("Logout succesfully!!!")</script>';
header('location:index.php');
?>