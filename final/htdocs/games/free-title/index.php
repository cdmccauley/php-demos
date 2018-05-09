<?php # games/index.php

// start session
session_name('GitGudGamesAuth');
session_start();

// query helper
require('../../../mysqli_connect.php');

// declare and run query
$thisDirectory = basename(dirname($_SERVER['PHP_SELF']));
$mysqli->real_escape_string($thisDirectory);
$q = "SELECT game_studios.studio_name, games.game_name, games.game_price, games.game_desc, games.game_dir FROM game_studios INNER JOIN games ON game_studios.studio_id=games.studio_id WHERE games.game_dir='$thisDirectory';";
$r = $mysqli->query($q);
$r = $r->fetch_assoc();

// finished with query
$mysqli->close();
unset($mysqli);

// get header
$page_title = $r['studio_name'];
include('../../includes/header.html');

// prepare cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// cart validation
$in_cart = in_array(array($r['game_name'], $r['game_price'], $r['game_dir']), $_SESSION['cart']);

// primed declaration
$in_games = false;

// games validation
if (isset($_SESSION['games'])) {
    foreach ($_SESSION['games'] as $myGame) {
        if (in_array($r['game_dir'], $myGame)) {
            $in_games = true;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // validate cart
    if (!$in_cart) {
        $_SESSION['cart'][] = array($r['game_name'], $r['game_price'], $r['game_dir']);
        $in_cart = true;
    }

    // redirect to cart
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php-scripts/final/htdocs/cart.php");
}

// begin content
echo '
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h2 style="margin:.5em;">' . $r['game_name'] . '</h2></div>
        <div class="panel-body">
            <div class="col-sm-7">
                <img src="https://placehold.it/500x250?text=screenshot.png" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="well col-sm-5">
                <p style="margin-top:.75em;">' . $r['studio_name'] . '</p>
                <p>' . $r['game_desc'] . '</p>
                <p>$' . $r['game_price'] . '</p>
            </div>
        </div>
        <div class="panel-footer text-right">
            <form class="form-inline" action="index.php" method="post">
                <button type="submit" class="btn btn-default"';

// print button
if ($in_cart) {
    echo ' disabled>Game In Cart</button>';
} elseif ($in_games) {
    echo ' disabled>Game In MyGames</button>';
} else {
    echo '>Add To Cart</button>';
}

// complete content
echo '                
            </form>
        </div>
    </div>
</div>
';

// get footer
include('../../includes/footer.html');

?>