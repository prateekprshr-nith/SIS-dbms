<!DOCTYPE html>
<head>
	<title>Thank you for your suggestion.</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
	<body>
		<body class="templatemo-bg-gray">

		 <?php 
    		
    	   	$today 				= date("jS \of F Y l his A ");
		
			$file 				= fopen("$today.txt" , "w");
			$email	  			= $_POST ["email"];
			$descriptipon 		= $_POST ["description"];
			$name 				= $_POST ["name"];
			$phone_number 		= $_POST ["phone"];
			
			fwrite($file , $name);
			fwrite($file ,"     ");
			fwrite($file , $email);	
			fwrite($file ,"     ");
			fwrite($file , $phone_number);
			fwrite($file ,"     ");
			fwrite($file , $descriptipon);
			fwrite($file ,"     ");
			
			fclose($file);
		
			echo "<div id=\"try\">
					<h1 class=\"margin-bottom-15\">Thank you for your suggestion.....</h1> <br> 
    	    	    <a href=\"/dbms/login.html\"> <center> Click here</a> to login again.
    	    	 </div>"
		
		
		?>
           
	</body>
    
</html>
