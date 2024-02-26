<?php 
require "../common/database.php";
?>

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





    