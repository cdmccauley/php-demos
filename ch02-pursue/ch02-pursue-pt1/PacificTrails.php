<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Form Feedback</title>
</head>
<body>
<?php

$nights = $_POST['myNights'];

if ($nights < 0 || $nights > 31) { 
    print "Nights must be 1-31"; // html already validates 1-14 but is part of assignment
} else {
    print "Thank you! We will contact you shortly.";
}

?>
</body>
</html>