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

	// Get the data from the home
	$roll_no	= $_SESSION["roll"];
	$password	= $_SESSION["pwd"];
	$semester	= $_SESSION["sem"];
	$section	= $_SESSION["sec"];
	$name		= $_SESSION["name"];

	// Create connection to database
	$server		= "localhost:6994";
	$username	= "STUDENT";
	$passwd		= "student";
	$dbname		= "studentinfodb";

	// Set the sessions
	$_SESSION["ask"]	= false;
	$_SESSION["view"]	= false;

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">
			Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
			  </div>";
		die();
	};

	// Check for valid roll no and password
	$query	= "SELECT roll_no, passwd
				FROM stu_login
					WHERE roll_no = '$roll_no' AND passwd = '$password'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	if($row < 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ROLL NO. OR PASSWORD</h1>
			Please<a href=\"login.html\"> Try Again</a>
			</div>";
		$_SESSION["login"] = false;
		die();
	}
	else
		$validate = true;

	// Get the assigments
	$query = "SELECT course_name, assignNo, description, handOutDate, dueDate
				FROM assignment as A , course_info as C
					WHERE C.course_code = A.course_code AND A.course_code in (SELECT course_code
																				FROM marks_attendence
                        															WHERE roll_no = '$roll_no')";
	$asmnt = $con->query($query);
	if(mysqli_num_rows($asmnt) < 1)
		$fasmnt = false;
	else
		$fasmnt = true;

	// Fetch the time table
	$day = date("l");
	$query		= "SELECT class1, class2, class3, class4, class5, class6, class7, class8
	    			FROM timetable
	    				WHERE semester = '$semester' and day = '$day' AND section= '$section'";
	$Time		= $con->query($query);
	$data		= $Time->fetch_assoc();

	$class1		= $data["class1"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class1'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class1     = $cname["course_name"];

	$class2		= $data["class2"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class2'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class2     = $cname["course_name"];

	$class3		= $data["class3"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class3'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class3     = $cname["course_name"];

	$class4		= $data["class4"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class4'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class4     = $cname["course_name"];

	$class5		= $data["class5"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class5'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class5     = $cname["course_name"];

	$class6		= $data["class6"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class6'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class6     = $cname["course_name"];

	$class7		= $data["class7"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class7'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class7     = $cname["course_name"];

	$class8		= $data["class8"];
	$query      = "SELECT course_name
	    			FROM course_info
	    				WHERE course_code = '$class8'";
	$time		= $con->query($query);
	$cname		= $time->fetch_assoc();
	$class8     = $cname["course_name"];

	if(!$class1)
		$class1 = "Yuipee No Class :-)";
	if(!$class2)
		$class2 = "Yuipee No Class :-)";
	if(!$class3)
		$class3 = "Yuipee No Class :-)";
	if(!$class4)
		$class4 = "Yuipee No Class :-)";
	if(!$class5)
		$class5 = "Yuipee No Class :-)";
	if(!$class6)
		$class6 = "Yuipee No Class :-)";
	if(!$class7)
		$class7 = "Yuipee No Class :-)";
	if(!$class8)
		$class8 = "Yuipee No Class :-)";

	//-----------------------------------------------------------------------------------------------------------------------
	// Now the main part starts
	if($validate)
	{
			echo "
					<div id=\"title\"><strong><center>
		            STUDENT INFORMATION SYSTEM<br><center>NIT HAMIRPUR</strong>
					</div>
					<div id=\"mcont\">
						 <div id=\"mnu\">
							<div id=\"txt\">Welcome $name</div>
							 <ul style='margin-left: 40%'>
						<li><a href=\"stu_dash.php\">Home</a></li>
						 <li><a href=\"stuPerf.php\">View my Performance</a></li>
						 <li><a href=\"stuAtt.php\">View my attendance</a></li>
						 <li><a href=\"stuAsn.php\">Assignments</a></li>
						 <li><a href=\"stuDout.php\">Doubt corner</a></li>
						 <li><a href=\"stuUinfo.php\">Update info</a></li>
						 <li><a href=\"logout.php\">Logout</a></li>
					 </ul>
						 </div> <!-- end menu -->
						 <div id=\"ctnt\">
							<p id=\"infohead\"
							style=\"margin-left:50%;width: 1%\"><br><u><strong>Assignments</strong></u>:</p>
				";

			if($fasmnt)
			{
				echo "
					<div id=\"tablTeach\" style='margin-top: 1%;margin-left:  5%;width: 100%'>
						<table class=\"table2\">
							<thead>
								<tr>
									<th></th>
									<th scope=\"col\" abbr=\"Starter\"><center>Course <center></th>
									<th scope=\"col\" abbr=\"Medium\"><center>Assignment no.<center></th>
									<th scope=\"col\" abbr=\"Medium\"><center>Description.<center></th>
									<th scope=\"col\" abbr=\"Medium\"><center>Given on<center></th>
									<th scope=\"col\" abbr=\"Medium\"><center>Due by<center></th>
								</tr>
					";


				while ($result = $asmnt->fetch_assoc())
				{
					echo "<tr>
												 <th scope=\"row\"></th>";

					echo "<td style=\"border-radius:6px;
											border:groove;width:15%\"><center>" . $result["course_name"] . "</td>" .
						"<td style=\"border-radius:6px;
											border:groove;\"><center>" . $result["assignNo"] . "</td>" .
						"<td style=\"border-radius:6px;
											border:groove;\"><center><textarea required readonly>" . $result["description"] . "</textarea> </td>" .
						"<td
											 style=\"border-radius:6px;
											border:groove;width:15%\"><center>" . $result["handOutDate"] . "</td>" .
						"<td style=\"border-radius:6px;
											border:groove;width:15%\"><center>" . $result["dueDate"] . "</td>";


					echo "</tr>";
				}// closed while
				echo "</table></div>";
			}// Closed display if
			else        // If no assignment given
			{
				echo "<div  style='margin-top: 10%;margin-left: 55%'><br><strong>No Assignments given</strong></div>";
			}


?><!--End php-->

		</div> <!--end content-->

		<!--Sidebar-->
		<?php
			echo"
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
					<div id=\"footer\">
		                Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
		                <br>Found a bug ? <a href=\"contact/contact.html\">Contact us.</a>
		            </div>
				";
			}
?>
</body>
</html>