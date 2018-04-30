<?php # check_logged_in.php

// check if a user is logged in on a page used for registering or logging in

function check_logged_in() {
    if (isset($_SESSION['agent']) || isset($_SESSION['email'])) {

        // logged in, redirect to mygames.php
        require('../redirect_user.php');
        redirect_user('mygames.php');

    }
}