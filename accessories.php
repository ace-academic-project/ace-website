<?php include 'db.php';
session_start();

$bottleCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$accessoriesCount = isset($_SESSION['accessoriesCart']) ? count($_SESSION['accessoriesCart']) : 0;

$totalCartItems = $bottleCount + $accessoriesCount;
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
}
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page == 2) {
  $sql = "SELECT * FROM accessories ORDER BY accessoriesID DESC LIMIT 2";
}else {
  $sql = "SELECT * FROM accessories ORDER BY accessoriesID ASC LIMIT 8";
}

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ace Login</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/accessories.css">
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


    <h2 class = "accessories-heading">Accessories Shop</h2>

    <div class="accessories-box">
        <?php 

        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
        ?>
                <div class="bottle-accessories">
                    <img src="<?php echo $item['accessoriesImage']; ?>" alt="<?php echo $item['accessoriesName']; ?>">

                    <br>
                    <h4 class = "accessories-name"><?php echo $item['accessoriesName']; ?></h4>
                    <br>
                    
                    <span class = "accessories-price">Rs <?php echo $item['accessoriesPrice']; ?></span>
                    <br>
                
                    <a class = "view-accessories" href="individual_accessory.php?id=<?php echo $item['accessoriesID']; ?>">View Product</a>
                </div>
        <?php 
            } 
        }
        
        $conn->close();
        ?>    
      
</div>

     <?php


     $btn1_class = "page-btn";
     $btn2_class = "page-btn";

     if ($page == 1){
        $btn1_class = "page-btn active";
     }elseif ($page == 2){
         $btn2_class = "page-btn active";
     }
     ?>

     <div class="pagination-buttons">
         <a href= "accessories.php?page=1" class="<?php echo $btn1_class; ?>">1</a>
         <a href= "accessories.php?page=2" class="<?php echo $btn2_class; ?>">2</a>
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

 <script src="javascript/main.js"></script>
</body>
</html>