<?php

	session_start();

	// GEt data
	$roll_no    = $_SESSION["roll"];
	$course     = $_POST["course1"];
	$descp      = $_POST["descp"];
	$date 		= getdate();
	$curdate 	= $date[year]."-".$date[mon]."-".$date[mday];

	// Create conncetion to database
	$server		= "localhost:6994";
	$username	= "STUDENT";
	$passwd		= "student";
	$dbname		= "studentinfodb";

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"stuDout.php\"> Try Again </a>
            </div>";
		$_SESSION["login"] = false;
		die();
	}

	// Insert into database
	$query = "INSERT INTO doubt(roll_no, course_code, description, askDate)
 						VALUES ('$roll_no', '$course', '$descp', '$curdate')
										";
	if($con->query($query) == true)
	{
		$_SESSION["ask"] = false;
		header("Location: stuDout.php");
	}
	else
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">eOOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"stuDout.php\"> Try Again </a>
            </div>";
		$_SESSION["login"] = false;
		die();
	}
?>