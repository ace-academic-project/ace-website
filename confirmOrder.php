<?php
include 'db.php';
session_start();
$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;

$bottleCount = count($_SESSION['cart']);
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
        <link rel="stylesheet" href="css/confirmOrder.css">
        <link rel="stylesheet" href="css/cart.css">

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
    <div class="cart-body">
        <h1 class = "your-cart">Confirm Your Order</h1>
        
        <?php

        $result = $conn->query("
            SELECT *
            FROM (
                SELECT *
                FROM personalisations
                ORDER BY personalisationID DESC
                LIMIT $bottleCount
            ) AS latest
            ORDER BY personalisationID ASC
        ");
        

        while ($item = $result->fetch_assoc()) {
            $colourID = $item['colourID'];
            $capID    = $item['capID'];
            $iconID   = $item['iconID'];
            $totalPrice = $item['Price'];

            $colourResult = $conn->query(
                "SELECT colour, colourImage FROM bottle_colours WHERE colourID = $colourID"
            );
            $colour = $colourResult->fetch_assoc();
            $bottleColour = $colour['colour'];

            $capResult = $conn->query(
                "SELECT capColour, capImage FROM caps WHERE capID = $capID"
            );
            $cap = $capResult->fetch_assoc();
            $capColour = $cap['capColour'];

            $iconName = 'None';

            if ($iconID != 0) {
                $iconResult = $conn->query(
                    "SELECT iconName, iconImage FROM icons WHERE iconID = $iconID"
                );
                $icon = $iconResult->fetch_assoc();
                $iconName = $icon['iconName'];
            }
        ?>
        

            <div class="cart-product">
                <div class="cart-product-display">

                    <div class="bottle-display">
                        <img src="<?= $colour['colourImage']; ?>" alt="colour">                
                    </div>

                    <div class="cap-display">
                        <img src="<?= $cap['capImage']; ?>" alt="cap">   
                    </div>

                    <div class="icon-display">
                        <?php if ($iconID > 0) { ?>
                            <img src="<?= $icon['iconImage']; ?>" alt="icon" ? style="display:block;">                    
                        <?php } ?>
                    </div>

                </div>
                    <div class="info">
                <h1 id="product-heading">Personalised Water Bottle</h1>
                <div class="details">
                    <p >Bottle Colour : <span><?= $bottleColour ?></span></p>
                    <p >Cap Colour : <span><?= $capColour ?></span></p>
                    <p >Icon : <span><?= $iconName ?></span></p>
                </div>
                <p class="total-price">Price : Rs <span><?= $totalPrice ?></span></p>
            </div>
            </div>
        <?php
}
?>
        <?php
    if (!empty($_SESSION['accessoriesCart'])) {
        foreach ($_SESSION['accessoriesCart'] as $item) {

            $accessoriesID = $item['accessoriesID'];

            $accessoriesResult = $conn->query(
                "SELECT accessoriesName, accessoriesImage,accessoriesPrice FROM accessories WHERE accessoriesID = $accessoriesID"
            );
            $accessories = $accessoriesResult->fetch_assoc();
            $accessoriesName = $accessories['accessoriesName'];
            $accessoriesPrice = $accessories['accessoriesPrice'];
        }

        ?>
        

            <div class="cart-product">
                <div class="cart-product-display">

                    <div class="bottle-display">
                        <img src="<?= $accessories['accessoriesImage']; ?>" alt="accessories">                
                    </div>
                </div>
                    <div class="info">
                <h1 id="product-heading">Accessories</h1>
                <div class="details">
                    <p >Accessorie Name : <span><?= $accessoriesName ?></span></p>
                </div>
                <p class="total-price">Price : Rs <span><?= $accessoriesPrice ?></span></p>
            </div>
            </div>
        <?php
}
?>
        <div class="cart-buttons">
            <p class="bottle-count">
                Bottles: <span id="bottleCount">
                    <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                </span>
            </p>
            <p class="bottle-count">
            Accessories: <span id="bottleCount">
                <?= isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0 ?>
            </span>
        </p>
            <button class="confirm-btn" onclick="window.location.href='completeOrder.php'">
                Confirm Order
            </button>
            <button class="cancel-order" onclick="window.location.href='cancelOrder.php'">
                Cancel Order
            </button>
        </div>
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
