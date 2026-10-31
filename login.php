<?php
session_start();
$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;
require "db.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $conn->prepare("SELECT customer_id, password, first_name, last_name FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["customer_id"];
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["last_name"] = $user["last_name"];
        $_SESSION["logged_in"] = true;
        header("Location: login.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ace Login</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/ace.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="menu_bar"> 
        <img src="Assets/Images/ace logo 2.png" alt="Logo" class="acelogo"> 

        <div class = "hamburger" id = "hamburger">&#9776;</div>

        <ul class = "nav-links" id = "nav-links"> 
            <li class = "nav-item"><a href= "index.php" class = "nav-link">Home</a></li> 
            <li class = "nav-item"><a href="about-us.php" class = "nav-link">About</a></li> 
            <li class = "nav-item"><a href="accessories.php?page=1" class = "nav-link">Accessories</a></li> 
            <li class = "nav-item"><a href="personalise.php" class = "nav-link">Personalise Your Water Bottle</a></li>
            <li class="nav-item">
                <a href="cart.php" class="nav-link">
                    Cart(<span id="cartCount"><?= $totalCartItems ?></span>)
                </a>
            </li>

            <li class="login-dropdown">
              <a href="#" class = "nav-link">Account &#9662;</a>
              <div class="dropdown_menu">
                <ul>
                  <li><a href="login.php" class = "nav-item">Login</a></li>
                  <li><a href="register.php" class = "nav-item">Register</a></li>
                </ul>
              </div>
            </li>
        </ul> 
    </div>

    <div class="wrapper">
        <?php if (isset($_SESSION["user_id"])): ?>
            <div class="profile-box">
                <h1>Welcome, <?= htmlspecialchars($_SESSION["first_name"] . " " . $_SESSION["last_name"]) ?>!</h1>
                <form action="logout.php" method="post">
                    <button type="submit" class="logout-btn">Log out</button>
                </form>
            </div>

        <?php else: ?>

            <form method="post" action="login.php">
                <h1>Login</h1>
                <?php if ($error): ?>
                    <p class="login-error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <img src="Assets/Images/email_icon.png" alt="email icon" class="login-icon">
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <img src="Assets/Images/password_icon.png" alt="password icon" class="login-icon">
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </form>

<?php endif; ?>
                </div>
<div class="website-footer">
  <div class="footer-container">

    <div class="footer-content">
      <h3>Shop by category</h3>
      <ul>
        <li><a href="personalise.php">Water bottle</a></li>
        <li><a href="accessories.php">Accessories</a></li>
    </ul>
    </div>

    <div class="footer-content">
      <h3>Company</h3>
      <ul>
        <li><a href="about-us.php">About us</a></li>
        <li><a href="contact.php">Contact us</a></li>
      </ul>
    </div>

    <div class="footer-content">
      <h3>Contact details</h3>
      <p class="contact-label">Email:</p>
      <p class="contact-value">ace.ilemaurice@gmail.com</p>

      <p class="contact-label">Point of Sale:</p>
      <p class="contact-value">Cascavelle Mall, Bagatelle Mall, and Tribeca Mall</p>
    </div>

  </div>

  <div class="footer-bottom">
    <div class="footer-bottom-container">
      <div class="footer-logo">
        <img src="Assets/Images/ace logo.png" alt="Ace Logo">
      </div>
  </div>
</div>
    </body>
</html> 