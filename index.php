<!DOCTYPE html>
<html lang="en">
<head>
  <title>Peters Guitar Logger!</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<?php   
  // connect to database for datalist query  
  // create connection
  $conn = mysqli_connect("localhost", "root", "password", "guitardatabase");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>

  <div>
    <form action="process.php" method="post">
      <!--
      Will be a select dropdown from already submitted brands, but Will
      be able to be added to.
      -->
      <p>
        <label for="make">Guitar Make:</label> 
        <input type="text" name="make"><br>
      </p>

      <p>
        <label for="brandName">Manufacturer:</label>
        <input type="text" name="brandName" list="brands">

        <datalist id="brands">
        <?php
          // Query and result of query.
          // This will show as a drop down menu to try and prevent duplicate
          // data.
          $sql = "SELECT brandName FROM brand";
          $result = mysqli_query($conn, $sql);
          foreach ($result as $row) {
          
          echo "<option value='$row[brandName]'/>"; }
        ?>
        
 

        </datalist>
      </p> 

      <p>
        <label for="type">Guitar type</label>
        <select>
          <option value="Electric">Electric</option>
          <option value="Acoustic">Acoustic</option>
          <option value="Classical">Classical</option>
          <option value="Bass">Bass</option>
        </select>
      </p>

      <p>
        <label for="wood">Wood</label>
        <input type="text" name="wood">
      </p>

      <p>
        <label for="yearProduced">Year Produced</label>
        <!-- PHP Sets max year as current year -->
        <input type="number" id="year-produced" min="1900" max="<?php echo date("Y");?>" name="yearProduced">
      </p>

      <p>
        <input type="submit" value="Submit">

    </form>
  </div>

<?php 
  //close connection
  mysqli_close($conn);
?>
</body>
</html>
