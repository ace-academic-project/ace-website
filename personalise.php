<?php
include 'db.php';
session_start();

$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ace Login</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/personalise.css">
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
<div class = "personalisation-page">
    <div class="product-display">
        <div class="bottle-display">
        <?php
$result = $conn->query("SELECT colourImage, colour FROM bottle_colours WHERE colourId = 1");
$row = $result->fetch_assoc();
?>
        <img id="bottleImage" src="<?php echo $row['colourImage']; ?>" alt="Bottle">
    </div>
    <div class="cap-display">
        <?php
$result = $conn->query("SELECT capImage, capColour FROM caps WHERE capId = 1");
$row = $result->fetch_assoc();
?>
        <img id="capImage" src="<?php echo $row['capImage']; ?>" alt="Cap">
    </div>
    <div class="icon-display">
            <img id="bottleIcon" src="" alt="Selected Icon">
    </div>
    </div>
    
    
    
    <div class="personalise-box">
        <h2>Personalise Your Water Bottle</h2>
        <p>1. Choose your preferred bottle color and design:</p>

        <div class="design-buttons">
            <?php
                $result = $conn->query("SELECT * FROM bottle_colours");

                while ($row = $result->fetch_assoc()) {
                    echo '
                        
                        <button class="colour-btn" data-id="' . $row['colourID'] . '">
                        <span class="colourCircle"
                        style="background-color:' . strtolower($row['colour']) . ';"></span>
                        <span class="colour-text">' . htmlspecialchars($row['colour']) . '</span>
                        </button>
                        ';
                }
            ?>
        </div>
        <p>2. Choose your cap color:</p>

        <div class="design-buttons">
            <?php
                $result = $conn->query("SELECT * FROM caps");

                while ($row = $result->fetch_assoc()) {
                    echo '
                        <button class="cap-btn" data-id="' . $row['capID'] . '">
                        <span class="colourCircle"
                        style="background-color:' . strtolower($row['capColour']) . ';"></span>
                        <span class="colour-text">' . htmlspecialchars($row['capColour']) . '</span>
                        </button>
                        ';
                }
            ?>
        </div>
        <p>3. Choose your preferred icon:</p>
        <div class="design-buttons">
            <button class="icon-btn" data-id="0">
                <p>None</p>
            </button>
            <?php
                $result = $conn->query("SELECT * FROM icons");

            while($row = $result->fetch_assoc()) {
            ?>
            <button class="icon-btn" data-id="<?= $row['iconID'] ?>">
                <img src="<?= $row['iconImage'] ?>" alt="<?= $row['iconName'] ?>">
            </button>
            <?php
            }
            ?>
        </div>
        <div class="price-cart">
            <p class="price">Price: Rs <span id="totalPrice">800</span></p>
            <div id="cartMessage" class="cart-message">
              ✓ Added to cart!
          </div>
            <button class="addCart">Add to Cart</button>
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
        let bottlePrice = 800;
        let iconPrice = 0;
        let capPrice = 0;
        let selectedBottleID = 1;
        let selectedCapID = 1;
        let selectedIconID = 0;
        function updateTotalPrice() {
            const total = bottlePrice + iconPrice + capPrice;
            document.getElementById('totalPrice').textContent = total;
        }
        function selectedIcon(iconID) {

            if (iconID == 0) {
                document.getElementById('bottleIcon').style.display = 'none';
                iconPrice = 0;
                selectedIconID = 0;
                updateTotalPrice();
                return;
            }
            selectedIconID = iconID;

            fetch(`getIcon.php?id=${iconID}`)
                .then(response => response.json())
                .then(data => {

                    const bottleIcon = document.getElementById('bottleIcon');

                    bottleIcon.src = data.iconImage;
                    bottleIcon.style.display = 'block';

                    iconPrice = parseInt(data.Price);
                    

                    updateTotalPrice();
            })
            .catch(error => console.error(error));
        }
        document.querySelectorAll('.icon-btn').forEach(button => {
            button.addEventListener('click', () => {
                selectedIcon(button.dataset.id);
            });
        });
        function selectedColour(colourID) {
            selectedBottleID = colourID;
            fetch(`getColour.php?id=${colourID}`)
                .then(response => response.json())
                .then(data => {

                    const colourImage = data.colourImage;
                    const price = data.Price;

                    document.getElementById('bottleImage').src = colourImage;
                    bottlePrice = price;
                    

                    updateTotalPrice();
                })
                
        .catch(error => console.error(error));
        }
        document.querySelectorAll('.colour-btn').forEach(button => {
            button.addEventListener('click', () => {
                selectedColour(button.dataset.id);
            });
        });
        function selectedCap(capID) {
            selectedCapID = capID;
            fetch(`getCap.php?id=${capID}`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById('capImage').src = data.capImage;
                    capPrice = parseInt(data.Price);
                    

                    updateTotalPrice();
                });
        }
        document.querySelectorAll('.cap-btn').forEach(button => {
            button.addEventListener('click', () => {
                selectedCap(button.dataset.id)
            });
        });
        function addToCart() {
            fetch('addBottleToCart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    colourID: selectedBottleID,
                    capID: selectedCapID,
                    iconID: selectedIconID,
                    price: bottlePrice + capPrice + iconPrice
                })
            })
            .then(response => response.text())
            .then(() => {

                const count = document.getElementById('cartCount');
                count.textContent = parseInt(count.textContent) + 1;

                const message = document.getElementById('cartMessage');
                message.classList.add('show');

                setTimeout(() => {
                    message.classList.remove('show');
                }, 2000);

            })
        }
        document.querySelector('.addCart').addEventListener('click', addToCart);

        document.querySelectorAll('.icon-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document
                    .querySelectorAll('.icon-btn')
                    .forEach(b => b.classList.remove('selected'));

                btn.classList.add('selected');
            });
        });

        document.querySelectorAll('.cap-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document
                    .querySelectorAll('.cap-btn')
                    .forEach(b => b.classList.remove('selected'));

                btn.classList.add('selected');
            });
        });

        document.querySelectorAll('.colour-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document
                    .querySelectorAll('.colour-btn')
                    .forEach(b => b.classList.remove('selected'));

                btn.classList.add('selected');
            });
        });

    </script>
    </body>
</html> 