<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Form Feedback</title>
</head>
<body>
<?php

// spam_scrubber() declaration
function spam_scrubber($value) {
    $very_bad = array('to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:');

    foreach ($very_bad as $v) {
        if (stripos($value, $v) !== false) return '';
    }

    $value = str_replace(array( "\r", "\n", "%0a", "%0d"), ' ', $value);

    return trim($value);
}

// use spam_scrubber()
$scrubbed = array_map('spam_scrubber', $_POST);

// var declarations
$email = $scrubbed['myEmail'];
$nights = $scrubbed['myNights'];
$errors = array();

// validate nights
if ($nights < 0 || $nights > 31 || empty($nights)) { 
    $errors[] = "Nights must be 1-31";
}

// using to demonstrate spam_scrubber
if (!empty($_POST['myEmail']) && empty($email)) {
    $errors[] = "Manipulation detected";
}

// validate email
if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $errors[] = "Invalid e-mail address";
}

// echo output
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