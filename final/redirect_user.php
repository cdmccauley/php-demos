<?php # redirect_user.php

// redirect the user to another page

function redirect_user ($page = 'index.php') {

	// build url
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// clean url
	$url = rtrim($url, '/\\');
	
	// append page name
	$url .= '/' . $page;
	
	// redirect
    header("Location: $url");
    
    // exit script
	exit();
}