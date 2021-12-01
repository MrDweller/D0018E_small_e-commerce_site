<?php
    include_once 'header.php';
    require_once 'include/account.inc.php';
?>
    <div class="center_div">
        <!-- Fix these functions for useraccounts -->
        <h1>Edit account credentials</h1><br>
        <button type="submit" class="btn">Inbox</button>
        <button type="submit" class="btn">Change email</button>
        <button type="submit" class="btn">Change password</button>
        <!-- <button type="submit" class="btn">Delete your account</button> -->

        <form action="include/delete_user.inc.php" method="post" onsubmit="return confirm('WARNI WARNI, this is permanent!')">
            <input name="delete_myself" id="delete_myself" type="hidden" value="<?php echo $_SESSION["userid"] ?>">
            <td>
                <button type="submit" class="btn">Delete your account</button>
            </td>
        </form>

        <!-- Change shoppinghistory to store the history of products bought each session instead of each product -->
        <h1>Shopping history</h1><br>
        <?php

            for($i = sizeof($shop_hist) - 1; $i >= 0; $i--)
            {
                ?>        
                    <?php echo $shop_hist[$i][0] ?> amount: <?php echo $shop_hist[$i][1] ?> date/time: <?php echo $shop_hist[$i][2] ?>

                    <?php
                        if($reviews)
                        {
                            $no_review = true;
                            for($j = 0; $j < sizeof($reviews); $j ++)
                            {
                                if($reviews[$j][0] == $shop_hist[$i][3])
                                {
                                    ?>
                                        <button class="btn" onclick='button_press("user_review.php?productID=<?php echo $shop_hist[$i][3]?>")'>Edit review</button><br>
                                    <?php
                                    $no_review = false;
                                }
                            }
                            if($no_review)
                            {
                                ?>
                                    <button class="btn" onclick='button_press("user_review.php?productID=<?php echo $shop_hist[$i][3]?>")'>Add review</button><br>
                                <?php
                            }
                        }
                        else 
                        {
                            ?>
                                <button class="btn" onclick='button_press("user_review.php?productID=<?php echo $shop_hist[$i][3]?>")'>Add review</button><br>
                            <?php
                        }
                    ?>
                <?php
            }
        
        ?>

    </div>

<?php
    include_once 'footer.php';
?>

    