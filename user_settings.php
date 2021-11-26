<?php
    require_once 'header.php';
    require_once 'admin_header.php';
?>
    <table class="center">
        <tr>
            <th style="padding-right: 20px;">User</th>
            <th style="padding-right: 150px;">Email</th>
        </tr>
        <?php
            require_once 'include/admin_functions.inc.php';
            $user_array = get_all_users($conn);
            for($i = 0; $i < sizeof($user_array); $i++)
            {
                ?>
                    <tr>
                        <td class="user_column"><?php echo $user_array[$i][0] ?></td>
                        <td class="user_column"><?php echo $user_array[$i][1] ?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
    <br>

<?php
    require_once 'footer.php';
?>