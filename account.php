<?php
    include_once 'header.php';
    require_once 'include/account.inc.php';
?>
    <div class="center_div">
        <h1>Shopping history</h1><br>
        <?php

            for($i = sizeof($shop_hist) - 1; $i >= 0; $i--)
            {
                ?>        
                    <p><?php echo $shop_hist[$i][0] ?> amount: <?php echo $shop_hist[$i][1] ?> date/time: <?php echo $shop_hist[$i][2] ?></p><br>
                <?php
            }
        
        ?>

    </div>

<?php
    include_once 'footer.php';
?>

    