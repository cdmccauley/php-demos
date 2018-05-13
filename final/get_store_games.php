<?php # get_store_games.php

// gets values needed to display the store page

function get_store_games($dbc) {
    // declarations
    $storeValues = array();
    $q = "SELECT games.game_name, games.game_price, games.game_dir FROM games;";
    $r = @$dbc->query($q);

    // store results
    $gameTotal = $r->num_rows;
    $storeValues['numFullRows'] = (int)($gameTotal / 3); // 0, 0, or 1+
    $storeValues['numPartialRows'] = $gameTotal % 3; // 1, 2, or 0
    $storeValues['games'] = $r->fetch_all();

    // return results
    return $storeValues;
}