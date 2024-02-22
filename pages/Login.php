<?php
session_start(); 
$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    if (empty($_POST["email"])) {
        $emailErr ="Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST['password']);
    }
}

require "../common/database.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    require "../common/database.php";
    if (!$conn) {
        die('Connection Failed' . mysqli_error());
    }

    $sql = "SELECT * FROM userdata WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['userid'] = $user['id'];
            
           

            header("Location: profile.php");
        } else {
            $wrongpassword = "Wrong password";
        }
    } else {
        $loginerror = "User not found"; 
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}
?>



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
        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            cursor: pointer;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!--header -->
<?php include "../common/header.php" ?>
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
                </div>
                <br />
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Your Password"
                        name="password"
                    />
                    <span class="eye-icon" onclick="togglePassword('password', 'eye-icon')">
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
</body>
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
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
></script>
</html>
