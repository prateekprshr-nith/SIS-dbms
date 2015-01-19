<?php
	session_start();
?>

<!doctype html>
<html>
<head>
	<title>welcome administrator</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="contact/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="contact/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="contact/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="contact/css/templatemo_style.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="/dbms/logo/logo.png">
</head>
<body class="templatemo-bg-gray">
<?php
	
	// Get the data
if($_SESSION["logged"])
	{
	$adminname		= $_SESSION["adminname"];
	$adminpass		= $_SESSION["adminpass"];	
	}
	else
	{
		// Get the data from the form
	$adminname		= $_POST["adminname"];
	$adminpass		= $_POST["adminpass"];	
	}	
	// Create conncetion to database
	$server		= "localhost:6994";
	$username	= "ADMIN";
	$passwd		= "admin";
	$dbname		= "studentinfodb";
	$con		= new mysqli($server, $username, $passwd, $dbname);
	if($con->connect_error)
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a href=\"contact/contact.html\">		Bug Report,</a> Or<a href=\"admin-login.html\"> Try Again </a>
			   ";
		session_unset();
		session_destroy(); 
		die();
	}


// Check for valid name and password	
	$query	= "SELECT name, passwd FROM admin_login WHERE name = '$adminname' AND passwd = '$adminpass'";
	$tmp	= $con->query($query);
	$row	= mysqli_num_rows($tmp);
	$case   = $tmp->fetch_assoc();
	if($row < 1 )
	{
		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT USERNAME OR PASSWORD</h1>
			Please<a href=\"admin-login.html\"> Try Again</a></div>
			 ";
		session_unset();
		session_destroy(); 
		die();
	}

	else if(strcmp($adminpass, $case["passwd"]) != 0 || strcmp($adminname, $case["name"]) != 0)
	{

		echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">PLEASE ENTER A CORRECT ID. OR PASSWORD(check your caps lock)</h1>
			Please<a href=\"admin-login.html\"> Try Again</a>
			</div>";
		$_SESSION["login"] = false;
		die();
	}
	else
		$validate = true;
		
		
		
// Now set the sessions
	$_SESSION["adminname"] = $adminname;
	$_SESSION["adminpass"] = $adminpass;

		// Fetch the availabele list of sections
	$query1		= "SELECT section 
					FROM section";
					 
	$section	= $con->query($query1);
	
