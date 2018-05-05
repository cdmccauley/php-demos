<?php # games/index.php

// start session
session_name('GitGudGamesAuth');
session_start();

// query helper
require('../../../mysqli_connect.php');

// declare and run query
$in_dir = basename(dirname($_SERVER['PHP_SELF']));
$q = "SELECT game_studios.studio_name, games.game_name, games.game_price, games.game_desc, games.game_dir FROM game_studios INNER JOIN games ON game_studios.studio_id=games.studio_id WHERE games.game_dir='$in_dir';";
$r = $mysqli->query($q);
$r = $r->fetch_row();

// finished with query
$mysqli->close();
unset($mysqli);

// get header
$page_title = $r[1];
include('../../includes/header.html');

// cart is stored in session variable
// add logic to change the button from cart to dl once payment is complete and game has been added to user

?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading"><h2 style="margin:.5em;"><?php echo $r[1];?></h2></div>
        <div class="panel-body">
            <div class="col-sm-7">
                <img src="https://placehold.it/500x250?text=screenshot.png" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="well col-sm-5">
                <p style="margin-top:.75em;"><?php echo $r[0];?></p>
                <p><?php echo $r[3];?></p>
                <p>$<?php echo $r[2];?></p>
            </div>
        </div>
        <div class="panel-footer text-right"><form><button type="button" class="btn">Add To Cart</button></form></div>
    </div>
</div>

<?php

include('../../includes/footer.html');

?>