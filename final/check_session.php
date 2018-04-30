<?php # check_session.php

// check for login credentials and check current agent against login agent

function check_session() {
    
    if (!(isset($_SESSION['agent']) && isset($_SESSION['email'])) || $_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT'])) {
        // insert explicit logout

        // redirect to index.php
        require('redirect_user.php');
        redirect_user();
    }
}