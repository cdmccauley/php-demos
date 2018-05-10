<?php # index.php

// start session
session_name('GitGudGamesAuth');
session_start();

// helper function declaration
function draw_card($class_value, $result_set, $game_index) {
  echo '
    <div class="' . $class_value . '">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a style="font-weight:bold;display:block;" href="games/' . $result_set[$game_index][2] . '/">' . $result_set[$game_index][0] . '</a>
        </div>
        <div class="panel-body">
          <a href="games/' . $result_set[$game_index][2] . '/"><img src="https://placehold.it/500x250?text=games/' . $result_set[$game_index][2] . '/cover.png" class="img-responsive" style="width:100%" alt="Image"></a>
        </div>
        <div class="panel-footer text-right">
          <strong>$' . $result_set[$game_index][1] . '</strong>
        </div>
      </div>
    </div>
  ';
}

// get header
$page_title = 'Git Gud Games';
include('includes/header.html');

// query helper
require('../mysqli_connect.php');

// declare and run query !!! MOVE TO FUNCTIONS !!! name: get_store_games()
$q = "SELECT games.game_name, games.game_price, games.game_dir FROM games;";
$r = @$mysqli->query($q);

// store query results
$game_total = $r->num_rows;
$full_row = (int)($game_total / 3); // 0, 0, or 1+
$partial_row = $game_total % 3; // 1, 2, or 0
$games = $r->fetch_all();

// finished with query
$mysqli->close();
unset($mysqli);

// declarations
$full_row_class = 'col-sm-4';
$even_row_class = 'col-sm-offset-2 col-sm-4'; // second panel on even row will use $full_row_class
$odd_row_class = 'col-sm-offset-4 col-sm-4';
$game_counter = 0;

// begin content
echo '
  <div class="row">
    <div class="col-sm-4">
        <h1>Store</h1><br>
    </div>
  </div>
';

// draw games rows
if ($full_row > 0) { // draw full rows
  for ($i = $full_row; $i > 0; $i--) {
    echo '<div class="row">';
    for ($j = 0; $j < 3; $j++) {
      draw_card($full_row_class, $games, $game_counter);
      $game_counter++;
    }
    echo '</div><br>';
  }
}

if ($partial_row > 0) { // draw partial row
  if ($partial_row % 2 == 0) { // draw row of 2
    echo '<div class="row">';
    draw_card($even_row_class, $games, $game_counter);
    $game_counter++;
    draw_card($full_row_class, $games, $game_counter);
    $game_counter++;
    echo '</div><br>';
  } else { // draw row of 1
    echo '<div class="row">';
    draw_card($odd_row_class, $games, $game_counter);
    $game_counter++;
    echo '</div><br>';
  }
}

// get footer
include('includes/footer.html'); 

?>