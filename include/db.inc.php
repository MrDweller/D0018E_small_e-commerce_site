<?php

// db variables
$serverName = "aliroad.se";
$dBUsername = "aliadmin";
$dBPassword = "deesnuts";
$dBName = "alibase";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Could not establish connection.. connection failed: " . mysqli_connect_error());
}
