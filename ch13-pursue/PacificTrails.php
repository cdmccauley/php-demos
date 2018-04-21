<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Form Feedback</title>
</head>
<body>
<?php

$email = $_POST['myEmail'];
$nights = $_POST['myNights'];
$errors = array();

// validate nights
if ($nights < 0 || $nights > 31) { 
    $errors[] = "Nights must be 1-31";
}
// validate email
if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $errors[] = "Invalid e-mail address";
}
// if there are errors, print them
if (!(empty($errors))) {
    foreach ($errors as $error) {
        echo ($error . '<br />');
    }
} else {
    echo "Thank you for your reservation! We will contact you shortly.";
}

?>
</body>
</html>