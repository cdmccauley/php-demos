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

		// store customers games
		$q = "SELECT games.game_dir FROM games WHERE games.game_id IN (SELECT customer_games.game_id FROM customer_games WHERE customer_games.customer_id IN (SELECT customers.customer_id FROM customers WHERE customers.email='" . $_SESSION['email'] . "'));";
		$r = mysqli_query($dbc, $q);
		$_SESSION['games'] = array();
		if (mysqli_num_rows($r) > 0) {
			while ($row = $r->fetch_array()) {
				$_SESSION['games'][] = $row[0];
			}
		}

		// indicate successful login
		return true;
	} else {
		// failed login
		return false;
	}
}