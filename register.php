<?php
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
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $password = $_POST["password"];

     // Check if input fields are empty
  if (empty($email) || empty($password)) {
    $error = "Please fill in all fields.";
  }

  else{
      // Insert user details into database
      $sql = "INSERT INTO users (username, email, phone, address, password) VALUES ('$name', '$email','$phone','$address', '$password')";

      if ($conn->query($sql) === TRUE) {
        // Redirect to login page
        header("Location: login.php");
        exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
	<title>Register</title>
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
					<div class="card-header bg-dark text-white">
						<h4>Register</h4>
					</div>
					<div class="card-body">
						<form action="register.php" method="post">
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
							</div>
							<div class="form-group">
                                <label for="phone">Phone number:</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
	                        </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                            </div>
							<div class="form-group">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
							</div>
							<div class="form-group">
								<label for="confirm-password">Confirm Password:</label>
								<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm password">
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
						<?php if (isset($error)) { ?>
                            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
