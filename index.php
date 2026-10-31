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
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/ace.css">
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

    <div id = "slideshow">
        <img id = "slide" src = "Assets/Images/image1(1).png" alt = "Slideshow Image">
        <button class="previous-btn" onclick="prevSlide()">&#10094;</button>
        <button class="next-btn" onclick="nextSlide()">&#10095;</button>
    </div>

    <div class="product-heading-container">
      <h4 class = "product-heading">Choose Your Style</h4>
   </div>
   <div class = "bottles-imgs">
    <div class="first-bottle">
        <img src="Assets/Images/bottle_colours/personalised_1.png" alt = "purple bottle"
        class = "bottle-boxx">
    </div>
    <div class="second-bottle">
        <img src="Assets/Images/bottle_colours/personalised_2.png" alt = "purple bottle"
        class = "bottle-boxx">
    </div>
    <div class="third-bottle">
        <img src="Assets/Images/bottle_colours/personalised_3.png" alt = "purple bottle"
        class = "bottle-boxx">
    </div>
    </div>

    <div class = "steps-rectangle">
        <div> <img src = "Assets/Images/steps.jpeg" alt = "steps image" class = "image-steps">
        </div>

        <div class = "steps-content">
            <h2 class="steps-heading">How It Works</h2>
            <ol class = "steps">

                <li class = "stepnum">Step 1: Choose your bottle that you like and its colour.</li>
                <li class = "stepnum">Step 2: Choose your cap that you like and its colour.</li>
                <li class = "stepnum">Step 3: Choose an icon that you want engraved in the bottle .</li>
            </ol>
        </div>

    </div>
    <div class = "getstarted-rectangle">
        <img src="Assets/Images/secondimage.jpg" alt="" 
         class="getstarted-image"> 
        <div class = "getstarted-content">
            <h1 class = "getstarted">Personalise<br>Now<br></h1>
            <a href = "personalise.php" class = "clickable-link">
            <div class = "click-here">Click Here</div>
            </a>
        </div>
    </div>


  <div class="faq-box">
    <div class="faq-container">
        <h2 class="product-heading faq-header"> FAQs (Frequently Asked Questions)</h2>
    <div class="faq-list">

      <div class="faq-item">
        <div class="faq-question">
          <span>Do Ace bottles have warranty?</span>
          <span class = "faq-dropdown">&#9662;</span>
        </div>
        <div class="faq-answer">
          <div class="faq-answer-content">
            <p>Yes! Ace does provide warranty for 2 months. You can visit our store at Bagatelle, Tribeca or Cascavelle mall
              for any inquiries. However, the warranty excludes damage caused by physical impact.
            </p>
          </div>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <span>Can I put other beverages in there besides water?</span>
          <span class = "faq-dropdown">&#9662;</span>
        </div>
        <div class="faq-answer">
          <div class="faq-answer-content">
            <p>Yes! You can use your bottle for juice, sports drinks, or tea. However, carbonated drinks or perishable liquids should not be kept in sealed containers for extended periods.</p>
          </div>
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <span>Can I buy additional accesories to customise my water bottle?</span>
          <span class = "faq-dropdown">&#9662;</span>
        </div>
        <div class="faq-answer">
          <div class="faq-answer-content">
            <p>Yes! You can buy additional accessories to customise the water bottle in whatever way you like.</p>
          </div>
        </div>
      </div>

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
        <script src="javascript/main.js"></script>
        <script src = "javascript/ace.js"></script>
</body>
</html>