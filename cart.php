<?php
  // Start the session (if not already started)
  session_start();

  // Connect to the database
  $conn = new mysqli("localhost", "root", "", "e-commerce");

  // Check for database connection errors
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Get the user id from the session
  $userId = $_SESSION['username'];

  // Get the user's cart items from the database
  $sql = "SELECT `cart` FROM `users` WHERE `username`='$userId'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $cartItems = explode(",", $row["cart"]);

      // Initialize total price to 0
      $totalPrice = 0;

      // Display cart items in a table
      echo '
      <html>
      <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="cart.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </head>
      <body>
        <div class="container">
          <h2>Shopping Cart</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Item Details</th>
                <th>Item Price</th>
                <th>Item Image</th>
              </tr>
            </thead>
            <tbody>';

      // Loop through each item in the cart and display its details
      foreach ($cartItems as $itemId) {
          // Get the item details from the database
          $sql_item = "SELECT * FROM `items` WHERE `id`='$itemId'";
          $result_item = $conn->query($sql_item);

          if ($result_item->num_rows > 0) {
              $row_item = $result_item->fetch_assoc();
              $itemName = $row_item["item_name"];
              $itemDetail = $row_item["details"];
              $itemPrice = $row_item["price"];
              $itemImage = $row_item["image"];

              // Add the item price to the total price
              $totalPrice += $itemPrice;

              // Display the item details in the table row
              echo '
              <tr>
                <td>' . $itemName . '</td>
                <td>' . $itemDetail . '</td>
                <td>Kshs ' . number_format($itemPrice, 2) . '</td>
                <td><img src="' . $itemImage . '" height="100"></td>
              </tr>';
          }
      }

      // Display the total price
      echo '
            </tbody>
          </table>
          <div class="text-center">
            <div class="col-md-12">
              <h4 class="pull-centre total_price">Total Price: Kshs ' . number_format($totalPrice, 2) . '</h4>
              <a href="checkout.php" class="btn btn-primary btn-lg checkout_btn">Checkout</a>
            </div>
          </div>
        </div>
      </body>
      </html>';
  } else {
      echo "No items in cart.";
  }

  // Close the database connection
  $conn->close();
?>
