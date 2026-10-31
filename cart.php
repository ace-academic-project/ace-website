<?php
$isLoggedIn = false;

session_start();
$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;


if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    $isLoggedIn = true;
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ace Login</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/ace.css">
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
        <h1 class = "your-cart">Your Cart</h1>
        <?php if (!empty($_SESSION['cart']) || !empty($_SESSION['accessoriesCart'])): ?>

    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>

        <?php
        $colourID = $item['colourID'];
        $capID    = $item['capID'];
        $iconID   = $item['iconID'];

        $colourResult = $conn->query(
            "SELECT colour,colourImage,Price FROM bottle_colours WHERE colourID = $colourID"
        );
        $colour = $colourResult->fetch_assoc();
        $bottleColour = $colour['colour'];
        $bottlePrice = $colour['Price'];

        $capResult = $conn->query(
            "SELECT capColour,capImage,Price FROM caps WHERE capID = $capID"
        );
        $cap = $capResult->fetch_assoc();
        $capColour = $cap['capColour'];
        $capPrice = $cap['Price'];

        $iconImage = '';
        $iconPrice = 0;
        $iconName = 'None';

        if ($iconID != 0) {
            $iconResult = $conn->query(
                "SELECT iconName,iconImage,Price FROM icons WHERE iconID = $iconID"
            );
            $icon = $iconResult->fetch_assoc();
            $iconName = $icon['iconName'];
            $iconPrice = $icon['Price'];
        }
        $totalPrice = $bottlePrice + $capPrice + $iconPrice;
        ?>

        <div class="cart-product">
            <div class="cart-product-display">

                <div class="bottle-display">
                    <img src="<?= $colour['colourImage']; ?>" alt="<?= $colour['colour'] ?>">                
                </div>

                <div class="cap-display">
                    <img src="<?= $cap['capImage']; ?>" alt="<?= $cap['capColour'] ?>">   
                </div>

                <div class="icon-display">
                    <?php if ($iconID > 0) { ?>
                        <img src="<?= $icon['iconImage']; ?>" alt="<?= $icon['iconName'] ?>"style="display:block;">                    
                    <?php } ?>
                </div>

            </div>
            <div class="info">
                <button class="remove-item" onclick="removeItem(<?= $index ?>, 'cart')">
                    ✖
                </button>
                <h1 id="product-heading">Personalised Water Bottle</h1>
                <div class="details">
                    <p >Bottle Colour : <span><?= $bottleColour ?></span></p>
                    <p >Cap Colour : <span><?= $capColour ?></span></p>
                    <p >Icon : <span><?= $iconName ?></span></p>
                </div>
                <p class="total-price">Price : Rs <span><?= $totalPrice ?></span></p>
            </div>
        </div>

        <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['accessoriesCart'])): ?>
        <?php foreach ($_SESSION['accessoriesCart'] as $index => $item): ?>

        <?php
        $accessoriesID = $item['accessoriesID'];
        $accessoriesResult = $conn->query(
            "SELECT accessoriesName,accessoriesImage,accessoriesPrice FROM accessories WHERE accessoriesID = $accessoriesID"
        );
        $accessories = $accessoriesResult->fetch_assoc();
        $accessoriesName = $accessories['accessoriesName'];
        $accessoriesPrice = $accessories['accessoriesPrice'];
        ?>

        <div class="cart-product">
            <div class="cart-product-display">

                <div class="bottle-display">
                    <img src="<?= $accessories['accessoriesImage']; ?>" alt="<?= $accessories['accessoriesName'] ?>">                
                </div>


            </div>
            <div class="info">
                <button class="remove-item" onclick="removeItem(<?= $index ?>, 'accessoriesCart')">
                    ✖
                </button>
                <h1 id="product-heading">Accessories</h1>
                <div class="details">
                    <p >Accessories Name : <span><?= $accessoriesName ?></span></p>
                    <br>
                    <br>
                    <br>
                </div>
                <p class="total-price">Price : Rs <span><?= $accessoriesPrice ?></span></p>
            </div>
        </div>

        <?php endforeach; ?>
        <?php endif; ?>
        <?php else: ?>

        <p class="empty-cart">Your cart is empty.</p>

    <?php endif; ?>
    <div class="cart-buttons">
        <p class="bottle-count">
            Bottles: <span id="bottleCount">
                <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
            </span>
        </p>
        <p class="accessories-count">
            Accessories: <span id="accessoriesCount">
                <?= isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0 ?>
            </span>
        </p>
        <?php if ($isLoggedIn): ?>

            <button
                id="checkoutBtn"
                class="checkout <?= (empty($_SESSION['cart']) && empty($_SESSION['accessoriesCart'])) ? 'disabled' : '' ?>"
                onclick="checkout()"
                <?= (empty($_SESSION['cart']) && empty($_SESSION['accessoriesCart'])) ? 'disabled' : '' ?>>
                Checkout
            </button>

        <?php else: ?>


                <p class="login-warning">Please <a href="login.php">log in</a> before checking out.</p>
                <button
                    id="checkoutBtn"
                    class="checkout disabled"
                    disabled>
                    Checkout
                </button>

        <?php endif; ?>
        <button class="clear-cart" onclick="clearCart()">
            Clear Cart
        </button>
    </div>
        
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
    <script>
        function clearCart() {
            fetch('clearCart.php')
                .then(response => response.text())
                .then(() => {

                    document.querySelectorAll('.cart-product').forEach(product => {
                        product.remove();
                    });

                    document.getElementById('bottleCount').textContent = '0';
                    document.getElementById('accessoriesCount').textContent = '0';


                    const checkoutBtn = document.getElementById('checkoutBtn');
                    checkoutBtn.disabled = true;
                    checkoutBtn.classList.add('disabled');

                })
                .catch(error => console.error(error));
        }
        function removeItem(index, type) {
            fetch('removeItem.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'index=' + index + '&type=' + type
            })
            .then(response => response.text())
            .then(() => {
                location.reload();
            });
        }
        function checkout() {
            fetch('checkout.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(() => {
                window.location.href = 'confirmOrder.php';
            })
            .catch(error => console.error(error));
        }
    </script>
</body>
</html>
