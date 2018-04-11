<?php

$page_title = 'View Customers';
include ('includes/header.html');
echo '<h1>Customers</h1>';

require ('mysqli_connect.php');
		
$q = "SELECT customers.customer_id AS ID, 
	CONCAT(customers.first_name, ' ', customers.last_name) AS Customer 
	FROM customers ORDER BY customers.customer_id;";		
$r = @mysqli_query ($dbc, $q);

$num = mysqli_num_rows($r);

if ($num > 0) {

	echo '<table align="left" width="400px">
	<tr>
		<td align="left"><b>ID</b></td>
		<td align="left"><b>Customer</b></td>
		<td align="left"><b>Edit</b></td>
		<td align="left"><b>Delete</b></td>
	</tr>
	';
	
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr>
			<td align="left">' . $row['ID'] . '</td>
			<td align="left">' . $row['Customer'] . '</td>
			<td align="left"><a href="edit_user.php?ID=' . $row['ID'] . '">Edit</a></td>
			<td align="left"><a href="delete_user.php?ID=' . $row['ID'] . '">Delete</a></td>
		</tr>
		';
	}

	echo '</table>';
	mysqli_free_result ($r);	

} else {
	echo '<p class="error">There are no current customers to display.</p>';
}

mysqli_close($dbc);

?>