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

	// Get the data
	$id			= $_SESSION["id"];
	$password	= $_SESSION["pwd"];	
	$name		= $_SESSION["name"]; 
	$dept		= $_SESSION["dept"];
	
	// Create conncetion to database
	$server		= "localhost:6994";
	$username	= "TEACHER";
	$passwd		= "teacher";
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
	};
	
	// Now check what is to be updated
	$TYPE = $_POST["TYPE"];
	
	//--------------------------------------------------------------------------------------------------
	// If password is to be changed
	if($TYPE == "PWD")
	{
		$pwd    = $_POST["pwd"];
		$cpwd   = $_POST["cpwd"];
		
		// password check
		$query	= "SELECT passwd from faculty_login where passwd = '$pwd'";
		$tmp = $con->query($query);
		$row = mysqli_num_rows($tmp);
		if(strlen($pwd) < 5)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE USE MINIMUM 5 CHARACTERS FOR PASSWORD</h1>
				Please<a href=\"facUinfo.php\"> Try Again</a>
				</div>";
			die();
		}
		else if($row >= 1)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PASSWORD ALREADY TAKEN.</h1>
				Please<a href=\"/dbms/facUinfo.php\"> Try Again</a>
				</div>";
			die();
		}
		else if(strcmp($pwd, $cpwd) != 0)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PASSWORDS DON'T MATCH(check your caps lock)</h1>
				Please<a href=\"/dbms/facUinfo.php\"> Try Again</a>
				</div>";
			die();
		}
		else
			$fpasswd = true;
		
		if($fpasswd)
		{
			$query = "UPDATE faculty_login SET passwd='$pwd' WHERE f_id='$id'";
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
								href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
				  </div>";
				session_unset();
				session_destroy();
				die();
			}
		}
	}//	End password
	//--------------------------------------------------------------------------------------------------
	
	// If phone no is to be changed
	if($TYPE == "PNO")
	{
		$pno = $_POST["pno"];
		
		// Check for pno
		$query	= "SELECT phone_no from faculty_info where phone_no = '$pno'";
		$tmp = $con->query($query);
		$row = mysqli_num_rows($tmp);
		if($row >= 1 || !preg_match("/^[0-9]{10}$/", $pno) )
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT PHONE NO.</h1>
				Please<a href=\"/dbms/facUinfo.php\"> Try Again</a>
				</div>";
			die();
		}
		else
			$fpno = true;
		
		if($fpno)
		{
			$query = "UPDATE faculty_info SET phone_no='$pno' WHERE f_id='$id'";
			if($con->query($query) == true)
				$info1 = true;
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your phone number has been successfully updated.</h1>
					Please<a href=\"/dbms/login.html\"> Click here </a>to login
					</div>";
					header("Location: /dbms/facUinfo.php");
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
						href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
				  </div>";
				session_unset();
				session_destroy();
				die();
			}
		}
	}//	End pno
	//-----------------------------------------------------------------------------------------------------
	
	// If address is to be changed
	if($TYPE == "ADD")
	{
		$add = $_POST["add"];
		
		if($add)
			$validate = true;
		else
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
								href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
				  </div>";
			session_unset();
			session_destroy();
			die();
		}
		
		if($validate)
		{
			$query = "UPDATE faculty_info SET office='$add' WHERE f_id='$id'";
			if($con->query($query) == true)
				$info1 = true;
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your address has been successfully updated.</h1>
					Please<a href=\"/dbms/login.html\"> Click here </a>to login
					</div>";
					header("Location: /dbms/facUinfo.php");
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
								href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
				  </div>";
				session_unset();
				session_destroy();
				die();
			} 		
		}
	}// Finished address
	//------------------------------------------------------------------------------------------------------
	
	// For email
	if($TYPE == "MAIL")
	{
		// Get the form data
		$email = $_POST["email"];
	
		// Check for email
		$query	= "SELECT email from faculty_info where email = '$email'";
		$tmp = $con->query($query);
		$row = mysqli_num_rows($tmp);
		if($row >= 1 || strlen($email) < 1)
		{
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT EMAIL.</h1>
				Please<a href=\"/dbms/facUinfo.php\"> Try Again</a>
				</div>";
			die();
		}
		else
			$femail = true;
			
		if($femail)
		{
			$query = "UPDATE faculty_info SET email='$email' WHERE f_id='$id'";
			if($con->query($query) == true)
				$info1 = true;
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your email id has been successfully updated.</h1>
					Please<a href=\"/dbms/login.html\"> Click here </a>to login
					</div>";
					header("Location: /dbms/facUinfo.php");
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
								href=\"/dbms/contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/login.html\"> Try
								Again </a>
				  </div>";
				session_unset();
				session_destroy();
				die();
			} 	
		}
	} // Email done
	//---------------------------------------------------------------------------------------------------	
?>
</body>
</html>
