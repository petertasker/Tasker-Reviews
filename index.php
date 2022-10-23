<?php
require_once "config.php";
require_once "session_start.php";
// require_once "redirect_login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Guitar Review</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css"/>
  </head>
<body>
  <div id="top">
    <?php
    // if session names are set the bar at the top displays 'my reviews'
    // and 'sign out'. If they arent set it displays 'log in'
    if (isset($_SESSION['forename'])) {
      $username = $_SESSION['username'];
      ?>

      <p>Hello, <?php echo $_SESSION['forename'] ?> </p>
    
      <ul>
        <a class="nav-link" href="?logout">Sign Out</a>
        <a class="nav-link" href="myreviews.php">My reviews</a>
    </ul>
    <?php
    } else {
      echo "<a href='login.php'>Log in here</a>";
    }
    // Logs out the user when the link is clicked
    if(isset($_GET['logout'])) {
      session_unset();
      }
    ?>

  </div>
  <div style="clear:both"></div>
  <section>
    <div id="main-div-1">
    <div class="image">
      <img class="image__img" src="media/guitarsquare.jpg" alt="Guitar">
      <div class="image__overlay">
        <div class="image__title">
          <a class="link" href="guitarreview.php">Review guitar</a>
        </div>
        <p class="image__description">
          Click above to review a guitar.
        </p>
      </div>
    </div>
    <div class="image"> 
        <img class="image__img" src="media/accessory2.jpg" alt="Accessory">
        <div class="image__overlay">
          <div class="image__title">
            <a class="link" href="accessoryreview.php">Review accessory</a>
          </div>
          <p class="image__description">
            Click above to review an accessory.
          </p>
        </div>
      </div>
    </div>
  </section>
  <div id="main-div-2">
    <div class="image" style="width:100% !important">
      <img class="image__img" src="media/review.jpg" alt="Review">
      <div class="image__overlay">
        <div class="image__title">
          <a class="link" href="searchreview.php">Find Reviews</a>
        </div>
        <p class="image__description">
          Click above to find reviews.
        </p>
      </div>
    </div>
  </div>
</body>
</html>

