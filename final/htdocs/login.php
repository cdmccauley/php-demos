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

    if (empty($error)) { // passed login variable validation

        // function files
        require('../mysqli_connect.php');
        require('../login_functions.php');

        // attempt login with provided credentials
        if (check_login($mysqli, $_POST['email'], $_POST['pass'])) {

            // dispose of db connection, move to function
			$mysqli->close();
            unset($mysqli);
            
            // successful login, provide new session id
            session_regenerate_id();

            // redirect user to mygames
            require('../redirect_user.php');
            redirect_user('mygames.php');

        } else {

            // failed login, dispose of db connection
			$mysqli->close();
            unset($mysqli);
            
            $error = 'Provided e-mail and password combination were not valid.';
        }
    }
}

$page_title = 'Git Gud Games - Login';
include ('includes/header.html');

if (isset($error) && !empty($error)) {
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

?>
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <h1>Login</h1><br>
    </div>
</div>
<form class="form-horizontal" action="login.php" method="post">
    <div class="form-group">
        <label class="control-label col-sm-3" for="email">E-Mail:</label>
        <div class="col-sm-6">
            <input type="email" class="form-control" placeholder="Enter your e-mail address" name="email" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="email">Password:</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" placeholder="Enter your password" name="pass" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>

<?php include ('includes/footer.html'); ?>