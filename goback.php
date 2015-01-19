<?php
	session_start();
	$type = $_POST["TYPE"];
	if($type == "record")
	{
		$_SESSION["record"] = false;
		header("Location: fac_class.php");
	}
	elseif($type == "assignment")
	{
		$_SESSION["view"] = false;
		header("Location: fac_asn.php");
	}
	elseif($type == "dout")
	{
		$_SESSION["view"] = false;
		header("Location: stuDout.php");
	}
?>