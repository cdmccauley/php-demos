<?php # mygames.php

// start session
session_name('GitGudGamesAuth');
session_start();

// check session
require('../check_session.php');
check_session();

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // download was submitted

    // confirm user owns the game
    foreach ($_SESSION['games'] as $game) {
        if (in_array($_POST['download'], $game)) {
            // confirmed to own, send the file
            header('Content-Description: File Transfer');
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="' . $_POST['download'] . '.txt"');  
            readfile('../game-files/' . $_POST['download'] . '.txt');
            exit();
        }
    }
}

// get header
$page_title = 'Git Gud Games - My Games';
include('includes/header.html');

// begin content
echo '
  <div class="row">
    <div class="col-sm-4">
        <h1>My Games</h1><br>
    </div>
  </div>
';

// draw game list
if (count($_SESSION['games']) == 0) { // user does not own any games
    echo '
        <div class="panel panel-default">
            <div class="panel-body">
                <p>You have no games!</p>
                <p><a href="index.php">Visit the store to purchase a game</a>!</p>
                <p style="margin-bottom:0em;"><a href="cart.php">Visit your cart to checkout</a>!</p>
            </div>
        </div>
    ';
} else {
    foreach ($_SESSION['games'] as $game) { // user owns games
        echo '
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="/games/' . $game[0] . '"><img src="https://placehold.it/140x80?text=/games/' . $game[0] . '/cover.png" class="img-responsive pull-left" style="padding-right:1em;" alt="Image">
                    <p style="margin-bottom:0.25em;display:inline;">' . $game[1] . '</p></a>
                    <form class="form-inline" action="mygames.php" method="post">
                        <button type="submit" class="btn btn-default pull-right" name="download" value="' . $game[0] . '">Download</button>
                    </form>
                </div>
            </div>
        ';
    }
}


// get footer
include('includes/footer.html');

?>