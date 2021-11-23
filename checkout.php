<?php
    include_once 'header.php';


    if(isset($_GET['success']))
    {
        if($_GET['success'] === 'true')
        {
            ?>
                <h1 class="center_div">ZANG KYO FOR PURSHES!</h1>
            <?php
        }
        else if($_GET['success'] === 'false')
        {
            ?>
                <h1 class="center_div">PURSHES FAILED!</h1>
            <?php
        }
        else 
        {
            ?>
                <h1 class="center_div">NOTHING TO CHECKOUT!</h1>
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