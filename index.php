<!DOCTYPE html>
<html lang="en">
<head>
  <title>Peters Guitar Logger!</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php   
  // connect to database for datalist query  
  //create connection
  $conn = new mysqli("localhost", "username", "password", "GuitarDatabase");

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  $query = "SELECT brandName from Brand";
  $result = ($conn->query($query));
  //declare array to store the data of database
  $row = []; 
  $result = $conn->query($query);

  if ($result->num_rows > 0) 
  {
      // fetch all data from db into array 
      $row = $result->fetch_all(MYSQLI_ASSOC);
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
        <input type="text" name="make">
      </p>

      <p>
        <label for="brandName">Manufacturer:</label>
        <input type="text" name="brandName" list="brands">
        <!-- This will show all the brands already in the database, but will
            allow the user to insert new ones, to hopefully lessen duplicate
            data. -->
        <datalist id="brands">
    



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
        <input type="number" min="1900" max="2099" name="yearProduced">
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


<!--
Brand:
  brandName
  dateEstablished

Guitar:
  guitarID
  make
  brandName*
  type
  wood
  yearProduced

Users:
  userID
  username
  password

OwnedGuitars:
  userID*
  guitarID*
-->