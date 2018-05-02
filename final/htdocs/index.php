<?php # index.php

// start session
session_name('GitGudGamesAuth');
session_start();

$page_title = 'Git Gud Games';
include ('includes/header.html');

?>

<!-- example html for store.php -->
<div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">GAME1</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-default">
        <div class="panel-heading">GAME2</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-default">
        <div class="panel-heading">GAME3</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container"> <!-- example of row with 3 games -->
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-default">
        <div class="panel-heading">GAME4</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-default">
        <div class="panel-heading">GAME5</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-default">
        <div class="panel-heading">GAME6</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container"> <!-- example of row with 2 games -->
    <div class="row">
        <div class="col-sm-offset-2 col-sm-4">
            <div class="panel panel-default">
            <div class="panel-heading">GAME7</div>
            <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer">Shop Now!</div>
        </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-default">
        <div class="panel-heading">GAME8</div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">Shop Now!</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container"> <!-- example of row with 1 game -->
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-default">
            <div class="panel-heading">GAME9</div>
            <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
            <div class="panel-footer">Shop Now!</div>
        </div>
    </div>
  </div>
</div><br>

<?php include ('includes/footer.html'); ?>