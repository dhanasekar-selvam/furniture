<?php
include("./header/header.php");
include("../db/db.php");
?>

<body>
    <?php
    if (isset($_POST['login-submit'])) {
        $email = $_POST['email'];
        $password = $_POST['login']['password'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);


        if ($row['email'] == $email && $row['password'] == $password) {

            $_SESSION['email'] = $email;

            echo '<script>
            toastr.success("Login successfully");
            </script>';
            if ($row['usrtype'] == 'admin') {
                header("Location: admin/index.php");
            } else if ($row['usrtype'] == 'user') {
                header("Location: user/index.php");
            }
    ?>
            <script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 2000);
            </script>
    <?php
        } else {
            echo '<script>
            toastr.error("Invalid Credentials");
            </script>';
        }
    }

    ?>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="">
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required="" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="login[password]" required="" placeholder="*********">
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                    </div><a class="link" href="forgot_password.php">Forgot password?</a>
                                    <div class="text-end mt-4">
                                        <button class="btn btn-primary btn-block w-100" type="submit" name="login-submit">Sign in</button>
                                    </div>
                                </div>

                                <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="signup.php">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include("./header/script.php");
        ?>
    </div>
</body>

</html>