<?php

$page_title = 'Delete Customer';
include ('includes/header.html');
echo '<h1>Delete Customer</h1>';

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

	if ($_POST['sure'] == 'Yes') {
		$q = "DELETE FROM accounts WHERE accounts.customer_id=$ID";
		$r = @mysqli_query ($dbc, $q);
		
		$q = "DELETE FROM customers WHERE customers.customer_id=$ID LIMIT 1";
		$r = @mysqli_query ($dbc, $q);

		if (mysqli_affected_rows($dbc) == 1) {
			echo '<p>The user has been deleted.</p>';
		} else {
			echo '<p class="error">The user could not be deleted due to a system error.</p>';
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
		}
	
	} else {
		echo '<p>The user has NOT been deleted.</p>';	
	}

} else {
	$q = "SELECT CONCAT(customers.first_name, ' ', customers.last_name) FROM customers WHERE customers.customer_id=$ID";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);

		echo "<h3>Name: $row[0]</h3>
		<p>Are you sure you want to delete this user?</p>";
		
		echo '<form action="delete_user.php" method="post">
			<input type="radio" name="sure" value="Yes" /> Yes 
			<input type="radio" name="sure" value="No" checked="checked" /> No
			<input type="submit" name="submit" value="Submit" />
			<input type="hidden" name="ID" value="' . $ID . '" />
			</form>';
	
	} else {
		echo '<p class="error">This page has been accessed in error.</p>';
	}

}

mysqli_close($dbc);
		
?>