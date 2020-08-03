<?php

	unset($_SESSION["email"]);
	unset($_SESSION["first_name"]);
	unset($_SESSION["last_name"]);
	unset($_SESSION["usertype"]);
	unset($_SESSION["loggedin"]);
	header("Location: index.php");
	
?>