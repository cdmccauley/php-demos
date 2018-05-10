<?php # games/index.php

/*
 * each game has a directory that has been junctioned with the games/game-page directory
 * when the directory for the game is accessed this script runs and uses the directory that was called to determine content of the page
 * if junctions are not possible, this script can just be copied to each directory in games
 */

// start session
session_name('GitGudGamesAuth');
session_start();

// query helper
require('../../../mysqli_connect.php');

// primed declaration
$thisDirectory = basename(dirname($_SERVER['PHP_SELF']));

// get game page content
require('../../../get_game_page.php');
$gameData = get_game_page($mysqli, $thisDirectory);

// finished with query
$mysqli->close();
unset($mysqli);

// get header
$page_title = $gameData['studio_name'];
include('../../includes/header.html');

// prepare cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// declarations
$in_cart = in_array(array($gameData['game_name'], $gameData['game_price'], $gameData['game_dir']), $_SESSION['cart']);
$in_games = false;

// games validation
if (isset($_SESSION['games'])) {
    foreach ($_SESSION['games'] as $myGame) {
        if (in_array($gameData['game_dir'], $myGame)) {
            $in_games = true;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // game was added to cart

    // validate cart
    if (!$in_cart) {
        $_SESSION['cart'][] = array($gameData['game_name'], $gameData['game_price'], $gameData['game_dir']);
        $in_cart = true;
    }

    // redirect to cart
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/php-scripts/final/htdocs/cart.php");
}

// begin content
echo '
<div class="row" style="margin-top:3em;">
    <div class="panel panel-default">
        <div class="panel-heading"><h2 style="margin:.5em;">' . $gameData['game_name'] . '</h2></div>
        <div class="panel-body">
            <div class="col-sm-7">
                <img src="https://placehold.it/500x250?text=cover.png" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="well col-sm-5">
                <p style="margin-top:.75em;">' . $gameData['studio_name'] . '</p>
                <p>' . $gameData['game_desc'] . '</p>
                <p>$' . $gameData['game_price'] . '</p>
            </div>
        </div>
        <div class="panel-footer text-right">
            <form class="form-inline" action="index.php" method="post">
                <button type="submit" class="btn btn-default"';

// complete button
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