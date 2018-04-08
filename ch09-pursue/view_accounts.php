<?php

$page_title = 'View account balances';
include ('includes/header.html');

echo '<h1>Account balances:</h1>';

require ('mysqli_connect.php');

$q = "SELECT CONCAT(customers.first_name, ' ', customers.last_name) AS Customer, 
	CONCAT('$', FORMAT(accounts.balance, 2)) AS 'Account Balance' 
	FROM customers INNER JOIN accounts ON customers.customer_id = accounts.customer_id";
$r = @mysqli_query ($dbc, $q);

$num = mysqli_num_rows($r);

if ($num > 0) {

	echo '<table align="left" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Name</b></td><td align="left"><b>Account Balance</b></td></tr>';
	
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['Customer'] . '</td><td align="left">' . $row['Account Balance'] . '</td></tr>		';
	}

	echo '</table>';
	
	mysqli_free_result ($r);	

} else {

	echo '<p class="error">There are currently no accounts.</p>';

}

mysqli_close($dbc);
?>