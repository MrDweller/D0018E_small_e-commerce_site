<?php
    include_once 'header.php';


    if(isset($_GET['success']))
    {
        if($_GET['success'] === 'true')
        {
            ?>
                <p>THANK TOU FOR PURSHES</p>
            <?php
        }
        else if($_GET['success'] === 'false')
        {
            ?>
                <p>PURSHES FAILED</p>
            <?php
        }
        else 
        {
            ?>
                <p>NOTHING TO CHECKOUT!</p>
            <?php
        }
    }
    else 
    {
        header("location: index.php");
        exit();
    }


    


    include_once 'footer.php';
?>