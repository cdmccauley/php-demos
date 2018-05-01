<?php # login.php

// start session
session_name('GitGudGamesAuth');
session_start();

// check logged in
require('../check_logged_in.php');
check_logged_in();

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // login was submitted

    // declarations
    $error;

    // trim whitespace
    $_POST['email'] = trim($_POST['email']);
    $_POST['pass'] = trim($_POST['pass']);

    // login variable validation
    if (!isset($_POST['email'], $_POST['pass']) || (empty($_POST['email']) || empty($_POST['pass']))) {
        $error = 'Please provide both e-mail and password.';
    } elseif (strlen($_POST['email']) > 60) {
        $error = 'Provided e-mail address too long to have been registered.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Provided e-mail address format not recognized.';
    } elseif (strlen($_POST['pass']) < 8 || strlen($_POST['pass']) > 20) {
        $error = 'Provided password length is invalid. Passwords must be between 8 and 20 characters.';
    } elseif (!preg_match('/[A-Za-z0-9!@#$%^&]{8,20}/', $_POST['pass'])) {
        $error = 'Provided password is invalid. Passwords must be 8-20 characters and can only contain A-Z, a-z, 0-9, or !@#$%^& .';
    }

    if (empty($error)) {
        // passed login variable validation

        // function files
        require('../mysqli_connect.php');
        require('../login_functions.php');

        // attempt login with provided credentials
        if (check_login($mysqli, $_POST['email'], $_POST['pass'])) {

            // successful login, go to mygames
            require('../redirect_user.php');
            redirect_user('mygames.php');

        } else {
            // failed login
            $error = 'Provided e-mail and password combination were not valid.';
        }
    }
}

$page_title = 'Git Gud Games - Login';
include ('includes/header.html');

if (isset($error) && !empty($error)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error occurred:<br />';
	echo " - $error<br /></p>";
	echo '<p>Please try again.</p>';
}

?>
<h1>Login</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" /> </p>
	<p>Password: <input type="password" name="pass" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>

<?php include ('includes/footer.html'); ?>