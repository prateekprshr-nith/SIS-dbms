<?php
	session_start();
	$_SESSION["record"] = true;
	$_SESSION["courseName"] = $_POST["course"];
	header("Location: fac_class.php");
?>