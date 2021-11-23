<?php



if(isset($_POST["submit"])){
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $message = $_POST["subject"];

    require_once 'db.inc.php';
    require_once 'contact_functions.inc.php';
    


    // ERROR HANDLING
    if(emptyInputContact($fname, $lname, $message) !== false)
    {
        header("location: ../contacts.php?error=emptyinput");
        exit();
    }

    if(invalidName($fname) !== false)
    {
        header("location: ../contacts.php?error=invalidFname");
        exit();
    }

    if(invalidName($lname) !== false)
    {
        header("location: ../contacts.php?error=invalidLname");
        exit();
    }

    complete_contact($conn, $fname, $lname, $message);
    header("location: ../contact_complete.php");
    exit();
}
else{
    header("location: ../contacts.php");
    exit();
}





?>