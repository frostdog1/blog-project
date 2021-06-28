<?php

session_start();

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        // if session is set return true
        return true;
    } else {
        return false;
    }
}
