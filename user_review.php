<?php
    include_once 'header.php';
?>

    <form class="center_div" action="include/review_submit.inc.php" method="post">
        <input id="productID" name="productID" type="hidden" value="<?php echo $_GET["productID"]?>">
        <textarea id="review" name="review" placeholder="Enter your opinion..." value=""> </textarea><br>
        
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        </select><br>

        <button class="btn" type="submit" id="submit" name="submit">Submit review</button>
    </form>

<?php
    include_once 'footer.php';
?>