    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>APPDOWNLOAD</h3>
                    <p>For android and ios</p>
                    <div class="app-logo">
                        <img src="media/app-store.png">
                        <img src="media/play-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img id="Aliroad" src="media/logo.png">
                    <p>cheap shit for cheap price</p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful shit</h3>
                    <ul>
                        <!-- add anchortags -->
                        <li>Read more</li> </a> 
                        <li>Join our affiliation</li>
                        <li>Return policy</li>
                    </ul>
                </div>

                <div class="footer-col-3">
                    <h3>We are on</h3>
                    <ul>
                        <!-- add anchortags -->
                        <li><a href="https://discord.gg/3eSaF8aHYD" style="color: #ffff">Discord</li></a>
                        <li>Youtube</li>
                        <li>Instagram</li>
                    </ul>
                </div>
            </div>
            <hr><p class="copyright">&copy; 2021 Aliroad Inc by MrDweller, MrBoi and Mr51</p>
        </div>
    </div>

</body>
</html>

<script>
    set_scroll();
</script>

<?php
# Cookie alert
require_once 'javascript/cookies.php'
?>
<script>
    cookie_alert = getCookie("cookie_alert");
    if(cookie_alert == 0)
    {
        alert("On aliroad we use cookies.\nOur cookies is for functionality only!");
        set_cookie("cookie_alert", 1);
    }
</script>