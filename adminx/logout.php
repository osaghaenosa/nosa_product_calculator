<?php
//logout.php
session_start();
ob_start();
unset($_SESSION["myemail"]);
unset($_SESSION["mypassword"]);
unset($_SESSION["nickname"]);
unset($_SESSION["surname"]);
unset($_SESSION["phone"]);
unset($_SESSION["gender"]);
unset($_SESSION["dob"]);
unset($_SESSION["state"]);
unset($_SESSION["id"]);
$_SESSION['errl'] = "You have Successfully logged out";
header("location: login");
session_destroy();
ob_flush();
?>