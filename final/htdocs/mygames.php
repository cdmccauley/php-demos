<?php # mygames.php

// start session
session_name('GitGudGamesAuth');
session_start();

// check session
require('../check_session.php');
check_session();

$page_title = 'Git Gud Games - My Games';
include ('includes/header.html');

echo $_SESSION['email'] . '<br>';

print_r($_SESSION['games']);

include ('includes/footer.html');

?>