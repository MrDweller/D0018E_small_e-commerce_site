<?php

// CHECKOUT
function empty_input_checkout($fname, $lname, $email, $address, $city, $postcode)
{
    $result = null;

    if(empty($fname) || empty($lname) || empty($email) || empty($address) || empty($city) || empty($postcode))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}


function invalid_name($name)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z]*$/", $name))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}


function invalid_email($email)
{
    $result = null;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}


function invalid_address($address)
{
    $result = null;

    if(!preg_match("/^[a-zA-Z0-9 ]*$/", $address))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}


function invalid_city($city)
{
    $result = null;

    if(!preg_match("/^\pL+$/u", $city))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}


function invalid_postcode($postcode)
{
    $result = null;

    if(!preg_match("/^[0-9]*$/", $postcode))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}