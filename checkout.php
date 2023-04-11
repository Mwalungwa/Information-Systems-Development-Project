<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Start the session (if not already started)
                    session_start();

                    // Get the user id from the session
                    $userId = $_SESSION['username'];

                    // Connect to the database
                    $conn = new mysqli("localhost", "root", "", "e-commerce");

                    // Check for database connection errors
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Get the cart items for the current user
                    $sql = "SELECT `cart` FROM `users` WHERE `username`='$userId'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $cart_items = explode(",", $row["cart"]);

                        $total_price = 0;

                        // Loop through the cart items and display them in the table
                        foreach ($cart_items as $item_id) {
                            $sql_item = "SELECT * FROM `items` WHERE `id`='$item_id'";
                            $result_item = $conn->query($sql_item);

                            if ($result_item->num_rows > 0) {
                                $row_item = $result_item->fetch_assoc();
                                $item_name = $row_item["item_name"];
                                $item_price = $row_item["price"];
                                $total_price += $item_price;
                                echo "<tr><td>$item_name</td><td>Kshs $item_price</td></tr>";
                            }
                        }

                        // Display the total price row
                        echo "<tr><td>Total Price:</td><td>Kshs $total_price</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </tbody>
        </table>
        <div class="discount">
            <label class="discount label" for="discount-code">Discount Code:</label>
            <input type="text" id="discount_code" name="discount-code">
            <button type="button" class="apply-discount">Apply Discount</button>
        </div>
        <div class="payment">
            <h2>Choose Payment Method</h2>
            <ul class="payment-icons">
                <a href=""><img class="payment-icons-image" src="mpesa_icon.jpeg" alt="M-Pesa"></a>
                <a href=""><img class="payment-icons-image" src="paypal-logo.png" alt="PayPal"></a>
                <a href=""><img class="payment-icons-image" src="visa_icon.jpg" alt="Visa"></a>
            </ul>
            <div class =  "paying">
            <p>Total Amount: Kshs <span class="total-amount"><?php echo $total_price ?></span></p>
            <button type="button" class="checkout-btn">Proceed to Payment</button>
            </div
        </div>
    </div>
</body>
</html>
