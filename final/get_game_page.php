<?php #get_game_page.php

// returns game page data

function get_game_page($dbc, $dirName) {

    $dbc->real_escape_string($dirName);
    $q = "SELECT game_studios.studio_name, games.game_name, games.game_price, games.game_desc, games.game_dir FROM game_studios INNER JOIN games ON game_studios.studio_id=games.studio_id WHERE games.game_dir='$dirName';";
    $r = $dbc->query($q);
    return $r->fetch_assoc();

}