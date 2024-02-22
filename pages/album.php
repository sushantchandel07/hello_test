
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrapproject</title>
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





    <div class="album-section-image">
      <img src="../photos/Rectangle 619.png " alt="Image" width="100%" />
    </div>

    <div class="profile-content-1 d-flex justify-content-evenly flex-wrap">
      <div class="profile-para">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quos
          maiores quia ullam<br />
          maxime eligendi ipsam aliquam totam at. Consequatur. Lorem ipsum dolor
          sit amet.
        </p>
      </div>
      <div class="prodfile-para">
      <a href="profile.php"><button class="profile-button m-2">
          Profile
        </button></a>
        <a href="album.php"><button class="profile-button m-2">
         Images
        </button></a>
        <a href="addalbum.php"><button class="profile-button m-2">
         Album
        </button></a>
      </div>
    </div>
    <hr />

    <div>
      <div class="container-fluid">
        <div class="first-album d-flex justify-content-center text-center">
          <div class="first-album-image">
            <img class="album-img" src="../photos/Rectangle 516 (4).png" />
            <h3>King of the road</h3>
          </div>
          <div class="first-album-image">
            <img class="album-img" src="../photos/Rectangle 516 (5).png" />
            <h3>Ego Trippin</h3>
          </div>
          <div class="first-album-image">
            <img
              class="album-img"
              src="../photos/Rectangle 516 (6).png"
              alt="Image"
            />
            <h3>Eliminator</h3>
          </div>
        </div>
        <div class="second-album d-flex justify-content-center text-center">
          <div class="first-album-image">
            <img class="album-img" src="../photos/Rectangle 623.png" />
            <h3>Nostagia, ultra</h3>
          </div>
          <div class="first-album-image">
            <img class="album-img" src="../photos/Rectangle 624.png" />
            <h3>Red River Rock</h3>
          </div>
          <div class="first-album-image">
            <img class="album-img" src="../photos/Rectangle 625.png" alt="" />
            <h3>Autobahn</h3>
          </div>
        </div>
      </div>
    </div>





    <?php include "../common/footer.php" ?>


  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
  ></script>
</html>
