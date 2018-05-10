<?php # cart.php

// start session
session_name('GitGudGamesAuth');
session_start();

// get header
$page_title = 'Git Gud Games - Cart';
include('includes/header.html');

// prep cart variable
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// empty any games that a logged in user has in mygames from their cart
if (isset($_SESSION['games'])) {
    foreach ($_SESSION['games'] as $myGame) {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if (in_array($_SESSION['cart'][$i][2], $myGame)) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // checkout or remove submitted

    // checkout was submitted
    if (isset($_POST['checkout'])) {
        /* 
        $_POST['checkout'] now contains the total price for games in cart.
        if not a mock store, assumption is this value would be sent out, along with user info, to a 3rd party to complete payment.
        for demo, the code will assume proper payment was made
        */

        // if logged out go to login
        require('../check_logged_out.php');
        check_logged_out();

        // query helper
        require('../mysqli_connect.php');

        // assuming proper payment, set customer games
        require('../set_customer_games.php');
        set_customer_games($mysqli, $_SESSION['cart'], $_POST['checkout']);

    }

    // removal from cart was submitted
    if (isset($_POST['remove'])) {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_POST['remove'] == $_SESSION['cart'][$i][2]) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
    }
}

// begin content
echo '
    <div class="row">
        <div class="col-sm-4">
            <h1>Cart</h1><br>
        </div>
    </div>
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
            <form class="form-inline" action="cart.php" method="post">
                <button type="submit" class="btn btn-default btn-xs pull-right" name="remove" value="' . $game[2] . '">remove</button>
            </form>
        </div>
    </div>';
}

// print total and checkout button
echo '    
    <div class="panel panel-default">
    <div class="panel-header">
            <p class="text-right" style="padding-right:1em;padding-top:1em;">Estimated Total: $' . $total . '</p>
        </div>
        <div class="panel-body">
            <form class="form-inline" action="cart.php" method="post">
                <button type="submit" class="btn pull-right" name="checkout" value="' . $total;

// disable checkout if cart is empty
echo empty($_SESSION['cart']) ? '" disabled>' : '">';

// complete total and checkout button
echo '
                Purchase</button>
            </form>
        </div>
    </div>
</div>';

// get footer
include('includes/footer.html');

?>