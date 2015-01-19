<?php
	session_start();
	$type = $_POST["TYPE"];

	if($type == "view")                 // To view given assignments
	{
		$_SESSION["view"] = true;
		header("Location: fac_asn.php");
	}

	elseif($type == "give")             // To give assignment
	{
		$_SESSION["give"] = true;
		header("Location: fac_asn.php");
	}

	elseif($type == "new")              // To insert assignment into database
	{
		// GEt data
		$course     = $_POST["course1"];
		$no         = $_POST["no"];
		$descp      = $_POST["descp"];
		$date 		= getdate();
		$curdate 	= $date[year]."-".$date[mon]."-".$date[mday];
		$date       = $_POST["date"];

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
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_asn.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}

		$query = "INSERT INTO assignment VALUES ('$course', '$no', '$descp', '$curdate', '$date')";
		if($con->query($query) == true)
		{
			$_SESSION["give"] = false;
			header("Location: fac_asn.php");
		}
		else
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_asn.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}
	}

	elseif($type == "viewDoubt")        // To see asked doubts
	{
		$_SESSION["view"] = true;
		header("Location: stuDout.php");
	}

	elseif($type == "askDoubt")          // To ask a doubt
	{
		$_SESSION["ask"] = true;
		header("Location: stuDout.php");
	}

	elseif($type == "resDout")            // For teacher to resolve doubt
	{
		// Get the data
		$resp   = $_POST["response"];
		$cCode  = $_POST["cCode"];
		$roll   = $_POST["roll"];


		// Create conncetion to database
		$server		= "localhost:6994";
		$username	= "TEACHER";
		$passwd		= "teacher";
		$dbname		= "studentinfodb";

		$co		= new mysqli($server, $username, $passwd, $dbname);
		if($co->connect_error)
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_asn.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}
		// Insert
		$query = "update doubt
					set response='$resp'
						where roll_no='$roll' and course_code='$cCode'";

		if($co->query($query) == true)
			header("Location: fac_query.php");
		else
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_query.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}
	}
	elseif($type == "delDout")              // To delete a doubt
	{
		// Get the data
		$cCode  = $_POST["cCode"];
		$roll   = $_POST["roll"];


		// Create conncetion to database
		$server		= "localhost:6994";
		$username	= "TEACHER";
		$passwd		= "teacher";
		$dbname		= "studentinfodb";

		$co		= new mysqli($server, $username, $passwd, $dbname);
		if($co->connect_error)
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_asn.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}
		// Insert
		$query = "DELETE FROM doubt WHERE roll_no='$roll' and`course_code`='$cCode'";

		if($co->query($query) == true)
			header("Location: fac_query.php");
		else
		{
			echo "<div id=\"try\">
			<h1 class=\"margin-bottom-15\">OOPS !!! Something went wrong.</h1> Please submit a <a
			href=\"contact/contact.html\"> Bug Report,</a> Or<a href=\"fac_query.php\"> Try Again </a>
            </div>";
			$_SESSION["login"] = false;
			die();
		}
	}


?>