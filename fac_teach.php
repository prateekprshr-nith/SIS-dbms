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
	$_SESSION["view"] = false;
	$_SESSION["give"] = false;
	//-------------------------
	
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
	$query	= "SELECT course_code, lectures_held FROM teaching_info WHERE f_id = '$id'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	if($row < 1)
		$set_course = false;
	else
		$set_course = true;
	
	// Fetch the availabele list of courses
	$query		= "SELECT course_code 
					FROM course_info
					 WHERE d_code = '$dept' and course_code not in (select course_code
																	from teaching_info); ";
	$courses	= $con->query($query);

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
	$exec		= $con->query($query);
	$row		= $exec->fetch_assoc();

	$class1		= $row["class1"];
	$query      = "SELECT course_name
                    FROM course_info
                    WHERE course_code = '$class1'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class1     = $cname["course_name"];

	$class2		= $row["class2"];
	$query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class2'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class2     = $cname["course_name"];

	$class3		= $row["class3"];
	$query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class3'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class3     = $cname["course_name"];

	$class4		= $row["class4"];
	$query      = "SELECT course_name
                            FROM course_info
                            WHERE course_code = '$class4'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class4     = $cname["course_name"];

	$class5		= $row["class5"];
	$query      = "SELECT course_name
                            FROM course_info
                            WHERE course_code = '$class5'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class5     = $cname["course_name"];

	$class6		= $row["class6"];
	$query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class6'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class6     = $cname["course_name"];

	$class7		= $row["class7"];
	$query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class7'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
	$class7     = $cname["course_name"];

	$class8		= $row["class8"];
	$query      = "SELECT course_name
                        FROM course_info
                        WHERE course_code = '$class8'";
	$exec		= $con->query($query);
	$cname		= $exec->fetch_assoc();
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
					<p id=\"infoheadteacher\"><br><u><strong>Teaching Information</strong></u></p>
						<div id=\"info\">
							<p  style=\"margin-left:1.5%\"><strong>Courses I'am teaching</strong>: </p> ";
							if(!$set_course)
								echo "<p style=\"background-color: #66FF00; width:50%; margin-left:1%; padding-top:1%;border-radius: 16px\"><marquee style=\"height:10;width:200\" scrollamount=\"4\" scrolldelay=\"1\">TIP : Enter Courses to get Started</marquee></p>";
					
								?>	 
					
                    <div style="width:100%">
                    	<div id="courseForm" style="margin-right:38%">
		                    <label for="courseForm" style="margin-top:0%;margin-left:0% "> Add new course</label>
                    		    <form  role="form" id="courseForm" action="update\uCourse.php" method="post">
			                        <div class="form-group">
	                                    <div class="col-md-5">
				                             <select id="course" class="form-control" required name="course1">
	                                            <option value="">Select Course Code</option>

													<?php
													while($list = $courses->fetch_assoc())
							                            echo "<option value=\"".$list["course_code"]. "\">". $list["course_code"]. "</option>";
							                        ?>
	                                         </select>
					                    </div>
		                                <div class="col-md-6">
                                        <input type="submit" value="Add" onclick="alert('Confirm course addition ?')"
                                           class="btn btn-info"><br><br>
		                                </div>
		        				    </div>
		      				    </form>
                    	</div>
                        
                        <?php
						{
							echo "
                 			   <div id=\"tablTeach\" style='margin-left: 50%;margin-top: -15%;width: 100%;'>
                    			<table class=\"table2\">
                        			<thead>
                            		<tr>
                                <th></th>
                                <th scope=\"col\" abbr=\"Starter\">Course </th>
                                <th scope=\"col\" abbr=\"Medium\">Lectures Held</th>
                                <th scope=\"col\" abbr=\"Medium\">Update Lectures</th>
								<th scope=\"col\" abbr=\"Medium\">Remove course</th>
                            	</tr> ";
                            
                            
						
						while($result = $tmp->fetch_assoc())
						{
							echo "<tr>
								 <th scope=\"row\"></th>";
							
							echo "<td><center>" .$result["course_code"]. "</td>".
							     "<td><center>" .$result["lectures_held"]. "</td>".
								 "<td><center>
								  <form class=\"pure-form\" action=\"update/ulec.php\" method=\"post\">
   									 <input type=\"text\" required name=\"no\" class=\"pure-input-rounded\">
									 <input hidden required name=\"course\" value=\"" .$result["course_code"].  "\"class=\"pure-input-rounded\">
    								 <button type=\"submit\" onclick=\"alert('Confirm Update ?')\" class=\"btn btn-info\">Go</button>
								  </form>
								  </td>".
								  "<td><center>
								   <form class=\"pure-form\" action=\"update/delCourse.php\" method=\"post\">
									 <input hidden required name=\"course\" value=\"" .$result["course_code"].  "\"class=\"pure-input-rounded\">
    								 <button type=\"submit\" onclick=\"confirm('Confirm Removal ?')\" class=\"btn btn-info\">Remove</button>
									 </form>
								   </td>" ;
							echo "</tr>";
						}
						}// closed while
						?>
                         
                       
                                        </tbody>
                                </table>
                             </div>
                         </div><!--end table-->
                    </div>	<!--end info-->
                    
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
		";
	}
	?>
<div id="footer">
    			Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
    			<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
</body>
</html>