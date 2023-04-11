<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Men's Fashion</title>
    <script src="https://kit.fontawesome.com/dc4473b3aa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">

</head>
<body>
  <header>
    <div class="container">
      <a href="home.php" class="logo">Fashion Drips <p></a>
      <nav>
        <ul>
          <li><a href="men.php">Men's Fashion</a></li>
          <li><a href="women.php">Women's Fashion</a></li>
          <li><a href="children.php">Children's Fashion</a><p></li>
        </ul>
      </nav>
      <div class = "user_item">
          <div class="cart">
           <a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping" style="color: #fafcd6; padding-right:5px;"> </i>Cart</a>
          </div>
          <div class="user">
            <a href="user_details.php" class="user" ><i class="fa-solid fa-user" style="color: #fafcd6; padding-right:5px;"> </i> <?php echo $_SESSION['username']; ?></a>
          </div>
      </div>
    </div>
  </header>

	<div class="container">
		<h1>Children's Fashion</h1>
        <div class = "row">
            <?php
                // Connect to the database
                $conn = new mysqli("localhost", "root", "", "e-commerce");

                // Check for database connection errors
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query the database for men's items
                $sql = "SELECT id,item_name, price, image FROM items WHERE category='children'";
                $result = $conn->query($sql);

                // If there are items in the database, display them
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $itemId = $row["id"];
                        $itemName = $row["item_name"];
                        $price = $row["price"];
                        $image = $row["image"];

                        echo "<div class='row my_items'>";
                        echo "<div class='col-md-6'>";
                        echo "<div class='card my_card'>";
                        echo "<img class='img-thumbnail card-img-top images' src='$image' alt='$itemName'>";
                        echo "<div class='card-body'>";
                        echo "<h4 class='card-title'>$itemName</h4>";
                        echo "<p class='card-text'>Kshs $price</p>";
                        echo "<form method='POST' action='add_to_cart.php'>";
                        echo "<input type='hidden' name='item_id' value='$itemId'>";
                        echo "<button type='submit' class='btn btn-primary' name='add_to_cart'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div></div></div></div>";
                    }

                } else {
                    echo "No items found in the database.";
                }

                // Close the database connection
                $conn->close();
            ?>
        </div>
	</div>


</body>
</html>