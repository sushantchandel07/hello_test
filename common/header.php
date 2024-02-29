<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bootstrapproject</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <style>
    .login a{
  color: white;
  text-decoration: none;
}
      .logout{
        color:white;
        background-color:;
        border:none;
        border-radius:3px;
        padding:5px 14px;
        background-color: rgb(56, 146, 187);
        font-size:18px;
      }
     
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">

  <?php
// session_start();
?>
<nav class="navbar">
      <div class="container-fluid">
      <div class="nav-logo">
        <a href="../index.php"><img src="../photos/logo.png" alt="Logo" /></a>
        </div>

          
          

          <!-- Desktop Navigation -->
        <div class="nav-center-list pt-2">
            <div class="nav-side-list-1 d-flex">
            <p class="Home font-size"><a href="../index.php">Home</a></p>
            <p class="About font-size"><a href="about.php">About Us</a></p>
            </div>
        </div>

        <div class="nav-side-list pt-2 ">
           <div class="nav-side-list-mobile d-flex">
           <?php
           if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
           echo "<div class='profile'>
           <i class='fa-solid fa-user pt-2'></i>
           <p class='profile font-size'><a href='profile.php'>Profile</a></p>
           </div>";
           }else{
                "";
           }
           ?>
           <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
         echo "<a href ='logout.php'><button class = 'logout'>logout</button> </a>";
          } else {
          echo "<div class='d-flex profile-2'>
          <p class='login font-size border-info p-2 rounded text-white'>
          <a href='Login.php'>Login</a>
          </p>
          <p class='signup font-size border-info p-2 bg-primary rounded text-white'>
          <a href='signup.php'>Signup</a>
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
              <a class="nav-link active text-light fs-1 fd-bold" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-light fs-4 text-opacity-50" href="about.php">About</a>
          </li>
          <?php
           if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
           echo "<div class='profile'>
           <i class='fa-solid fa-user pt-2'></i>
           <p class='profile font-size'><a href='profile.php'>Profile</a></p>
           </div>";
           }else{
                "";
           }
           ?>
          <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
         echo "<a href ='logout.php'><button class = 'logout'>logout</button> </a>";
          } else {
          echo "<div class='d-flex profile-2'>
          <p class='login font-size border-info p-2 rounded text-white'>
          <a href='Login.php'>Login</a>
          </p>
          <p class='signup font-size border-info p-2 bg-primary rounded text-white'>
          <a href='signup.php'>Signup</a>
          </p>
          </div>";
          }
        ?>
      </ul>
  </div>
</div>

      </div>
  </nav>
