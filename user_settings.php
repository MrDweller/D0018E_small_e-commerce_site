<?php
    require_once 'header.php';
    require_once 'admin_header.php';
?>
    <table class="center">
        <tr>
            <th style="padding-right: 20px;">User</th>
            <th style="padding-right: 150px;">Email</th>
            <th style="padding-left: 30px;">User Role</th>
        </tr>
        <?php
            require_once 'include/admin_functions.inc.php';
            $user_array = get_all_users($conn);
            for($i = 0; $i < sizeof($user_array); $i++)
            {
                ?>
                    <tr>
                        <td class="user_column"><?php echo $user_array[$i][1] ?></td>
                        <td class="user_column"><?php echo $user_array[$i][2] ?></td>
                        <?php
                            $isAdmin = is_admin($conn, $user_array[$i][0]);
                            $isAli = is_ali($conn, $user_array[$i][0]);
                            if($isAli)
                            {
                                ?>
                                    <td class="user_column">ALI</td>
                                <?php
                            }
                            else if($isAdmin)
                            {
                                ?>
                                    <td class="user_column">Admin</td>
                                <?php
                            }
                            else 
                            {
                                ?>
                                    <td class="user_column">Customer</td>
                                <?php
                            }

                            if(!$isAli)
                            {
                                ?>
                                    <form action="include/delete_user.inc.php" method="post">
                                        <input name="delete_user" id="delete_user" type="hidden" value="<?php echo $user_array[$i][0] ?>">
                                        <td>
                                            <button type="submit" class="settingsbtn">DELETE</button>
                                        </td>
                                    </form>


                                    <form action="include/change_user_role.inc.php" method="post">
                                        <input name="change_user" id="change_user" type="hidden" value="<?php echo $user_array[$i][0] ?>">
                                        <td class="dropdown" style="padding-top: 30px;">
                                            <button class="dropbtn">User role</button>
                                                <div class="dropdown-content">
                                                    <button name="admin" id="admin" type="submit" class=btn2 >Admin</button>
                                                    <button name="customer" id="customer" type="submit" class=btn2 >Customer</button>
                                                </div>
                                        </td>
                                    </form>
                                    
                                    
                                <?php
                            }

                        ?>
                        
                    </tr>
                    
                <?php
            }
        ?>
    </table>
    <br>

<?php
    require_once 'footer.php';
?>