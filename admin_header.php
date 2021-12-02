<?php
    if(isset($_SESSION["admin"]))
    {
        ?>
            <div class="center_div">
                <h1>WELCOME <?php echo $_SESSION["useruid"]; ?> ADMIN!</h1>
                
                <div class="adminbar">
                    <a href = "user_settings.php" class="btn"> Users settings </a>
                    <a href = "product_settings.php" class="btn"> Product settings </a>
                    <a href = "user_feedback.php" class="btn"> User feedback </a>
                </div>
            
            </div>
        <?php
    }
    else 
    {
        header("location: index.php");
        exit();
    }
?>