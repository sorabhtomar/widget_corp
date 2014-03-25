<?php

	define("DB_SERVER", "localhost");
	define("DB_USER", "php_cms");
	define("DB_PASS", "secretpassword");
	define("DB_NAME", "php_tutorial");

	// 1. Create a database connection
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	
	// Test if connection occured.
	if ( mysqli_connect_errno() ) {
		die("Database connection failed: " .
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
		);
	}
?>