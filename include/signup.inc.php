<?php

    if(isset($_POST["submit"]))
    {
        $uid = $_POST["uid"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $pwdrepeat = $_POST["pwdrepeat"];

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        // ERROR HANDLING
        if(emptyInputSignup($uid, $email, $pwd, $pwdrepeat) !== false)
        {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        if(invalidUID($uid) !== false)
        {
            header("location: ../signup.php?error=invalidUID");
            exit();
        }

        if(invalidEmail($email) !== false)
        {
            header("location: ../signup.php?error=invalidEmail");
            exit();
        }

        if(invalidPWD($pwd, $pwdrepeat) !== false)
        {
            header("location: ../signup.php?error=invalidPWD");
            exit();
        }

        if(uidExist($conn, $uid, $email) !== false)
        {
            header("location: ../signup.php?error=UIDtaken");
            exit();
        }

        createUser($conn, $uid, $email, $pwd, $pwdrepeat);
        loginUser($conn, $uid, $pwd);
    }
    else
    {
        header("location: ../signup.php");
        exit();
    }