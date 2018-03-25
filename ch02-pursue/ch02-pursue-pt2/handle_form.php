<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Form Feedback</title>
	<style type="text/css" title="text/css" media="all">
	.error {
		font-weight: bold;
		color: #C00;
	}
	</style>
</head>
<body>
<?php # Script 2.4 - handle_form.php #3

// Validate the name:
if (!empty($_POST['name'])) {
	$name = $_POST['name'];
} else {
	$name = NULL;
	echo '<p class="error">You forgot to enter your name!</p>';
}

// Validate the email:
if (!empty($_POST['email'])) {
	$email = $_POST['email'];
} else {
	$email = NULL;
	echo '<p class="error">You forgot to enter your email address!</p>';
}

// Validate the comments:
if (!empty($_POST['comments'])) {
	$comments = $_POST['comments'];
} else {
	$comments = NULL;
	echo '<p class="error">You forgot to enter your comments!</p>';
}

// Validate the gender:
if (isset($_POST['gender']) && ($_POST['gender'] == 'M' || $_POST['gender'] == 'F')) {
	$gender = $_POST['gender'];
	$greeting = '<p><b>Good day!</b></p>';
} else { // $_POST['gender'] is not set.
	$gender = NULL;
	echo '<p class="error">Invalid gender.</p>';
}

if (isset($_POST['age']) && ($_POST['age'] == '0-29' || $_POST['age'] == '30-60' || $_POST['age'] == '60+')) {
	$age = $_POST['age'];
} else {
	$age = NULL;
	echo '<p class="error">Invalid age.</p>';
}

// If everything is OK, print the message:
if ($name && $email && $gender && $age && $comments) {

	echo "<p>Thank you, <b>$name</b>, for the following comments:<br />
	<tt>$comments</tt></p>
	<p>We will reply to you at <i>$email</i>.</p>\n";
	
	echo $greeting;
	
} else { // Missing form value.
	echo '<p class="error">Please go back and fill out the form again.</p>';
}

?>
</body>
</html>