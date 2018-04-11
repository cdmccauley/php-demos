<?php

$page_title = 'Edit Customer';
include ('includes/header.html');
echo '<h1>Edit Customer</h1>';

if ( (isset($_GET['ID'])) && (is_numeric($_GET['ID'])) ) {
	$ID = $_GET['ID'];
} elseif ( (isset($_POST['ID'])) && (is_numeric($_POST['ID'])) ) {
	$ID = $_POST['ID'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('mysqli_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	if (empty($errors)) {
	
		$q = "UPDATE customers SET first_name='$fn', last_name='$ln' WHERE customer_id = $ID LIMIT 1";
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) {
			echo '<p>The user has been edited.</p>';	
		} else {
			echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
		
	} else {
		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	}

}
$q = "SELECT customers.first_name, customers.last_name FROM customers WHERE customers.customer_id = $ID";
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) {
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);

	echo '<form action="edit_user.php" method="post">
		<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
		<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
		<p><input type="submit" name="submit" value="Submit" /></p>
		<input type="hidden" name="ID" value="' . $ID . '" />
		</form>';

} else {
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
?>