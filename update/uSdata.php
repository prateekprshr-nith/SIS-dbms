<!doctype html>
<html>
<head>
	<title>STUDENT INFO SYSTEM - NIT HAMIRPUR</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="/dbms/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="/dbms/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/dbms/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="/dbms/css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="templatemo-bg-gray">
<?php
	session_start();
	$roll	= $_POST["rno"];
	$atn	= $_POST["atn"];
	$pm		= $_POST["pm"];
	$ass	= $_POST["ass"];
	$fin	= $_POST["fin"];
	$tot	= $_POST["tot"];
	$course	= $_SESSION["courseName"];
	
	// Check for valid data
	if(!preg_match("/^[0-9]*$/", $roll))	// Roll no
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ROLL NO.</h1>
			Please<a href=\"/dbms/fac_class.php\"> Try Again</a>
			</div>";
	
	else if(!preg_match("/^[0-9]*$/", $atn))	// Attendance
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT Attendance</h1>
			Please<a href=\"/dbms/fac_class.php\"> Try Again</a>
			</div>";
			
	else if(!preg_match("/^[0-9.]*$/", $pm))	// Periodical Marks
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER CORRECT MARKS</h1>
			Please<a href=\"/dbms/fac_class.php\"> Try Again</a>
			</div>";
	
	else if(!preg_match("/^[0-9.]*$/", $ass))	// ASS Marks
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER CORRECT MARKS</h1>
			Please<a href=\"/dbms/fac_class.php\"> Try Again</a>
			</div>";
			
	else if(!preg_match("/^[0-9.]*$/", $fin))	// Finall Marks
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER CORRECT MARKS</h1>
			Please<a href=\"/dbms/fac_class.php\"> Try Again</a>
			</div>";
			
	// Now connect To db
	else
	{
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
				href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"/dbms/fac_class.php\"> Try Again </a>
				  </div>";
			die();
		};

        // Check if the student has registered or not
        $query = "SELECT roll_no
				  from student_info
				  where roll_no = '$roll'";
        $tmp = $con->query($query);
        if(mysqli_num_rows($tmp) < 1)
        {
            echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">This student has not registered himself in SIS.</h1><a href=\"/dbms/fac_class.php\"> Go back </a>
				  </div>";
            die();
        }
		
		// Check if entry is already present or not
		$query = "SELECT roll_no, course_code
				  from marks_attendence
				  where roll_no = '$roll' and course_code = '$course'";
		$tmp = $con->query($query);
		if(mysqli_num_rows($tmp) > 0)
			$query = "UPDATE marks_attendence
					  SET attendence='$atn', periodical_marks='$pm', ass_marks='$ass', final_marks='$fin', total_marks='$tot' 
					  WHERE roll_no='$roll' and course_code='$course'";
		else
			$query = "INSERT INTO marks_attendence VALUES('$roll', '$course', '$atn', '$pm', '$ass', '$fin','$tot')";
		
		// NOw insert into table
		if($con->query($query) == true)
			header("Location: /dbms/fac_class.php");
		else
		{	echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">PLEASE USE 0 (zero) FOR EMPTY FIELDS.</h1><a
				 href=\"/dbms/fac_class.php\">
				 Try Again </a>
				  </div>";
			die();
		};
	}// End main else

?>
</body>
</html>