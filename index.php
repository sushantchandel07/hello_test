<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bootstrapproject</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  

  <nav class="navbar">
      <div class="container navbar-contain">
      <div class="nav-logo">
        <a href="../index.php"><img src="photos/logo.png" alt="Logo" /></a>
        </div>

          
          

          <!-- Desktop Navigation -->
        <div class="nav-center-list pt-2">
            <div class="nav-side-list-1 d-flex">
            <p class="Home font-size"><a href="index.php">Home</a></p>
            <p class="About font-size"><a href="pages/about.php">About Us</a></p>
            </div>
        </div>

        <div class="nav-side-list pt-2 ">
           <div class="nav-side-list-mobile d-flex">
           <?php
           if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
           echo "<div class='profile'>
           <i class='fa-solid fa-user pt-2'></i>
           <p class='profile font-size'><a href='pages/profile.php'>Profile</a></p>
           </div>";
           }else{
                "";
           }
           ?>
           <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
         echo "<a href ='pages/logout.php'><button class = 'logout'>logout</button> </a>";
          } else {
          echo "<div class='d-flex profile-2'>
          <p class='login font-size border-info p-2 rounded text-white'>
          <a href='pages/Login.php'>Login</a>
          </p>
          <p class='signup font-size border-info p-2 bg-primary rounded text-white'>
          <a href='pages/signup.php'>Signup</a>
          </p>
          </div>";
          }
        ?>

              
           </div>
          </div>

          <!-- Mobile Navigation -->
        <!-- Toggle Button for Mobile -->
<button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<!-- Mobile Navigation -->
<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
  <div class="offcanvas-header">
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
              <a class="nav-link active text-light fs-1 fd-bold" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light fs-4 text-opacity-50" href="pages/about.php">About</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light fs-4 text-opacity-50" href="pages/profile.php">Profile</a>
          </li>
          <li class="nav-item"> 
              <a class="nav-link text-light fs-4 text-opacity-50" href="pages/Login.php">Login</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light fs-5 text-opacity-50" href="pages/signup.php">Signup</a>
          </li>
      </ul>
  </div>
