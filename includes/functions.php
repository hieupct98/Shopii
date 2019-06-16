<?php
function isSeller()
{
    return (isset($_SESSION['email']) && $_SESSION['roleID'] == 2);
}

function isAdmin()
{
    return (isset($_SESSION['email']) && $_SESSION['roleID'] == 1);
}

function isLoggedIn()
{
    return isset($_SESSION['email']);
}

function clearMessage()
{
    unset($_SESSION['message']);
}