<?php # cart.php

// start session
session_name('GitGudGamesAuth');
session_start();

$page_title = 'Git Gud Games - Cart';
include('includes/header.html');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// empty any games that a logged in user has in their games from their cart

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // go to checkout
    if (isset($_POST['checkout'])) {
        /* 
        $_POST['checkout'] now contains the total price for games in cart.
        if not a mock store, assumption is this value would be sent out, along with user info, to a 3rd party to complete payment.
        for demo, the code will assume proper payment was made
        */

        // if logged out go to login
        require('../check_logged_out.php');
        check_logged_out();

        // add game to users games
        // store order with order_details
        // update customer_games - works
        require('../mysqli_connect.php');

        foreach($_SESSION['cart'] as $game) {
            $q = "INSERT INTO customer_games (customer_games.customer_id, customer_games.game_id) VALUES ((SELECT customers.customer_id FROM customers WHERE customers.email='" . $_SESSION['email'] . "'), (SELECT games.game_id FROM games WHERE games.game_dir='" . $game[2] . "'));";
            $mysqli->query($q);
            $_SESSION['games'][] = $game[2];
        }

        // clear cart
        unset($_SESSION['cart']);

        // redirect to mygames
        require('../redirect_user.php');
        redirect_user('mygames.php');

    }

    // remove game from cart
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