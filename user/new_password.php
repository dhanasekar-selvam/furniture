<?php
session_start();
include("./header/header.php");
include("../db/db.php");
?>

<body>
    <?php
    if (isset($_POST['reset-password'])) {
        if ($_POST['login']['password'] == '' || $_POST['cpassword'] == '') {
            echo '<script>
                toastr.error("Please enter your password", "Error");
                </script>';
        } else {
            if ($_POST['login']['password'] == $_POST['cpassword']) {
                $sql = "UPDATE users SET password='" . $_POST['login']['password'] . "' WHERE email='" . $_SESSION['email'] . "'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<script>
                        toastr.success("Password reset successfully");
                        </script>';
                    unset($_SESSION['email']);
                    unset($_SESSION['otp']);

    ?>
                    <script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 2000);
                    </script>
    <?php
                } else {
                    echo '<script>
                            toastr.error("Password reset failed");
                            </script>';
                }
            } else {
                echo '<script>
                        toastr.error("Password not match");
                        </script>';
            }
        }
    }


    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="../assets/images/customimg/furniture1.jpeg" alt="looginpage"></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/customimg/furniture_logo_default.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="post" action="">
                                <h4>Reset Your Password</h4>

                                <h6 class="mt-4">Create Your Password</h6>
                                <div class="form-group">
                                    <label class="col-form-label">New Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="login[password]" required="" placeholder="*********" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ?  $_POST['login']['password'] : '' ?>">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Retype Password</label>
                                    <input class="form-control" type="password" name="cpassword" required="" placeholder="*********" value="<?php echo $_SERVER['REQUEST_METHOD'] === 'POST' ?  $_POST['cpassword'] : '' ?>">

                                </div>
                                <div class="form-group mb-0">

                                    <button class="btn btn-primary btn-block w-100" type="submit" name="reset-password">Reset Password </button>
                                </div>
                                <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2" href="login.php">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include('./header/script.php');
    ?>
</body>

</html>