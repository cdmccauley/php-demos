<?php

session_name('GitGudGamesAuth');
session_start();

if (!(isset($_SESSION['agent'])) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))) {
    require('../login_functions.php');
    redirect_user();
}

$page_title = 'Git Gud Games - My Games';
include ('includes/header.html');
include ('includes/footer.html');

?>