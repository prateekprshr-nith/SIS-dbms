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
    <script src="sidebar/jquery-latest.js" type="text/javascript"></script>
    <script src="sidebar/script.js"></script>
	<link rel="icon" type="image/png" href="/dbms/logo/logo.png">
</head>
<body class="templatemo-bg-gray">
<?php
	if($_SESSION["logged"])
	{
		$id			= $_SESSION["id"];
		$password	= $_SESSION["pwd"];
		$name		= $_SESSION["name"]; 
	}
	else
	{
		// Get the data from the form
		$id		  		  = $_POST["tusername"];
		$password		  = $_POST["tpassword"];
	}
	
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
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
            </div>";
		$_SESSION["login"] = false;
		die();
	}
	
	// Check for valid id and password
	$query	= "SELECT f_id, passwd FROM faculty_login WHERE f_id = '$id' AND passwd = '$password'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	$case   = $tmp->fetch_assoc();
	if($row < 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID OR PASSWORD</h1>
			Please<a href=\"login.html\"> Try Again</a>
			</div>";
			$_SESSION["login"] = false;
		die();
	}
	else if(strcmp($password, $case["passwd"]) != 0)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ROLL NO. OR PASSWORD(check your caps lock)</h1>
			Please<a href=\"login.html\"> Try Again</a>
			</div>";
		$_SESSION["login"] = false;
		die();
	}
	else
		$validate = true;
	
	// Fetch the name of Teacher
	$query	= "SELECT f_name FROM faculty_info WHERE f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= $tmp->fetch_assoc();
	$name	= $row["f_name"];
	
	// Fetch department
	$query	= "SELECT d_code FROM faculty_info WHERE f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= $tmp->fetch_assoc();
	$dept	= $row["d_code"];
	if($dept == "CSED")
	{
		$deptname	= "Compueter Science and Engineering Department";
		$branch 	= "cse";
	}
	if($dept == "ECED")
	{
		$deptname	= "Electronics and Coommunication Engineering Department";
		$branch 	= "ece";
	}
	if($dept =="EED")
	{
		$deptname	= "Electrical and Electronics Engineering Department";
		$branch 	= "eed";
	}
	if($dept == "CED")
	{
		$deptname	= "Civil Engineering Department";
		$branch		= "ced";
	}
	if($dept == "MED")
	{
		$deptname	= "Mechanical Engineering Department";
		$branch		= "med";
	}
	if($dept == "CHED")
	{
		$dept = "Chemical Engineering Department";
		$branch = "ched";
	}
	if($dept == "ARD")
	{
		$deptname	= "Architecture Department";
		$branch		= "ard";
	}

	// Fetch phone no
	$query	= "SELECT phone_no FROM faculty_info WHERE f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= $tmp->fetch_assoc();
	$phone	= $row["phone_no"];
		
	// Fetch email id
	$query	= "SELECT email FROM faculty_info WHERE  f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= $tmp->fetch_assoc();
	$email	= $row["email"];
	
	
	// Fetch address
	$query		= "SELECT office FROM faculty_info WHERE f_id = '$id'";
	$tmp		= $con->query($query);
	$row		= $tmp->fetch_assoc();
	$address	= $row["office"];

	// Fetch Bdate
	$query		= "SELECT bDate FROM faculty_info WHERE f_id = '$id'";
	$tmp		= $con->query($query);
	$row		= $tmp->fetch_assoc();
	$bDate		= $row["bDate"];

    // Time table
    $day = date("l");
    $query = "SELECT class1, class2, class3, class4, class5, class6, class7, class8
                FROM timetable WHERE  day = '$day'
                    AND
                    (class1 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class2 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class3 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class4 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class5 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class6 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class7 in (select course_code
                                 from teaching_info
                                 where f_id = '$id')
                    OR class8 in (select course_code
                                 from teaching_info
                                 where f_id = '$id'));";
    $tmp		= $con->query($query);
    $row		= $tmp->fetch_assoc();

    $class1		= $row["class1"];
    $query      = "SELECT course_name
                    FROM course_info
                    WHERE course_code = '$class1'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class1     = $cname["course_name"];

    $class2		= $row["class2"];
    $query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class2'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class2     = $cname["course_name"];

    $class3		= $row["class3"];
    $query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class3'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class3     = $cname["course_name"];

    $class4		= $row["class4"];
    $query      = "SELECT course_name
                            FROM course_info
                            WHERE course_code = '$class4'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class4     = $cname["course_name"];

    $class5		= $row["class5"];
    $query      = "SELECT course_name
                            FROM course_info
                            WHERE course_code = '$class5'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class5     = $cname["course_name"];

    $class6		= $row["class6"];
    $query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class6'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class6     = $cname["course_name"];

    $class7		= $row["class7"];
    $query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class7'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class7     = $cname["course_name"];

    $class8		= $row["class8"];
    $query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class8'";
    $tmp		= $con->query($query);
    $cname		= $tmp->fetch_assoc();
    $class8     = $cname["course_name"];

	if(!$class1)
		$class1 = "No Class";
	if(!$class2)
		$class2 = "No Class";
	if(!$class3)
		$class3 = "No Class";
	if(!$class4)
		$class4 = "No Class";
	if(!$class5)
		$class5 = "No Class";
	if(!$class6)
		$class6 = "No Class";
	if(!$class7)
		$class7 = "No Class";
	if(!$class8)
		$class8 = "No Class";

	
	// Now set the sessions
	$_SESSION["id"] = $id;
	$_SESSION["pwd"] = $password;
	$_SESSION["name"] = $name;
	$_SESSION["dept"] = $dept;
	$_SESSION["record"] = false;
	$_SESSION["view"] = false;
	$_SESSION["give"] = false;
	//-----------------------------------------------------------------------------------------------------------------------
	// Now the main part starts
	if($validate)
	{
		
		// set the session
		$_SESSION["logged"] = true;
		echo "
			<div id=\"title\"><strong><center>
    		STUDENT INFORMATION SYSTEM<br><center>NIT HAMIRPUR</strong>
			</div>
			<div id=\"mcont\"> 
				 <div id=\"mnu\">
					<div id=\"txt\">Welcome $name</div>
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
					<p id=\"infohead\"><br><u><strong>Personal Information</strong></u> :</p>
					
						<div id=\"info\">
							<p><strong>Name</strong> : $name</p>
							<p><strong>ID</strong> : $id</p>
							<p><strong>DOB</strong> : $bDate </p>
							<p><strong>Department</strong> : $deptname</p>
							<p><strong>Phone No.</strong> : $phone</p>
							<p><strong>Email id</strong> : $email</p>
							<p><strong>Address</strong> : $address</p>
						</div>
					
			     </div> <!-- end content -->
				 <div id=\"sb\">
				 	<div id=\"cssmenu\">
					<ul>
					   <li class=\"active has-sub\"><a><span>Today's Lectures:</span></a>
						  <ul style=\"display: none;\">
							 <li class=\"has-sub\"><a href=\"#\"><span>First Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class1</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Second Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class2</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Third Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class3</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Fourth Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class4</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Fifth Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class5</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Sixth Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class6</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Seventh Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class7</span></a></li>
								</ul>
							 </li>
							 <li class=\"has-sub\"><a href=\"#\"><span>Eighth Class:</span></a>
								<ul style=\"\">
								   <li><a href=\"#\"><span>$class8</span></a></li>
								</ul>
							 </li>
						  </ul>
					   </li>
					</ul>
					</div>
				 </div> <!-- end sidebar -->
			</div>
			
		";
	}	
?>

<div id="footer">
    			Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
    			<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
		
		
</body>
</html>