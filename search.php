<?php
	session_start();
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Welcome to SIS</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
		<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="sidebar/styles.css">
		<link rel="stylesheet" href="pure/pure-min.css">
		<script src="sidebar/jquery-latest.js" type="text/javascript"></script>
		<script src="sidebar/script.js"></script>
		<link rel="icon" type="image/png" href="/dbms/logo/logo.png">
	</head>
	<body class="templatemo-bg-gray">
<?php

	// Get the data
	$id			= $_SESSION["id"];
	$password	= $_SESSION["pwd"];
	$name		= $_SESSION["name"];
	$dept		= $_SESSION["dept"];

	// Create connection to database
	$server		= "localhost:6994";
	$username	= "TEACHER";
	$passwd		= "teacher";
	$dbname		= "studentinfodb";

	$_SESSION["view"] = false;
	$_SESSION["give"] = false;
	//-------------------------

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
			  </div>";
		$_SESSION["login"] = false;
		die();
	}

	// Now get the form data
	$type   = $_POST["type"];

	// If teacher
	if($type == "teacher")
	{

		$roll_no    = $_POST["rno"];
		$tname      = $_SESSION["name"];
		// Fetch student details
		// Fetch the name of student
		$query	= "SELECT s_name FROM student_info WHERE roll_no = '$roll_no'";
		$tmp	= $con->query($query);
		$row	= $tmp->fetch_assoc();
		$name	= $row["s_name"];

		// Fetch department
		$query	= "SELECT d_code FROM student_info WHERE roll_no = '$roll_no'";
		$tmp	= $con->query($query);
		$row	= $tmp->fetch_assoc();
		$dept	= $row["d_code"];
		if($dept == "CSED")
		{
			$dept	= "Compueter Science and Engineering Department";
			$branch = "cse";
		}
		if($dept == "ECED")
		{
			$dept	= "Electronics and Coommunication Engineering Department";
			$branch = "ece";
		}
		if($dept =="EED")
		{
			$dept	= "Electrical and Electronics Engineering Department";
			$branch = "eed";
		}
		if($dept == "CED")
		{
			$dept	= "Civil Engineering Department";
			$branch = "ced";
		}
		if($dept == "MED")
		{
			$dept	= "Mechanical Engineering Department";
			$branch = "med";
		}
		if($dept == "CHED")
		{
			$dept = "Chemical Engineering Department";
			$branch = "ched";
		}
		if($dept == "ARD")
		{
			$dept	= "Architecture Department";
			$branch = "ard";
		}
		// Fetch semester
		$query		= "SELECT semester FROM student_info WHERE roll_no = '$roll_no'";
		$tmp		= $con->query($query);
		$row		= $tmp->fetch_assoc();
		$semester	= $row["semester"];
		if($semester == 1)
			$sem ="st";
		else if($semester == 2)
			$sem ="nd";
		else if($semester == 3)
			$sem ="3rd";
		else
			$sem ="th";

		// Fetch section
		$query		= "SELECT section FROM student_info WHERE roll_no = '$roll_no'";
		$tmp		= $con->query($query);
		$row		= $tmp->fetch_assoc();
		$section	= $row["section"];

		// Fetch phone no
		$query	= "SELECT phone_no FROM student_info WHERE roll_no = '$roll_no'";
		$tmp	= $con->query($query);
		$row	= $tmp->fetch_assoc();
		$phone	= $row["phone_no"];

		// Fetch email id
		$query	= "SELECT email FROM student_info WHERE roll_no = '$roll_no'";
		$tmp	= $con->query($query);
		$row	= $tmp->fetch_assoc();
		$email	= $row["email"];

		// Fetch address
		$query		= "SELECT address FROM student_info WHERE roll_no = '$roll_no'";
		$tmp		= $con->query($query);
		$row		= $tmp->fetch_assoc();
		$address	= $row["address"];

		// Fetch section
		$query		= "SELECT section FROM student_info WHERE roll_no = '$roll_no'";
		$tmp		= $con->query($query);
		$row		= $tmp->fetch_assoc();
		$section	= $row["section"];

		// Fetch Bdate
		$query		= "SELECT bDate FROM student_info WHERE roll_no = '$roll_no'";
		$tmp		= $con->query($query);
		$row		= $tmp->fetch_assoc();
		$bDate		= $row["bDate"];
	}

	echo "

		<div id=\"title\"><strong><center>
    		STUDENT INFORMATION SYSTEM<br><center>NIT HAMIRPUR</strong>
			</div>
			<div id=\"mcont\">
				 <div id=\"mnu\">
					<div id=\"txt\">Welcome $tname</div>
					<ul style='margin-left: 45%'>
						<li><a href=\"fac_dash.php\">Home</a></li>
						 <li><a href=\"fac_teach.php\">Teaching info</a></li>
						 <li><a href=\"fac_class.php\">Student Record</a></li>
						 <li><a href=\"fac_asn.php\">Assignments</a></li>
						 <li><a href=\"fac_query.php\">Student queries</a></li>
						 <li><a href=\"facUinfo.php\">Update info</a></li>
						 <li><a href=\"logout.php\">Logout</a></li>
					 </ul>
				 </div> <!-- end menu -->
				 <div id=\"ctnt\">
					<p id=\"infohead\"
					style='margin-left: 75%;line-height: 1%;margin-top: 2%'><br><u><strong>Student Profile</strong></u></p>
					<form action='fac_class.php' method='post'>
					<input style='margin-left: 150%' class='btn btn-info' type='submit'
					 value='Go back'></form>";
	echo "
						<div id=\"info\" style='margin-top: -10%;margin-bottom: 20%'>
							<p><strong>Name</strong> : $name </p>
							<p><strong>DOB</strong> : $bDate </p>
							<p><strong>Roll no.</strong> : $roll_no</p>
							<p><strong>Section.</strong> : $section</p>
							<p><strong>Semester</strong> : $semester$sem </p>
							<p><strong>Department</strong> : $dept</p>
							<p><strong>Phone No.</strong> : $phone</p>
							<p><strong>Email id</strong> : $email</p>
							<p><strong>Address</strong> : $address</p>
						</div>";


	?>
</div>
<div id="footer">
	Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
	<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
	</body>
</html>