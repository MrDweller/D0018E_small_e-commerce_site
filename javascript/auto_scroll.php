<script>
    function excecute_link(link)
    {
        window.location.href = link;
    }

</script>


<?php
    // FINISH SAVING
    if(isset($_POST['scroll_y']))
    {
        $_SESSION['scroll_y'] = $_POST['scroll_y'];
        $_SESSION['link'] = $_POST['link'];
        ?>
            <script>
                excecute_link(<?php echo json_encode($_SESSION['link'])?>);
            </script>
           
        <?php
    }
?>

<script>

function save_scroll()
{
    var scroll_y = document.body.scrollTop;
    document.getElementById('scroll_y').value = scroll_y;
    
}

function set_scroll()
{
    <?php
        
        if(isset($_SESSION['scroll_y']))
        {
            $scroll_y = $_SESSION['scroll_y'];
            ?>
                document.write(<?php echo json_encode($scroll_y)?>);
                document.write(<?php echo json_encode($_SESSION['link'])?>);
                window.scrollTo(0, <?php echo json_encode($scroll_y)?>);

            <?php
        }
    ?>
}

function button_press_scroll(link)
{
    save_scroll();
    document.getElementById('link').value = link;
    document.forms['scroll_pos'].submit();
}

function button_press(link)
{
    document.getElementById('link').value = link;
    document.forms['scroll_pos'].submit();
}

</script>

<form name="scroll_pos" id="scroll_pos" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <input name="scroll_y" id="scroll_y" type="hidden" value="" />
    <input name="link" id="link" type="hidden" value="" />
</form>