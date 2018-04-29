<?php # login.php

// start session
session_name('GitGudGamesAuth');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // login was submitted

    // helper files
    require('../login_functions.php');
    require('../mysqli_connect.php');

    if (true) { // variables are set and valid
        if (check_login($mysqli, $_POST['email'], $_POST['pass'])) {
            // valid login
            
            // store session information
            $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

            // ??? redirect then exit script ???
            redirect_user('mygames.php');

        } else {
            // invalid login
            echo 'failure: 27'; // test line
        }
    } else { // variables were not set or were not valid
        echo 'failure: 30'; // test line
    }
}

$page_title = 'Git Gud Games - Login';
include ('includes/header.html');

if (isset($errors) && !empty($errors)) {
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

?>
<h1>Login</h1>
<form action="login.php" method="post">
	<p>Email Address: <input type="text" name="email" /> </p>
	<p>Password: <input type="password" name="pass" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>

<?php include ('includes/footer.html'); ?>