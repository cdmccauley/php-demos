<?php # check_login.php

function check_login($dbc, $email, $pass) {
	// declarations
	$e = mysqli_real_escape_string($dbc, $email);
	$p = mysqli_real_escape_string($dbc, $pass);
	$q = "SELECT customers.email FROM customers WHERE customers.email='$email' AND customers.pass=SHA1('$pass');";

	// execute query
	$r = @mysqli_query ($dbc, $q);
	
	// check query result
	if (mysqli_num_rows($r) == 1) {

		// success, store session information
		$_SESSION['email'] = current($r->fetch_assoc());
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		// indicate successful login
		return true;
	} else {
		// failed login
		return false;
	}
}