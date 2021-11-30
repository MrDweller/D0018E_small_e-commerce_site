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

function start_transaction($conn)
{
    $sql = "START TRANSACTION;";

    if(mysqli_query($conn, $sql))
    {
        echo "Successfully started transaction\n";
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function commit_transaction($conn)
{
    $sql = "COMMIT;";

    if(mysqli_query($conn, $sql))
    {
        echo "Successfully commited transaction\n";
    }
    else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}