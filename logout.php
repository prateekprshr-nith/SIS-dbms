<?php
	session_start();
	$_SESSION["login"] = false;
	session_unset();
	session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout Successful</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="/dbms/logo/logo.png">
</head>
<body>
	<body class="templatemo-bg-gray">
		<?php
			echo "<div id=\"try\">
				<h1 class=\"margin-bottom-15\">Logout Successful...</h1> <br> 
    	        <a href=\"login.html\"> <center> Click here</a> to login.
    	     	</div>";
    	 ?>      
	</body>
</html>
