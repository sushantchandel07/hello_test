
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

<!--main section-->
<div class="section d-flex pt-5">
    <div class="section-image ">
        <img class="section-image-1" src="../photos/Rectangle.png" />
    </div>
    <input name="password_token" class="d-none" value = "<?php if(isset($_GET['token'])){echo $_GET[ 'token'];}?>"/>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-container ">
            <div class="form heading">
                <div class="form-heading">
                    <h3>Reset-Password</h3>
                </div>
                <br />
            </div>
            <div class="form">
                <div class="form-group position-relative">
                    <label for="password"><span class="important"></span>Email</label>
                    <input
                        
                        class="form-control"
                        id="password"
                        placeholder="Email"
                        name="email"
                        value = "<?php  if(isset($_GET['email'])){echo $_GET[ 'email'];}?>"
                    />
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
                <br/>
                <div class="form-group position-relative">
                    <label for="password"><span class="important"></span>Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="new-password"
                        name="new_password"
                        
                    />
                    <span class="error"><?php echo $passwordErr; ?></span>
                    <br>
                </div>
                <div class="form-group position-relative">
                    <label for="password"><span class="important"></span>confirm Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="confirm-password"
                        name="confirm_password"
                       
                    />
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
                <br>

                <div class="form-group">
                    <button class="button-1 btn-primary" name="password" type="submit">Submit</button>
                </div>
                <br />
            </div>
        </div>
    </form>
</div>


<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
></script>
</body>
</html>
