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
	
	// Create connection to database
	$server		= "localhost:6994";
	$username	= "TEACHER";
	$passwd		= "teacher";
	$dbname		= "studentinfodb";

	$_SESSION["view"] = false;
	$_SESSION["give"] = false;
	//-------------------------

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
	
	//-----------------------------------------------------------------------------------------------------------------------
	// Now the main part starts
	if($validate)
	{
		
		// set the session
		$_SESSION["logged"] = true;
		echo "
			<div id=\"title\"><strong><center>
    		STUDENT INFORMATION SYSTEM<br><center>NIT HAMIRPUR</strong>
			</div
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
					<div id=\"infoheadteacher\" style='width: 100%'><br><u><strong>Student Record </strong></u>";
						if($_SESSION["record"])
							echo"(". $_SESSION["courseName"].")";

						echo"</div>
					
						<div id=\"info\"> ";

                        // To display course selection
                        if(!$_SESSION["record"])
						{
							echo "
						<form  style=\"margin-top:10%;margin-left:40%;width:100%\"role=\"form\" action=\"selCourse.php\" method=\"post\">
		       					 <div class=\"form-group\">
                 				 	<div class=\"col-md-5\">
			            <select id=\"course\" class=\"form-control\" required name=\"course\">
                        <option value=\"\">Select a Course to go</option>";
                        
						while($list = $tmp->fetch_assoc())
                        	echo "<option value=\"".$list["course_code"]. "\">". $list["course_code"]. "</option>";
 						
						echo "
                        </select>
							 </div> 
		                           <div class=\"col-md-6\">
                                   <input type=\"submit\" value=\"GO\" class=\"btn btn-info\"><br><br>
                                   
                             </div>
							
								";
						}
						
						// For record display
						if($_SESSION["record"])
						{
							echo "<p style=\"margin-left:55%;margin-top: 10%;width:35%;position:fixed;float:left\"><marquee style=\"height:20;width:200\"
 								scrollamount=\"4\"
 								scrolldelay=\"1\"><br><strong><i>#NOTE:</strong> Please use \"0\" (zero) for empty fields.</i></marquee></p>";
							echo " <form action=\"goback.php\" method=\"post\" style=\"margin-left:55%;margin-top: 9%;width:35%;
							position:fixed;float:left\">
									<input type='text' hidden name=\"TYPE\" value=\"record\">
									<input type='submit' class='btn btn-info' value='Go Back'> </form>		";
							// Firstly get the data from Database
							$courseCode = $_SESSION["courseName"];
							$query = "SELECT roll_no, attendence, periodical_marks, ass_marks, final_marks, total_marks
									  FROM marks_attendence
									  WHERE course_code = '$courseCode'";
							
							$tmp = $con->query($query);
							$row	= mysqli_num_rows($tmp);
							if($row < 1)
								echo "<p style=\"background-color: #66FF00; width:50%; margin-left:40%; padding-top:1%;border-radius: 16px\"><marquee
 style=\"height:20;width:200\" scrollamount=\"4\" scrolldelay=\"1\">TIP : Enter Roll nos. to get Started (No need to enter names. They will appear automatically)</marquee></p>";
					
							$i = 1;
							// Get data
							while($result = $tmp->fetch_assoc())
							{
								$ROLL[$i]	= $result["roll_no"];
								
								$ATT[$i]	= $result["attendence"];
								$PM[$i]		= $result["periodical_marks"];
								$ASS[$i]	= $result["ass_marks"];
								$FIN[$i]	= $result["final_marks"];
								$TOT[$i]	= $PM[$i] + $ASS[$i] + $FIN[$i];
								
								$query = "SELECT s_name 
									  FROM student_info as S
									  WHERE  S.roll_no= '$ROLL[$i]'";
								$RSLT = $con->query($query);
								$NAM = $RSLT->fetch_assoc();
								$NAME[$i] = $NAM["s_name"];
								$i++;
							}
							asort($ROLL);
							
							
							echo "
                 			   <div id=\"tablTeach\" style='margin-top: 5%'>
                    			<table class=\"table2\">
                        			<thead>
                            		<tr>
                                <th></th>
								<th scope=\"col\" abbr=\"Starter\">Sr no.</th>
								<th scope=\"col\" abbr=\"Starter\">Name</th>
                                <th scope=\"col\" abbr=\"Starter\">Roll no.</th>
                                <th scope=\"col\" abbr=\"Medium\">Attendance</th>
                                <th scope=\"col\" abbr=\"Medium\">Periodical Marks</th>
								<th scope=\"col\" abbr=\"Medium\">Internal Marks</th>
								<th scope=\"col\" abbr=\"Medium\">Final Marks</th>
								<th scope=\"col\" abbr=\"Medium\">Total Marks</th>
								<th scope=\"col\" abbr=\"Medium\">Update</th>
                            </tr> ";
							
							$i = 1;
							
							while($i < 101)
							{
							echo "<tr>
								 <th scope=\"row\"></th>";
							
							echo 
								 "<td style=\" 
	border:groove;\"><center>" .$i. ")</td>";

								if($NAME[$i])
								echo "<td style=\" border-bottom:groove;border-right:groove;width:auto;\" >
									<center><form action='search.php' method=\"post\">
	<input class=\"btn btn-info\" style='width: 100%' type=\"submit\"  value=\" $NAME[$i]\">
	<input type='text' name=\"rno\" value='$ROLL[$i]' hidden>
	<input type='text' name=\"type\" value='teacher' hidden>
	</center></form></td>";
								else
									echo "<td style=\"
	border-bottom:groove;border-right:groove;width:auto;\" ><center>
	</center></input></td>";
								 echo
								 "<form class=\"pure-form\" action=\"update/uSdata.php\"
	 method=\"post\">".
								 "<td
	 ><center><input type=\"text\" style=\"border-radius:6px;
	border:groove;\" required name=\"rno\" maxlength=\"5\" value=\"$ROLL[$i]\"		 class=\"pure-input-rounded\"></td>".
								 
								 "<td><center><input type=\"text\" style=\"border-radius:6px; 
	border:groove;\"  name=\"atn\" maxlength=\"2\" value=\"$ATT[$i]\" class=\"pure-input-rounded\"></td>".
								 
								 "<td><center><input type=\"text\" style=\"border-radius:6px; 
	border:groove;\" name=\"pm\" maxlength=\"5\" value=\"$PM[$i]\" class=\"pure-input-rounded\"></td>".
								 
								 "<td><center><input type=\"text\" style=\"border-radius:6px; 
	border:groove;\" name=\"ass\" maxlength=\"5\" value=\"$ASS[$i]\" class=\"pure-input-rounded\"></td>".
								
								 
								 "<td><input type=\"text\" style=\"border-radius:6px; 
	border:groove;\" name=\"fin\" maxlength=\"5\" value=\"$FIN[$i]\" class=\"pure-input-rounded\"></td>".
								 
								 "<td><input type=\"text\" style=\"border-radius:6px; 
	border:groove;\" name=\"tot\"  value=\"$TOT[$i]\" class=\"pure-input-rounded\"></td>".
								 "<td><center>
    								 <button type=\"submit\" onclick=\"confirm('Confirm Update ?')\" class=\"btn btn-info\">Update</button>
									 </form>
								   </td>";
								 
								 
								
							echo "</form></tr>";
						
						$i++;
						}// closed while
						echo "</div>";// ENd table

						
						}// End if For record printing

							
					}	// End validate if

				
	
				?> <!--ENd php-->
                    </div><!--End info-->
			     </div> <!-- end content -->
			</div>
        </div>
<?php
	if(!    $_SESSION["record"])
	echo "<div id=\"footer\">
			Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
				<br>Found a bug ? <a href=\"contact/contact.html\">Contact us.</a>
			</div>	";
?>



		


		
</body>
</html>