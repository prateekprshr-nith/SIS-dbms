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

	// Get the data
	$id			= $_SESSION["id"];
	$password	= $_SESSION["pwd"];
	$name		= $_SESSION["name"];
	$dept		= $_SESSION["dept"];

	$_SESSION["record"] = false;
	$_SESSION["view"] = false;
	$_SESSION["give"] = false;
	//-------------------------

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
		die();
	};

	// Check for valid id and password
	$query	= "SELECT f_id, passwd FROM faculty_login WHERE f_id = '$id' AND passwd = '$password'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	if($row < 1)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID OR PASSWORD</h1>
			Please<a href=\"login.html\"> Try Again</a>
			</div>";
		$_SESSION["login"] = false;
		die();
	}
	else
		$validate = true;

	// Fetch the doubts if any
	$query = "SELECT *
				FROM doubt as D
					WHERE D.course_code IN (SELECT course_code
											FROM teaching_info
											WHERE f_id = '$id')";
	$dList = $con->query($query);
	if(mysqli_num_rows($dList) < 1)
		$fdout = false;
	else
		$fdout = true;


	//-----------------------------------------------------------------------------------------------------------------------
	// Now the main part starts
	if($validate)
	{echo "
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
					<p id=\"infohead\" style=\"margin-left: 70%;line-height: 1%;margin-top: 1%\"><br><u>
					<strong>Student Queries</strong></u></p>"; ?>
		<!--UPDATE info-->

		</div> <!--end content-->
		    <?php
		{
			if ($fdout) {
				echo "
							<div id=\"tablTeach\" style='margin-top: %;margin-left: 10%; float: left'>
								<table class=\"table2\" style='width: 100%'>
									<thead>
									<tr>
										<th></th>
										<th scope=\"col\" abbr=\"Starter\"><center>Course</center> </th>
										<th scope=\"col\" abbr=\"Starter\"><center>Roll no.</center> </th>
										<th scope=\"col\" abbr=\"Medium\"><center>Description</center></th>
										<th scope=\"col\" abbr=\"Medium\"><center>Asked on</center></th>
										<th scope=\"col\" abbr=\"Medium\"><center>Your response</center></th>
										<th scope=\"col\" abbr=\"Medium\"><center>Resolve</center></th>
										<th scope=\"col\" abbr=\"Medium\"><center>Remove</center></th>
									</tr>
							";


				while ($result = $dList->fetch_assoc()) {
					echo "<tr>
								<th scope=\"row\"></th>";

					echo "<td style=\"border-radius:6px;
								          border:groove;\"><center>" . $result["course_code"] . "</center></td>" .
						"<td style=\"border-radius:6px;
								          border:groove;\"><center>" . $result["roll_no"] . "</center></td>" .
						"<td style=\"border-radius:6px;
									     border:groove;\"><textarea required readonly>
							 " .$result["description"] . "</textarea></td>" .
						"<td style=\"border-radius:6px;
										     border:groove;\"><center>" . $result["askDate"] . "</center></td>" .
						"<td style=\"border-radius:6px;
											     border:groove;\"><form action=\"asn.php\" method=\"post\">
							<textarea
							 required placeholder=\"Your response\" name=\"response\">" .$result["response"] . "</textarea></td>".

						"<td
							 style=\"border-radius:6px;
											     border:groove;\">
											     <input type=\"text\" hidden name=\"TYPE\" value=\"resDout\">
											     <input type=\"text\" hidden name=\"cCode\" value=\"" . $result["course_code"] . "\">
							                     <input type=\"text\" hidden name=\"roll\" value=\"" . $result["roll_no"] . "\">
											     <center><button type=\"submit\"  class=\"btn btn-info\">Resolve</button></form>
									</center> </td>".

						"<td style=\"border-radius:6px;
											     border:groove;\">
											     <center><form action=\"asn.php\" method=\"post\">
											     <input type=\"text\" hidden name=\"TYPE\" value=\"delDout\">
											     <input type=\"text\" hidden name=\"cCode\" value=\"" . $result["course_code"] . "\">
							                     <input type=\"text\" hidden name=\"roll\" value=\"" . $result["roll_no"] . "\">
											     <button type=\"submit\"  class=\"btn
											     btn-info\">Remove</button></form></center></td>";




					echo "</tr>";
				}//cloase while
				echo "</table></div>";
			}// Closed display if
			else        // If no assignment given
			{
				echo "<div  style='margin-top: 10%;margin-left: 45%'><br><strong>No Queries</strong></div>";
			}
		}
		?>


	<?php

	}
?>
<div id="footer">
	Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
	<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
</body>
</html>