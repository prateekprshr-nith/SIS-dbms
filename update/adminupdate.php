<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>adminupdate</title>
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

	$_SESSION["logged"] = true;

	// Get the data
	$adminname		= $_SESSION["adminname"];
	$adminpass		= $_SESSION["adminpass"];	

	// Create conncetion to database
	$server		= "localhost:6994";
	$username	= "ADMIN";
	$passwd		= "admin";
	$dbname		= "studentinfodb";
	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">		Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
			  </div>";
		session_unset();
		session_destroy(); 
		die();
	}
	
	// Now check what is to be updated
	$TYPE = $_POST["TYPE"];

//--------------------------------------------------------------------------------------------------
	// If Time Table is to be created
	if($TYPE == "CRTT")
	{
	
				//get data timeTable
				$day	= $_POST["day"];
				$sem	= $_POST["semester"];
				$section= $_POST["section"];
				$class1	= $_POST["class1"];	
				$class2	= $_POST["class2"];	
				$class3	= $_POST["class3"];	
				$class4	= $_POST["class4"];	
				$class5	= $_POST["class5"];	
				$class6	= $_POST["class6"];	
				$class7	= $_POST["class7"];	
				$class8	= $_POST["class8"];	
				$i 		= 0;
				echo"$class1";
				$query = "INSERT INTO timetable (section , semester , day ) VALUES ('$section', '$sem', '$day')";
				if($con->query($query) == true)
					$info1 = true ; 
				
				if(!info1)
				{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 						href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
				} 		
				


				//update database
				//----------------CLASS1-----------------//
				if($class1)
				{
					$querycheck1 = "select course_code from teaching_info where course_code = '$class1'";
					$tmp1	= $con->query($querycheck1);
					if($con->query($querycheck1) == true)
					{
						$row1	= mysqli_num_rows($tmp1);					
					if($row1 > 0)
					{
						$query1 = "UPDATE timetable SET class1 = '$class1' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query1) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row1 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 1 END------------//
				
				//----------------CLASS2-----------------//
				if($class2)
				{
					$querycheck2 = "select course_code from teaching_info where course_code = '$class2'";
					$tmp2	= $con->query($querycheck2);
					if($con->query($querycheck2) == true)
					{
						$row2	= mysqli_num_rows($tmp2);
					
					if($row2 > 0)
					{
						$query2 = "UPDATE timetable SET class2 = '$class2' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query2) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row2 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 2 END------------//	
					
				//----------------CLASS3-----------------//
				if($class3)
				{
					$querycheck3 = "select course_code from teaching_info where course_code = '$class3'";
					$tmp3	= $con->query($querycheck3);
					if($con->query($querycheck3) == true)
					{
						$row3	= mysqli_num_rows($tmp3);
					
					if($row3 > 0)
					{
						$query3 = "UPDATE timetable SET class3 = '$class3' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query3) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row3 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 3 END------------//
				
				//----------------CLASS4-----------------//
				if($class4)
				{
					$querycheck4 = "select course_code from teaching_info where course_code = '$class4'";
					$tmp4	= $con->query($querycheck4);
					if($con->query($querycheck4) == true)
					{
						$row4	= mysqli_num_rows($tmp4);
					
					if($row4 > 0)
					{
						$query4 = "UPDATE timetable SET class4 = '$class4' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query4) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row4 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 4 END------------//
				//----------------CLASS5-----------------//
				if($class5)
				{
					$querycheck5 = "select course_code from teaching_info where course_code = '$class5'";
					$tmp5	= $con->query($querycheck5);
					if($con->query($querycheck5) == true)
					{
						$row5	= mysqli_num_rows($tmp5);
										
					if($row5 > 0)
					{
						$query5 = "UPDATE timetable SET class5 = '$class5' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query5) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row5 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 5 END------------//
				//----------------CLASS6-----------------//
				if($class6)
				{
					$querycheck6 = "select course_code from teaching_info where course_code = '$class6'";
					$tmp6	= $con->query($querycheck6);
					if($con->query($querycheck6) == true)
					{
						$row6	= mysqli_num_rows($tmp6);
	
					if($row6 > 0)
					{
						$query6 = "UPDATE timetable SET class6 = '$class6' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query6) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row6 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 6 END------------//
				//----------------CLASS7-----------------//
				if($class7)
				{
					$querycheck7 = "select course_code from teaching_info where course_code = '$class7'";
					$tmp7	= $con->query($querycheck7);
					if($con->query($querycheck7) == true)
					{
						$row7	= mysqli_num_rows($tmp7);
						
					if($row7 > 0)
					{
						$query7 = "UPDATE timetable SET class7 = '$class7' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query7) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row7 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 7 END------------//
				//----------------CLASS8-----------------//
				if($class8)
				{
					$querycheck8 = "select course_code from teaching_info where course_code = '$class8'";
					$tmp8	= $con->query($querycheck8);
					if($con->query($querycheck8) == true)
					{
						$row8	= mysqli_num_rows($tmp8);
				
					if($row8 > 0)
					{
						$query8 = "UPDATE timetable SET class8 = '$class8' WHERE section = '$section' and semester = '$sem' and day = '$day' " ;
						if($con->query($query8) == true)
						{
							$bool[$i] = true ; 
							$i++;
						}
					
					}
					
							if($row8 == 0)
						{
							$bool[$i] = false ;  
							$i++;
						}		
					
					}
				
				}
				//----------------CLASS 8 END------------//
					$abool = true ;
					for( $j = 0 ; $j < $i ; $j++ )
					{
						$abool = $bool[$j] && $abool;
					}
							if($abool)
							{			
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					
					}
						else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			}
}				
//------TIME TABLE ADDED
	






	
	//--------------------------------------------------------------------------------------------------
	// If Time Table is to be changed
	if($TYPE == "UPTT")
	{
	
				//get data timeTable
				$day	= $_POST["day"];
				$sem	= $_POST["semester"];
				$section= $_POST["section"];
				$class1	= $_POST["class1"];	
				$class2	= $_POST["class2"];	
				$class3	= $_POST["class3"];	
				$class4	= $_POST["class4"];	
				$class5	= $_POST["class5"];	
				$class6	= $_POST["class6"];	
				$class7	= $_POST["class7"];	
				$class8	= $_POST["class8"];	
				$i 		= 0;
				
				//update database
				if($class1){
					$query0 = "UPDATE timetable SET class1='$class1' WHERE day='$day' AND semester='$sem' AND section='$section'" ;
					if($con->query($query0) == true){
						$bool[$i] = true ; 
						$i++;
						}
					}
					
				if($class2){
					$query1 = "UPDATE timetable SET class2='$class2' WHERE day='$day' AND semester='$sem' AND section='$section'" ;
					if($con->query($query1) == true){
						$bool[$i] = true;
							$i++;
					}
			} 
				
				if($class3){
					$query2 = "UPDATE timetable SET class3='$class3' WHERE day='$day' AND semester='$sem' AND section='$section' ";
					if($con->query($query2) == true)
						$bool[$i] = true;
					$i++;	 
						
					}
				if($class4){
					$query3 = "UPDATE timetable SET class4='$class4' WHERE day='$day' AND semester='$sem' AND section='$section' " ;
					if($con->query($query3) == true)
							$bool[$i] = true;
					$i++;
						
					}
				if($class5){
					$query4 = "UPDATE timetable SET class5='$class5' WHERE day='$day' AND semester='$sem' AND section='$section' " ;
					if($con->query($query4) == true)
						$bool[$i] = true;
					
					$i++;
					
					}
				if($class6){
					$query5 = "UPDATE timetable SET class6='$class6' WHERE day='$day' AND semester='$sem' AND section='$section' " ;
					if($con->query($query5) == true)
						$bool[$i] = true;
					$i++;
					
					}
				if($class7){
					$query6 = "UPDATE timetable SET class7='$class7' WHERE day='$day' AND semester='$sem' AND section='$section' ";
					if($con->query($query6) == true)
						$bool[$i] = true;
					$i++;
						

					}
				if($class8){
					$query7 = "UPDATE timetable SET class8='$class8' WHERE day='$day' AND semester='$sem' AND section='$section' ";
					if($con->query($query7) == true)
						$bool[$i] = true;
					$i++;
					
						}
					$abool = true ;
					for( $j = 0 ; $j < $i ; $j++ )
					{
						$abool = $bool[$j] && $abool;
					}
							if($abool)
							{			
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					
					}
						else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			}
}				
//------TIME TABLE CHANGED
	
	//--------------------------------------------------------------------------------------------------
	// If DEPARTMENT is to be ADDED
	if($TYPE == "UPDEP")
	{
				//get data 
				$dept		= $_POST["adddept"];
				$deptcode	= $_POST["adddeptcode"];
				
				//query
				$query = "insert into department values ('$deptcode','$dept')";
				
				//
				if($con->query($query) == true)
				$info1 = true;
			
			if($info1)
			{
				
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			} 		
	}//------DEPARTMENT ADDED
	
	//--------------------------------------------------------------------------------------------------
	// If SECTION is to be ADDED
	if($TYPE == "ADDSEC")
	{
				//get data 
				$sections	= $_POST["sections"];
				
				//query
				$query = "insert into section values ('$sections')";

				//
				if($con->query($query) == true)
				$info1 = true;
			
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			} 		
	}//------SECTION ADDED
	
	//--------------------------------------------------------------------------------------------------
	// If SECTION is to be DELETED
	if($TYPE == "DELDEP")
	{
				//get data 
				$sec2	= $_POST["section2"];
				
				//query
				$query = "DELETE FROM section WHERE section='$sec2';";

				//
				if($con->query($query) == true)
				$info1 = true;
			
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			} 		
	}//------SECTION DELETED
	
	
	//--------------------------------------------------------------------------------------------------
	// If SECTION is to be ADDED
	if($TYPE == "ADDSEC")
	{
				//get data 
				$sections	= $_POST["sections"];
				
				//query
				$query = "insert into section values ('$sections')";

				//
				if($con->query($query) == true)
				$info1 = true;
			
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					header('Location: /dbms/Admin.php');
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			} 		
	}//------SECTION ADDED
	
	//--------------------------------------------------------------------------------------------------
	// If PASSWORD is to be UPDATED
	if($TYPE == "PASUP")
	{
				//get data 
				$passadmin	= $_POST["passadmin"];
				
				//query
				 $query = "UPDATE admin_login SET passwd='$passadmin' ;";

				//
				if($con->query($query) == true)
				$info1 = true;
			
			if($info1)
			{
					echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Congratulations. Your changes been successfully updated.</h1>
					Please<a href=\"/dbms/admin-login.html\"> Click here </a>to login
					</div>";
					die();
			}
			else
			{
				echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a 				href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
				  </div>";
							
				session_unset();
				session_destroy(); 
			die();
			} 		
	}//------PASSWORD UPDATED
	
	//--------------------------------------------------------------------------------------------------
	// If PASSWORD is to be RESETED of a student
	if($TYPE == "STUPASS")
	{
				//get data 
				$stu_pass	= $_POST["stu_pass"];
				$stu_roll	= $_POST["stu_roll_pass"];
				
				//query
				 $query_pass_stu = "UPDATE stu_login  SET passwd = '$stu_pass' WHERE roll_no = '$stu_roll' ;";

				//
				if($con->query($query_pass_stu) == true)
				$info_pass_stu = true;
			
			if($info_pass_stu)
			{
				$query_update_stu = "DELETE FROM pwd_stu WHERE roll_no='$stu_roll'";
				if($con->query($query_update_stu) == true)
					$info_pass_stu_up = true;
					if($info_pass_stu_up)
							header('Location: /dbms/Admin.php');
			
					else
					{
						echo "<div id=\"try\">
						<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
							  </div>";
							
						session_unset();
						session_destroy(); 
						die();
					} 
			}
				else
					{
						echo "<div id=\"try\">
						<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
							  </div>";
							
						session_unset();
						session_destroy(); 
						die();
						
					}
	}//------PASSWORD RESET
	
	
	
	//--------------------------------------------------------------------------------------------------
	// If PASSWORD is to be RESETED of a TEACHER
	if($TYPE == "TEACHPASS")
	{
				//get data 
				$fac_pass	= $_POST["teach_pass"];
				$fac_id		= $_POST["fac_pass"];
				
				//query
				 $query_pass_fac = "UPDATE faculty_login  SET passwd = '$fac_pass' WHERE f_id = '$fac_id' ;";

				//
				if($con->query($query_pass_fac) == true)
				$info_pass_fac = true;
			
			if($info_pass_fac)
			{
				$query_update_fac = "DELETE FROM pwd_fac WHERE f_id='$fac_id'";
				if($con->query($query_update_fac) == true)
					$info_pass_fac_up = true;
					if($info_pass_fac_up)
							header('Location: /dbms/Admin.php');
			
					else
					{
						echo "<div id=\"try\">
						<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
							  </div>";
							
						session_unset();
						session_destroy(); 
						die();
					} 
			}
				else
					{
						echo "<div id=\"try\">
						<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">Bug Report,</a> Or<a href=\"/dbms/admin-login.html\"> Try Again </a>
							  </div>";
							
						session_unset();
						session_destroy(); 
						die();
						
					}
	}//------PASSWORD RESET
?>

</body>
</html>	