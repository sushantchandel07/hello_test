<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
/>
    <link rel="stylesheet" href="../css/style.css"/>

<div class="section d-flex pt-5">
    <div class="section-image ">
        <img class="section-image-1" src="../photos/Rectangle.png" />
    </div>
    
    <form method="post" action="password-reset-code.php">
    <input name="password_token" class="d-none" value = "<?php if(isset($_GET['token'])){echo $_GET[ 'token'];}?>"/>
        <div class="form-container ">
            <div class="form heading">
                <div class="form-heading">
                    <h3>Reset-Password</h3>
                </div>
                <br />
            </div>
            <div class="form">
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
                    <button class="button-1 btn-primary" name="password_update" type="submit">Submit</button>
                </div>
                <br />
            </div>
        </div>
    </form>
</div>
</body>
</html>
