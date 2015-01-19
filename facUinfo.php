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
					<p id=\"infohead\"><br><u><strong>Update Info</strong></u>:</p>"; ?>
                <!--UPDATE info-->
                <div id="uinfo">
                 <form  role="form" action="update\finfo.php" method="post">
		        
                <div class="form-group">
                 <div class="col-md-3">
		            <input type="password" class="form-control" id="id" name="pwd" required placeholder="Your new password.">
                    <input type="text" hidden name="TYPE" required value="PWD">	                 
                  </div>
	                <div class="col-md-3">
		                <input type="password" class="form-control" id="id" name="cpwd" required placeholder="Confirm
		                 password.">
		                <input type="text" hidden name="TYPE" required value="PWD">
	                </div>
	                <div class="col-md-6">
                     <input type="submit" value="Update" onclick="alert('Confirm password Update ?')" class="btn btn-danger">
                    <br><br>
                    </div>          
		        </div>
		      </form>
               
               
               <form  role="form" action="update\finfo.php" method="post">
		        <div class="form-group">
                 <div class="col-md-6">
		            <input type="text" class="form-control" id="roll_no" name="pno" maxlength="10" required placeholder="Your new phone no.">	                 
                    <input type="text" hidden name="TYPE" required value="PNO">
                    </div> 
		             <div class="col-md-6">
                     <input type="submit" value="Update" onclick="alert('Confirm phone number Update ?')" class="btn btn-danger">
                    <br><br>
                    </div>          
		        </div>
		      </form>
               
               <form  role="form" action="update\finfo.php" method="post">
		        <div class="form-group">
                 <div class="col-md-6">
		            <input type="text" class="form-control" id="roll_no" name="add" required placeholder="Your new address.">
                 	<input type="text" hidden name="TYPE" required value="ADD"> 
                 </div> 
		             <div class="col-md-6">
                     <input type="submit" value="Update" onclick="alert('Confirm Address Update ?')" class="btn btn-danger">
                    <br><br>
                    </div>          
		        </div>
		      </form>
               
               <form  role="form" action="update\finfo.php" method="post">
		        <div class="form-group">
                 <div class="col-md-6">
		            <input type="email" class="form-control" id="roll_no" name="email" required placeholder="Your new email id.">
	                 <input type="text" hidden name="TYPE" required value="MAIL">
                    </div> 
		             <div class="col-md-6">
                     <input type="submit" value="Update" onclick="alert('Confirm Email Update ?')" class="btn btn-danger">
                    <br><br>
                    </div>          
		        </div>
		      </form>
               
              
               
                    </div>	
				</div> <!--end content-->		
				
				<!--Sidebar-->
				<?php
				
				}
				?>
<div id="footer">
	Developed By: Prateek Prasher and Arnav Dhiman, CSED NIT-Hamirpur
	<br>Found a bug ? <a href="contact/contact.html">Contact us.</a>
</div>
</body>
</html>