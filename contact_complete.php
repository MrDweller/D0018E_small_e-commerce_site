<?php
    include_once 'header.php';


    if(isset($_POST["submit"]))
    {
        $message = $_POST["subject"];


        # insert shiet here



        $filename = 'angry_letters/'+$us

        $handle = fopen('angry_letters/asseater.txt', 'w');

        fwrite($handle, $message);
        fclose($handle);

?>  

    <h1 class="center_div">ZANG KYO FOR YOUR OPINION, WE DONT CARE(ok we CARE)!</h1>

    <?php
    }
    ?>

      
<?php
    include_once 'footer.php';
?>