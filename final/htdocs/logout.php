<?php # logout.php

// start session
session_name('GitGudGamesAuth');
session_start();

// clear session
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600);

// get header
$page_title = 'Git Gud Games - Logout';
include('includes/header.html');

// begin content
echo '<div class="row" style="margin-top:3em">
        <div class="col-sm-offset-3 col-sm-6">
            <p class="text-center">You have been logged out.</p>
        </div>
    </div>';

// get footer
include('includes/footer.html');

?>