<?php
    require_once 'cookies.php';
?>

<script>
    function save_scroll()
    {
        var scroll_y = document.body.scrollTop;
        set_cookie("scrollY", scroll_y);
        
    }

    function set_scroll()
    {
        var scrollY = getCookie("scrollY");
        window.scrollTo(0, scrollY);
        set_cookie("scrollY", 0);
    }

    function button_press_scroll(link)
    {
        save_scroll();

        window.location.href = link;
    }

    function button_press(link)
    {
        window.location.href = link;
    }
</script>
