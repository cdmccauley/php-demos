<?php # cart.php

// start session
session_name('GitGudGamesAuth');
session_start();

$page_title = 'Git Gud Games - Cart';
include('includes/header.html');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// if not logged in then redirect to login, otherwise take to cart

print_r($_SESSION['cart']);

include('includes/footer.html');

?>