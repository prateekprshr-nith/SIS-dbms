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

	$_SESSION["record"] = false;

	// Create connection to database
	$server		= "localhost:6994";
	$username	= "TEACHER";
	$passwd		= "teacher";
	$dbname		= "studentinfodb";

	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"login.html\"> Try Again </a>
			  </div>";
		$_SESSION["login"] = false;
		die();
	}

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

	// Fetch the courses Currently teaching
	$query	= "SELECT course_code FROM teaching_info WHERE f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	if($row < 1)
		$set_course = false;
	else
		$set_course = true;

	// Fetch given assignments
	$query      = "SELECT *
				FROM assignment as A
				  WHERE  A.course_code in (SELECT course_code
				  							FROM teaching_info as T
				  								WHERE T.f_id = '$id')";
	$asnList    =  $con->query($query);
	if(mysqli_num_rows($asnList) < 1)
		$list = false;
	else
		$list = true;

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
				 <div id=\"ctnt\">";
				 	if(!$_SESSION["give"] && !$_SESSION["view"])
						echo "<div id=\"infoheadteacher\"><br><u><strong>Assignments</strong></u></div>";
					if($_SESSION["view"])
						echo "<div id=\"infoheadteacher\"><br><u><strong>Assignments given</strong></u></div>";


		echo "<div id=\"info\">";


		?>

		<div>
			<?php
				{
					// TO choose
					if (!$_SESSION["give"] && !$_SESSION["view"])
					{
						echo "
							<div class=\"col-md-12\" style='margin-left: 35%;margin-top: 5%'>
								<form class=\"col-md-6\"style='width: 30%' action='asn.php' method='post'>
									<input type=\"text\" name=\"TYPE\"hidden value=\"view\">
									<input type=\"submit\" value=\"View given assignments\" class=\"btn btn-info\">
								</form>
								<form class=\"col-md-6\" action='asn.php' method='post'>
									<input type=\"text\" hidden name=\"TYPE\" value=\"give\">
									<input type=\"submit\" value=\"Give new assignment\" class=\"btn btn-info\">
								</form>
							</div>
							";
					}






					// To give assnmnt
					if($_SESSION["give"])
					{
						echo "<div class=\"container\" style=\"margin-top: -6%;margin-left: 50%;margin-bottom: .5%\">
							<div class=\"col-md-6\">
								<p class=\"text-center margin-bottom-15\" style=\"margin-bottom: 0%\"><strong><u>New
											Assignment</strong></u></p>
								<form class=\"form-horizontal templatemo-contact-form-2 templatemo-container\"
								role=\"form\" action=\"asn.php\" method=\"post\">
									<div class=\"form-group\">
										<div class=\"col-sm-3\">
											<div class=\"templatemo-input-icon-container\">
												<label for=\"course\" class=\"control-label\" >Course</label>
												<select id=\"course\" class=\"form-control\" required name=\"course1\">
													<option value=\"\">Select Course Code</option>";


											while($list = $tmp->fetch_assoc())
												echo "<option value=\"".$list["course_code"]. "\">". $list["course_code"]. "</option>";
											echo"
												</select>
											</div>
										</div>
										<div class=\"col-sm-4\">
											<div class=\"templatemo-input-icon-container\">
												<label for=\"course\" class=\"control-label\" >Assignment no.</label>
												<input required type=\"number\" class=\"form-control\" name=\"no\" id=\"name\"
												       placeholder=\"Assingment no.\">
											</div>
										</div>
										<div class=\"col-sm-5\">
											<div class=\"templatemo-input-icon-container\">
												<label for=\"date\" class=\"control-label\" >Due date</label>
												<input required type=\"date\" class=\"form-control\" name=\"date\" id=
												\"date\">

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
											<input type=\"text\" name=\"TYPE\"hidden value=\"new\">
											<input type=\"submit\" value=\"Give Assignment\" class=\"btn btn-warning pull-right\">
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
						if($list)
						{
							echo "
		                               <div id=\"tablTeach\" style='margin-top: 10%;margin-left: 35%; float: left'>
		                                <table class=\"table2\">
		                                    <thead>
		                                    <tr>
		                                <th></th>
		                                <th scope=\"col\" abbr=\"Starter\">Course </th>
		                                <th scope=\"col\" abbr=\"Medium\">Assignment no.</th>
		                                <th scope=\"col\" abbr=\"Medium\">Given on</th>
										<th scope=\"col\" abbr=\"Medium\">Due by</th>
		                                </tr> ";


							while ($result = $asnList->fetch_assoc()) {
								echo "<tr>
										 <th scope=\"row\"></th>";

								echo "<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["course_code"] . "</td>" .
									"<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["assignNo"] . "</td>" .
									"<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["handOutDate"] . "</td>" .
									"<td style=\"border-radius:6px;
									border:groove;\"><center>" . $result["dueDate"] . "</td>";


								echo "</tr>";
							}// closed while
						}// Closed display if
						else        // If no assignment given
						{
							echo "<div  style='margin-top: 10%;margin-left: 55%'><br><strong>No Assignments given</strong></div>";
						}
						echo "
								<form action=\"goback.php\" method=\"post\">
									<input type='submit'
									 class='btn btn-info' style='float: right;margin-right: -20%;margin-top:15%;width:
									  20%' value='Go Back'>
									  <input type='text' hidden name=\"TYPE\" value=\"assignment\">
									   </form>";
					}// Closed if
				}// Closed php
			?>


							</tbody>
						</table>
					</div>
				</div><!--end table-->
			</div>	<!--end info-->
		</div> <!--end content-->

		<!--Sidebar-->
		<?php

			echo "</div>
		";
	}
?>
<div id="footer">
	Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
	<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
</body>
</html>