<!DOCTYPE html>
<head>
	<title>Create Account</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="/dbms/logo/logo.png">
</head>
<body class="templatemo-bg-gray">

<?php

	//Create connection to database
	$server		= "localhost:6994";
	$username	= "TEACHER";
	$passwd		= "teacher";
	$dbname		= "studentinfodb";

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
	        <h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
	        href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"fac_regis.html\"> Try Again </a>
	          </div>";
		die();
	}

	// Get the form data
	$name		= $_POST["name"];
	$id			= $_POST["id"];
	$email		= $_POST["email"];
	$department = $_POST["department"];
	$phone		= $_POST["phone"];
	$office		= $_POST["office"];
	$password   = $_POST["password"];
	$c_password = $_POST["c_password"];
	$bday		= $_POST["bday"];
	$date 		= getdate();
	$curdate 	= $date[year]."-".$date[mon]."-".$date[mday];

	// Check for name
	if (!preg_match("/^[a-zA-Z ]*$/", $name))
	{
		 echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT NAME.</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fname = true;

	// Check for email
	$query	= "SELECT email from faculty_info where email = '$email'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT EMAIL.</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$femail = true;

	// Check id
	$query	= "SELECT f_id from faculty_info where f_id = '$id'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID.</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fid = true;

	// Check for phone number
	$query	= "SELECT phone_no from faculty_info where phone_no = '$phone'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1 || !preg_match("/^[0-9]{10}$/", $phone) )
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT PHONE NO.</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fpno = true;

	// password check
	$query	= "SELECT passwd from faculty_login where passwd = '$password'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if(strlen($password) < 5)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE USE MINIMUM 5 CHARACTERS FOR PASSWORD</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORD ALREADY TAKEN.</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else if(strcmp($password, $c_password) != 0)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORDS DON'T MATCH</h1>
			Please<a href=\"fac_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fpasswd = true;

	// Now validate and register the user
	if($fname && $fid && $fpno && $fpasswd && $femail)
		$validate = true;
	else
	{
		echo "<div id=\"try\">
	    <h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug
		  Report, Please<a href=\"fac_regis.html\"> Try Again</a>
	     </div>";
		 die();
	}

	if($validate)
	{
		$query = "insert into faculty_info values ('$id','$name', '$department', '$phone', '$email', '$office', '$bday', '$curdate')";
	    if($con->query($query) == true)
			$info1 = true;
		$query = "insert into faculty_login values ('$id','$password')";
		if($con->query($query) == true)
			$info = true;
		if($info && $info1)
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">Congratulations. You have been successfully registered.</h1>
				Please<a href=\"login.html\"> Click here </a>to login
				</div>";
		else
		{
			echo "<div id=\"try\">
	        <h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
	        href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"fac_regiss.html\"> Try Again </a>
	          </div>";
		die();
		}
	}
?>
</body>
</html>
