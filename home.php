<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <script src="https://kit.fontawesome.com/dc4473b3aa.js" crossorigin="anonymous"></script>
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
  <main>
    <div class="container">
      <h1>Welcome to Fashion Drips</h1>
        <div class="icons center">
            <div height=200px; width = 100px;>
            <a href="men.php"><img class="img" src="men_image.png"></i></a>
            <a href="men.php"><i class="fa-solid fa-person center"></i></a>
            </div>
            <div height=200px; width = 100px;>
            <a href="women.php"><img class="img" src="her_image.jpg"></a>
            <a href="women.php"><i class="fa-solid fa-person-dress  center"></i></a>
            </div>
            <div height=200px; width = 100px;>
            <a href="children.php"><img  class="img" src="child_image.jpg"></i></a>
            <a href="children.php"><i class="fa-solid fa-baby center"></i></a>
            </div>
        </div>
    </div>
  </main>
  <footer>
    <div class="container">
      <p>&copy; 2023 Fashion Drips</p>
    </div>
  </footer>
</body>
</html>
