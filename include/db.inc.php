<?php

// db variables
$serverName = "aliroad.se";
$dBUsername = "aliadmin";
$dBPassword = "deesnuts";
$dBName = "alibase";


$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

// display error message if connection fails
if(!$conn){
    die("Could not establish connection.. connection failed: " . mysqli_connect_error());
}
