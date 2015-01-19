<?php
	session_start();
	$_SESSION["login"] = false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="/dbms/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/dbms/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="/dbms/css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="templatemo-bg-gray">

<?php

	//Create connection to database
	$server		= "localhost:6994";
	$username	= "STUDENT";
	$passwd		= "student";
	$dbname		= "studentinfodb";

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"/dbms/contact/contact.html\">
					Bug Report,</a> Or<a href=\"/dbms/login.html\"> Try Again </a>
			  </div>";
		die();
	}
	
	// Roll no
	$roll_no = $_SESSION["roll"];
	// Get the form data
	$pwd    = $_POST["pwd"];
	$cpwd   = $_POST["cpwd"];
	if(strcmp($pwd, $cpwd) != 0)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORDS DON'T MATCH</h1>
			Please<a href=\"/dbms/stuUinfo.php\"> Try Again</a>
			</div>";
		die();
	}
	
	// password check
	$query	= "SELECT passwd from stu_login where passwd = '$pwd'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if(strlen($pwd) < 5)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE USE MINIMUM 5 CHARACTERS FOR PASSWORD</h1>
			Please<a href=\"/dbms/stuUinfo.php\"> Try Again</a>
			</div>";
		die();
	}
	else if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORD ALREADY TAKEN.</h1>
			Please<a href=\"/dbms/stuUinfo.php\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fpasswd = true;
	
	// Now change the password
	if($fpasswd)
		$validate = true;
	else
	{
		echo "<div id=\"try\">
		<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug  
		  Report,</a> Or<a href=\"/dbms/stuUinfo.php\"> Try Again </a>
		 </div>";
		 die();
	}
	if($validate)
	{
		$query = "UPDATE stu_login SET passwd='$pwd' WHERE roll_no='$roll_no'";
		if($con->query($query) == true)
			$info1 = true;
		if($info1)
		{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">Congratulations. Your password has been successfully updated.</h1>
				Please<a href=\"/dbms/login.html\"> Click here </a>to login
				</div>";
				session_unset();
				session_destroy();
				die();
		}
		else
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"/dbms/contact/contact.html\">
			Bug Report,</a> Or<a href=\"/dbms/login.html\"> Try Again </a>
			  </div>";
			session_unset();
			session_destroy();
			die();
		} 		
}
?>
</body>
</html>
