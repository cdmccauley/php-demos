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

// begin content
echo '
<div class="well">
';

// declaration
$total = 0.00;

// print games in cart
foreach ($_SESSION['cart'] as $game) {
    $total += $game[1];
    echo '
    <div class="panel panel-default">
        <div class="panel-body">
            <img src="https://placehold.it/140x80?text=/games/' . $game[2] . '/cover.png" class="img-responsive pull-left" style="padding-right:1em;" alt="Image">
            <p>' . $game[0] . '</p>
            <p class="text-right">$' . $game[1] . '</p>
            <a href="#" class="pull-right small">remove</a>
        </div>
    </div>';
} // !!! ADD LOGIC TO REMOVE GAME FROM CART

// print total and checkout
echo '    
    <div class="panel panel-default">
    <div class="panel-header">
            <p class="text-right" style="padding-right:1em;padding-top:1em;">Estimated Total: $' . $total . '</p>
        </div>
        <div class="panel-body">
            <button class="btn pull-right">Purchase</button>
        </div>
    </div>
</div>';

// get footer
include('includes/footer.html');

?>