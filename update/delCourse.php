<?php
	session_start();
	$_SESSION["login"] = false;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Course</title>
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
	}
	
	// ID
	$id = $_SESSION["id"];
	
	// Get the form data
	$course = $_POST["course"];
	
	// Now validate and delete the course
	$validate = true;
	if($validate)
	{
		$query = "DELETE FROM teaching_info WHERE course_code='$course' and f_id='$id'";
		if($con->query($query) == true)
			$info1 = true;
		if($info1)
		{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">Course has been removed.</h1>
				</div>"; 
				header("Location: /dbms/fac_teach.php");
		}
		else
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">hereOOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"/dbms/contact/contact.html\">Bug Report,</a> Or<a hrefa=\"/dbms/fac_teach.php\"> Try Again </a>
			  </div>";
			  session_unset();
			  session_destroy(); 
		die();
		}
}

?>
</body>
</html>
