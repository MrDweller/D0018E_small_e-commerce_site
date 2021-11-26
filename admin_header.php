<?php
    if(isset($_SESSION["admin"]))
    {
        ?>
            <div class="center_div">
                <h1>WELCOME <?php echo $_SESSION["useruid"]; ?> ADMIN!</h1>
                
                <div class="adminbar">
                    <button onclick='button_press("user_settings.php")' class="btn"> Users settings </button>
                    <button onclick='button_press("product_settings.php")' class="btn"> Product settings </button>
                    <button onclick='button_press("user_feedback.php")' class="btn"> User feedback </button>
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