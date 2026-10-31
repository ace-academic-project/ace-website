<?php
require "db.php";
session_start();

$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first-name"]);
    $last_name = trim($_POST["last-name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm-password"];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT customer_id FROM customer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "This email is already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed);
            $stmt->execute();

            header("Location: login.php");
            exit;
        }
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
                <form method="post" action="register.php">
                    <h1>Register</h1>

                    <?php if ($error): ?>
                        <p class="login-error"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <div class="input-box">
                    <input type="text" name="first-name" placeholder="First Name" value="<?= htmlspecialchars($_POST['first-name'] ?? '') ?>" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="last-name" placeholder="Last Name" value="<?= htmlspecialchars($_POST['last-name'] ?? '') ?>" required>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        <img src="Assets/Images/email_icon.png" alt="email icon" class="login-icon">
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required>
                        <img src="Assets/Images/password_icon.png" alt="password icon" class="login-icon">
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirm-password" placeholder="Confirm Password" required>
                        <img src="Assets/Images/password_icon.png" alt="password icon" class="login-icon">
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" name="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
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