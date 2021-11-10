<?php
    include_once 'header.php';
?>

<section class="row">
    <div class="col-2">
        <div class="contact-form-form">
            <h2> Contact us </h2>
            <form action="include/contacts.inc.php" method="post">

                <label for="fname">First Name:</label><br>
                <input type="text" id="fname" name="firstname" placeholder="Enter your name.."><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" id="lname" name="lastname" placeholder="Enter your last name.."><br>

                <label for="country">Continent:</label><br>
                <select id="continent" name="continent">
                <option value="africa">Africa</option>
                <option value="asia">Asia</option>
                <option value="antarctica">Antarctica</option>
                <option value="aus">Australia</option>
                <option value="europa">Europa</option>
                <option value="na">North America</option>
                <option value="sa">South America</option>
                </select><br>

                <label for="subject">Subject:</label><br>
                <textarea id="subject" name="subject" placeholder="Write something.."></textarea><br>
                <button class="btn" type="submit" name="submit"> Submit </button>

                <?php

                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"] == "emptyinput")
                        {
                            echo "<p> Fill in all fields!</p>";
                        }

                        if($_GET["error"] == "invalidFname")
                        {
                            echo "<p> Not a valid first name </p>";
                        }

                        if($_GET["error"] == "invalidLname")
                        {
                            echo "<p> Not a valid last name </p>";
                        }
        
                    }

                ?>

            </form>
        </div>
    </div>

    <div class="col-2">
        <br>
        <h2>Aliroad</h2>
        <img id="Aliroad" src="media/logo.png">

        <h3> <i class="fa fa-map-marker"></i> Location:</h3>
            <ul>
                <a href="https://www.google.com/maps/place/Lule%C3%A5+Tekniska+Universitet/@65.6172496,22.1394371,15.06z/data=!4m5!3m4!1s0x467f65109fea2c99:0xd261b63661083957!8m2!3d65.6179964!4d22.1401794">
                    Luleå Tekniska Universitet</a>
            </ul>


        <h3> &#9742; Phone:</h3>
            <ul>
                +46730605560
            </ul>


        
        <h3> &#64; Email:</h3>
            <ul>
                <a href = "mailto: arimas-8@student.ltu.se">arimas-8@student.ltu.se</a><br>
                <a href = "mailto: jesfri-8@student.ltu.se">jesfri-8@student.ltu.se</a><br>
                <a href = "mailto: frastc-9@student.ltu.se">frastc-9@student.ltu.se</a><br>
            </ul><br>
    </div>





</section>




<?php
    include_once 'footer.php';
?>