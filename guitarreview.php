<?php 

require_once "config.php";
require_once "session_start.php";
// require_once "redirect_login.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guitar Review</title>   
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="form-body">
        <section class="item-review">
            <div class="box">
                <form>
                    <h1>Review A Guitar</h1>
                    <input name="make" class="input" type="text" placeholder="*Make of Guitar"required>
                    <input name="brand" class="input" type="text" placeholder="*Brand" required>
                    <input name="cost" class="input" type="number" placeholder="Cost" min="0.00" max="9999999.99" step="0.01">
                    <input name="year-made" class="input" type="number" placeholder="Year Made" min="1900" max="<?php echo date("Y"); ?>">
                    <textarea name="review-text" class="input review-textarea" type="text" placeholder="Review Text" rows="4" cols="50"></textarea>
                    <input name="star-rating" type="number" class="input" required>
                </form>
            </div>
        </section>
        <section class="review-review">

        </section>
    </body>
</html>
