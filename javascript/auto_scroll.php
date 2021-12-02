<script>
    function set_cookie(scrollY)
    {
        document.cookie = "scrollY=" + scrollY;
    }

    function getCookie(cname) 
    {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return parseFloat(c.substring(name.length, c.length));
            }
        }
        return 0;
    }

function save_scroll()
{
    var scroll_y = document.body.scrollTop;
    set_cookie(scroll_y);
    
}

function set_scroll()
{
    var scrollY = getCookie("scrollY");
    window.scrollTo(0, scrollY);
    set_cookie(0);
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
