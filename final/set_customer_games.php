<?php # set_customer_games.php

// updates database to indicate customer owns a game

function set_customer_games($dbc, $cartGames, $orderTotal) {

    foreach($cartGames as $game) {
        $q = "INSERT INTO customer_games (customer_games.customer_id, customer_games.game_id) VALUES ((SELECT customers.customer_id FROM customers WHERE customers.email='" . $_SESSION['email'] . "'), (SELECT games.game_id FROM games WHERE games.game_dir='" . $game[2] . "'));";
        $dbc->query($q);
        $_SESSION['games'][] = array($game[2], $game[0]);
    }

    // store order and order_details !!!
    $q = "INSERT INTO orders (orders.customer_id, orders.order_total) VALUES ((SELECT customers.customer_id FROM customers WHERE customers.email='" . $_SESSION['email'] . "'), $orderTotal);";
    $dbc->query($q);

    // finished with cart
    unset($_SESSION['cart']);

    // finished with query
    $dbc->close();
    unset($dbc);

    // redirect to mygames
    require('../redirect_user.php');
    redirect_user('mygames.php');

}