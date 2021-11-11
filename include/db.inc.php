<?php

// db variables
$serverName = "localhost:3305";
$dBUsername = "root";
$dBPassword = "";
$dBName = "alibase";


$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

// display error message if connection fails
if(!$conn){
    die("Could not establish connection.. connection failed: " . mysqli_connect_error());
}
