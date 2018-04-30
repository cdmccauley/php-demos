<?php # check_registered_email.php

function check_registered_email($dbc, $email) {
    // declarations
    $e = $dbc->real_escape_string($email);
    $q = "SELECT customers.email FROM customers WHERE email='$e'";

    // execute query
    $dbc->query($q);

    // check query result
    if ($dbc->affected_rows > 0) {
        // email exists in database
        return true;
    } else {
        // email is not in database
        return false;
    }
}