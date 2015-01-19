
<!DOCTYPE html>
<html>
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
	$username	= "STUDENT";
	$passwd		= "student";
	$dbname		= "studentinfodb";

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">		Bug Report,</a> Or<a href=\"stu_regis.html\"> Try Again </a>
			  </div>";
		die();
	}
	
	// Get the form data
	$name		= $_POST["name"];
	$roll_no	= $_POST["roll_no"];
	$email		= $_POST["email"];
	$department = $_POST["department"];
	$phone		= $_POST["phone"];
	$address	= $_POST["address"];
	$password   = $_POST["password"];
	$c_password = $_POST["c_password"];
	$semester	= $_POST["semester"];
	$section	= $_POST["section"];
	$bday		= $_POST["bday"];
	$date 		= getdate();
	$curdate 	= $date[year]."-".$date[mon]."-".$date[mday];
	
	// Check for name
	if (!preg_match("/^[a-zA-Z ]*$/", $name)) 
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT NAME.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fname = true;
		
	// Check for email
	$query	= "SELECT email
				FROM student_info
					WHERE email = '$email'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT EMAIL.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$femail = true;
	
	// Check for roll no
	$query	= "SELECT roll_no
				FROM student_info
					WHERE roll_no = '$roll_no'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1 || !preg_match("/^[0-9]*$/", $roll_no))
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ROLL NO.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$froll_no = true;
	
	// Check for sem
	if($semester > 0 && $semester < 11)
		$fsemester = true;
	else
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT SEMESTER.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	
	// Check for section
	if($section == "A1" || $section == "A2" || $section == "A3" ||
	   $section == "B1" || $section == "B2" || $section == "B3" ||
	   $section == "C1" || $section == "C2" || $section == "C3" ||
	   $section == "D1" || $section == "D2" || $section == "D3" ||
	   $section == "E1" || $section == "E2" || $section == "E3" ||
	   $section == "F1" || $section == "F2" || $section == "F3" ||
	   $section == "G1" || $section == "G2" || $section == "G3")
		$fsection = true;
	else
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT SECTION.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	
	// Check for phone number
	$query	= "SELECT phone_no
				FROM student_info
					WHERE phone_no = '$phone'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if($row >= 1 || !preg_match("/^[0-9]{10}$/", $phone) )
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT PHONE NO.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else
		$fpno = true;
	
	// password check
	$query	= "SELECT passwd
				FROM stu_login
					WHERE passwd = '$password'";
	$tmp = $con->query($query);
	$row = mysqli_num_rows($tmp);
	if(strlen($password) < 5)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE USE MINIMUM 5 CHARACTERS FOR PASSWORD</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else if($row >= 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORD ALREADY TAKEN.</h1>
			Please<a href=\"stu_regis.html\"> Try Again</a>
			</div>";
		die();
	}
	else if(strcmp($password, $c_password) != 0)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PASSWORDS DON'T MATCH</h1>
			Please <a href=\"stu_regis.html\">Try Again</a>
			</div>";
		die();
	}
	else
		$fpasswd = true;
	
	// Now validate and register the user
	if($fname && $froll_no && $fpno && $fpasswd && $femail && $fsemester && $fsection)
		$validate = true;
	else
	{
		echo "<div id=\"try\">
		<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug  
		  Report,</a> Or<a href=\"stu_regis.html\"> Try Again </a>
		 </div>";
		 die();
	}
	
	if($validate)
	{
		$query = "insert into student_info 
					values('$roll_no','$name','$department','$email','$phone','$address','$semester','$section', '$bday', '$curdate')";
		if($con->query($query) == true)
			$info1 = true;
		$query = "insert into stu_login values ('$roll_no','$password')";
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
			<h1 class=\"margin-bottom-15\">here OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"stu_regis.html\"> Try Again </a>
			  </div>";
		die();
		}
}
?>
</body>
</html>