</div>

      </div>
  </nav>

    <img
      class="main-img"
      src="photos/Group 1597882539.png"
      alt="Background Image"
    />
    <img
      class="secondary-img"
      src="photos/4-2-car-png-hd 1.png"
      alt="Secondary Image"
    />
    <div class="content-overlay">
      <div class="header-content">
        <h1 class="header-heading">Purchase and Sale of Pre-Owned Cars</h1>
        <p>
          Are you looking for amazing pre-owned cars parchaseand sale service?
          Don't worry! we got it for you
        </p>
        <button class="header-button">
          <a href="pages/signup.php">Buy a car</a>
        </button>
      </div>
      <div>
        <h3 class="text-primary pt-3">Trade or sale your car now</h3>
      </div>
    </div>

    <div class="card-line-first">
      <div class="first-cards-heading text-center">
        <h2>Reason to Buy/Sell a Car</h2>
      </div>
      <div class="card-container d-flex justify-content-center flex-wrap">
        <div class="card-1">
          <img
            src="./photos/Group 1099 (1).png"
            class="row-card-1 card-img-top"
            alt="..."
          />
          <div class="card-body-1">
            <p>
              3 Month warranty on any mechanical issue which you can extend to
              12 month for and extra money
            </p>
          </div>
        </div>
        <div class="card-1">
          <img
            src="./photos/Rectangle 519.png"
            class="row-card-1 card-img-top"
            alt="..."
          />
          <div class="card-body-1">
            <p>
              You don't have to deal diractly with Seller but through CarSafe
            </p>
          </div>
        </div>
        <div class="card-1">
          <img
            src="./photos/Rectangle 519 (1).png"
            class="row-card-1 card-img-top"
            alt="..."
          />
          <div class="card-body-1">
            <p>Pre apply to a cridit to pay for the car</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card-line-second">
      <div class="second-cards-heading text-center">
        <h2>Our featured cars for you!</h2>
      </div>
      <div class="card-container d-flex justify-content-center flex-wrap">
        <div class="card-2">
          <img
            src="./photos/Rectangle 623.png"
            class="row-card-2 card-img-top"
            alt="..."
          />
          <div class="card-body-2 mt-4">
            <h5>Honda Accord EXL</h5>
            <p class="card-text-2">2015-105,360 Km - Monterey<br /></p>
            <p class="crad-2-price">
              $256,999 &nbsp;&nbsp;<span class="card-old-price">$347,999</span>
            </p>
          </div>
        </div>
        <div class="card-2">
          <img
            src="./photos/Rectangle 624.png"
            class="row-card-2 card-img-top"
            alt="..."
          />
          <div class="card-body-2 mt-4">
            <h5>Honda Accord EXL</h5>
            <p class="card-text-2">2015-105,360 Km - Monterey<br /></p>
            <p class="crad-2-price">
              $256,999 &nbsp;&nbsp;<span class="card-old-price">$347,999</span>
            </p>
          </div>
        </div>
        <div class="card-2">
          <img
            src="./photos/Rectangle 625.png"
            class="row-card-2 card-img-top"
            alt="..."
          />
          <div class="card-body-2 mt-4">
            <h5>Honda Accord EXL</h5>
            <p class="card-text-2">2015-105,360 Km - Monterey<br /></p>
            <p class="crad-2-price">
              $256,999 &nbsp;&nbsp;<span class="card-old-price">$347,999</span>
            </p>
          </div>
        </div>
        <div class="card-2">
          <img
            src="./photos/Rectangle 625.png"
            class="row-card-2 card-img-top"
            alt="..."
          />
          <div class="card-body-2 mt-4">
            <h5>Honda Accord EXL</h5>
            <p class="card-text-2">2015-105,360 Km - Monterey<br /></p>

            <p class="crad-2-price">
              $256,999 &nbsp;&nbsp;<span class="card-old-price">$347,999</span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="card-line-third">
      <div class="third-cards-heading text-center">
        <h2>
          High Quality Output, <br />
          Awesome service
        </h2>
      </div>

      <div class="card-container d-flex justify-content-center flex-wrap">
        <div class="third-card-background-div"></div>
        <div class="card-3">
          <img
            src="./photos/Group 453.png"
            class="row-card-3 card-img-top"
            alt="..."
          />
          <div class="card-body-3 text-center">
            <h3 class="text-primary">Buy a used car</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, quo.
            </p>
          </div>
        </div>
        <div class="card-3">
          <img
            src="./photos/Group 454.png"
            class="row-card-3 card-img-top"
            alt="..."
          />
          <div class="card-body-3 text-center">
            <h3 class="text-primary">Sell a used car</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, quo.
            </p>
          </div>
        </div>
        <div class="card-3">
          <img
            src="./photos/Group 453.png"
            class="row-card-3 card-img-top"
            alt="..."
          />
          <div class="card-body-3 text-center">
            <h3 class="text-primary">Change a used car</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, quo.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="last-block d-flex justify-content-evenly flex-wrap">
      <div class="last-left-block">
        <div class="last-heading">
          <h2>
            Manage your Purchase<br />
            sale of pre-owned cars<br />with our app
          </h2>
        </div>
        <br />
        <div class="last-paragraph">
          <div class="d-flex">
            <img class="last-correct-icon" src="photos/Vector.svg" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam,
              veritatis!<br />
              Quibusdam, at? Corporis facere quidem distinctio quaerat dolorum
              alias dicta?
            </p>
          </div>
          <br />
          <div class="d-flex">
            <img class="last-correct-icon" src="photos/Vector.svg" />
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam,
              veritatis! <br />Quibusdam, at? Corporis facere quidem distinctio
              quaerat dolorum alias dicta?
            </p>
          </div>
          <br />
          <div class="d-flex">
            <img class="last-correct-icon" src="photos/Vector.svg" />
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          </div>
          <br />
          <div>
            <button class="btn last-button" type="submit">
              Get to Know the car
            </button>
          </div>
        </div>
      </div>
      <div class="last-right-block">
        <div class="right-block-image">
          <div>
            <img src="photos/Group 1099.png" />
          </div>
        </div>
      </div>
    </div>

    <footer class="footer mt-5">
      <div class="container">
        <div class="row justify-content-evenly">
          <div class="col-md-4">
            <div class="footer-left-side">
              <img src="photos/Group 47.png" />
              <p>
                2024 Lorem ipsum, dolor sit amet <br />
                consectetur adipisicing.
              </p>
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                <div class="quick-links">
                  <h4>Quick-links</h4>
                  <p>Home</p>
                  <p>About Us</p>
                  <p>Buy a car</p>
                  <p>Sell a car</p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="social-link">
                  <h4>Follow Us</h4>
                  <div class="social-list">
                    <div class="facebook">
                      <i class="fab fa-facebook" style="color: #45aaf7"></i>
                      <span>Facebook</span>
                    </div>
                    <br />
                    <div class="twitter">
                      <i class="fab fa-twitter" style="color: #6daada"></i>
                      <span>Twitter</span>
                    </div>
                    <br />
                    <div class="instagram">
                      <i class="fab fa-instagram" style="color: #67b2eb"></i>
                      <span>Instagram</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="contacts">
                  <h4>Contact Us</h4>
                  <p>2024 Lorem ipsum dolor sit amet consectetur. 19494</p>
                  <p>example2024@gmail.com</p>
                  <p>9876-87-8765</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>
