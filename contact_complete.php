<?php
    include_once 'header.php';
    require_once 'include/db.inc.php';
    require_once 'include/contact_functions.inc.php';


    if(isset($_POST["submit"]))
    {
        $message = $_POST["subject"];
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];

        # insert shiet here
        if(isset($_SESSION["userid"]))
        {
            $userid = $_SESSION["userid"];
            $filename = add_contact_info($conn, $userid, $fname, $lname, $message);
            
            $handle = fopen($filename, 'w');

            fwrite($handle, $message);
            fclose($handle);
        }
        

        

?>  

    <h1 class="center_div">ZANG KYO FOR YOUR OPINION, WE DONT CARE(ok we CARE)!</h1>

    <?php
    }
    ?>

      
<?php
    include_once 'footer.php';
?>