//-----------------------------------------------------------------------------------------------------------------------
	// Now the main part starts
	if($validate)
	{
		echo"
	
<!-- TITLE BEGIN -->
<hr style='border:ridge'></hr>
<h1 style='font-size:500%'>WELCOME ADMINISTRATOR</h1><br><br>
<hr style='border:ridge'></hr>
<form name=\"form1\" method=\"post\" action=\"update\adminupdate.php\">
  <h1><br><centre>Create Time Table</h1>
   <label for=\"state\" class=\"control-label\">Department:<br></label>
 						<select name=\"day\" size=\"1\" class=\"form-control\" id=\"day\" required>
 						<option value=\"\">Select a Day...</option>
                        <option value=\"MONDAY\">MONDAY.</option>
 						<option value=\"TUESDAY\">TUESDAY.</option>
                        <option value=\"WEDNESDAY\">WEDNESDAY.</option>
                        <option value=\"THURSDAY\">THURSDAY.</option>
                        <option value=\"FRIDAY\">FRIDAY.</option> 
 						</select>
     <label for=\"state\" class=\"control-label\"><br>
			        Semester:
			          <select id=\"Semester\" class=\"panel-primary\" required name=\"semester\">
			            <option value=\"\">Select a Semester...</option>
			            <option value=\"1\">1.</option>
			            <option value=\"2\">2.</option>
			            <option value=\"3\">3.</option>
			            <option value=\"4\">4.</option>
			            <option value=\"5\">5.</option>
			            <option value=\"6\">6.</option>
			            <option value=\"7\">7.</option>
			            <option value=\"8\">8.</option>
			            <option value=\"9\">9.</option>
			            <option value=\"10\">10.</option>
			            </select>
			         	Section:
			            
				                              <select id=\"Section\" class=\"panel-primary\" required name=\"section\">
	                                            <option value=\"\">Select section :</option>";

													
													while($list1 = $section->fetch_assoc())
							                         echo "<option value=\"".$list1["section"]. "\">". $list1["section"]. "</option>";
							             echo "                                                               
	                                         </select>
					                     
    <br></label>
  </p>
    
                        <label for=\"state\" class=\"control-label\"><br>
	                     </label>
	                           
                       <label for=\"Class1\" class=\"control-label\">Class 1</label><input type=\"text\" class=\"form-control\" id=\"class1\" maxlength=\"200\" name=\"class1\" placeholder=\"Class1\">		            		            		            
			                    
                       <label for=\"class2\" class=\"control-label\">Class 2</label><input type=\"text\" class=\"form-control\" id=\"class2\" maxlength=\"200\" name=\"class2\" placeholder=\"Class2\">		            		            		            
			                     <label for=\"class3\" class=\"control-label\">Class 3</label><input type=\"text\" class=\"form-control\" id=\"class3\" maxlength=\"200\" name=\"class3\" placeholder=\"Class3\">		            		            		            
			                    
                       <label for=\"class4\" class=\"control-label\">Class 4</label><input type=\"text\" class=\"form-control\" id=\"class4\" maxlength=\"200\" name=\"class4\" placeholder=\"Class4\">		            		            		            
			                    
                       <label for=\"class5\" class=\"control-label\">Class 5</label><input type=\"text\" class=\"form-control\" id=\"class5\" maxlength=\"200\" name=\"class5\" placeholder=\"Class5\">		            		            
			                    
                       <label for=\"class6\" class=\"control-label\">Class 6</label><input type=\"text\" class=\"form-control\" id=\"class6\" maxlength=\"200\" name=\"class6\" placeholder=\"Class6\">		            		            		            
			             
                       <label for=\"class7\" class=\"control-label\">Class 7</label><input type=\"text\" class=\"form-control\" id=\"class7\" placeholder=\"Class7\" maxlength=\"200\" name=\"class7\">		            		            		            
			             
   <label for=\"class8\" class=\"control-label\">Class 8</label><input type=\"text\" class=\"form-control\" id=\"class8\" maxlength=\"200\" name=\"class8\" placeholder=\"Class8\">
   
   <br>
    <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
                         
 <input type=\"text\" hidden name=\"TYPE\" required value=\"CRTT\">	

</form>
<p>&nbsp;</p>



<hr style='border:ridge'></hr>



<form name=\"form1\" method=\"post\" action=\"update\adminupdate.php\">
  <h1><br><centre>Update Time Table</h1>
   <label for=\"state\" class=\"control-label\">Department:<br></label>
 						<select name=\"day\" size=\"1\" class=\"form-control\" id=\"day\" required>
 						<option value=\"\">Select a Day...</option>
                        <option value=\"MONDAY\">MONDAY.</option>
 						<option value=\"TUESDAY\">TUESDAY.</option>
                        <option value=\"WEDNESDAY\">WEDNESDAY.</option>
                        <option value=\"THURSDAY\">THURSDAY.</option>
                        <option value=\"FRIDAY\">FRIDAY.</option> 
 						</select>
     <label for=\"state\" class=\"control-label\"><br>
			        Semester:
			          <select id=\"Semester\" class=\"panel-primary\" required name=\"semester\">
			            <option value=\"\">Select a Semester...</option>
			            <option value=\"1\">1.</option>
			            <option value=\"2\">2.</option>
			            <option value=\"3\">3.</option>
			            <option value=\"4\">4.</option>
			            <option value=\"5\">5.</option>
			            <option value=\"6\">6.</option>
			            <option value=\"7\">7.</option>
			            <option value=\"8\">8.</option>
			            <option value=\"9\">9.</option>
			            <option value=\"10\">10.</option>
			            </select>
			         	Section:
			            
				                              <select id=\"Section\" class=\"panel-primary\" required name=\"section\">
	                                            <option value=\"\">Select section :</option>";

										// Fetch the availabele list of sections
									$query2		= "SELECT section 
												FROM section";
					 
									$section	= $con->query($query2);
													while($list2 = $section->fetch_assoc())
							                           echo "<option value=\"".$list2["section"]. "\">". $list2["section"]. "</option>";
							             echo "                                                               
	                                         </select>
					                     
    <br></label>
  </p>
    
                        <label for=\"state\" class=\"control-label\"><br>
	                     </label>
	                           
                       <label for=\"Class1\" class=\"control-label\">Class 1</label><input type=\"text\" class=\"form-control\" id=\"class1\" maxlength=\"200\" name=\"class1\" placeholder=\"Class1\">		            		            		            
			                    
                       <label for=\"class2\" class=\"control-label\">Class 2</label><input type=\"text\" class=\"form-control\" id=\"class2\" maxlength=\"200\" name=\"class2\" placeholder=\"Class2\">		            		            		            
			                     <label for=\"class3\" class=\"control-label\">Class 3</label><input type=\"text\" class=\"form-control\" id=\"class3\" maxlength=\"200\" name=\"class3\" placeholder=\"Class3\">		            		            		            
			                    
                       <label for=\"class4\" class=\"control-label\">Class 4</label><input type=\"text\" class=\"form-control\" id=\"class4\" maxlength=\"200\" name=\"class4\" placeholder=\"Class4\">		            		            		            
			                    
                       <label for=\"class5\" class=\"control-label\">Class 5</label><input type=\"text\" class=\"form-control\" id=\"class5\" maxlength=\"200\" name=\"class5\" placeholder=\"Class5\">		            		            
			                    
                       <label for=\"class6\" class=\"control-label\">Class 6</label><input type=\"text\" class=\"form-control\" id=\"class6\" maxlength=\"200\" name=\"class6\" placeholder=\"Class6\">		            		            		            
			             
                       <label for=\"class7\" class=\"control-label\">Class 7</label><input type=\"text\" class=\"form-control\" id=\"class7\" placeholder=\"Class7\" maxlength=\"200\" name=\"class7\">		            		            		            
			             
   <label for=\"class8\" class=\"control-label\">Class 8</label><input type=\"text\" class=\"form-control\" id=\"class8\" maxlength=\"200\" name=\"class8\" placeholder=\"Class8\">
   
   <br>
    <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
                         
 <input type=\"text\" hidden name=\"TYPE\" required value=\"UPTT\">	

</form>




<form name =\"form2\" form action=\"update\adminupdate.php\" method=\"post\">
<br>
&nbsp;
&nbsp;

<br>
<hr style='border:ridge'></hr>
 <h1><br><centre>Update Department</h1>
<strong>Add Department:</strong>
  <input name=\"adddept\" type=\"text\" size=\"30\" maxlength=\"100\" placeholder=\"Department\">
  <br><br>
  <strong>Department Code:</strong>
  <input name=\"adddeptcode\" type=\"text\" size=\"10\" maxlength=\"10\" placeholder=\"Code\">
  <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
<input type=\"text\" hidden name=\"TYPE\" required value=\"UPDEP\">	
 
</form>
<hr style='border:ridge'></hr>
 <h1><br><centre>Update Section</h1>
<form name =\"form3\" form action=\"update\adminupdate.php\" method=\"post\">
 <br> <strong>Add Sections(example:E1):- 
  <input name=\"sections\" type=\"text\" size=\"3\" maxlength=\"3\" placeholder=\"section\">
  </strong>
 <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
  
  <input type=\"text\" hidden name=\"TYPE\" required value=\"ADDSEC\">	
</form>


<form name =\"form4\" form action=\"update\adminupdate.php\" method=\"post\">
<br> <strong>Delete Section: </strong>

				                              <select id=\"section\" class=\"panel-primary\" name=\"section2\">
	                                            <option value=\"\">Select Section:</option>";
												
														// Fetch the availabele list of sections
														$query3		= "SELECT section 
																		FROM section";
					 
														$section	= $con->query($query3);
													while($list3 = $section->fetch_assoc())
							                           echo "<option value=\"".$list3["section"]. "\">". $list3["section"]. "</option>";
							             echo " 
   <input type=\"text\" hidden name=\"TYPE\" required value=\"DELDEP\">	
   <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
 
 </label>
 
   
</form>
<hr style='border:ridge'></hr>
 <h1><br><centre>Password Resets</h1>
<form name =\"form5\" form action=\"update\adminupdate.php\" method=\"post\">

 <form name =\"form7\" form action=\"update\adminupdate.php\" method=\"post\">
<br>
<strong>Reset Student Password:</strong>

		     <select id=\"stupass\" class=\"panel-primary\" required name=\"stu_roll_pass\">
	         <option value=\"\">Select Roll Number:</option><br>";
												
																		 
					 
													 // Fetch the email and roll no
													
													  $query5	="SELECT roll_no , email
													  				FROM pwd_stu " ;
													  $rne	= $con->query($query5);
													
													while($list4 = $rne->fetch_assoc())
							                           echo "<option value=\"".$list4["roll_no"]. "\">". $list4["roll_no"]."->". $list4["email"]."</option>";
													  
													   
							             echo " 
 	<input name=\"stu_pass\" type=\"text\" size=\"40\" requried maxlength=\"100\" placeholder=\"PASSWORD\">
  
   <input type=\"text\" hidden name=\"TYPE\" required value=\"STUPASS\">	
   <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
   </form>

<form name =\"form8\" form action=\"update\adminupdate.php\" method=\"post\">
<br>
<strong>Reset Teacher Password:</strong>

		     <select id=\"facpass\" class=\"panel-primary\" required name=\"fac_pass\">
	         <option value=\"\">Select Faculty-id:</option>";
												
																		 
					 
													 // Fetch the email and p_id
													
													  $query5	="SELECT f_id , email
													  				FROM pwd_fac ";
													  $rnef	= $con->query($query5);
													
													while($list5 = $rnef->fetch_assoc())
							                           echo "<option value=\"".$list5["f_id"]. "\">". $list5["f_id"]."->". $list5["email"]."</option>";
													  
													   
							             echo " 
 <input name=\"teach_pass\" type=\"text\" size=\"40\" requried maxlength=\"100\" placeholder=\"PASSWORD\">
  
   <input type=\"text\" hidden name=\"TYPE\" required value=\"TEACHPASS\">	
   <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
   </form>

   <hr style='border:ridge'></hr>
   <br>
<strong>Update Admin Password:</strong>
  <input name=\"passadmin\" type=\"password\" size=\"40\" requried maxlength=\"100\" placeholder=\"PASSWORD\">

   <input type=\"text\" hidden name=\"TYPE\" required value=\"PASUP\">
   <input type=\"submit\" value=\"SUBMIT\" class=\"btn btn-info\">
   </form>

<form name =\"form6\" form action=\"admin-logout.php\" method=\"post\">

   
   <br>
    <span class=\"form-group\"><span class=\"control-wrapper\">
			<br>    <input type=\"submit\" value=\"LOGOUT\" class=\"btn btn-info\">
			    </span></span>
   
&nbsp;&nbsp;&nbsp;
</form>
"


	;
	}
?>
<div id="footer">
	Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
	<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
</body>
</html>

