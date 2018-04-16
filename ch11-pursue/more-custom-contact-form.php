<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Contact Me</title>
</head>
<body>
<h1>A "More Custom" Contact Form</h1>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) ) {
	
		$body = "Name: {$_POST['name']}\nLocation: {$_POST['location']}\nMessage: {$_POST['message']}\n";
		$body = wordwrap($body, 70);
        mail('phpsendmailtesting@gmail.com', $_POST['subject'], $body, "From: {$_POST['email']}");
        
        $body = "{$_POST['name']},\n\nThank you for submitting your message about '{$_POST['subject']}'. I will respond as soon as possible.\n\nSincerely,\nChris McCauley";
        $body = wordwrap($body, 70);
        mail($_POST['email'], 'Message Confirmation', $body, "From: phpsendmailtesting@gmail.com");

		echo '<p><em>Thank you for submitting your message!</em></p>';
		
		$_POST = array();
	
	} else {
		echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
	}
}

?>
<p>Fill out the form below and press the Send button to message me.</p>
<form action="more-custom-contact-form.php" method="post">
	<p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	<p>Location: <input type="text" name="location" size="30" maxlength="80" value="" /></p>
	<p>Subject: <input type="text" name="subject" size="30" maxlength="80" value="" /></p>
	<p>Message: <textarea name="message" rows="5" cols="30"><?php if (isset($_POST['message'])) echo $_POST['message']; ?></textarea></p>
	<p><input type="submit" name="submit" value="Send" /></p>
</form>
</body>
</html>