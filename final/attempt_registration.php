<?php # attempt_registration.php

function attempt_registration($dbc, $email, $pass) {
    // declarations
    $e = $dbc->real_escape_string($email);
    $p = $dbc->real_escape_string($pass);
    $q = "INSERT INTO customers (email, pass) VALUES ('$e', SHA1('$p'))";

    // execute the query
    $dbc->query($q);

    // check query result
    if ($dbc->affected_rows == 1) {
        // user registration success
        return true;
    } else {
        // user registration failed
        return false;
    }
}