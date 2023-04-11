<?php
    // Start the session (if not already started)
    session_start();

    // Check if the add_to_cart button was clicked
    if(isset($_POST['add_to_cart'])) {
        // Get the item id from the form data
        $itemId = $_POST['item_id'];

        // Get the user id from the session
        $userId = $_SESSION['username'];

        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "e-commerce");

        // Check for database connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the cart column is currently 0
        $sql_check = "SELECT `cart` FROM `users` WHERE `username`='$userId'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $row = $result_check->fetch_assoc();
            $cart = $row["cart"];
            if ($cart == 0) {
                // If cart is 0, replace it with the new item id
                $sql = "UPDATE `users` SET `cart`='$itemId' WHERE `username`='$userId'";
            } else {
                // Otherwise, concatenate the new item id to the existing cart value
                $sql = "UPDATE `users` SET `cart`=CONCAT(`cart`, ',$itemId') WHERE `username`='$userId'";
            }

            // Execute the SQL query
            if ($conn->query($sql) === TRUE) {
                // Start output buffering
                ob_start();

                // Redirect the user back to the previous page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;

                // Flush output buffer
                ob_end_flush();
            } else {
                echo "Error adding item to cart: " . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
    }
?>
