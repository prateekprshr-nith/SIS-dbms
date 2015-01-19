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

	// Fetch the courses student is studying
	$query	= "SELECT M.course_code, course_name
				FROM course_info as C, marks_attendence as M
					WHERE roll_no = '$roll_no' and  M.course_code = C.course_code";
	$cList  = $con->query($query);

	// Fetch the doubts he has asked
	$query = "SELECT *
				FROM doubt
					WHERE roll_no = '$roll_no'";
	$dList = $con->query($query);
	if(mysqli_num_rows($dList) > 0)
		$fdout = true;
	else
		$fdout = false;

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
				 <div id=\"ctnt\">";
					if(!$_SESSION["ask"] && !$_SESSION["view"])
						echo "<p id=\"infohead\"
					style=\"margin-left:40%;margin-top: 20%;line-height: 1%;width: 110%\"><br><u><strong>
					Doubts</u>?</strong> Your teachers are always there to help you.</p>";
					if($_SESSION["view"])
						echo "<div id=\"infoheadteacher\"><br><u><strong>My Doubts</strong></u></div>";


?><!--End php-->

		<!--UPDATE info-->
		<div id="uinfo">

			<?php
				{
					// TO choose
					if (!$_SESSION["ask"] && !$_SESSION["view"])
					{
						echo "
							<div class=\"col-md-12\" style='margin-left: 65%;margin-top: 10%'>
								<form class=\"col-md-6\"style='width: 30%' action='asn.php' method='post'>
									<input type=\"text\" name=\"TYPE\"hidden value=\"viewDoubt\">
									<input type=\"submit\" value=\"View asked doubts\" class=\"btn btn-info\">
								</form>
								<form class=\"col-md-6\" action='asn.php' method='post'>
									<input type=\"text\" hidden name=\"TYPE\" value=\"askDoubt\">
									<input type=\"submit\" value=\"Ask a doubt\" class=\"btn btn-info\">
								</form>
							</div>
							";
					}

					// To ask doubt
					if($_SESSION["ask"])
					{
						echo "<div class=\"container\" style=\"margin-top: -6%;margin-left: 50%;margin-bottom: .5%\">
							<div class=\"col-md-6\">
								<p class=\"text-center margin-bottom-15\"
								style=\"margin-bottom: 0%\"><strong><u>Ask a doubt</strong></u></p>
								<form class=\"form-horizontal templatemo-contact-form-2 templatemo-container\"
								role=\"form\" action=\"dout.php\" method=\"post\">
									<div class=\"form-group\">
										<div class=\"col-sm-6\">
											<div class=\"templatemo-input-icon-container\">
												<label for=\"course\" class=\"control-label\" >Course</label>
												<select id=\"course\" class=\"form-control\" required name=\"course1\">
													<option value=\"\">Select Course</option>";


						while($list = $cList->fetch_assoc())
							echo "<option value=\"".$list["course_code"]. "\">". $list["course_name"]. "</option>";
						echo"
												</select>
											</div>
										</div>


										<div class=\"col-sm-12\">
											<div class=\"templatemo-input-icon-container\">
												<label for=\"description\" class=\"control-label\" >Description</label>
												<textarea required  class=\"form-control\"
												          name=\"descp\"
												          id=\"description\" placeholder=\"Description\"></textarea>
											</div>
										</div>

										<div class=\"col-md-12\">
											<input type=\"submit\" value=\"Ask\" class=\"btn btn-warning pull-right\">
										</div>

									</div>


								</form>

								<div class=\"row\"></div>

							</div>
						</div>";

					} // ENd if

					// TO see given assignments
					if ($_SESSION["view"])
					{
						if($fdout)
						{
							echo "
		                               <div id=\"tablTeach\"
		                               style='margin-top: 10%;margin-left: 35%; float: left;width: 100%'>
		                                <table class=\"table2\">
		                                    <thead>
		                                    <tr>
		                                <th></th>
		                                <th scope=\"col\" abbr=\"Starter\"><center>Course </center></th>
		                                <th scope=\"col\" abbr=\"Medium\"><center>Description</center></th>
		                                <th scope=\"col\" abbr=\"Medium\"><center>Asked on</center></th>
										<th scope=\"col\" abbr=\"Medium\"><center>Teacher's response</center></th>
		                                </tr> ";


							while ($result = $dList->fetch_assoc()) {
								echo "<tr>
										 <th scope=\"row\"></th>";

								echo "<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["course_code"] . "</center></td>" .
									"<td style=\"border-radius:6px;
									border:groove;\"><textarea required readonly> " .$result["description"] . "</textarea> </td>".
									"<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["askDate"] . "</center></td>" .
									"<td style=\"border-radius:6px;
									border:groove;\"><textarea required readonly> " . $result["response"] . "</textarea> </td>";


								echo "</tr>";
							}//cloase while
							echo "</table></div>";
						}// Closed display if
						else        // If no assignment given
						{
							echo "<div  style='margin-top: 10%;margin-left: 55%'><br><strong>No Doubts</strong></div>";
						}
						echo "
								<form action=\"goback.php\" method=\"post\">
									<input type='submit'
									 class='btn btn-info'
									  style='float: right;margin-top:1%;width: 20%' value='Go Back'>
									  <input type='text' hidden name=\"TYPE\" value=\"dout\">
									   </form>";
					}// Closed if
				}// Closed php
			?>

		</div>
		</div> <!--end content-->

		<!--Sidebar-->
		<?php
			echo"

					<div id=\"footer\">
		                Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
		                <br>Found a bug ? <a href=\"contact/contact.html\">Contact us.</a>
		            </div>
				";
			}
?>
</body>
</html>