<?php
    require_once 'header.php';
    require_once 'admin_header.php';
?>
    <table class="center">
        <tr>
            <th style="padding-right: 20px;">Product name</th>
            <th style="padding-left: 40px;">Image</th>
            <th style="padding-left: 10px;">Price</th>
            <th style="padding-left: 30px;">Quantity</th>
        </tr>
        <?php
            require_once 'include/admin_functions.inc.php';
            $product_array = get_all_products($conn);
            for($i = 0; $i < sizeof($product_array); $i++)
            {
                ?>
                    <tr>
                        <td class="user_column"><?php echo $product_array[$i][1] ?></td>
                        <td class="user_column"><img class="img_admin" src=<?php echo $product_array[$i][2] ?>></td>
                        <td class="user_column"><?php echo $product_array[$i][3] ?></td>

                        <td  onclick="button_press_scroll('include/alter_quantity.inc.php?prodID=<?php echo $product_array[$i][0]; ?>&minus')" class="btn_product_settings_down" >-</td>
                        
                        <td class="user_column"><?php echo $product_array[$i][4] ?></td>

                        <td onclick="button_press_scroll('include/alter_quantity.inc.php?prodID=<?php echo $product_array[$i][0]; ?>&plus')" class="btn_product_settings_down" >+</td>
                    
                        
                        <form action="include/delete_product.inc.php" method="post">
                            <input name="delete_product" id="delete_product" type="hidden" value="<?php echo $product_array[$i][0] ?>">
                            <td>
                                <button type="submit" class="settingsbtn">DELETE</button>
                            </td>
                        </form>

                    
                        
                        
                        
                        
                    </tr>
                    
                <?php
            }
        ?>
    </table>
    <br>

<?php
    require_once 'footer.php';
?>