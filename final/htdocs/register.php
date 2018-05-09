<?php # register.php

// start session
session_name('GitGudGamesAuth');
session_start();

// check logged in
require('../check_logged_in.php');
check_logged_in();

$page_title = 'Git Gud Games - Register';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // registration was submitted

	// declarations
	$error;
	$valid_email;
	$valid_pass;

	// trim whitespace
	$_POST['email'] = trim($_POST['email']);
	$_POST['pass1'] = trim($_POST['pass1']);
	$_POST['pass2'] = trim($_POST['pass2']);
	
	// validate email
	if (!isset($_POST['email']) || empty($_POST['email'])) {
        $error = 'Please provide an e-mail address.';
    } elseif (strlen($_POST['email']) > 60) {
        $error = 'Please provide an e-mail address less than 60 characters long.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Provided e-mail address format not recognized.';
    } else {
		$valid_email = $_POST['email'];
		$_POST['email'] = '';
	}

	if (empty($error) && !empty($valid_email)) {
		// email validated, check against existing emails
		require('../mysqli_connect.php');
		require('../check_registered_email.php');

		if (!check_registered_email($mysqli, $valid_email)) {
			// provided email does not exist in database, validate pass
			if ((!isset($_POST['pass1']) || empty($_POST['pass1'])) || (!isset($_POST['pass2']) || empty($_POST['pass2']))) {
				$error = 'Please provide values for both password fields.';
			} elseif ((strlen($_POST['pass1']) < 8 || strlen($_POST['pass1']) > 20) || (strlen($_POST['pass2']) < 8 || strlen($_POST['pass2']) > 20)) {
				$error = 'Password must be at least 8 characters and no more than 20 characters.';
			} elseif ($_POST['pass1'] != $_POST['pass2']) {
				$error = 'Provided passwords do not match!';
			} elseif (!preg_match('/[A-Za-z0-9!@#$%^&]{8,20}/', $_POST['pass1'])) {
				$error = 'Password can only contain A-Z, a-z, 0-9, or !@#$%^& .';
			} else {
				$valid_pass = $_POST['pass1'];
				$_POST['pass1'] = '';
				$_POST['pass2'] = '';
			}
		} else {
			$error = 'Provided e-mail is already registered.';
		}

		if (!empty($error)) {
			// error present, dispose of db connection
			$mysqli->close();
			unset($mysqli);
		}
	}
	
	if (empty($error) && !empty($valid_email) && !empty($valid_pass)) {
	
		// attempt user registration
		require('../attempt_registration.php');

		if (attempt_registration($mysqli, $valid_email, $valid_pass)) {

			// indicate registration success
			echo '<h1>Thank you!</h1>';
			echo '<p>You are now registered.</p>';
			echo '<a href="login.php">Go to the login page.</a>';

			// registration success, dispose of db connection
			$mysqli->close();
			unset($mysqli);

			// stop script
			exit();
		} else {
			// indicate registration failure
			$error = 'Unexpected system error, we apologize for any inconvenience.';

			// registration failure, dispose of db connection
			$mysqli->close();
			unset($mysqli);
		}
	} else {
		// error present, display error
		echo '
			<div class="col-sm-offset-3 col-sm-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h1>Error!</h1>
					</div>
					<div class="panel-body">
						<p style="margin-bottom:0em;"> - ' . $error . '</p>
					</div>
				</div>
			</div>
		';
	}
}
?>
<div class="row">
	<div class="col-sm-offset-3 col-sm-6">
		<h1>Register</h1><br>
	</div>
</div>
<form class="form-horizontal" action="register.php" method="post">
	<div class="form-group">
		<label class="control-label col-sm-3" for="email">E-Mail:</label>
		<div class="col-sm-6">
			<input type="email" class="form-control" name="email" placeholder="Enter your e-mail address" value="<?php if (isset($valid_email)) echo $valid_email;?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" for="pass1">Password:</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" placeholder="Enter your password" name="pass1" pattern="[A-Za-z0-9!@#$%^&]{8,20}"/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" for="pass2">Confirm Password:</label>
		<div class="col-sm-6">
			<input type="password" class="form-control" placeholder="Confirm your password" name="pass2" pattern="[A-Za-z0-9!@#$%^&]{8,20}"/>
		</div>
	</div>
	<div class="col-sm-offset-3 col-sm-6">
		<p>Password must be 8-20 characters and can only contain A-Z, a-z, 0-9, and !@#$%^& .</p>
	</div>
	<div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" name="submit" class="btn btn-default">Register</button>
        </div>
	</div>
</form>

<?php include ('includes/footer.html'); ?>