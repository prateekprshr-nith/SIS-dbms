
<!DOCTYPE html>
<head>
	<title>Forgot password</title>
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

	// Get data
	$id     	= $_POST["id"];
	$type		= $_POST["type"];

	//Create connection to database
	$server		= "localhost:6994";
	$username	= "STUDENT";
	$passwd		= "student";
	$dbname		= "studentinfodb";
	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a
			 <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"forgot-password.html\"> Try Again </a>
			  </div>";
		$_SESSION["login"] = false;
		die();
	}

	// If request is by teacher
	if($type == "faculty")
	{
		$query = "SELECT email
					FROM faculty_info
						WHERE f_id = '$id'";

		$tmp = $con->query($query);
		$row	= mysqli_num_rows($tmp);
		if($row < 1)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID OR PASSWORD</h1>
				Please<a href=\"forgot-password.html\"> Try Again</a>
				</div>";
			die();
		}
		else
		{
			$Email = $tmp->fetch_assoc();
			$email = $Email["email"];
		}

		// Great you got the email id, now insert into table
		$Query = "INSERT INTO pwd_fac
					VALUES ('$id', '$email')";
		if($con->query($Query))
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\"> Request Received.</h1> <br>We have received your request.You will receive an
			 email regarding this action on your registered email id within 24 hours.<br><a href='login.html'> Login
			 </a>
		</div>";
		else
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a
			<a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"forgot-password.html\"> Try Again </a>
			  </div>";
	}

	// If request is by student
	if($type == "student")
	{
		$query = "SELECT email
					FROM student_info
						WHERE roll_no = '$id'";

		$tmp = $con->query($query);
		$row	= mysqli_num_rows($tmp);
		if($row < 1)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID OR PASSWORD</h1>
				Please<a href=\"forgot-password.html\"> Try Again</a>
				</div>";
			die();
		}
		else
		{
			$Email = $tmp->fetch_assoc();
			$email = $Email["email"];
		}

		// Great you got the email id, now insert into table
		$Query = "INSERT INTO pwd_stu
					VALUES ('$id', '$email')";
		if($con->query($Query))
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\"> Request Received.</h1> <br>We have received your request.You will receive an
			 email regarding this action on your registered email id within 24 hours.<br><a href='login.html'> Login
			 </a>
		</div>";
		else
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a
			<a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"forgot-password.html\"> Try Again </a>
			  </div>";
	}


	$today 		= date("jS \of F Y l his A ");
	$file		= fopen("ForgotPassword $today.txt","w");

	// Write to file
	fwrite($file , $id);
	fwrite($file , "      ");
	fwrite($file , $type);
	fwrite($file , "      ");
	fwrite($file , $email);
	fclose($file);
	
	echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\"> Request Received.</h1> <br>We have received your request.You will receive an
			 email regarding this action on your registered email id within 24 hours.<br><a href='login.html'> Login
			 </a>
		</div>";

	
	
	
	
?>
</body>
</html>
