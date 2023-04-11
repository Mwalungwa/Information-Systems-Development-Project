<?php
    // Start the session
    session_start();

    // Check if user is logged in, if not redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-commerce";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the current user's name from the session
    $current_user = $_SESSION["username"];

    // Retrieve user details from the database for the current user only
    $sql = "SELECT * FROM users WHERE username ='$current_user'";
    $result = $conn->query($sql);

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Details | <?php echo $current_user; ?></title>
        <link rel="stylesheet" href="user_details.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="header">
            <h1>User Details</h1>
            <div class="user-icon">
                <?php echo $current_user; ?>
            </div>
        </div>

        <div class="container mt-5">
            <table class="table table-bordered">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                </tr>
                <?php
                    // Output the user's details
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["address"] . "</td></tr>";
                        }
                    }
                ?>
            </table>
        </div>

      
    </body>
</html>
