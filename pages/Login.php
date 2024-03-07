<?php 
require "../controllers/controller.login.php";
?>
<div class="section d-flex">
    <div class="section-image">
        <img class="section-image-1" src="../photos/Illustration.png" />
    </div>
    <form method="POST">
        <div class="form-container">
            <div class="form heading">
                <div class="form-heading">
                    <h3>Login to your account</h3>
                </div>
                <br />
            </div>
            <div class="form">
                <div class="form-group position-relative">
                    <label for="email">E-mail</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Your E-mail"
                        name="email"
                        value="<?php echo htmlspecialchars($email); ?>"
                    />
                    <span class="text-danger"><?php echo $emailErr?></span>
                    <span class="error"><?php echo  $loginerror; ?></span>
                </div>
                <br/>
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Your Password"
                        name="password"
                        value="<?php echo htmlspecialchars($password); ?>"
                    />
                    <span class="eye-icon" style="position:absolute; right:10px; top:50%;  cursor:pointer;" onclick="togglePassword('password', 'eye-icon')">
                        <i class="far fa-eye"></i>
                    </span>
                    <span class="text-danger"><?php echo $passwordErr?></span>
                    <span class="text-danger"><?php echo $wrongpassword ? "<p>$wrongpassword</p>":"" ?></span>
                </div>
                <br />
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" />
                    <div class="d-flex justify-content-between">
                        <label class="form-check-label" for="rememberMe"
                        >Remember me</label
                        >
                        <a href="forgetpassowrd.php">Forget-Password</a>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <input type="submit" class="button-1 btn-primary text-center" name="login" value="login">
                </div>
                <br />
                <div>
                    Don't have an account ?
                    <span><a href="signup.php">Signup</a></span>
                </div>
            </div>
        </div>
    </form>
</div>

<!--footer-->
<?php include "../common/footer.php" ?>
<script>
    function togglePassword(passwordFieldId, eyeIconId) {
        let passwordInput = document.getElementById(passwordFieldId);
        let eyeIcon = document.querySelector('.' + eyeIconId + ' i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.className = 'far fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            eyeIcon.className = 'far fa-eye';
        }
    }
</script>

