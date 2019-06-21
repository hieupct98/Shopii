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

function clearError()
{
    unset($_SESSION['error']);
}

function priceFormat($price)
{
    $symbol_thousand = '.';
    $decimal_place = 0;
    return number_format($price, $decimal_place, '', $symbol_thousand);
}
/**
 * Undocumented function
 *
 * @param string $datetime
 * @return date
 */
function dateFormat($datetime)
{
    return date("d-m-Y H:i:s",strtotime($datetime));
}