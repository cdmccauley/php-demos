<?php # logout.php

// start session
session_name('GitGudGamesAuth');
session_start();

$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600);

$page_title = 'Git Gud Games - Logout';
include('includes/header.html');

echo '<div class="row">
        <div class="col-sm-offset-3 col-sm-6">
        <p class="text-center">You have been logged out.</p>
        </div>
    </div>';

include('includes/footer.html');