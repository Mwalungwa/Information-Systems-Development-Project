<?php
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

    // Check if input fields are empty
  if (empty($email) || empty($password)) {
    $error = "Please fill in all fields.";
  }

  // Check if user exists in the database
  else{
      $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // User exists, set session variables and redirect to home page
        // Retrieve the username from the database and store it in the session variable
        $user = $result->fetch_assoc()["username"];
        $_SESSION["username"] = $user;
        $_SESSION["loggedin"] = true;
        header("Location: home.php");
        exit();
        }

      else {
        // User does not exist, show error message
        $error = "Invalid login credentials.";
      }
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6 col-sm-12">
				<div class="card">
					<div class="card-header  bg-dark text-white">
						<h4 class="mb-0">Login to Clothing E-Commerce</h4>
					</div>
					<div class="card-body">
						<form action="login.php" method="post">
							<div class="mb-3">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
							</div>
							<div class="mb-3">
								<label for="password">Password:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
						<?php if (isset($error)) { ?>
                            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                        <?php } ?>
					</div>
					<div class="card-footer">
						<p class="text-center mb-0">Don't have an account? <a href="register.php">Sign up</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>

