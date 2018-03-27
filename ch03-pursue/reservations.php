<!DOCTYPE html>
<html lang="en">
<head>
<title>Pacific Trails Resort :: Reservations </title>
<meta charset= "utf-8">
<link rel="stylesheet" href="pacific.css">
<meta name="viewport" width="device-width, initial-scale=1.0">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
</head>

<body>
<div id="wrapper">
    <?php include("header.inc.html"); ?>
	
<div id="content">
	<h2>Reservations at Pacific Trails</h2>
	<h3>Contact Us Today!</h3>
	  <p>Required fields are marked with an asterisk*.</p>
<form method="post" action="http://localhost/PacificTrails.php">
<div>
	<label for="myFName">*First Name:</label>
	<input type="text" name="myFName" id="myFName"required="required">
</div>
<div>
	<label for="myLName">*Last Name:</label>
	<input type="text" name="myLName" id="myLName" required="required">
</div>
<div>
	<label for="myEmail">*E-Mail:</label>
	<input type="email" name="myEmail" id="myEmail" size="40" maxlength="12" required="required">
</div>
<div>
	<label for="myPhone">Phone:</label>
	<input type="tel" name="myPhone" id="myPhone" maxlength="12">
</div>
	<div>
	<label for="myDate">Arrival Date</label>
	<input type="date" name="myDate" id="myDate">
</div>
<div>
	<label for="myNights">Nights</label>
	<input type="number" name="myNights" id="myNights" min="1" max="14">
</div>
<div>
	<label for="myComments">*Comments:</label>
	<textarea name="myComments" id="myComments" rows="2" cols="42"
        required="required" placeholder="comments"></textarea>
</div>
<div>
	<input type="submit" value="Submit">
</div>
</form>
  
 <div id="contact">
	  <p><span class="resort">Pacific Trails Resort</span> <br>
							  12010 Pacific Trails Road<br>
							  Zephyr, CA 95555<br><br>
	  <a id="mobile" href="tel:888-555-5555">888-555-5555</a>
	  <span id="desktop">888-555-5555</span>
	  </p>
</div>
</div>
<?php include("footer.inc.html"); ?>
