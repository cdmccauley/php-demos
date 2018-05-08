<?php # check_logged_out.php

// check if a user is logged out, if so redirect to login page

function check_logged_out() {
    if (!isset($_SESSION['agent']) || !isset($_SESSION['email'])) {

        // logged out, redirect to login.php
        require('redirect_user.php');
        redirect_user('login.php');

    }
}