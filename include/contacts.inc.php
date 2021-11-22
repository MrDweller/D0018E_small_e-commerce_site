<?php


if(isset($_POST["submit"])){
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $subject = $_POST["subject"];

    require_once 'db.inc.php';
    require_once 'contact_functions.inc.php';


    // ERROR HANDLING
    if(emptyInputContact($fname, $lname, $subject) !== false)
    {
        header("location: ../contacts.php?error=emptyinput");
        exit();
    }

    if(invalidFname($fname) !== false)
    {
        header("location: ../contacts.php?error=invalidFname");
        exit();
    }

    if(invalidFname($lname) !== false)
    {
        header("location: ../contacts.php?error=invalidLname");
        exit();
    }


}
else{
    header("location: ../contacts.php");
    exit();
}





?>