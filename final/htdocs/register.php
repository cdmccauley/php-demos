<?php # register.php

// start session
session_name('GitGudGamesAuth');
session_start();

// check logged in
require('../check_logged_in.php');
check_logged_in();

$page_title = 'Git Gud Games - Register';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // register was submitted

	// helper file
	require('../mysqli_connect.php');
	
	// declarations
	$errors = array();
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your e-mail address.';
	} elseif (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
		$errors[] = "Invalid e-mail address";
	} else {
		$e = $mysqli->real_escape_string(trim($_POST['email']));
	}

	if (empty($errors)) { // check for existing email
		$q = "SELECT customers.email FROM customers WHERE email='$e'";
		$mysqli->query($q);
		if ($mysqli->affected_rows > 0) { // email exists in database
			$errors[] = 'The provided email is already registered.';
		}
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} elseif (!(preg_match('/[A-Za-z0-9!@#$%^&]{8,}/', $_POST['pass1']))) {
			$errors[] = 'Password must be at least 8 characters and can only contain A-Z, a-z, 0-9, and !@#$%^&';
		} else {
			$p = $mysqli->real_escape_string(trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO customers (email, pass) VALUES ('$e', SHA1('$p'))";
		
		// Execute the query:
		$mysqli->query($q);
			
		if ($mysqli->affected_rows == 1) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p>You are now registered.</p>';
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . $mysqli->error . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		$mysqli->close(); // Close the database connection.
		unset($mysqli);

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	$mysqli->close(); // Close the database connection.
	unset($mysqli);

} // End of the main Submit conditional.
?>
<h1>Register</h1>
<form action="register.php" method="post">
	<p>Email Address: <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" pattern="[A-Za-z0-9!@#$%^&]{8,}" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /> Must be at least 8 characters and can only contain A-Z, a-z, 0-9, and !@#$%^& .</p>
	<p>Confirm Password: <input type="password" name="pass2" pattern="[A-Za-z0-9!@#$%^&]{8,}" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>
<?php include ('includes/footer.html'); ?>