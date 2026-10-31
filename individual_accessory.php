<?php include 'db.php';
session_start();

$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;
$id = $_GET['id'];

$sql = "SELECT * FROM accessories WHERE accessoriesID = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ace Login</title>
        <link rel="stylesheet" href="css/individual_accesssory.css">
    <link rel="stylesheet" href="css/main.css">
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

    <div class = "accessory-container"> 
        
        <div class = "product-image-container">
           <img src = "<?php echo $row['accessoriesImage']; ?>"
                alt = "<?php echo $row['accessoriesName']; ?>"
                class = "accessory-image">
        </div>

        <div class = "product-details">
           <h1 class = "accessory-name"><?php echo $row['accessoriesName']; ?></h1>

           <div class = "individual-price">Rs <?php echo $row['accessoriesPrice']; ?></div>
           <div id="cartMessage" class="cart-message">
              ✓ Added to cart!
          </div>
           <button class="addCart">Add to Cart</button>
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
  function addToCart() {
    console.log("Add to cart clicked");

    fetch('addAccessoriesToCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            accessoriesID: <?= (int)$row['accessoriesID'] ?>
        })
    })
    .then(response => response.text())
    .then(data => {

        const count = document.getElementById('cartCount');
        count.textContent = parseInt(count.textContent) + 1;

        console.log(data);

        const message = document.getElementById('cartMessage');
        message.classList.add('show');

        setTimeout(() => {
            message.classList.remove('show');
        }, 2000);

    })
    .catch(error => console.error(error));
}

document.querySelector('.addCart').addEventListener('click', addToCart);

</script>
 <script src="javascript/main.js"></script>

</body>
</html>