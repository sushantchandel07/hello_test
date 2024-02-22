<?php 
require "../common/database.php";

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bootstrapproject</title>
    <style>
      .error{
        color:red;
      }
      .important{
       color: red;
      }
      </style>
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
  </head>
  <body class="d-flex flex-column min-vh-100">
   

<!--header-->
  <?php include "../common/header.php" ?>

  <!--main section-->

    <div class="section d-flex">
      <div class="section-image">
        <img class="section-image-1" src="../photos/Rectangle.png" />
      </div>
      <form method="post"  action="password-reset-code.php">
      <div class="form-container ">
        <div class="form heading">
          <div class="form-heading">
            <h3>Forget-Password</h3>
          </div>
          <br />
        </div>
        <div class="form">
          <div class="form-group">
            <label for="email">E-mail<span class="important">*</span></label>
            <input
           
            type="text"
              class="form-control"
              id="email"
              placeholder="Your E-mail"
              name="email"
            />
            <span class="error"><?php echo $emailErr;?></span>
          </div>
          <br/>
  
         
          <div class="form-group">
            <button class="button-1 btn-primary" type="submit" name="reset-password">submit</button>
          </div>
          <br />
        </div>
      </div>
  </form>
    </div>


    <?php include "../common/footer.php" ?>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>
