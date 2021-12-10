<?php
    include_once 'header.php';
    require_once 'include/account.inc.php';
?>

    <div class="center_div">
        <?php
        if(isset($_GET['success']))
        {
            if($_GET['success'] === 'emailChanged')
            {
                ?>
                    <h1 class="center_div">Email successfully changed! good job!</h1>
                <?php
            }
            if($_GET['success'] === 'passwordChanged')
            {
                ?>
                    <h1 class="center_div">Password successfully changed! Good boi!</h1>
                <?php
            }
        }
        ?>

        <h1>Edit account credentials</h1><br>
        <a href = "change_email.php" type="submit" class="btn">Change email</a>
        <a href = "change_password.php" type="submit" class="btn">Change password</a>

        <form action="include/delete_user.inc.php" method="post" onsubmit="return confirm('WARNI WARNI, this is permanent!')">
            <input name="delete_myself" id="delete_myself" type="hidden" value="<?php echo $_SESSION["userid"] ?>">
            <td>
                <button type="submit" class="btn">Delete your account</button>
            </td>
        </form>

        <h1>Shopping history</h1><br>
        <?php

            for($i = sizeof($shop_hist) - 1; $i >= 0; $i--)
            {
                ?>        
                    <?php echo $shop_hist[$i][0] ?> - Unit price:  <?php echo $shop_hist[$i][4] ?> - Amount: <?php echo $shop_hist[$i][1] ?> - Date/Time: <?php echo $shop_hist[$i][2] ?>

                    <?php
                        if($reviews)
                        {
                            $no_review = true;
                            for($j = 0; $j < sizeof($reviews); $j ++)
                            {
                                if($reviews[$j][0] === $shop_hist[$i][3])
                                {
                                    ?>
                                        <a class="btn" href = "user_review.php?productID=<?php echo $shop_hist[$i][3]?>" >Edit review</a><br>
                                    <?php
                                    $no_review = false;
                                }
                            }
                            if($no_review)
                            {
                                ?>
                                    <a class="btn" href = "user_review.php?productID=<?php echo $shop_hist[$i][3]?>" >Add review</a><br>
                                <?php
                            }
                        }
                        else 
                        {
                            ?>
                                <a class="btn" href = "user_review.php?productID=<?php echo $shop_hist[$i][3]?>">Add review</a><br>
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

    